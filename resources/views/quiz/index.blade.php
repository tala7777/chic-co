@extends('layouts.app')

@section('title', 'Find Your Style')

@section('content')
    <div class="container py-5" x-data="{ step: 1, answers: {} }">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="mb-4">Find Your Style</h1>

                <!-- Progress Bar -->
                <div class="progress mb-5" style="height: 4px;">
                    <div class="progress-bar" role="progressbar" :style="'width: ' + (step * 20) + '%'"
                        style="background-color: var(--color-primary-blush);"></div>
                </div>

                <!-- Step 1: Vibe -->
                <div x-show="step === 1" x-transition>
                    <h3 class="mb-4">Which vibe feels like you?</h3>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card card-custom h-100 p-3 cursor-pointer border-0 shadow-sm"
                                @click="answers.vibe = 'soft'; step++" style="cursor: pointer;">
                                <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?ixlib=rb-4.0.3&w=400&q=80"
                                    class="rounded mb-3" alt="Soft">
                                <h5>Soft Girl 🌸</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom h-100 p-3 cursor-pointer border-0 shadow-sm"
                                @click="answers.vibe = 'alt'; step++" style="cursor: pointer;">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&w=400&q=80"
                                    class="rounded mb-3" alt="Alt">
                                <h5>Alt Girl 🖤</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-custom h-100 p-3 cursor-pointer border-0 shadow-sm"
                                @click="answers.vibe = 'clean'; step++" style="cursor: pointer;">
                                <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105?ixlib=rb-4.0.3&w=400&q=80"
                                    class="rounded mb-3" alt="Clean">
                                <h5>Clean Girl 🤍</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Colors -->
                <div x-show="step === 2" x-transition style="display: none;">
                    <h3 class="mb-4">Pick a color palette</h3>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <button @click="answers.color = 'pastels'; step++" class="btn p-4 rounded-circle shadow-sm"
                            style="background: #FFE5EC; width: 100px; height: 100px; border: 2px solid transparent;">Pastels</button>
                        <button @click="answers.color = 'dark'; step++" class="btn p-4 rounded-circle shadow-sm"
                            style="background: #1E1E1E; color: white; width: 100px; height: 100px; border: 2px solid transparent;">Dark</button>
                        <button @click="answers.color = 'neutral'; step++" class="btn p-4 rounded-circle shadow-sm"
                            style="background: #F8F9FA; width: 100px; height: 100px; border: 2px solid #ddd;">Neutral</button>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-link text-muted" @click="step--">Back</button>
                    </div>
                </div>

                <!-- Step 3: Occasion -->
                <div x-show="step === 3" x-transition style="display: none;">
                    <h3 class="mb-4">Where are you going?</h3>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card card-custom p-4 cursor-pointer" @click="answers.occasion = 'casual'; step++">
                                <h5>Uni / Work / Coffee ☕</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-custom p-4 cursor-pointer" @click="answers.occasion = 'event'; step++">
                                <h5>Evening / Event / Date ✨</h5>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-link text-muted" @click="step--">Back</button>
                    </div>
                </div>

                <!-- Step 4: Budget -->
                <div x-show="step === 4" x-transition style="display: none;">
                    <h3 class="mb-4">What's the budget?</h3>
                    <div class="btn-group-vertical w-50 gap-2">
                        <button @click="answers.budget = 'save'; step++" class="btn btn-outline-dark py-3 rounded">Just
                            browsing (Low)</button>
                        <button @click="answers.budget = 'spend'; step++" class="btn btn-outline-dark py-3 rounded">Treat
                            myself (Mid)</button>
                        <button @click="answers.budget = 'splurge'; step++"
                            class="btn btn-outline-dark py-3 rounded">Investment pieces (High)</button>
                    </div>
                    <div class="mt-4">
                        <button type="button" class="btn btn-link text-muted" @click="step--">Back</button>
                    </div>
                </div>

                <!-- Step 5: Result (Mock) -->
                <div x-show="step === 5" x-transition style="display: none;">
                    <h2 class="mb-3">We found your match!</h2>
                    <p class="lead mb-5">Based on your choices, you are a <strong>Soft Luxury Icon</strong>.</p>
                    <div class="spinner-border text-primary-custom mb-4" role="status"
                        style="color: var(--color-primary-blush);">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-muted">Curating your store... (Mock redirect)</p>

                    <div class="mt-3">
                        <a href="{{ url('/shop') }}" class="btn btn-primary-custom px-5">Go to My Shop</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection