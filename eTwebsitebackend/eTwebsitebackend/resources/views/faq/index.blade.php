@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #0A0E1A, #111827);">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24 mb-16">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                Frequently Asked Questions
            </h1>
            <p class="text-lg" style="color: #94A3B8;" class="max-w-3xl mx-auto">
                Get answers to common questions about our services, pricing, project management, technology, security, and support.
            </p>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-12">
        <div class="flex flex-wrap gap-2 justify-center">
            <button class="filter-btn active px-4 py-2 rounded-full text-sm font-medium transition-all duration-300" style="background: #2684FF; color: white;"
                    data-category="all">
                All Questions
            </button>
            @foreach ($categories as $category)
                <button class="filter-btn px-4 py-2 rounded-full text-sm font-medium transition-all duration-300" style="background: #111827; color: #94A3B8; border: 1px solid rgba(255,255,255,0.08);" onmouseover="this.style.background='#1F2937'; this.style.color='#E2E8F0';" onmouseout="this.style.background='#111827'; this.style.color='#94A3B8';"
                        data-category="{{ strtolower(str_replace(' & ', '-', $category)) }}">
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- FAQs -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        @php
            $categoryMap = [];
            foreach ($faqs as $faq) {
                $categoryMap[strtolower(str_replace(' & ', '-', $faq['category']))] = true;
            }
        @endphp

        @foreach ($categories as $category)
            @php $categorySlug = strtolower(str_replace(' & ', '-', $category)); @endphp
            <div class="category-group" data-category="{{ $categorySlug }}">
                <h2 class="text-xl font-semibold mb-4 ml-4" style="color: #2684FF;">{{ $category }}</h2>
                
                @foreach ($faqs as $faq)
                    @if ($faq['category'] === $category)
                        <div class="faq-item mb-3 rounded-lg transition-all duration-300" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                            <button class="faq-question w-full px-6 py-4 text-left font-semibold transition-colors duration-300 flex justify-between items-center" style="color: #E2E8F0;"
                                    data-faq-id="{{ $faq['id'] }}">
                                <span>{{ $faq['question'] }}</span>
                                <svg class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            </button>
                            <div class="faq-answer hidden px-6 py-4 border-t rounded-b-lg" style="border-color: rgba(255,255,255,0.08); background: #0A0E1A; color: #94A3B8;">
                                <p>{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endforeach
    </div>

    <!-- CTA Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-16">
        <div class="rounded-2xl p-12 text-center glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-4" style="color: #E2E8F0;">Still have questions?</h2>
            <p class="mb-8 max-w-2xl mx-auto" style="color: #94A3B8;">
                Our team is here to help. Get in touch with us for personalized guidance on your project.
            </p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                Contact Us
            </a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ Accordion
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const svg = this.querySelector('svg');
                
                // Close other open FAQs
                document.querySelectorAll('.faq-question').forEach(otherBtn => {
                    if (otherBtn !== button) {
                        otherBtn.nextElementSibling.classList.add('hidden');
                        otherBtn.querySelector('svg').style.transform = 'rotate(0deg)';
                    }
                });
                
                answer.classList.toggle('hidden');
                svg.style.transform = answer.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
            });
        });

        // Category Filter
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const category = this.dataset.category;
                
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white');
                    b.classList.add('bg-gray-700', 'text-gray-300');
                });
                this.classList.remove('bg-gray-700', 'text-gray-300');
                this.classList.add('bg-blue-600', 'text-white');

                // Show/hide categories
                if (category === 'all') {
                    document.querySelectorAll('.category-group').forEach(group => {
                        group.style.display = 'block';
                    });
                } else {
                    document.querySelectorAll('.category-group').forEach(group => {
                        if (group.dataset.category === category) {
                            group.style.display = 'block';
                        } else {
                            group.style.display = 'none';
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
