<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachDashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();

        $categories = $coach->categories()->withCount(['entries'])->get();

        // Count unique students under this coach's categories
        $totalStudents = \App\Models\EntryMember::whereHas('entry.category.coaches', function ($q) use ($coach) {
            $q->where('coaches.id', $coach->id);
        })->count();

        $recentAnnouncements = $coach->announcements()->take(5)->get();

        return view('coach.dashboard', compact(
            'coach',
            'categories',
            'totalStudents',
            'recentAnnouncements'
        ));
    }

    public function announcements()
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();
        $announcements = $coach->announcements()->with('category')->paginate(20);

        return view('coach.announcements.index', compact('announcements'));
    }

    public function createAnnouncement()
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();
        $categories = $coach->categories()->orderBy('name')->get();

        return view('coach.announcements.create', compact('categories'));
    }

    public function storeAnnouncement(Request $request)
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();

        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'body'        => 'required|string',
            'type'        => 'required|in:announcement,audition',
            'category_id' => 'nullable|exists:categories,id',
            'event_at'    => 'nullable|date',
            'location'    => 'nullable|string|max:200',
        ]);

        // Ensure the coach can only post for their own categories
        if (!empty($validated['category_id'])) {
            $allowed = $coach->categories()->where('categories.id', $validated['category_id'])->exists();
            abort_unless($allowed, 403, 'You are not assigned to that category.');
        }

        $coach->announcements()->create($validated);

        return redirect()
            ->route('coach.announcements')
            ->with('success', 'Announcement posted successfully.');
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();

        abort_unless($announcement->coach_id === $coach->id, 403);

        $announcement->delete();

        return back()->with('success', 'Announcement deleted.');
    }

    public function myEvents()
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();
        $categories = $coach->categories()->withCount(['entries'])->get();

        return view('coach.events', compact('categories'));
    }

    public function myStudents(Request $request)
    {
        /** @var \App\Models\Coach $coach */
        $coach = Auth::guard('coach')->user();

        $categoryIds = $coach->categories()->pluck('categories.id');

        $query = \App\Models\EntryMember::with('entry.category')
            ->whereHas('entry', fn ($q) => $q->whereIn('category_id', $categoryIds));

        if ($catId = $request->query('category_id')) {
            $query->whereHas('entry', fn ($q) => $q->where('category_id', $catId));
        }

        if ($gender = $request->query('gender')) {
            $query->where('gender', $gender);
        }

        if ($program = $request->query('program')) {
            $query->where('program', $program);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%");
            });
        }
        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
        $paginator = $query->paginate(50);
        $students = $paginator->withQueryString();

        return view('coach.students', compact('students', 'coach'));
    }
}