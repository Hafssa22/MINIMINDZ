@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        color: #333;
        font-family: 'Figtree', sans-serif;
    }

    .form-container {
        max-width: 500px;
        margin: 3rem auto;
        background: white;
        border-radius: 1rem;
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        padding: 2.5rem;
    }

    .form-container h2 {
        text-align: center;
        font-size: 1.8rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: #0cc0df;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .back-button {
        background-color: #ffffff;
        color: #0cc0df;
        padding: 0.5rem 1.2rem;
        font-weight: bold;
        border-radius: 1rem;
        text-decoration: none;
        transition: background 0.2s;
        display: inline-block;
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        z-index: 10;
    }

    .back-button:hover {
        background-color: #e0f9fc;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
        color: #555;
    }

    input[type="text"],
    select {
        width: 100%;
        padding: 0.7rem;
        border: 1px solid #ccc;
        border-radius: 0.7rem;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    input[type="file"] {
        margin-top: 0.5rem;
        margin-bottom: 2rem;
    }

    button[type="submit"] {
        background: #0cc0df;
        color: white;
        font-weight: bold;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        border: none;
        border-radius: 0.7rem;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }

    button[type="submit"]:hover {
        background: #08a6be;
    }

    .current-preview {
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .current-preview img,
    .current-preview video {
        max-width: 100%;
        height: 150px;
        border-radius: 0.7rem;
    }

    .current-preview audio {
        margin-top: 1rem;
        width: 100%;
    }

    .current-preview-label {
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #444;
    }
</style>

<div class="form-container">
    <a href="/tutor/dashboard" class="back-button">← Back to Dashboard</a>
    <h2>Edit Content</h2>

    <form action="{{ route('contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ $content->title }}" required>

        <label for="category">Category</label>
        <select name="category" id="category" required>
            <option value="ABC" {{ $content->category === 'ABC' ? 'selected' : '' }}>ABC</option>
            <option value="Numbers" {{ $content->category === 'Numbers' ? 'selected' : '' }}>Numbers</option>
            <option value="Colors" {{ $content->category === 'Colors' ? 'selected' : '' }}>Colors</option>
            <option value="Songs" {{ $content->category === 'Songs' ? 'selected' : '' }}>Songs</option>
            <option value="Animals" {{ $content->category === 'Animals' ? 'selected' : '' }}>Animals</option>
            <option value="Games" {{ $content->category === 'Games' ? 'selected' : '' }}>Games</option>
        </select>

        <label for="media_type">Media Type</label>
        <select name="media_type" id="media_type" required>
            <option value="image" {{ $content->media_type === 'image' ? 'selected' : '' }}>Image</option>
            <option value="audio" {{ $content->media_type === 'audio' ? 'selected' : '' }}>Audio</option>
            <option value="video" {{ $content->media_type === 'video' ? 'selected' : '' }}>Video</option>
        </select>

        <div class="current-preview">
            <div class="current-preview-label">Current Media</div>
            @if($content->media_type === 'image')
                <img src="{{ asset('storage/' . $content->media_path) }}" alt="{{ $content->title }}">
            @elseif($content->media_type === 'audio')
                <audio controls>
                    <source src="{{ asset('storage/' . $content->media_path) }}">
                </audio>
            @elseif($content->media_type === 'video')
                <video controls
                    @if($content->poster_path)
                        poster="{{ asset('storage/' . $content->poster_path) }}"
                    @endif
                >
                    <source src="{{ asset('storage/' . $content->media_path) }}">
                </video>
            @endif
        </div>

        <label for="media_path">Upload New File (optional)</label>
        <input type="file" name="media_path" id="media_path">

        @if($content->media_type === 'video')
            <label for="poster">Upload New Poster (optional)</label>
            <input type="file" name="poster" id="poster" accept="image/*">
        @endif

        <button type="submit">Update Content</button>
    </form>
</div>
@endsection
