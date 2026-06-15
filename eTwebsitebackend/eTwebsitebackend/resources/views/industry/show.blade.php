@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #0A0E1A, #111827);">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 gradient-text">
                {{ $industry['headline'] }}
            </h1>
            <p class="text-xl max-w-3xl mx-auto" style="color: #94A3B8;">
                {{ $industry['tagline'] }}
            </p>
        </div>
    </div>

    <!-- Overview Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-6" style="color: #E2E8F0;">Overview</h2>
            <p class="text-lg leading-relaxed" style="color: #94A3B8;">
                {{ $industry['description'] }}
            </p>
        </div>
    </div>

    <!-- Two Column Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Challenges -->
            <div>
                <h2 class="text-2xl font-bold mb-6" style="color: #2684FF;">Challenges We Solve</h2>
                <ul class="space-y-4">
                    @foreach ($industry['challenges'] as $challenge)
                        <li class="flex items-start">
                            <span class="mr-4 mt-1 text-xl">⚠</span>
                            <span style="color: #94A3B8;">{{ $challenge }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Solutions -->
            <div>
                <h2 class="text-2xl font-bold mb-6" style="color: #2684FF;">Our Solutions</h2>
                <ul class="space-y-4">
                    @foreach ($industry['solutions'] as $solution)
                        <li class="flex items-start">
                            <span class="mr-4 mt-1 text-xl" style="color: #2684FF;">✓</span>
                            <span style="color: #94A3B8;">{{ $solution }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Tech Stack -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12 text-center" style="color: #E2E8F0;">Technology Stack</h2>
        <div class="rounded-lg p-8" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
            <div class="flex flex-wrap gap-4 justify-center">
                @foreach ($industry['tech_stack'] as $tech)
                    <span class="text-white px-6 py-3 rounded-full font-semibold" style="background: linear-gradient(135deg, #0052CC, #2684FF);">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Case Study -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-8" style="color: #E2E8F0;">Case Study</h2>
            <h3 class="text-2xl font-semibold mb-8" style="color: #2684FF;">{{ $industry['case_study_title'] }}</h3>
            
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($industry['results'] as $result)
                    <div class="text-center">
                        <p class="text-3xl font-bold mb-2" style="color: #2684FF;">{{ explode(' ', $result)[0] }}</p>
                        <p style="color: #94A3B8;">{{ substr($result, strlen(explode(' ', $result)[0])) }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 pt-8" style="border-top: 1px solid rgba(255,255,255,0.08);">
                <p style="color: #94A3B8;" class="italic">
                    This is an example of the type of impact we deliver. Every project is customized to your specific business needs and goals.
                </p>
            </div>
        </div>
    </div>

    <!-- Comparison Table -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12" style="color: #E2E8F0;">Why Choose Us for {{ $industry['name'] }}?</h2>
        <div class="rounded-lg overflow-hidden" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
            <div class="p-8 space-y-4">
                <div class="flex items-center">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">✓</span>
                    <span style="color: #94A3B8;">Industry-specific compliance and security expertise</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">✓</span>
                    <span style="color: #94A3B8;">Proven technology stack optimized for your industry</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">✓</span>
                    <span style="color: #94A3B8;">Experience with regulatory requirements and best practices</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">✓</span>
                    <span style="color: #94A3B8;">Dedicated team with deep domain knowledge</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">✓</span>
                    <span style="color: #94A3B8;">Post-launch support and continuous optimization</span>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 text-center glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-4" style="color: #E2E8F0;">Ready to build your {{ $industry['name'] }} solution?</h2>
            <p class="mb-8 max-w-2xl mx-auto" style="color: #94A3B8;">
                Let's discuss your specific challenges and how we can help. Schedule a free 30-minute consultation today.
            </p>
            <a href="{{ route('contact') }}" class="inline-block px-8 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                Schedule Consultation
            </a>
        </div>
    </div>

    <!-- Internal Links -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-2xl font-bold mb-8" style="color: #E2E8F0;">Explore More</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <a href="{{ route('services') }}" class="border rounded-lg p-6 transition-all duration-300" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                <p class="text-2xl mb-3">🛠</p>
                <h3 class="font-semibold mb-2" style="color: #2684FF;">Explore Services</h3>
                <p style="color: #94A3B8;" class="text-sm">View all our service offerings and capabilities.</p>
            </a>
            <a href="{{ route('portfolio') }}" class="border rounded-lg p-6 transition-all duration-300" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                <p class="text-2xl mb-3">📂</p>
                <h3 class="font-semibold mb-2" style="color: #2684FF;">Case Studies</h3>
                <p style="color: #94A3B8;" class="text-sm">See detailed examples of our previous work.</p>
            </a>
            <a href="{{ route('contact') }}" class="border rounded-lg p-6 transition-all duration-300" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                <p class="text-2xl mb-3">💬</p>
                <h3 class="font-semibold mb-2" style="color: #2684FF;">Get in Touch</h3>
                <p style="color: #94A3B8;" class="text-sm">Talk to our team about your project.</p>
            </a>
        </div>
    </div>
</div>
@endsection
