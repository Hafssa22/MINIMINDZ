@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        color: white;
        font-family: 'Figtree', sans-serif;
    }

    .kids-wrapper {
        padding: 3rem 1rem;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .kids-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .kids-subtitle {
        font-size: 1.1rem;
        color: #e6faff;
        margin-bottom: 2rem;
        text-align: center;
    }

    .kids-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        max-width: 720px;
        width: 100%;
    }

    .kids-card {
        background-color: white;
        border-radius: 1.2rem;
        padding: 1rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .kids-card:hover {
        transform: scale(1.05);
    }

    .kids-img {
        width: 100%;
        height: 110px;
        object-fit: contain;
        border-radius: 1rem;
        margin-bottom: 0.75rem;
    }

    .kids-label {
        font-weight: bold;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }
</style>

<div class="kids-wrapper">

    <h1 class="kids-title">Welcome, Little Genius!</h1>
    <p class="kids-subtitle">This is your playground! Tap a card to learn something fun! </p>

    <div class="kids-grid">

        @foreach([
            ['name' => 'Animals', 'img' => 'animals.png'],
            ['name' => 'Numbers', 'img' => 'numbers.png'],
            ['name' => 'ABC', 'img' => 'abc.png'],
            ['name' => 'Games', 'img' => 'games.png'],
            ['name' => 'Colors', 'img' => 'colors.png'],
            ['name' => 'Songs', 'img' => 'songs.png'],
        ] as $item)

        <a href="{{ route('kids.category', $item['name']) }}" class="kids-card">
            <img src="{{ asset('images/kids/' . $item['img']) }}" class="kids-img" alt="{{ $item['name'] }}">
        </a>

        @endforeach

    </div>

</div>
@endsection
