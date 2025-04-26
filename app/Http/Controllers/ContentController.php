<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = \App\Models\Content::all()->groupBy('category');       
        return view('contents.index', compact('contents'));
    }

    public function create()
    {
    return view('contents.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'category' => 'required',
        'media_type' => 'required',
        'media_path' => 'required|file',
        'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $filePath = $request->file('media_path')->store('uploads', 'public');

    $posterPath = null;

    if ($request->media_type == 'video' && $request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('posters', 'public');
    }

    if ($request->media_type == 'audio') {
        $existingImage = Content::where('title', $request->title)
                                ->where('category', $request->category)
                                ->where('media_type', 'image')
                                ->first();

        if ($existingImage) {
            $posterPath = $existingImage->media_path; 
        }
    }

    Content::create([
        'title' => $request->title,
        'category' => $request->category,
        'media_type' => $request->media_type,
        'media_path' => $filePath,
        'poster_path' => $posterPath,
    ]);

    return redirect()->route('contents.index')->with('success', 'Content added successfully!');
}



    public function show(Content $content)
    {
        //
    }

    public function edit($id)
    {
    $content = Content::findOrFail($id);
    return view('contents.edit', compact('content'));
    }

    public function update(Request $request, Content $content)
{
    $request->validate([
        'title' => 'required',
        'category' => 'required',
        'media_type' => 'required',
        'media_path' => 'nullable|file',
        'poster' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update media file if uploaded
    if ($request->hasFile('media_path')) {
        $filePath = $request->file('media_path')->store('uploads', 'public');
        $content->media_path = $filePath;
    }

    // Update poster if uploaded
    if ($request->hasFile('poster')) {
        $posterPath = $request->file('poster')->store('posters', 'public');
        $content->poster_path = $posterPath;
    }

    // If editing an audio and no manual poster uploaded, try linking an image
    if ($content->media_type == 'audio' && !$request->hasFile('poster')) {
        $existingImage = Content::where('title', $request->title)
                                ->where('category', $request->category)
                                ->where('media_type', 'image')
                                ->first();

        if ($existingImage) {
            $content->poster_path = $existingImage->media_path;
        }
    }

    $content->title = $request->title;
    $content->category = $request->category;
    $content->media_type = $request->media_type;

    $content->save();

    return redirect()->route('contents.index')->with('success', 'Content updated successfully!');
}



    public function destroy($id)
    {
    $content = Content::findOrFail($id);
    $content->delete();
    return redirect()->route('contents.index')->with('success', 'Content deleted');
    }
}
