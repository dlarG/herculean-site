<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\EntryMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachDashboardController extends Controller
{
    public function index()
    {
        $coach = Auth::guard('coach')->user();

        // Expand any parent-with-variants (like "Mass Dance") into its actual
        // registrable children ("Dancer", "Propsmen") — those are what
        // entries actually attach to, never the parent itself.
        $displayCategories = $coach->categories()->with('variants')->orderBy('name')->get()
            ->flatMap(fn ($cat) => $cat->has_variants ? $cat->variants : collect([$cat]))
            ->unique('id')
            ->values();

        $counts = Entry::whereIn('category_id', $displayCategories->pluck('id'))
            ->selectRaw('category_id, count(*) as c')
            ->groupBy('category_id')
            ->pluck('c', 'category_id');

        $displayCategories->each(function ($cat) use ($counts) {
            $cat->entries_count = $counts[$cat->id] ?? 0;
        });

        $announcements = $coach->announcements()->with('category')->latest()->get();

        return view('coach.dashboard', [
            'coach'        => $coach,
            'categories'   => $displayCategories,
            'announcements' => $announcements,
        ]);
    }

    /**
     * List all participants under the coach's events, with filters.
     */
    public function participants(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $categoryIds = $this->registrableCategoryIds($coach);

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

        // Filter dropdown needs the expanded (leaf) categories too —
        // filtering by "Mass Dance" itself would never match anything.
        $categories = $coach->categories()->with('variants')->orderBy('name')->get()
            ->flatMap(fn ($cat) => $cat->has_variants ? $cat->variants : collect([$cat]))
            ->unique('id')
            ->values();

        return view('coach.participants', compact('coach', 'participants', 'categories'));
    }

    /**
     * Export filtered participants to PDF.
     */
    public function exportPdf(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $categoryIds = $this->registrableCategoryIds($coach);

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

    /**
     * Every category ID this coach's registrations can actually land under —
     * expanding any assigned parent-with-variants into its children.
     */
    private function registrableCategoryIds($coach)
    {
        return $coach->categories()->with('variants')->get()
            ->flatMap(fn ($cat) => $cat->has_variants ? $cat->variants->pluck('id') : collect([$cat->id]))
            ->unique()
            ->values();
    }
}