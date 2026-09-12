<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\EntryMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachDashboardController extends Controller
{
    public function index()
    {
        $coach = Auth::guard('coach')->user();

        $categories = $coach->categories()->withCount('entries')->orderBy('name')->get();
        $announcements = $coach->announcements()->with('category')->latest()->get();

        return view('coach.dashboard', compact('coach', 'categories', 'announcements'));
    }

    /**
     * List all participants under the coach's events, with filters.
     */
    public function participants(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $categoryIds = $coach->categories()->pluck('categories.id');

        $query = EntryMember::with('entry.category')
            ->whereHas('entry', fn ($q) => $q->whereIn('category_id', $categoryIds));

        if ($catId = $request->query('category_id')) {
            $query->whereHas('entry', fn ($q) => $q->where('category_id', $catId));
        }

        if ($gender = $request->query('gender')) {
            $query->where('gender', $gender);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%");
            });
        }

        $participants = $query->latest()->paginate(50)->withQueryString();

        // Need categories for the filter dropdown
        $categories = $coach->categories()->orderBy('name')->get();

        return view('coach.participants', compact('coach', 'participants', 'categories'));
    }

    /**
     * Export filtered participants to PDF.
     */
    public function exportPdf(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $categoryIds = $coach->categories()->pluck('categories.id');

        $query = EntryMember::with('entry.category')
            ->whereHas('entry', fn ($q) => $q->whereIn('category_id', $categoryIds));

        if ($catId = $request->query('category_id')) {
            $query->whereHas('entry', fn ($q) => $q->where('category_id', $catId));
        }

        if ($gender = $request->query('gender')) {
            $query->where('gender', $gender);
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('student_number', 'like', "%{$search}%");
            });
        }

        $members = $query->get()
            ->sortBy(fn ($m) => $m->entry->category->group . '|' . $m->entry->category->name . '|' . $m->full_name);

        $pdf = Pdf::loadView('admin.exports.entries-pdf', [
            'members'    => $members,
            'generated'  => now(),
            'filterNote' => "Coach {$coach->name} — " . ($catId ? 'Filtered' : 'All my events'),
        ])->setPaper('a4', 'portrait');

        $filename = 'herculean-dragon-' . str($coach->username)->slug() . '-' . now()->format('Y-m-d-His') . '.pdf';

        return $pdf->download($filename);
    }
}