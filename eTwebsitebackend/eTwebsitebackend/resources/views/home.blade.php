@extends('layouts.app')
@section('title','Home')
@section('content')
{{-- HERO --}}
<section class="relative pt-20 md:pt-24 pb-32 overflow-hidden" style="min-height: 100vh; background: linear-gradient(135deg, #050a15, #0a0f1a);">
    <!-- Animated Background Layers -->
    <div class="absolute inset-0">
        <!-- Base gradient background -->
        <div class="absolute inset-0 bg-gradient-to-br from-[#050a15] via-[#0f1729] to-[#050a15]"></div>
        
        <!-- Top-right radial gradient with blur -->
        <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full blur-[120px] opacity-20" style="background:radial-gradient(circle, rgba(38,132,255,0.2), transparent)"></div>
        
        <!-- Bottom-left radial gradient with blur -->
        <div class="absolute -bottom-40 -left-40 w-96 h-96 rounded-full blur-[120px] opacity-10" style="background:radial-gradient(circle, rgba(0,82,204,0.15), transparent)"></div>
        
        <!-- Center animated gradient orbs -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[700px] rounded-full border border-blue-500/5 animate-pulse" style="animation: pulse-glow 5s ease-in-out infinite"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] rounded-full border border-blue-400/8 animate-pulse" style="animation: pulse-glow 4s ease-in-out infinite"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] rounded-full border border-blue-300/10 animate-pulse" style="animation: pulse-glow 3s ease-in-out infinite"></div>
        
        <!-- Corner decorative borders -->
        <div class="absolute top-0 left-0 w-32 h-32 border-t border-l border-blue-400/5 rounded-tl-3xl"></div>
        <div class="absolute bottom-0 right-0 w-32 h-32 border-b border-r border-blue-400/5 rounded-br-3xl"></div>
    </div>

    <!-- Content -->
    <div class="container relative z-10 max-w-5xl">
        <div class="space-y-8 md:space-y-12">
            <div style="opacity: 1; transform: none;">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full border-2 bg-blue-500/8 text-[11px] sm:text-xs font-semibold tracking-wide" style="border-color: #2684FF; color: #2684FF;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                        <path d="M20 3v4"></path>
                        <path d="M22 5h-4"></path>
                        <path d="M4 17v2"></path>
                        <path d="M5 18H3"></path>
                    </svg>
                    AI-DRIVEN ENGINEERING
                </span>
            </div>
            <h1 class="font-bold leading-relaxed" style="opacity: 1; transform: none; font-size: clamp(2.25rem, 6.5vw, 4rem); letter-spacing: -0.02em;">
                We Build Software <span class="gradient-text">That Drives</span><br class="hidden sm:block"> Your Business Forward
            </h1>
            <p class="text-base sm:text-lg lg:text-xl text-muted-foreground leading-relaxed max-w-3xl" style="opacity: 1; transform: none; line-height: 1.8;">
                Enterprise-grade software solutions from a lean team of skilled engineers. More value, affordable cost, powered by AI. <span class="text-foreground font-medium">#drivenByEngineers</span>
            </p>
            <div class="flex flex-col sm:flex-row gap-5 pt-6" style="opacity: 1; transform: none;">
                <a href="{{ route('contact') }}">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 rounded-md gradient-bg border-0 text-primary-foreground hover:opacity-90 px-8 sm:px-10 h-12 sm:h-14 text-sm sm:text-base">
                        Get Started 
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-right">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </button>
                </a>
                <a href="{{ route('services') }}">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 rounded-md h-12 sm:h-14 text-sm sm:text-base px-8 sm:px-10 text-white hover:opacity-90" style="background-color: #000000;">
                        Our Services
                    </button>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 15px rgba(38, 132, 255, 0.05);
            }
            50% {
                box-shadow: 0 0 30px rgba(38, 132, 255, 0.1);
            }
        }
    </style>
</section>

{{-- SERVICES --}}
@if($services->count())
<section class="py-28 md:py-36">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 md:mb-20">
            <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-4" style="letter-spacing: -0.01em;">What We <span class="gradient-text">Build</span></h2>
            <p class="text-base sm:text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed">Tailored solutions across the full stack</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($services as $s)
            <div class="glass-card rounded-xl p-6 hover:border-blue-500/30 transition-colors">
                <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">{{ $s->title }}</h3>
                <p class="text-xs leading-relaxed" style="color:var(--muted)">{{ $s->description }}</p>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-10"><a href="{{ route('services') }}" class="text-sm font-medium inline-flex items-center gap-2 hover:gap-3 transition-all" style="color:#2684FF">View all services <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg></a></div>
    </div>
</section>
@endif

{{-- FEATURED PRODUCT SHOWCASE --}}
<section class="py-28 md:py-36">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-2xl overflow-hidden gradient-bg p-[1px]">
            <div class="bg-background rounded-2xl p-8 md:p-16 flex flex-col md:flex-row items-center gap-12">
                <div class="flex-1 space-y-6">
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-semibold tracking-wide">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sparkles">
                            <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path>
                            <path d="M20 3v4"></path>
                            <path d="M22 5h-4"></path>
                            <path d="M4 17v2"></path>
                            <path d="M5 18H3"></path>
                        </svg>
                        FEATURED PRODUCT
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-bold" style="letter-spacing: -0.01em;">
                        <span style="background: linear-gradient(135deg, #8c3cdd, #eb4799); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">glowup</span> — Bangladesh's Beauty & Wellness Platform
                    </h2>
                    <p class="text-muted-foreground leading-relaxed text-base">
                        Book salon services, stylists & henna artists. Buy products, event tickets & courses. Discover top-rated salons, talented stylists, and beauty products for men and women — book instantly with a few clicks.
                    </p>
                    <a href="https://glowupbd.app/" target="_blank" rel="noopener noreferrer">
                        <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary hover:bg-primary/90 h-11 px-6 py-2 gradient-bg border-0 text-primary-foreground hover:opacity-90">
                            Visit glowup 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-up-right">
                                <path d="M7 7h10v10"></path>
                                <path d="M7 17 17 7"></path>
                            </svg>
                        </button>
                    </a>
                </div>
                <div class="w-full md:w-96 shrink-0">
                    <img src="{{ asset('assets/glowup-banner-for-web-mPQHVMTM.png') }}" alt="glowup" class="w-full h-auto rounded-xl object-cover shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FEATURED SECTIONS --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">Explore Our <span class="gradient-text">Offerings</span></h2>
            <p class="text-sm" style="color:var(--muted)">Everything you need to transform your business</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Portfolio --}}
            <a href="{{ route('portfolio') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">Our Portfolio</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">Explore our successful projects across industries. From enterprise platforms to mobile applications.</p>
                <span class="text-xs font-medium" style="color:#2684FF">See Projects →</span>
            </a>

            {{-- Blog --}}
            <a href="{{ route('blog') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.228 6.228 2 10.228 2 15s4.228 8.772 10 8.772c5.771 0 10-3.956 10-8.772 0-4.772-4.229-8.747-10-8.747z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">Latest Insights</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">Read articles on technology trends, development best practices, and industry insights from our engineers.</p>
                <span class="text-xs font-medium" style="color:#2684FF">Read Articles →</span>
            </a>

            {{-- Industries --}}
            <a href="{{ route('industries') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">Industries</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">Specialized solutions for healthcare, fintech, e-commerce, education, and more industries.</p>
                <span class="text-xs font-medium" style="color:#2684FF">Explore Industries →</span>
            </a>

            {{-- Products --}}
            <a href="{{ route('products') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m0 0l8 4m-8-4v10l8 4m0-10l8 4m-8-4l8-4m0 10l-8 4m0 0l-8-4m8 4v-10"/></svg>
                </div>
                <h3 class="font-semibold mb-2">Our Products</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">Discover our ready-made software products and solutions for enterprise and SMB customers.</p>
                <span class="text-xs font-medium" style="color:#2684FF">View Products →</span>
            </a>

            {{-- Careers --}}
            <a href="{{ route('careers') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.402-9-1.145M16 6V4a2 2 0 00-2-2h-.5a2 2 0 00-2 2v2m0 0h-2.5a2 2 0 00-2 2v3.061a9.953 9.953 0 006 .7c1.863 0 3.68-.504 5.5-1.42V8a2 2 0 00-2-2z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">Join Our Team</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">We're hiring talented engineers, designers, and innovators. Be part of our AI-driven team.</p>
                <span class="text-xs font-medium" style="color:#2684FF">Open Positions →</span>
            </a>

            {{-- FAQ --}}
            <a href="{{ route('faq') }}" class="group glass-card rounded-xl p-6 hover:border-blue-500/30 transition-all hover:scale-105">
                <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="font-semibold mb-2">FAQs</h3>
                <p class="text-xs leading-relaxed mb-4" style="color:var(--muted)">Common questions about our services, pricing, engagement models, and technology approach.</p>
                <span class="text-xs font-medium" style="color:#2684FF">Get Answers →</span>
            </a>
        </div>
    </div>
</section>

{{-- CLIENT LOGOS MARQUEE --}}
@if($logos->count())
<section class="py-16 overflow-hidden" style="border-top:1px solid rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.05)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <p class="text-center text-xs font-medium uppercase tracking-widest" style="color:var(--muted)">Trusted by companies worldwide</p>
    </div>
    
    <style>
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .marquee-container {
            display: flex;
            animation: marquee 30s linear infinite;
            width: fit-content;
        }
        
        .marquee-container:hover {
            animation-play-state: paused;
        }
        
        .marquee-item {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            padding: 0 40px;
            min-width: 150px;
        }
        
        @media (max-width: 768px) {
            .marquee-item {
                padding: 0 24px;
                min-width: 120px;
            }
            
            .marquee-container {
                animation: marquee 20s linear infinite;
            }
        }
    </style>
    
    <div style="overflow: hidden; position: relative;">
        <div class="marquee-container">
            @foreach($logos as $logo)
            <div class="marquee-item">
                @if($logo->logo_url)
                <img src="{{ asset($logo->logo_url) }}" alt="{{ $logo->name }}" class="h-8 object-contain opacity-60 hover:opacity-100 transition-opacity grayscale hover:grayscale-0 duration-200" style="max-width:100px">
                @else
                <span class="text-xs font-semibold whitespace-nowrap" style="color:var(--muted)">{{ $logo->name }}</span>
                @endif
            </div>
            @endforeach
            {{-- Duplicate for seamless loop --}}
            @foreach($logos as $logo)
            <div class="marquee-item">
                @if($logo->logo_url)
                <img src="{{ asset($logo->logo_url) }}" alt="{{ $logo->name }}" class="h-8 object-contain opacity-60 hover:opacity-100 transition-opacity grayscale hover:grayscale-0 duration-200" style="max-width:100px">
                @else
                <span class="text-xs font-semibold whitespace-nowrap" style="color:var(--muted)">{{ $logo->name }}</span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- TESTIMONIALS --}}
@if($testimonials->count())
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-2xl sm:text-3xl font-bold mb-3">What Clients <span class="gradient-text">Say</span></h2>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($testimonials as $t)
            <div class="glass-card rounded-xl p-6">
                <div class="flex mb-3">@for($i=0;$i<$t->rating;$i++)<span style="color:#FBBF24">★</span>@endfor</div>
                <p class="text-sm leading-relaxed mb-4" style="color:var(--muted)">"{{ $t->quote }}"</p>
                <div class="flex items-center gap-3">
                    @if($t->photo_url)
                    <img src="{{ asset($t->photo_url) }}" alt="{{ $t->name }}" class="w-10 h-10 rounded-full object-cover">
                    @else
                    <div class="w-10 h-10 rounded-full gradient-bg flex items-center justify-center text-white text-sm font-bold">{{ strtoupper(substr($t->name,0,1)) }}</div>
                    @endif
                    <div>
                        <p class="text-sm font-semibold">{{ $t->name }}</p>
                        <p class="text-xs" style="color:var(--muted)">{{ $t->role }}@if($t->company), {{ $t->company }}@endif</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="glass-card rounded-2xl p-10 text-center hover-lift" style="background:linear-gradient(135deg,rgba(0,82,204,0.15),rgba(38,132,255,0.1))">
            <h2 class="text-2xl sm:text-3xl font-bold mb-4">Ready to build something <span class="gradient-text">great?</span></h2>
            <p class="text-sm mb-8 max-w-md mx-auto" style="color:var(--muted)">Let us turn your idea into a production-ready product. Fast, affordable, powered by AI.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 h-12 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-all hover:scale-105 active:scale-95">Start a Project →</a>
        </div>
    </div>
</section>

<!-- Scroll & Hover Animations -->
<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .glass-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .glass-card:hover {
        border-color: rgba(38, 132, 255, 0.5);
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(38, 132, 255, 0.1);
    }
    
    .hover-lift {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .hover-lift:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(0, 82, 204, 0.15);
    }
    
    .scroll-animate {
        opacity: 0;
        animation: slideInUp 0.8s ease-out forwards;
    }
    
    .scroll-animate:nth-child(1) { animation-delay: 0.1s; }
    .scroll-animate:nth-child(2) { animation-delay: 0.2s; }
    .scroll-animate:nth-child(3) { animation-delay: 0.3s; }
    .scroll-animate:nth-child(4) { animation-delay: 0.4s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('scroll-animate');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe all service cards
    document.querySelectorAll('section:not(:first-child) .glass-card').forEach(card => {
        observer.observe(card);
    });
    
    // Add staggered animation to sections
    document.querySelectorAll('section:nth-child(n+2)').forEach((section, idx) => {
        if (idx > 0) {
            section.style.opacity = '0';
            setTimeout(() => {
                section.style.animation = 'fadeIn 0.8s ease-out forwards';
            }, idx * 100);
        }
    });
    
    // Button hover effects
    document.querySelectorAll('button, a button').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection
