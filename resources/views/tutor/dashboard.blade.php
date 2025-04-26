@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0cc0df;
        color: white;
        font-family: 'Figtree', sans-serif;
    }

    .tutor-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 3rem 1rem;
        text-align: center;
    }

    .tutor-header {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
    }

    .tutor-subtitle {
        font-size: 1.1rem;
        color: #f0f9fb;
        margin-bottom: 2rem;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }

    .dashboard-card {
        background-color: white;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        text-align: center;
        transition: transform 0.3s ease;
        text-decoration: none;
        color: #0cc0df;
    }

    .dashboard-card:hover {
        transform: scale(1.05);
    }

    .dashboard-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .dashboard-title {
        font-weight: bold;
        font-size: 1.1rem;
    }

    .logout-link {
        margin-top: 2rem;
        display: inline-block;
        color: white;
        font-weight: bold;
        text-decoration: underline;
    }
</style>

<div class="tutor-wrapper">
    <h1 class="tutor-header">Tutor Dashboard</h1>

    <p class="tutor-subtitle">
        Manage your learning content and keep MiniMindz kids engaged!
    </p>

    <div class="dashboard-grid">
        <a href="{{ route('contents.create') }}" class="dashboard-card">
            <div class="dashboard-icon">➕</div>
            <div class="dashboard-title">Add New Content</div>
        </a>

        <a href="{{ route('contents.index') }}" class="dashboard-card">
            <div class="dashboard-icon">📂</div>
            <div class="dashboard-title">View All Content</div>
        </a>
        <a href="{{ route('profile.edit') }}" class="dashboard-card">
            <div class="dashboard-icon">👤</div>
            <div class="dashboard-title">Edit Profile</div>
        </a>

    </div>

    <a href="{{ route('logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="logout-link">
        Log Out
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
@endsection
