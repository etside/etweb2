@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #0A0E1A, #111827);">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24 mb-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                Industry Expertise
            </h1>
            <p class="text-lg max-w-3xl mx-auto" style="color: #94A3B8;">
                Deep domain knowledge across fintech, healthcare, logistics, e-commerce, and more. We understand your industry challenges and deliver solutions that work.
            </p>
        </div>
    </div>

    <!-- Industries Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($industries as $industry)
                <a href="{{ route('industry.show', $industry['slug']) }}"
                   class="group rounded-xl p-8 transition-all duration-300 hover:border-blue-500/50" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                    <div class="w-14 h-14 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        @if($industry['icon'] === 'credit-card')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V5a3 3 0 00-3-3H5a3 3 0 00-3 3v11a3 3 0 003 3z"/></svg>
                        @elseif($industry['icon'] === 'heart')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        @elseif($industry['icon'] === 'truck')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        @elseif($industry['icon'] === 'shopping-cart')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 8m10 0l2 8m0 0h-2.5m2.5 0h3"/></svg>
                        @elseif($industry['icon'] === 'book-open')
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.228 2 15s4.228 8.772 10 8.772c5.771 0 10-3.956 10-8.772 0-4.772-4.229-8.747-10-8.747z"/></svg>
                        @endif
                    </div>
                    <h2 class="text-2xl font-bold mb-4 transition-colors duration-300" style="color: #2684FF;">
                        {{ $industry['name'] }}
                    </h2>
                    <p class="transition-colors duration-300" style="color: #94A3B8;">
                        Explore our expertise, proven solutions, and case studies in this industry.
                    </p>
                    <div class="mt-6 flex items-center group-hover:translate-x-2 transition-transform duration-300" style="color: #2684FF;">
                        <span class="mr-2">Learn More</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Bottom CTA -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-20 mb-20">
        <div class="rounded-2xl p-12 text-center glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-4" style="color: #E2E8F0;">Ready to transform your business?</h2>
            <p class="mb-8 max-w-2xl mx-auto" style="color: #94A3B8;">
                Let's discuss how our industry expertise can help you build better software, faster.
            </p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                Schedule Consultation
            </a>
        </div>
    </div>
</div>
@endsection
