<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_open', true)
            ->orderBy('group')
            ->orderBy('name')
            ->get();

        $groups = $categories->groupBy('group');

        return view('home', compact('groups'));
    }
}