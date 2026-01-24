<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class SparkleQuiz extends Component
{
    public $step = 1;
    public $answers = [];
    public $result = null;

    public $questions = [
        1 => [
            'question' => "What's your ideal Friday night?",
            'options' => [
                'soft' => "Cozy in silk PJs, reading a book 🕯️",
                'alt' => "Underground concert or late-night drive 🎸",
                'luxury' => "Fine dining at a rooftop lounge 🍸",
                'mix' => "A little bit of everything! 🎉",
            ]
        ],
        2 => [
            'question' => "Pick a color palette:",
            'options' => [
                'soft' => "Pastels, Blush Pink, Cream 🎀",
                'alt' => "Black, Dark Red, Silver ⛓️",
                'luxury' => "Gold, Emerald, Royal Blue 👑",
                'mix' => "Neutrals with a pop of color 🎨",
            ]
        ],
        3 => [
            'question' => "What's your go-to accessory?",
            'options' => [
                'soft' => "A delicate pearl necklace 🦪",
                'alt' => "Chunky silver rings & chains 💍",
                'luxury' => "Designer handbag 👜",
                'mix' => "Statement earrings ✨",
            ]
        ],
        4 => [
            'question' => "Choose a footwear style:",
            'options' => [
                'soft' => "Ballet flats or cute sandals 🩰",
                'alt' => "Platform boots or combat boots 👢",
                'luxury' => "High heels or designer loafers 👠",
                'mix' => "Classic sneakers or ankle boots 👟",
            ]
        ],
        5 => [
            'question' => "Describe your vibe in one word:",
            'options' => [
                'soft' => "Dreamy ☁️",
                'alt' => "Edgy ⚡",
                'luxury' => "Elegant 💎",
                'mix' => "Versatile 🌟",
            ]
        ],
    ];

    public function selectOption($aesthetic)
    {
        $this->answers[$this->step] = $aesthetic;

        if ($this->step < count($this->questions)) {
            $this->step++;
        } else {
            $this->calculateResult();
        }
    }

    public function calculateResult()
    {
        $counts = array_count_values($this->answers);
        arsort($counts);
        $this->result = array_key_first($counts);

        // Save to session
        Session::put('user_aesthetic', $this->result);

        // Also update user if logged in
        if (auth()->check()) {
            $user = auth()->user();
            $user->style_persona = $this->result;
            $user->save();

            // Save for historical analysis
            \App\Models\StyleQuizResult::create([
                'user_id' => $user->id,
                'dominant_aesthetic' => $this->result,
                'preferences' => $this->answers
            ]);
        }

        // Redirect to feed after a short delay or show result first
        // We'll show the result step
        $this->step = 'result';
    }

    public function render()
    {
        return <<<'blade'
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        @if($step === 'result')
                            <div class="card border-0 shadow-lg text-center p-5 animate-fade-in">
                                <div class="mb-4">
                                    <i class="fa-solid fa-wand-magic-sparkles fa-3x text-primary-custom" style="color: #d4af37;"></i>
                                </div>
                                <h2 class="playfair mb-3">Your Aesthetic Is...</h2>
                                <h1 class="display-4 fw-bold text-uppercase mb-4" style="letter-spacing: 2px;">
                                    @php
                                        $aestheticNames = [
                                            'soft' => 'Soft Femme 🌸',
                                            'alt' => 'Alt Girly 🖤',
                                            'luxury' => 'Luxury Clean ✨',
                                            'mix' => 'Modern Mix 🎭'
                                        ];
                                    @endphp
                                    {{ $aestheticNames[$this->result] ?? 'Aesthetic' }}
                                </h1>
                                <p class="text-muted mb-5">
                                    Our concierge has curated a personalized gallery just for your unique vibe in Amman.
                                </p>
                                <a href="{{ route('personalized.feed') }}" class="btn btn-dark btn-lg rounded-pill px-5">
                                    View Your Collection
                                </a>
                            </div>
                        @else
                            <div class="card border-0 shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <span class="text-muted small text-uppercase ls-1">Question {{ $step }} of {{ count($questions) }}</span>
                                    <div class="progress" style="width: 100px; height: 4px;">
                                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{ ($step / count($questions)) * 100 }}%"></div>
                                    </div>
                                </div>

                                <h3 class="playfair text-center mb-5">{{ $questions[$step]['question'] }}</h3>

                                <div class="d-grid gap-3">
                                    @foreach($questions[$step]['options'] as $key => $option)
                                        <button wire:click="selectOption('{{ $key }}')" 
                                                class="btn btn-outline-dark py-3 px-4 text-start d-flex justify-content-between align-items-center hover-scale transition-all">
                                            <span>{{ $option }}</span>
                                            <i class="fa-solid fa-chevron-right small opacity-50"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <style>
                    .hover-scale:hover { transform: scale(1.02); }
                    .transition-all { transition: all 0.3s ease; }
                    .playfair { font-family: 'Playfair Display', serif; }
                    .ls-1 { letter-spacing: 1px; }
                </style>
            </div>
        blade;
    }
}
