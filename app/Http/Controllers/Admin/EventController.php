<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Event;

use Illuminate\Support\Str;

class EventController extends Controller
{

    // =========================
    // INDEX
    // =========================

    public function index()
    {
        $events = Event::latest()->get();

        return view('admin.events.index', compact('events'));
    }

    // =========================
    // CREATE
    // =========================

    public function create()
    {
        return view('admin.events.create');
    }

    // =========================
    // STORE
    // =========================

    public function store(Request $request)
    {

        $request->validate([

            'title' => 'required',

            'image' => 'required|image',
        ]);

        // UPLOAD IMAGE
        $imageFile = $request->file('image');

        $imageName = time() . '_' .
            $imageFile->getClientOriginalName();
        
        $imageFile->move(
            base_path('../public_html/storage/events'),
            $imageName
        );
        
        $image = 'events/' . $imageName;

        Event::create([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'image' => $image,

            'date' => $request->date,

            'location' => $request->location,
            
            'headliner' => $request->headliner,

            'description' => $request->description,

            'lineup' => $request->lineup,

            'status' => $request->status,
        ]);

        return redirect('/admin/events')
            ->with('success', 'Event created successfully');
    }

    // =========================
    // EDIT
    // =========================

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    // =========================
    // UPDATE
    // =========================

    public function update(Request $request, Event $event)
    {

        $image = $event->image;

        // REPLACE IMAGE
        if ($request->hasFile('image')) {

        // DELETE OLD IMAGE
        if (
            $event->image &&
            file_exists(
                base_path('../public_html/storage/' . $event->image)
            )
        ) {
    
            unlink(
                base_path('../public_html/storage/' . $event->image)
            );
        }
    
        // UPLOAD NEW IMAGE
        $imageFile = $request->file('image');
    
        $imageName = time() . '_' .
            $imageFile->getClientOriginalName();
    
        $imageFile->move(
            base_path('../public_html/storage/events'),
            $imageName
        );
    
        $image = 'events/' . $imageName;
    }

        $event->update([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'image' => $image,

            'date' => $request->date,

            'location' => $request->location,
            
            'headliner' => $request->headliner,

            'description' => $request->description,

            'lineup' => $request->lineup,

            'status' => $request->status,
        ]);

        return redirect('/admin/events')
            ->with('success', 'Event updated successfully');
    }

    // =========================
    // DELETE
    // =========================

    public function destroy(Event $event)
    {

        // DELETE IMAGE
        if ($event->image) {

            
            if (
                $event->image &&
                file_exists(
                    base_path('../public_html/storage/' . $event->image)
                )
            ) {
            
                unlink(
                    base_path('../public_html/storage/' . $event->image)
                );
            }
        }

        // DELETE DATABASE
        $event->delete();

        return redirect('/admin/events')
            ->with('success', 'Event deleted successfully');
    }
}