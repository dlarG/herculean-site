<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Entry;
use App\Models\EntryMember;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        // Get the student's registered entries (with category + entry data)
        $myEntries = EntryMember::with(['entry.category'])
            ->where('student_number', $student->student_number)
            ->latest()
            ->get();

        // Unique category IDs the student is registered in
        $categoryIds = $myEntries->pluck('entry.category_id')->filter()->unique();

        // Announcements: for categories the student registered in, OR general (null category)
        $announcements = Announcement::with(['coach', 'category'])
            ->where(function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds)
                  ->orWhereNull('category_id');
            })
            ->latest()
            ->take(20)
            ->get();

        return view('student.dashboard', compact('student', 'myEntries', 'announcements'));
    }
    public function applications()
    {
        $student = Auth::guard('student')->user();

        $entries = EntryMember::with('entry.category')
            ->where('student_number', $student->student_number)
            ->latest()
            ->paginate(20);

        return view('student.applications', compact('student', 'entries'));
    }

    public function destroyApplication(Entry $entry)
    {
        $student = Auth::guard('student')->user();

        // Confirm the entry actually belongs to this student
        $belongs = EntryMember::where('entry_id', $entry->id)
            ->where('student_number', $student->student_number)
            ->exists();

        abort_unless($belongs, 403);

        // Delete the entry and its members
        $entry->members()->delete();
        $entry->delete();

        return redirect()
            ->route('student.applications')
            ->with('success', 'Your application has been withdrawn.');
    }
    public function profile()
    {
        $student = Auth::guard('student')->user();

        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::guard('student')->user();

        $validated = $request->validate([
            'full_name'      => 'required|string|max:150',
            'program'        => 'required|string|max:150',
            'year_level'     => 'required|integer|between:1,4',
            'gender'         => 'required|in:Male,Female',
            'contact_number' => 'nullable|string|max:30',
            'facebook_link'  => 'nullable|string|max:255',
        ]);

        $student->update($validated);

        return redirect()
            ->route('student.profile')
            ->with('success', 'Profile updated successfully.');
    }
    public function events()
    {
        $student = Auth::guard('student')->user();

        // Categories that are actually registrable = leaf categories (no variants)
        $categories = Category::where('is_open', true)
            ->whereNotNull('parent_id')      // variants (Sprint → 100m, etc.)
            ->orWhere(function ($q) {
                // Standalone categories with no variants
                $q->where('is_open', true)
                ->whereNull('parent_id')
                ->whereDoesntHave('variants');
            })
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        // Which categories has this student already registered for?
        $appliedCategoryIds = EntryMember::where('student_number', $student->student_number)
            ->with('entry')
            ->get()
            ->pluck('entry.category_id')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        // Eligibility snapshot
        $existing = EntryMember::where('student_number', $student->student_number)
            ->with('entry.category')
            ->get()
            ->pluck('entry.category')
            ->filter();

        $totalEvents  = $existing->count();
        $teamEvents   = $existing->where('is_team_event', true)->count();
        $canAddMore   = $totalEvents < 3;
        $canJoinTeam  = $teamEvents < 1;

        return view('student.events', compact(
            'student',
            'categories',
            'appliedCategoryIds',
            'totalEvents',
            'teamEvents',
            'canAddMore',
            'canJoinTeam'
        ));
    }

    /**
     * Apply the logged-in student directly to a category using their saved profile.
     */
    public function applyToCategory(Category $category)
    {
        $student = Auth::guard('student')->user();

        // Category must be open and registrable
        abort_unless($category->is_open, 404);
        abort_if($category->has_variants, 400, 'This is a parent category — choose a specific event.');

        // Student profile must be complete
        $missing = collect([
            'full_name', 'program', 'year_level', 'gender',
        ])->filter(fn ($field) => blank($student->$field));

        if ($missing->isNotEmpty()) {
            return redirect()
                ->route('student.profile')
                ->with('error', 'Please complete your profile (name, program, year, gender) before applying.');
        }

        // Already registered for this exact category?
        $alreadyRegistered = EntryMember::where('student_number', $student->student_number)
            ->whereHas('entry', fn ($q) => $q->where('category_id', $category->id))
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', "You're already registered for {$category->name}.");
        }

        // Eligibility checks — same rules as the public register form
        $existing = EntryMember::where('student_number', $student->student_number)
            ->with('entry.category')
            ->get()
            ->pluck('entry.category')
            ->filter();

        if ($existing->count() >= 3) {
            return back()->with('error', 'You have already registered for 3 events, the maximum allowed.');
        }

        if ($category->is_team_event && $existing->where('is_team_event', true)->count() >= 1) {
            return back()->with('error', 'You have already joined a team event. Only one team event is allowed per student.');
        }

        // Create the entry + member
        DB::transaction(function () use ($student, $category) {
            $entry = Entry::create([
                'category_id' => $category->id,
            ]);

            $entry->members()->create([
                'full_name'      => $student->full_name,
                'student_number' => $student->student_number,
                'gender'         => $student->gender,
                'program'        => $student->program,
                'year_level'     => $student->year_level,
                'contact_number' => $student->contact_number,
                'email'          => $student->facebook_link,
            ]);
        });

        return redirect()
            ->route('student.events')
            ->with('success', "You've successfully applied for {$category->name}.");
    }
}