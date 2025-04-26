@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        font-family: 'Comic Sans MS', cursive;
        color: white;
    }

    .content-wrapper {
        max-width: 1000px;
        margin: auto;
        padding: 3rem 1rem;
        text-align: center;
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
    
    .content-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }


    .section-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 2rem;
        margin-bottom: 1rem;
        text-align: left;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 2rem;
        justify-items: center;
    }

    .card {
        background: white;
        border-radius: 20px;
        width: 180px;
        padding: 1rem;
        text-align: center;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card img,
    .card video {
        width: 100%;
        height: 120px;
        object-fit: contain;
        border-radius: 12px;
    }

    .card audio {
        width: 100%;
        margin-top: 0.5rem;
    }

    .card-title {
        font-weight: bold;
        font-size: 1rem;
        margin: 0.6rem 0;
        color: #333;
    }

    .actions {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.4rem;
    }

    .actions a,
    .actions form button {
        font-size: 0.8rem;
        background: #0cc0df;
        color: white;
        padding: 0.35rem 0.7rem;
        border: none;
        border-radius: 10px;
        text-decoration: none;
        cursor: pointer;
    }

    .actions form {
        display: inline;
    }
</style>

<div class="content-wrapper">
    <a href="/tutor/dashboard" class="back-button">← Back to Dashboard</a>
    <h1 class="content-title">All Uploaded Content</h1>

    @forelse ($contents as $category => $group)
        <h2 class="section-title">
            @if($category === 'ABC') ABC
            @elseif($category === 'Numbers') Numbers
            @elseif($category === 'Colors') Colors
            @elseif($category === 'Songs') Songs
            @elseif($category === 'Animals') Animals
            @else 📁 {{ $category }}
            @endif
        </h2>

        <div class="grid">
            @foreach ($group as $item)
                <div class="card">
                    @if($item->media_type === 'image')
                        <img src="{{ asset('storage/' . $item->media_path) }}" alt="{{ $item->title }}">
                    @elseif($item->media_type === 'audio')
                        <img src="{{ asset('images/kids/music-icon.png') }}" alt="Audio Icon">
                        <audio controls>
                            <source src="{{ asset('storage/' . $item->media_path) }}">
                        </audio>
                    @elseif($item->media_type === 'video')
                        <video controls>
                            <source src="{{ asset('storage/' . $item->media_path) }}">
                        </video>
                    @endif

                    <div class="card-title">{{ $item->title }}</div>

                    <div class="actions">
                        <a href="{{ route('contents.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('contents.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <p class="text-white text-center">No content uploaded yet.</p>
    @endforelse
</div>
@endsection
