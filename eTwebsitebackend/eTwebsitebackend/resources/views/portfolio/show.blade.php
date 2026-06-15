@extends('layouts.app')

@section('title', $portfolioItem->title . ' - Portfolio')

@section('content')
<!-- Hero Section -->
<section style="background:linear-gradient(135deg,#0A0E1A,#111827);padding:3rem 0" class="mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('portfolio') }}" style="color:#94A3B8" class="hover:text-white flex items-center gap-1 mb-6 inline-flex transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Portfolio
        </a>
        <h1 style="color:#E2E8F0" class="text-4xl md:text-5xl font-bold mb-4">
            {{ $portfolioItem->title }}
        </h1>
        <p style="color:#94A3B8" class="text-lg">
            Category: <span class="font-semibold">{{ $portfolioItem->category }}</span>
        </p>
    </div>
</section>

<!-- Main Content -->
<section style="background:#0A0E1A;padding:3rem 0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Image -->
            <div class="lg:col-span-2">
                @if($portfolioItem->image_url)
                <div style="border:1px solid rgba(255,255,255,0.08)" class="rounded-lg overflow-hidden shadow-lg mb-8">
                    <img 
                        src="{{ $portfolioItem->image_url }}" 
                        alt="{{ $portfolioItem->title }}"
                        class="w-full h-auto"
                    >
                </div>
                @endif

                <!-- Description -->
                <div class="space-y-6">
                    @if($portfolioItem->description)
                    <div>
                        <h2 style="color:#E2E8F0" class="text-2xl font-bold mb-3">Project Overview</h2>
                        <p style="color:#94A3B8" class="leading-relaxed whitespace-pre-line">
                            {{ $portfolioItem->description }}
                        </p>
                    </div>
                    @endif

                    <!-- Key Information -->
                    <div style="background:#111827;border:1px solid rgba(255,255,255,0.08)" class="rounded-lg p-6">
                        <h3 style="color:#E2E8F0" class="text-xl font-bold mb-4">Project Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            @if($portfolioItem->category)
                            <div>
                                <p style="color:#94A3B8" class="text-sm font-medium">Category</p>
                                <p style="color:#E2E8F0" class="font-semibold">{{ $portfolioItem->category }}</p>
                            </div>
                            @endif

                            @if($portfolioItem->client_name)
                            <div>
                                <p style="color:#94A3B8" class="text-sm font-medium">Client</p>
                                <p style="color:#E2E8F0" class="font-semibold">{{ $portfolioItem->client_name }}</p>
                            </div>
                            @endif

                            <div>
                                <p style="color:#94A3B8" class="text-sm font-medium">Project Type</p>
                                <p style="color:#E2E8F0" class="font-semibold capitalize">
                                    {{ str_replace('-', ' ', $portfolioItem->category) }}
                                </p>
                            </div>

                            <div>
                                <p style="color:#94A3B8" class="text-sm font-medium">Completed</p>
                                <p style="color:#E2E8F0" class="font-semibold">{{ $portfolioItem->created_at->format('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Logo Card -->
                @if($portfolioItem->logo_url)
                <div style="background:#111827;border:1px solid rgba(255,255,255,0.08)" class="rounded-lg shadow-md p-6 mb-6">
                    <h3 style="color:#94A3B8" class="text-sm font-semibold uppercase tracking-wide mb-4">Project Logo</h3>
                    <div style="background:#1F2937" class="flex items-center justify-center h-32 rounded">
                        <img 
                            src="{{ $portfolioItem->logo_url }}" 
                            alt="{{ $portfolioItem->title }}"
                            class="h-full w-auto object-contain p-2"
                        >
                    </div>
                </div>
                @endif

                <!-- CTA Card -->
                <div style="background:linear-gradient(135deg,#0052CC,#2684FF);color:white" class="rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-lg font-bold mb-2">Interested in This Project?</h3>
                    <p class="text-sm mb-4 opacity-90">
                        Learn more about our development process and how we can help your business.
                    </p>
                    @if($portfolioItem->external_link)
                    <a 
                        href="{{ $portfolioItem->external_link }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        style="background:white;color:#2684FF"
                        class="block w-full text-center font-semibold py-2 rounded hover:opacity-90 transition-opacity mb-3"
                    >
                        Visit Project
                    </a>
                    @endif
                    <a 
                        href="{{ route('contact') }}"
                        style="border:2px solid white;color:white"
                        class="block w-full text-center font-semibold py-2 rounded hover:opacity-80 transition-opacity"
                    >
                        Contact Us
                    </a>
                </div>

                <!-- Related Projects -->
                <div style="background:#111827;border:1px solid rgba(255,255,255,0.08)" class="rounded-lg shadow-md p-6">
                    <h3 style="color:#E2E8F0" class="text-lg font-bold mb-4">More Projects</h3>
                    <a 
                        href="{{ route('portfolio', ['category' => $portfolioItem->category]) }}"
                        style="color:#2684FF"
                        class="hover:opacity-80 font-semibold flex items-center gap-2 transition-opacity"
                    >
                        View {{ $portfolioItem->category }} Projects
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects Section -->
<section style="background:#111827;border-top:1px solid rgba(255,255,255,0.08);padding:3rem 0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 style="color:#E2E8F0" class="text-3xl md:text-4xl font-bold mb-12">Related Projects</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(\App\Models\PortfolioItem::where('category', $portfolioItem->category)->where('id', '!=', $portfolioItem->id)->take(3)->get() as $related)
            <a 
                href="{{ route('portfolio.show', $related->slug) }}"
                style="background:#0A0E1A;border:1px solid rgba(255,255,255,0.08)"
                class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-all"
            >
                <div style="background:linear-gradient(135deg,#1F2937,#0A0E1A)" class="relative h-48 overflow-hidden">
                    @if($related->image_url)
                    <img 
                        src="{{ $related->image_url }}" 
                        alt="{{ $related->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform"
                    >
                    @endif
                </div>
                <div class="p-4">
                    <h3 style="color:#E2E8F0" class="font-bold group-hover:text-blue-400 transition-colors line-clamp-2">
                        {{ $related->title }}
                    </h3>
                    <p style="color:#94A3B8" class="text-sm mt-1">{{ $related->category }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
