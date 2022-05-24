<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

// Common Resource Routes
// index - Show all listings
// show - Show a single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit a listing
// update - Update a listing
// destroy - Delete a listing

class AnnouncementsController extends Controller
{
    public function index()
    {
        session()->forget('manage');
        return view('announcements.index', [
            'announcements' => Announcement::latest()
                ->filter(request(['tag', 'search']))
                ->paginate(6)
        ]);
    }

    public function show(Announcement $announcement)
    {
        return view('announcements.show', [
            'announcement' => $announcement
        ]);
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(AnnouncementRequest $request)
    {
        $formFields = $request->validated();
        $formFields["tags"] = $request->input("tags");

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request->file("logo")->store("logos", "public");
        }

        $formFields['user_id'] = auth()->id();

        Announcement::create($formFields);

        return $this->backToProperListing("Announcement Successfully Created");
    }

    public function edit(Announcement $announcement)
    {
        if (!auth()->user()->isAdmin && $announcement->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        return view('announcements.edit', ['announcement' => $announcement]);
    }

    public function update(AnnouncementRequest $request, Announcement $announcement)
    {
        if (!auth()->user()->isAdmin && $announcement->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validated();
        $formFields["tags"] = $request->input("tags");

        if ($request->hasFile("logo")) {
            $formFields["logo"] = $request->file("logo")->store("logos", "public");
        } else {
            $formFields["logo"] = null;
        }
        if ($announcement->logo) {
            Storage::disk('public')->delete($announcement->logo);
        }

        $announcement->update($formFields);

        return $this->backToProperListing("Announcement Successfully Updated");
    }

    public function confirmDelete(Announcement $announcement)
    {
        if (!auth()->user()->isAdmin && $announcement->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        return view("announcements.delete", ['announcement' => $announcement]);
    }

    public function destroy(Announcement $announcement)
    {
        if (!auth()->user()->isAdmin && $announcement->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        if ($announcement->logo) {
            Storage::disk('public')->delete($announcement->logo);
        }
        $announcement->delete();
        return $this->backToProperListing("Announcement Deleted Successfully");
    }

    public function manage()
    {
        session(['manage' => true]);
        return view('announcements.manage', [
            'announcements' => User::find(Auth()->id())->announcements()
                ->latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    public function backToProperListing($message = null)
    {
        $returnPage = session('manage') ? route('announcements-manage') : "/";
        $redirect = redirect($returnPage);
        if ($message) {
            $redirect = $redirect->with("message", $message);
        }
        return $redirect;
    }
}
