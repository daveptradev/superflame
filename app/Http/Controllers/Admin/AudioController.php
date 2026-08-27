<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audio;
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
        $audios = Audio::latest()->get();

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
            'title'        => 'required|string|max:255',
            'artist'       => 'nullable|string|max:255',
            'category'     => 'nullable|string|max:100',
            'image'        => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'audio_url'    => 'nullable|string|max:500',
            'audio_file'   => 'nullable|mimes:mp3,wav,ogg,flac,m4a|max:25600',
            'buy_url'      => 'nullable|string|max:500',
            'buy_label'    => 'nullable|string|max:100',
            'release_date' => 'nullable|date',
            'description'  => 'nullable|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio');
            $imageFile->move($destDir, $imageName);
            $imagePath = 'audio/' . $imageName;
        }

        $audioFilePath = null;
        if ($request->hasFile('audio_file')) {
            $audioFile = $request->file('audio_file');
            $audioName = time() . '_' . Str::slug(pathinfo($audioFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $audioFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio/files');
            $audioFile->move($destDir, $audioName);
            $audioFilePath = 'audio/files/' . $audioName;
        }

        Audio::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'artist'       => $request->artist ?: 'SUPERFLAME',
            'category'     => strtoupper($request->category ?: 'TRACKS'),
            'description'  => $request->description,
            'image'        => $imagePath,
            'audio_url'    => $request->audio_url,
            'audio_file'   => $audioFilePath,
            'buy_url'      => $request->buy_url,
            'buy_label'    => $request->buy_label ?: 'Buy Now',
            'release_date' => $request->release_date,
        ]);

        return redirect('/admin/audios')
            ->with('success', 'Audio successfully added');
    }

    // =========================
    // EDIT
    // =========================
    public function edit(Audio $audio)
    {
        return view('admin.audios.edit', compact('audio'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, Audio $audio)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'artist'       => 'nullable|string|max:255',
            'category'     => 'nullable|string|max:100',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'audio_url'    => 'nullable|string|max:500',
            'audio_file'   => 'nullable|mimes:mp3,wav,ogg,flac,m4a|max:25600',
            'buy_url'      => 'nullable|string|max:500',
            'buy_label'    => 'nullable|string|max:100',
            'release_date' => 'nullable|date',
            'description'  => 'nullable|string',
        ]);

        $imagePath = $audio->image;
        if ($request->hasFile('image')) {
            $this->deleteStorageFile($audio->image);

            $imageFile = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio');
            $imageFile->move($destDir, $imageName);
            $imagePath = 'audio/' . $imageName;
        }

        $audioFilePath = $audio->audio_file;
        if ($request->hasFile('audio_file')) {
            $this->deleteStorageFile($audio->audio_file);

            $audioFile = $request->file('audio_file');
            $audioName = time() . '_' . Str::slug(pathinfo($audioFile->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $audioFile->getClientOriginalExtension();
            $destDir   = $this->getUploadDirectory('audio/files');
            $audioFile->move($destDir, $audioName);
            $audioFilePath = 'audio/files/' . $audioName;
        }

        $audio->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . $audio->id,
            'artist'       => $request->artist ?: 'SUPERFLAME',
            'category'     => strtoupper($request->category ?: 'TRACKS'),
            'description'  => $request->description,
            'image'        => $imagePath,
            'audio_url'    => $request->audio_url,
            'audio_file'   => $audioFilePath,
            'buy_url'      => $request->buy_url,
            'buy_label'    => $request->buy_label ?: 'Buy Now',
            'release_date' => $request->release_date,
        ]);

        return redirect('/admin/audios')
            ->with('success', 'Audio successfully updated');
    }

    // =========================
    // DESTROY
    // =========================
    public function destroy(Audio $audio)
    {
        $this->deleteStorageFile($audio->image);
        $this->deleteStorageFile($audio->audio_file);

        $audio->delete();

        return redirect('/admin/audios')
            ->with('success', 'Audio successfully deleted');
    }
}
