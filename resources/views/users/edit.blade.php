@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<style>
    .page-wrapper {
        background-color: var(--bg-page);
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
    }
    .main-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }
    .card-modern {
        background: var(--bg-card);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px -2px rgba(31, 41, 55, 0.06);
        padding: 2rem;
    }
</style>

<div class="page-wrapper">
    <div class="main-container">
        <h4 class="fw-bold mb-4" style="color: var(--text-primary);">Edit User</h4>

        <div class="card-modern">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @method('PUT')
                @include('users._form')
            </form>
        </div>
    </div>
</div>

@endsection
