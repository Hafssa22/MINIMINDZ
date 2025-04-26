@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        font-family: 'Figtree', sans-serif;
        color: white;
    }

    .wrapper {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 1rem;
        text-align: center;
    }

    .title {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 2rem;
    }

    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1.2rem;
        justify-items: center;
    }

    .card {
        background: white;
        border-radius: 1.5rem;
        padding: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        width: 100%;
        position: relative;
    }

    .card img {
        width: 80px;
        height: 80px;
        object-fit: contain;
        border-radius: 0.5rem;
        display: block;
        margin: auto;
    }

    .card audio {
        margin-top: 0.5rem;
        width: 100%;
    }

    .letter-label {
        font-size: 1.2rem;
        font-weight: bold;
        color: #333;
        margin-top: 0.5rem;
    }

    .back-btn {
        display: inline-block;
        margin-bottom: 2rem;
        background: white;
        color: #0cc0df;
        padding: 0.5rem 1rem;
        font-weight: bold;
        border-radius: 1rem;
        text-decoration: none;
    }

    .back-btn:hover {
        background-color: #e5fafd;
    }
</style>

<div class="wrapper">
    <a href="{{ route('kids.home') }}" class="back-btn">← Back to Categories</a>
    <h1 class="title">🔤 Let's Learn the Alphabet!</h1>

    <div class="grid">
        @foreach($grouped as $letter => $items)
            <div class="card">
                @php
                    $image = $items->firstWhere('media_type', 'image');
                    $audio = $items->firstWhere('media_type', 'audio');
                @endphp

                @if($image)
                    <img src="{{ asset('storage/' . $image->media_path) }}" alt="{{ $letter }}">
                @endif

                @if($audio)
                    <audio controls>
                        <source src="{{ asset('storage/' . $audio->media_path) }}">
                    </audio>
                @endif

                
            </div>
        @endforeach
    </div>
</div>
@endsection
