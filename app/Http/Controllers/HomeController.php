<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_open', true)
            ->whereNull('parent_id')       // ← only parents
            ->orderBy('group')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $groups = $categories->groupBy('group');

        return view('home', compact('groups'));
    }
}