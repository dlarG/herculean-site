<?php

namespace App\Http\Controllers;

use App\Models\EntryMember;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachDashboardController extends Controller
{
    public function index()
    {
        $coach = Auth::guard('coach')->user();

        $categories = $coach->categories()->withCount('entries')->get();
        $announcements = $coach->announcements()->with('category')->latest()->get();

        return view('coach.dashboard', compact('coach', 'categories', 'announcements'));
    }

    public function exportPdf(Request $request)
    {
        $coach = Auth::guard('coach')->user();
        $categoryIds = $coach->categories->pluck('id');

        $members = EntryMember::with('entry.category')
            ->whereHas('entry', fn ($q) => $q->whereIn('category_id', $categoryIds))
            ->get()
            ->sortBy(fn ($m) => $m->entry->category->group . '|' . $m->entry->category->name . '|' . $m->full_name);

        $pdf = Pdf::loadView('admin.exports.entries-pdf', [
            'members'    => $members,
            'generated'  => now(),
            'filterNote' => "My categories ({$coach->name})",
        ])->setPaper('a4', 'portrait');

        return $pdf->download('herculean-dragon-' . str($coach->username)->slug() . '-' . now()->format('Y-m-d-His') . '.pdf');
    }
}