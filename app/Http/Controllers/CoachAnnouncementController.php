<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoachAnnouncementController extends Controller
{
    public function index()
    {
        $coach = Auth::guard('coach')->user();
        $announcements = $coach->announcements()->with('category')->latest()->get();

        return view('coach.announcements.index', compact('announcements'));
    }

    public function create()
    {
        $coach = Auth::guard('coach')->user();

        return view('coach.announcements.form', [
            'announcement' => new Announcement(),
            'categories'   => $coach->categories,
        ]);
    }

    public function store(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $validated = $this->validated($request, $coach);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('announcements', 'public');
        }

        $coach->announcements()->create($validated);

        return redirect()->route('coach.announcements.index')->with('success', 'Announcement posted.');
    }

    public function edit(Announcement $announcement)
    {
        $this->authorizeCoach($announcement);
        $coach = Auth::guard('coach')->user();

        return view('coach.announcements.form', [
            'announcement' => $announcement,
            'categories'   => $coach->categories,
        ]);
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeCoach($announcement);
        $coach = Auth::guard('coach')->user();
        $validated = $this->validated($request, $coach);

        if ($request->hasFile('image')) {
            if ($announcement->image_path) {
                Storage::disk('public')->delete($announcement->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('coach.announcements.index')->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorizeCoach($announcement);

        if ($announcement->image_path) {
            Storage::disk('public')->delete($announcement->image_path);
        }

        $announcement->delete();

        return redirect()->route('coach.announcements.index')->with('success', 'Announcement deleted.');
    }

    private function validated(Request $request, $coach): array
    {
        $categoryIds = $coach->categories->pluck('id')->toArray();

        return $request->validate([
            'category_id' => ['nullable', 'in:' . implode(',', $categoryIds ?: [0])],
            'title'       => 'required|string|max:150',
            'body'        => 'required|string',
            'type'        => 'required|in:announcement,audition',
            'event_at'    => 'nullable|date',
            'location'    => 'nullable|string|max:150',
            'image'       => 'nullable|image|max:4096',
        ]);
    }

    private function authorizeCoach(Announcement $announcement): void
    {
        abort_unless($announcement->coach_id === Auth::guard('coach')->id(), 403);
    }
}