@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-custom p-4 shadow-sm border-0">
                    <div class="text-center mb-4">
                        <h3 style="font-family: 'Playfair Display', serif;">Welcome Back</h3>
                        <p class="text-muted">Login to continue to Chic & Co.</p>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="hello@example.com">
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="••••••••">
                        </div>

                        <button class="btn btn-primary-custom w-100 mb-3">Login</button>

                        <div class="text-center">
                            <a href="#" class="text-muted small text-decoration-none">Forgot Password?</a>
                        </div>

                        <hr class="my-4">

                        <button class="btn btn-outline-dark w-100">
                            <i class="fa-brands fa-google me-2"></i> Continue with Google
                        </button>
                    </form>
                </div>
                <div class="text-center mt-3">
                    <p class="text-muted">Don't have an account? <a href="#"
                            class="fw-bold text-dark text-decoration-none">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection