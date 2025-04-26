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

    .hidden {
        display: none;
    }
</style>

<div class="form-container">
    <a href="/tutor/dashboard" class="back-button">← Back to Dashboard</a>
    <h2>➕ Add New Content</h2>
    <form action="{{ route('contents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="category">Category</label>
        <select name="category" id="category" required>
            <option value="">-- Select --</option>
            <option value="ABC">ABC</option>
            <option value="Numbers">Numbers</option>
            <option value="Colors">Colors</option>
            <option value="Songs">Songs</option>
            <option value="Animals">Animals</option>
            <option value="Games">Games</option>
        </select>

        <label for="media_type">Media Type</label>
        <select name="media_type" id="media_type" required onchange="togglePosterField()">
            <option value="">-- Select --</option>
            <option value="image">Image</option>
            <option value="audio">Audio</option>
            <option value="video">Video</option>
        </select>

        <label for="media_path">Upload File</label>
        <input type="file" name="media_path" id="media_path" required>


        <button type="submit">Upload</button>
    </form>
</div>

<script>
    function togglePosterField() {
        const mediaType = document.getElementById('media_type').value;
        const posterSection = document.getElementById('poster-section');
        posterSection.classList.toggle('hidden', mediaType !== 'video');
    }
</script>
@endsection
