@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
        <h1 style="font-size: 6rem; font-family: 'Playfair Display', serif;">404</h1>
        <h3 class="mb-4">Oops! Page Not Found</h3>
        <p class="text-muted mb-4 text-center">The page you are looking for might have been removed, had its name changed,
            or is temporarily unavailable.</p>
        <a href="{{ url('/') }}" class="btn btn-dark px-5 py-3 rounded-pill">Return to Home</a>
    </div>
@endsection