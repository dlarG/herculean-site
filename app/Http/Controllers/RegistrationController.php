<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Entry;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Models\EntryMember;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    public const PROGRAMS = [
        'BS Information Technology (BSIT)',
        'BS Hospitality Management (BSHM)',
        'BS Tourism Management (BSTM)',
    ];

    public function create(Request $request)
    {
        // Group of parent categories for the FIRST dropdown
        $categories = Category::where('is_open', true)
            ->whereNull('parent_id')
            ->orderBy('group')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('group');

        // All variants keyed by their parent's ID, for the SECOND dropdown
        $variantsByParent = Category::where('is_open', true)
            ->whereNotNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('parent_id');

        $sport = $request->query('sport');
        $preselectedId = null;
        $preselectedVariantId = null;

        if ($sport) {
            // Find the category by name — could be a parent or a variant
            $match = Category::where('is_open', true)
                ->where('name', $sport)
                ->first();

            if ($match) {
                if ($match->parent_id) {
                    // It's a variant — preselect the parent AND the variant
                    $preselectedId = $match->parent_id;
                    $preselectedVariantId = $match->id;
                } else {
                    // It's a parent
                    $preselectedId = $match->id;
                }
            }
        }

        $programs = self::PROGRAMS;
        $allCategoriesById = Category::where('is_open', true)->get()->keyBy('id');

        return view('register', compact(
            'categories',
            'variantsByParent',
            'preselectedId',
            'preselectedVariantId',
            'programs',
            'allCategoriesById'
        ));
    }

    public function store(Request $request)
    {
        $category = Category::findOrFail($request->input('category_id'));

        $validated = $request->validate([
            'category_id'              => 'required|exists:categories,id',
            'members'                  => "required|array|min:{$category->min_members}|max:{$category->max_members}",
            'members.*.full_name'      => 'required|string|max:150',
            'members.*.student_number' => 'required|string|max:50',
            'members.*.gender'         => 'required|in:Male,Female',
            'members.*.program'        => 'required|string|max:150',
            'members.*.year_level'     => 'required|integer|between:1,4',
            'members.*.contact_number' => 'nullable|string|max:30',
            'members.*.email'          => 'nullable|max:150',
        ]);

        // Reject anyone already registered for this exact category —
        // checked BEFORE we write anything, so a duplicate never creates
        // a partial entry.
        foreach ($validated['members'] as $index => $member) {
            $alreadyRegistered = EntryMember::where('student_number', $member['student_number'])
                ->whereHas('entry', fn ($q) => $q->where('category_id', $category->id))
                ->exists();

            if ($alreadyRegistered) {
                throw ValidationException::withMessages([
                    "members.$index.student_number" =>
                        "Student number {$member['student_number']} is already registered for {$category->name}.",
                ]);
            }
        }

        DB::transaction(function () use ($validated, $category) {
            foreach ($validated['members'] as $memberData) {
                $entry = Entry::create([
                    'category_id' => $category->id,
                ]);

                $entry->members()->create($memberData);

                // Auto-provision a student login the first time we see this
                // student number. Default password is their student number —
                // they can be told to change it after logging in.
                Student::firstOrCreate(
                    ['student_number' => $memberData['student_number']],
                    [
                        'full_name' => $memberData['full_name'],
                        'password'  => Hash::make($memberData['student_number']),
                    ]
                );
            }
        });

        return redirect()
            ->route('register.create')
            ->with('success', "Thank you for registering. Registered for {$category->name}. Please wait for a message from your coach for further instructions. Please keep your messenger and lines open.");
    }

}
