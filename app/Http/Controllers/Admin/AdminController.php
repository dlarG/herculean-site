<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entry;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Entry::with(['category', 'members'])
            ->latest();

        if ($categoryId = $request->query('category_id')) {
            $query->where('category_id', $categoryId);
        }

        if ($group = $request->query('group')) {
            $query->whereHas('category', fn ($q) => $q->where('group', $group));
        }

        if ($gender = $request->query('gender')) {
            $query->whereHas('members', fn ($q) => $q->where('gender', $gender));
        }

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('team_name', 'like', "%{$search}%")
                  ->orWhereHas('members', function ($mq) use ($search) {
                      $mq->where('full_name', 'like', "%{$search}%")
                         ->orWhere('student_number', 'like', "%{$search}%");
                  });
            });
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator $paginator */
        $paginator = $query->paginate(20);
        $entries = $paginator->withQueryString();

        $categories = Category::where('is_open', true)
            ->orderBy('group')->orderBy('name')
            ->get();

        $groups = $categories->pluck('group')->unique()->values();

        return view('admin.dashboard', compact('entries', 'categories', 'groups'));
    }
}