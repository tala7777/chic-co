@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg p-4 animate-fade-in" style="border-radius: 24px;">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <h2 class="mb-2">Welcome Back</h2>
                            <p class="text-muted small">Enter your credentials to access your account</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label small fw-bold text-uppercase"
                                    style="letter-spacing: 1px;">Email Address</label>
                                <input id="email" type="email"
                                    class="form-control form-control-lg bg-light border-0 @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                    style="border-radius: 12px; font-size: 0.9rem;">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="form-label small fw-bold text-uppercase"
                                        style="letter-spacing: 1px;">Password</label>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none small text-muted" href="{{ route('password.request') }}">
                                            Forgot?
                                        </a>
                                    @endif
                                </div>
                                <input id="password" type="password"
                                    class="form-control form-control-lg bg-light border-0 @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password"
                                    style="border-radius: 12px; font-size: 0.9rem;">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check custom-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label small" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary-custom py-3 fw-bold">
                                    SIGN IN
                                </button>
                            </div>

                            <div class="text-center mt-5">
                                <p class="small text-muted mb-0">Don't have an account?</p>
                                <a href="{{ route('register') }}" class="fw-bold text-dark text-decoration-none">Create an
                                    Account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection