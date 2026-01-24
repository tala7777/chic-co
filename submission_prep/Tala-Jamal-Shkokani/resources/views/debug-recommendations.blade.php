@extends('layouts.app')

@section('title', 'Debug Recommendations')

@section('content')
    <div class="container py-5">
        <h1>Recommendations Debug</h1>

        @php
            $product = \App\Models\Product::first();
            $recommendations = \App\Models\Product::where('aesthetic', $product->aesthetic)
                ->where('id', '!=', $product->id)
                ->inRandomOrder()
                ->limit(4)
                ->get();
        @endphp

        <div class="card mb-4">
            <div class="card-header">
                <h3>Current Product</h3>
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> {{ $product->id }}</p>
                <p><strong>Name:</strong> {{ $product->name }}</p>
                <p><strong>Aesthetic:</strong> {{ $product->aesthetic }}</p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <h3>Recommendations Query Result</h3>
            </div>
            <div class="card-body">
                <p><strong>Count:</strong> {{ $recommendations->count() }}</p>
                <p><strong>Condition Check:</strong> @if($recommendations->count() > 0) TRUE @else FALSE @endif</p>
            </div>
        </div>

        @if($recommendations->count() > 0)
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h3>✓ Recommendations Section SHOULD BE VISIBLE</h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach($recommendations as $rec)
                            <div class="col-6 col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5>{{ $rec->name }}</h5>
                                        <p class="small">ID: {{ $rec->id }}</p>
                                        <p class="small">Aesthetic: {{ $rec->aesthetic }}</p>
                                        <p class="small">Price: {{ $rec->price }} JOD</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h3>Testing Product Card Component</h3>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach($recommendations as $rec)
                            <div class="col-6 col-md-3">
                                <x-product-card :product="$rec" :badgeType="$rec->aesthetic"
                                    :badgeText="ucfirst($rec->aesthetic)" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="card mb-4">
                <div class="card-header bg-danger text-white">
                    <h3>✗ No Recommendations Found</h3>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Database Stats</h3>
            </div>
            <div class="card-body">
                @php
                    $aesthetics = \App\Models\Product::select('aesthetic')
                        ->distinct()
                        ->get();
                @endphp
                <ul>
                    @foreach($aesthetics as $a)
                        @php
                            $count = \App\Models\Product::where('aesthetic', $a->aesthetic)->count();
                        @endphp
                        <li><strong>{{ $a->aesthetic }}:</strong> {{ $count }} products</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection