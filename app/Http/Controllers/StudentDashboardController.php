<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\EntryMember;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = Auth::guard('student')->user();

        $categoryIds = EntryMember::where('student_number', $student->student_number)
            ->with('entry')
            ->get()
            ->pluck('entry.category_id')
            ->filter()
            ->unique();

        $announcements = Announcement::where(function ($q) use ($categoryIds) {
                $q->whereIn('category_id', $categoryIds)
                  ->orWhereNull('category_id'); // general announcements for everyone
            })
            ->latest()
            ->get();

        return view('student.dashboard', compact('student', 'announcements'));
    }
}
