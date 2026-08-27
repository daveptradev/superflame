<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audio;
use App\Models\AudioTrack;
use Illuminate\Support\Str;

class AudioController extends Controller
{
    /**
     * Helper to get target storage directory for audios
     */
    private function getUploadDirectory(string $subfolder = 'audio'): string
    {
        $hostingerPath = base_path('../public_html/storage/' . $subfolder);
        $localPath = public_path('storage/' . $subfolder);

        $path = file_exists(base_path('../public_html/storage')) ? $hostingerPath : $localPath;

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        return $path;
    }

    /**
     * Helper to delete file safely from storage
     */
    private function deleteStorageFile(?string $relativePath): void
    {
        if (!$relativePath) {
            return;
        }

        $hostingerFile = base_path('../public_html/storage/' . $relativePath);
        $localFile = public_path('storage/' . $relativePath);

        if (file_exists($hostingerFile)) {
            @unlink($hostingerFile);
        } elseif (file_exists($localFile)) {
            @unlink($localFile);
        }
    }

    // =========================
    // INDEX
    // =========================
    public function index()
    {
        try {
            $audios = Audio::with('tracks')->latest()->get();
        } catch (\Throwable $e) {
            $audios = collect();
            session()->flash('error', 'Tabel database "audios" belum ada di database Hostinger. Silakan jalankan query SQL di phpMyAdmin.');
        }

        return view('admin.audios.index', compact('audios'));
    }

    // =========================
    // CREATE
    // =========================
    public function create()
    {
        return view('admin.audios.create');
    }

    // =========================
    // STORE
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'artist'         => 'nullable|string|max:255',
            'category'       => 'nullable|string|max:100',
            'image'          => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'audio_url'      => 'nullable|string|max:500',
            'buy_url'        => 'nullable|string|max:500',
            'buy_label'      => 'nullable|string|max:100',
            'release_date'   => 'nullable|date',
            'description'    => 'nullable|string',
            'tracks.*'       => 'nullable|mimes:mp3,wav,ogg,flac,m4a,aac|max:51200',
            'track_titles.*' => 'nullable|string|max:255',
        ]);

        // 1. Upload Cover Image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio');
            $imageFile->move($destDir, $imageName);
            $imagePath = 'audio/' . $imageName;
        }

        // 2. Create Audio Main Record
        $audio = Audio::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'artist'       => $request->artist ?: 'SUPERFLAME',
            'category'     => strtoupper($request->category ?: 'TRACKS'),
            'description'  => $request->description,
            'image'        => $imagePath,
            'audio_url'    => $request->audio_url,
            'buy_url'      => $request->buy_url,
            'buy_label'    => $request->buy_label ?: 'Buy Now',
            'release_date' => $request->release_date,
        ]);

        // 3. Upload Multi-Tracks
        if ($request->hasFile('tracks')) {
            $trackFiles  = $request->file('tracks');
            $trackTitles = $request->input('track_titles', []);
            $trackDir    = $this->getUploadDirectory('audio/tracks');

            foreach ($trackFiles as $index => $trackFile) {
                if ($trackFile && $trackFile->isValid()) {
                    $originalName = pathinfo($trackFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $cleanTitle   = !empty($trackTitles[$index]) ? trim($trackTitles[$index]) : $originalName;

                    $trackFileName = time() . '_' . ($index + 1) . '_' . Str::slug($originalName) . '.' . $trackFile->getClientOriginalExtension();
                    $trackFile->move($trackDir, $trackFileName);

                    AudioTrack::create([
                        'audio_id'     => $audio->id,
                        'title'        => $cleanTitle,
                        'file_path'    => 'audio/tracks/' . $trackFileName,
                        'track_number' => $index + 1,
                    ]);
                }
            }
        }

        return redirect('/admin/audios')
            ->with('success', 'Audio release successfully added with tracks');
    }

    // =========================
    // EDIT
    // =========================
    public function edit(Audio $audio)
    {
        $audio->load('tracks');
        return view('admin.audios.edit', compact('audio'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, Audio $audio)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'artist'         => 'nullable|string|max:255',
            'category'       => 'nullable|string|max:100',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'audio_url'      => 'nullable|string|max:500',
            'buy_url'        => 'nullable|string|max:500',
            'buy_label'      => 'nullable|string|max:100',
            'release_date'   => 'nullable|date',
            'description'    => 'nullable|string',
            'tracks.*'       => 'nullable|mimes:mp3,wav,ogg,flac,m4a,aac|max:51200',
            'track_titles.*' => 'nullable|string|max:255',
            'existing_track_titles' => 'nullable|array',
        ]);

        // 1. Cover Image Update
        $imagePath = $audio->image;
        if ($request->hasFile('image')) {
            $this->deleteStorageFile($audio->image);

            $imageFile = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio');
            $imageFile->move($destDir, $imageName);
            $imagePath = 'audio/' . $imageName;
        }

        // 2. Update Main Record
        $audio->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . $audio->id,
            'artist'       => $request->artist ?: 'SUPERFLAME',
            'category'     => strtoupper($request->category ?: 'TRACKS'),
            'description'  => $request->description,
            'image'        => $imagePath,
            'audio_url'    => $request->audio_url,
            'buy_url'      => $request->buy_url,
            'buy_label'    => $request->buy_label ?: 'Buy Now',
            'release_date' => $request->release_date,
        ]);

        // 3. Update Existing Track Titles & Active Statuses
        if ($request->has('existing_track_titles')) {
            $activeStatuses = $request->input('existing_track_active', []);
            foreach ($request->input('existing_track_titles') as $trackId => $newTitle) {
                $isActive = isset($activeStatuses[$trackId]) ? true : false;
                AudioTrack::where('id', $trackId)
                    ->where('audio_id', $audio->id)
                    ->update([
                        'title'     => $newTitle,
                        'is_active' => $isActive,
                    ]);
            }
        }

        // 4. Upload Additional Tracks
        if ($request->hasFile('tracks')) {
            $trackFiles  = $request->file('tracks');
            $trackTitles = $request->input('track_titles', []);
            $trackDir    = $this->getUploadDirectory('audio/tracks');
            $currentMaxOrder = $audio->tracks()->max('track_number') ?? 0;

            foreach ($trackFiles as $index => $trackFile) {
                if ($trackFile && $trackFile->isValid()) {
                    $originalName = pathinfo($trackFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $cleanTitle   = !empty($trackTitles[$index]) ? trim($trackTitles[$index]) : $originalName;

                    $trackFileName = time() . '_' . ($currentMaxOrder + $index + 1) . '_' . Str::slug($originalName) . '.' . $trackFile->getClientOriginalExtension();
                    $trackFile->move($trackDir, $trackFileName);

                    AudioTrack::create([
                        'audio_id'     => $audio->id,
                        'title'        => $cleanTitle,
                        'file_path'    => 'audio/tracks/' . $trackFileName,
                        'track_number' => $currentMaxOrder + $index + 1,
                        'is_active'    => true,
                    ]);
                }
            }
        }

        return redirect('/admin/audios')
            ->with('success', 'Audio updated successfully');
    }

    // =========================
    // TOGGLE TRACK ACTIVE/INACTIVE
    // =========================
    public function toggleTrackStatus(AudioTrack $track)
    {
        $track->is_active = !$track->is_active;
        $track->save();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success'   => true,
                'is_active' => $track->is_active,
                'message'   => $track->is_active ? 'Track activated' : 'Track disabled',
            ]);
        }

        return redirect()->back()
            ->with('success', 'Track status updated to ' . ($track->is_active ? 'Active (Visible)' : 'Disabled (Hidden)'));
    }

    // =========================
    // DELETE SINGLE TRACK
    // =========================
    public function deleteTrack(AudioTrack $track)
    {
        $audioId = $track->audio_id;
        $this->deleteStorageFile($track->file_path);
        $track->delete();

        return redirect()->back()
            ->with('success', 'Track removed successfully');
    }

    // =========================
    // DESTROY ALL
    // =========================
    public function destroy(Audio $audio)
    {
        // 1. Delete cover image
        $this->deleteStorageFile($audio->image);

        // 2. Delete all tracks files
        foreach ($audio->tracks as $track) {
            $this->deleteStorageFile($track->file_path);
            $track->delete();
        }

        // 3. Delete audio record
        $audio->delete();

        return redirect('/admin/audios')
            ->with('success', 'Audio release and all tracks deleted successfully');
    }
}
