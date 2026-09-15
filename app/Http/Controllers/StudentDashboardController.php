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
}