<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    // Adjust this list to match SLSU Sogod's actual offered programs
    public const PROGRAMS = [
        'BS Information Technology (BSIT)',
        'BS Hospitality Management (BSHM)',
        'BS Tourism Management (BSTM)',
        'Other',
    ];

    public function create(Request $request)
    {
        $categories = Category::where('is_open', true)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        $sport = $request->query('sport');
        $preselectedId = null;

        if ($sport) {
            $preselectedId = Category::where('is_open', true)
                ->where('name', $sport)
                ->orderBy('gender_division')
                ->value('id');
        }

        $programs = self::PROGRAMS;

        return view('register', compact('categories', 'preselectedId', 'programs'));
    }

    public function store(Request $request)
    {
        $category = Category::findOrFail($request->input('category_id'));

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'members' => "required|array|min:{$category->min_members}|max:{$category->max_members}",
            'members.*.full_name' => 'required|string|max:150',
            'members.*.student_number' => 'required|string|max:50',
            'members.*.gender' => 'required|in:Male,Female',
            'members.*.program' => 'required|string|max:150',
            'members.*.year_level' => 'required|integer|between:1,4',
            'members.*.contact_number' => 'nullable|string|max:30',
            'members.*.email' => 'nullable|max:150',
        ]);

        $entry = DB::transaction(function () use ($validated, $category) {
            $entry = Entry::create([
                'category_id' => $category->id,
            ]);

            foreach ($validated['members'] as $member) {
                $entry->members()->create($member);
            }

            return $entry;
        });

        return redirect()
            ->route('register.create')
            ->with('success', "Thank you for registering. Registered for {$category->name}. Please wait for a message from your coach for further instructions. Please keep your messenger and lines open.");
    }
}
