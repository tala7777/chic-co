@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4 animate-fade-in" style="border-radius: 24px;">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <h2 class="mb-2">Join Chic & Co.</h2>
                            <p class="text-muted small">Create your account to start your journey</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label small fw-bold text-uppercase"
                                    style="letter-spacing: 1px;">Full Name</label>
                                <input id="name" type="text"
                                    class="form-control form-control-lg bg-light border-0 @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                    style="border-radius: 12px; font-size: 0.9rem;">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label small fw-bold text-uppercase"
                                    style="letter-spacing: 1px;">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    style="border-radius: 12px; font-size: 0.9rem;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label small fw-bold text-uppercase"
                                    style="letter-spacing: 1px;">Password</label>
                                <input id="password" type="password"
                                    class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password"
                                    style="border-radius: 12px; font-size: 0.9rem;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="password-confirm" class="form-label small fw-bold text-uppercase"
                                    style="letter-spacing: 1px;">Confirm Password</label>
                                <input id="password-confirm" type="password"
                                    class="form-control form-control-lg bg-light border-0" name="password_confirmation"
                                    required autocomplete="new-password" style="border-radius: 12px; font-size: 0.9rem;">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary-custom py-3 fw-bold">
                                    CREATE ACCOUNT
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="small text-muted mb-0">Already have an account?</p>
                                <a href="{{ route('login') }}" class="fw-bold text-dark text-decoration-none">Sign In
                                    Instead</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection