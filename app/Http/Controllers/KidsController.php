<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

class KidsController extends Controller
{
    public function index()
    {
        return view('kids.index');
    }

    public function showCategory($category)
    {
        $contents = Content::where('category', $category)
            ->orderBy('title')
            ->get()
            ->groupBy('title');
        return view('kids.category', compact('contents', 'category'));
    }
    public function abc()
        {
            $contents = Content::where('category', 'ABC')->get();

            $grouped = $contents->groupBy('title');

            return view('kids.abc', compact('grouped'));
        }
}
