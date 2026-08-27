<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\LiveSet;

use Illuminate\Support\Str;

class LiveSetController extends Controller
{

    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $livesets = LiveSet::latest()->get();

        return view('admin.livesets.index', compact('livesets'));
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        return view('admin.livesets.create');
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'dj' => 'required',

            'image' => 'required|image',
        ]);

        // UPLOAD IMAGE
        $imageFile = $request->file('image');

        $imageName = time() . '_' .
            $imageFile->getClientOriginalName();
        
        $imageFile->move(
            base_path('../public_html/storage/livesets'),
            $imageName
        );
        
        $image = 'livesets/' . $imageName;


        LiveSet::create([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'dj' => $request->dj,

            'image' => $image,

            'description' => $request->description,

            'genre' => $request->genre,

            'event' => $request->event,

            'duration' => $request->duration,

            'youtube_url' => $request->youtube_url,

            'audio_url' => $request->audio_url,

            'release_date' => $request->release_date,
        ]);

        return redirect('/admin/livesets')
            ->with('success', 'Liveset created successfully');
    }

    // =========================
// EDIT
// =========================

public function edit(LiveSet $liveset)
{
    return view('admin.livesets.edit', compact('liveset'));
}

// =========================
// UPDATE
// =========================

public function update(Request $request, LiveSet $liveset)
{

    $request->validate([

        'title' => 'required',

        'dj' => 'required',
    ]);

    // DEFAULT IMAGE
    $image = $liveset->image;

    // REPLACE IMAGE
    if ($request->hasFile('image')) {

        // DELETE OLD IMAGE
        if ($liveset->image) {

            \Storage::disk('public')
                ->delete($liveset->image);
        }

        // UPLOAD NEW IMAGE
        $imageFile = $request->file('image');

        $imageName = time() . '_' .
            $imageFile->getClientOriginalName();
        
        $imageFile->move(
            base_path('../public_html/storage/livesets'),
            $imageName
        );
        
        $image = 'livesets/' . $imageName;
    }

    // UPDATE
    $liveset->update([

        'title' => $request->title,

        'slug' => \Str::slug($request->title),

        'dj' => $request->dj,

        'image' => $image,

        'description' => $request->description,

        'genre' => $request->genre,

        'event' => $request->event,

        'duration' => $request->duration,

        'youtube_url' => $request->youtube_url,

        'audio_url' => $request->audio_url,

        'release_date' => $request->release_date,
    ]);

    return redirect('/admin/livesets')
        ->with('success', 'Liveset updated successfully');
}

// =========================
// DELETE
// =========================

public function destroy(LiveSet $liveset)
{

    // DELETE IMAGE
    if ($liveset->image) {

        if (
            $liveset->image &&
            file_exists(
                base_path('../public_html/storage/' . $liveset->image)
            )
        ) {
        
            unlink(
                base_path('../public_html/storage/' . $liveset->image)
            );
        }
    }

    // DELETE DATABASE
    $liveset->delete();

    return redirect('/admin/livesets')
        ->with('success', 'Liveset deleted successfully');
}

}