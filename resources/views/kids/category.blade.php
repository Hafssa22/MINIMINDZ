@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        color: white;
    }

    .category-wrapper {
        padding: 2rem;
        text-align: center;
        min-height: 100vh;
        position: relative;
    }

    .category-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .back-button {
        background-color: #ffffff;
        color: #0cc0df;
        padding: 0.5rem 1.2rem;
        font-weight: bold;
        border-radius: 1rem;
        text-decoration: none;
        transition: background 0.2s;
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        z-index: 10;
    }

    .back-button:hover {
        background-color: #e0f9fc;
    }

    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.5rem;
        margin: 0 auto;
    }

    .content-card {
        background: white;
        padding: 1rem;
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        text-align: center;
        color: #333;
        transition: 0.3s ease;
        position: relative;
        width: 180px;
    }

    .content-card:hover {
        transform: scale(1.05);
    }

    .content-card img {
        width: 100%;
        height: 130px;
        object-fit: cover;
        border-radius: 0.8rem;
    }

    .audio-button {
        position: absolute;
        top: 10px;
        left: 10px;
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
    }

    .content-title {
        font-weight: bold;
        margin-top: 0.5rem;
    }

    /* 🎯 Full Width Song Video */
    .song-video {
        width: 90%;
        max-width: 800px;
        height: 450px;
        border-radius: 1rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        object-fit: cover;
        margin: 0 auto 2rem;
    }
</style>

<div class="category-wrapper">
    <h1 class="category-title">{{ strtoupper($category) }}</h1>

    <a href="{{ route('kids.home') }}" class="back-button">← Back to Categories</a>

    <div id="spinner" class="spinner"></div>

    <div class="content-grid" style="display: none;" id="contentGrid">

    @if (strtolower($category) === 'songs')
        @foreach($contents as $group)
            <div class="song-video">
                @php
                    $image = $group->firstWhere('media_type', 'image');
                    $video = $group->firstWhere('media_type', 'video');
                @endphp

                @if($video)
                    <video controls 
                        poster="{{ $video->poster_path 
                                    ? asset('storage/' . $video->poster_path) 
                                    : ($image ? asset('storage/' . $image->media_path) : asset('images/kids/video-thumbnail.jpg')) 
                                }}">
                        <source src="{{ asset('storage/' . $video->media_path) }}">
                    </video>
                @elseif($image)
                    <img src="{{ asset('storage/' . $image->media_path) }}" alt="{{ $image->title }}">
                @endif

                <div class="content-title">{{ $group->first()->title }}</div>
            </div>
        @endforeach
        @else
            {{-- For ABC, Numbers, Animals, etc (group image + audio) --}}
            @foreach($contents as $title => $items)
                <div class="content-card">

                    {{-- Audio Button if exists --}}
                    @foreach($items as $item)
                        @if($item->media_type === 'audio')
                            <button onclick="document.getElementById('audio-{{ $item->id }}').play()" class="audio-button">🔊</button>

                            <audio id="audio-{{ $item->id }}" style="display: none;">
                                <source src="{{ asset('storage/' . $item->media_path) }}">
                            </audio>
                        @endif
                    @endforeach

                    {{-- Image if exists --}}
                    @foreach($items as $item)
                        @if($item->media_type === 'image')
                            <img src="{{ asset('storage/' . $item->media_path) }}" alt="{{ $title }}">
                        @endif
                    @endforeach

                    <div class="content-title">{{ $title }}</div>

                    @auth
                        @if(Auth::user()->role === 'tutor')
                            <div class="admin-controls" style="margin-top: 0.5rem;">
                                <a href="{{ route('contents.edit', $items->first()->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('contents.destroy', $items->first()->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div>
            @endforeach
        @endif

    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.getElementById('spinner').style.display = 'none';
            document.getElementById('contentGrid').style.display = 'grid';
        }, 1000);
    });
</script>
@endsection
