@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #0A0E1A, #111827);">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="text-center mb-8">
            <p class="text-5xl mb-6">{{ $service['icon'] }}</p>
        </div>
        <div class="text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 gradient-text">
                {{ $service['heading'] }}
            </h1>
            <p class="text-xl max-w-3xl mx-auto" style="color: #94A3B8;">
                {{ $service['description'] }}
            </p>
        </div>
    </div>

    <!-- Overview -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-6" style="color: #E2E8F0;">{{ $service['heading'] }}</h2>
            <p class="text-lg leading-relaxed" style="color: #94A3B8;">
                {{ $service['overview'] }}
            </p>
        </div>
    </div>

    <!-- Use Cases -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12" style="color: #E2E8F0;">Typical Use Cases</h2>
        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($service['use_cases'] as $useCase)
                <div class="border rounded-lg p-6 transition-all duration-300" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                    <div class="flex items-start">
                        <span class="mr-4 text-2xl" style="color: #2684FF;">→</span>
                        <span style="color: #94A3B8;">{{ $useCase }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Tech Stack -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12" style="color: #E2E8F0;">Technology & Stack</h2>
        <div class="grid md:grid-cols-2 gap-8">
            @foreach ($service['tech_stack'] as $category => $techs)
                <div class="rounded-lg p-8" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                    <h3 class="text-xl font-semibold mb-4" style="color: #2684FF;">{{ $category }}</h3>
                    <div class="space-y-3">
                        @if (is_array($techs) && !empty($techs) && is_string(reset($techs)))
                            @foreach ($techs as $tech)
                                <div class="flex items-center">
                                    <span class="mr-3" style="color: #2684FF;">•</span>
                                    <span style="color: #94A3B8;">{{ $tech }}</span>
                                </div>
                            @endforeach
                        @else
                            @foreach ($techs as $subCat => $items)
                                <div>
                                    <p class="font-medium mb-2" style="color: #94A3B8;">{{ $subCat }}</p>
                                    <p style="color: #94A3B8;" class="text-sm">{{ is_array($items) ? implode(', ', $items) : $items }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Timeline & Details -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <div class="rounded-lg p-8 text-center" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                <p class="text-sm mb-2" style="color: #94A3B8;">Typical Timeline</p>
                <h3 class="text-3xl font-bold" style="color: #2684FF;">{{ $service['timeline'] }}</h3>
            </div>
            <div class="rounded-lg p-8 text-center" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                <p class="text-sm mb-2" style="color: #94A3B8;">Pricing Model</p>
                <h3 class="text-2xl font-bold" style="color: #2684FF;">{{ $service['pricing_model'] }}</h3>
            </div>
            <div class="rounded-lg p-8 text-center" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                <p class="text-sm mb-2" style="color: #94A3B8;">Engagement Type</p>
                <h3 class="text-2xl font-bold" style="color: #2684FF;">Custom</h3>
            </div>
        </div>
    </div>

    <!-- Our Process -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12" style="color: #E2E8F0;">Our Process</h2>
        <div class="space-y-4">
            @foreach ($service['process'] as $index => $step)
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full text-white font-bold" style="background: linear-gradient(135deg, #0052CC, #2684FF);">
                            {{ $index + 1 }}
                        </div>
                    </div>
                    <div class="ml-6 pt-2">
                        <p class="text-lg" style="color: #94A3B8;">{{ $step }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-8" style="color: #E2E8F0;">Why Choose Us?</h2>
            <ul class="space-y-6">
                <li class="flex items-start">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">★</span>
                    <div>
                        <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Proven Expertise</h3>
                        <p style="color: #94A3B8;">Years of experience delivering successful {{ $service['heading'] }} projects.</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">★</span>
                    <div>
                        <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Quality & Performance</h3>
                        <p style="color: #94A3B8;">We deliver high-performance solutions that scale with your business.</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">★</span>
                    <div>
                        <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Agile Development</h3>
                        <p style="color: #94A3B8;">Flexible, iterative approach with regular updates and stakeholder involvement.</p>
                    </div>
                </li>
                <li class="flex items-start">
                    <span class="mr-4 text-2xl" style="color: #2684FF;">★</span>
                    <div>
                        <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Ongoing Support</h3>
                        <p style="color: #94A3B8;">30 days free post-launch support and flexible maintenance packages available.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- FAQ CTA -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="grid md:grid-cols-2 gap-8">
            <div class="border rounded-lg p-8" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                <h3 class="text-2xl font-bold mb-4" style="color: #E2E8F0;">Common Questions?</h3>
                <p class="mb-6" style="color: #94A3B8;">Check out our FAQ for answers to common questions about pricing, timelines, and our process.</p>
                <a href="{{ route('faq') }}" class="inline-block px-6 py-2 rounded-lg transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                    Read FAQ
                </a>
            </div>
            <div class="border rounded-lg p-8" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                <h3 class="text-2xl font-bold mb-4" style="color: #E2E8F0;">Ready to Get Started?</h3>
                <p class="mb-6" style="color: #94A3B8;">Let's discuss your project requirements and put together a custom proposal.</p>
                <a href="{{ route('contact') }}" class="inline-block px-6 py-2 rounded-lg transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

    <!-- Related Services Link -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="text-center">
            <h2 class="text-2xl font-bold mb-8" style="color: #E2E8F0;">Explore Our Other Services</h2>
            <a href="{{ route('services') }}" class="inline-block text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300" style="background: linear-gradient(135deg, #0052CC, #2684FF);" onmouseover="this.style.boxShadow='0 0 20px rgba(38, 132, 255, 0.4)';" onmouseout="this.style.boxShadow='none';">
                View All Services
            </a>
        </div>
    </div>
</div>
@endsection
