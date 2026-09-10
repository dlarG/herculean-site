<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $groups = Category::where('is_open', true)
            ->orderBy('group')
            ->orderBy('name')
            ->get()
            ->groupBy('group')
            ->map(function ($items) {
                // Collapse Men/Women variants into one card per sport name
                return $items->pluck('name')->unique()->values();
            });

        return view('home', compact('groups'));
    }
}
