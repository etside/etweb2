@extends('layouts.app')

@section('title', 'Portfolio - engineersTech')

@section('content')
<!-- Hero Section -->
<section style="background:linear-gradient(135deg,#0A0E1A,#111827);padding:4rem 0 6rem" class="mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <h1 style="color:#E2E8F0" class="text-4xl md:text-5xl font-bold mb-6">
                Showcasing Our Journey of Innovation & Impact
            </h1>
            <p style="color:#94A3B8" class="text-lg">
                Explore our diverse portfolio of successful projects across multiple industries and technologies.
            </p>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section style="background:#111827;border-top:1px solid rgba(255,255,255,0.08);border-bottom:1px solid rgba(255,255,255,0.08);padding:3rem 0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($stats as $stat)
            <div class="text-center">
                <div style="color:#2684FF" class="text-4xl md:text-5xl font-bold mb-3">
                    {{ $stat['value'] }}
                </div>
                <p style="color:#E2E8F0" class="text-lg font-semibold">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Filter Section -->
<section style="background:#0A0E1A;padding:3rem 0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-12">
            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap gap-3 justify-center mb-12">
                @foreach($categories as $cat)
                <a 
                    href="{{ route('portfolio', ['category' => strtolower($cat === 'All' ? 'all' : $cat)]) }}"
                    style="{{ strtolower($cat === 'All' ? 'all' : $cat) === strtolower($category) ? 'background:#2684FF;color:white;border:1px solid #2684FF' : 'background:#111827;color:#94A3B8;border:1px solid rgba(255,255,255,0.08)' }}"
                    class="px-6 py-2.5 rounded-full font-medium transition-all duration-300 text-sm md:text-base"
                >
                    {{ $cat }}
                </a>
                @endforeach
            </div>

            <!-- Portfolio Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @forelse($portfolioItems as $item)
                <a 
                    href="{{ route('portfolio.show', $item->slug) }}"
                    style="background:#111827;border:1px solid rgba(255,255,255,0.08)"
                    class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1"
                >
                    <!-- Image Container -->
                    <div style="background:linear-gradient(135deg,#1F2937,#0A0E1A)" class="relative h-56 overflow-hidden">
                        @if($item->image_url)
                        <img 
                            src="{{ $item->image_url }}" 
                            alt="{{ $item->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        >
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16" style="color:#2684FF" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category Badge -->
                        <span style="background:rgba(38,132,255,0.1);color:#2684FF" class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-3">
                            {{ $item->category }}
                        </span>

                        <!-- Logo (if available) -->
                        @if($item->logo_url)
                        <div class="mb-3 h-10 w-10">
                            <img 
                                src="{{ $item->logo_url }}" 
                                alt="{{ $item->title }}"
                                class="h-full w-auto object-contain"
                            >
                        </div>
                        @endif

                        <!-- Title -->
                        <h3 style="color:#E2E8F0" class="text-xl font-bold mb-2 group-hover:text-blue-400 transition-colors line-clamp-2">
                            {{ $item->title }}
                        </h3>

                        <!-- Description -->
                        @if($item->description)
                        <p style="color:#94A3B8" class="text-sm line-clamp-3 mb-4">
                            {{ $item->description }}
                        </p>
                        @endif

                        <!-- Client Name -->
                        @if($item->client_name)
                        <p style="color:#94A3B8" class="text-sm font-medium">
                            Client: <span style="color:#E2E8F0">{{ $item->client_name }}</span>
                        </p>
                        @endif
                    </div>

                    <!-- Hover Arrow -->
                    <div style="background:white;color:#2684FF" class="absolute top-4 right-4 rounded-full p-2 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
                @empty
                <div class="col-span-full text-center py-12">
                    <p style="color:#94A3B8" class="text-lg">No portfolio items found in this category.</p>
                </div>
                @endforelse
            </div>

            <!-- Load More Button -->
            @if($portfolioItems->count() >= 9)
            <div class="flex justify-center mt-12">
                <button 
                    style="background:#2684FF;color:white"
                    class="px-8 py-3 font-semibold rounded-lg hover:opacity-90 transition-opacity flex items-center gap-2"
                    onclick="alert('Load more functionality can be implemented here')"
                >
                    Explore More Work
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- CTA Section -->
<section style="background:linear-gradient(135deg,#0052CC,#2684FF);padding:4rem 0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 style="color:#E2E8F0" class="text-3xl md:text-4xl font-bold mb-6">
            Ready to Start Your Project?
        </h2>
        <p style="color:rgba(226,232,240,0.8)" class="text-lg mb-8 max-w-2xl mx-auto">
            Let's work together to bring your vision to life. Contact our team today to discuss your project requirements.
        </p>
        <a 
            href="{{ route('contact') }}" 
            style="background:white;color:#2684FF"
            class="inline-block px-8 py-3 font-semibold rounded-lg hover:opacity-90 transition-opacity"
        >
            Get in Touch
        </a>
    </div>
</section>
@endsection
