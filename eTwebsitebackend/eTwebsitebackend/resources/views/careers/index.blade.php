@extends('layouts.app')

@section('content')
<div class="min-h-screen" style="background: linear-gradient(135deg, #0A0E1A, #111827);">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-24 mb-20">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 gradient-text">
                Careers at engineersTech
            </h1>
            <p class="text-lg max-w-3xl mx-auto mb-8" style="color: #94A3B8;">
                Join our team of talented engineers building the future of software. We're looking for passionate developers, designers, and innovators who want to make an impact.
            </p>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                @foreach ($stats as $stat)
                    <div class="rounded-lg p-6" style="background: #111827; border: 1px solid rgba(255,255,255,0.08);">
                        <p class="text-3xl md:text-4xl font-bold mb-2" style="color: #2684FF;">{{ $stat['value'] }}</p>
                        <p style="color: #94A3B8;">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Why Join Us Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 mb-12 glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-8" style="color: #E2E8F0;">Why Work at engineersTech?</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <p class="text-2xl mb-3">🚀</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Career Growth</h3>
                    <p style="color: #94A3B8;">Learn cutting-edge technologies, mentor others, and advance your career through meaningful work on high-impact projects.</p>
                </div>
                <div>
                    <p class="text-2xl mb-3">💡</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Innovation</h3>
                    <p style="color: #94A3B8;">Work on diverse projects across fintech, healthcare, logistics, and e-commerce. No boring work here.</p>
                </div>
                <div>
                    <p class="text-2xl mb-3">🌍</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Global Impact</h3>
                    <p style="color: #94A3B8;">Build software used by thousands of users globally. Your work matters and makes a real difference.</p>
                </div>
                <div>
                    <p class="text-2xl mb-3">🏆</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Competitive Compensation</h3>
                    <p style="color: #94A3B8;">Industry-leading salaries, performance bonuses (up to 3 months), and professional development allowances.</p>
                </div>
                <div>
                    <p class="text-2xl mb-3">⚖️</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Work-Life Balance</h3>
                    <p style="color: #94A3B8;">Hybrid work arrangement (3 days office, 2 remote), flexible hours, and 15+ days annual leave.</p>
                </div>
                <div>
                    <p class="text-2xl mb-3">👥</p>
                    <h3 class="text-xl font-semibold mb-3" style="color: #E2E8F0;">Great Team</h3>
                    <p style="color: #94A3B8;">Work with passionate engineers, supportive managers, and a collaborative culture that values your ideas.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Open Positions -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <h2 class="text-3xl font-bold mb-12" style="color: #E2E8F0;">Current Openings</h2>
        <div class="space-y-6">
            @foreach ($openings as $job)
                <div class="rounded-lg border transition-all duration-300 overflow-hidden" style="background: #111827; border-color: rgba(255,255,255,0.08);">
                    <div class="p-8">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                            <div>
                                <h3 class="text-2xl font-bold mb-2" style="color: #2684FF;">{{ $job['title'] }}</h3>
                                <div class="flex flex-wrap gap-3 text-sm">
                                    <span class="px-3 py-1 rounded" style="background: #1F2937; color: #94A3B8;">{{ $job['department'] }}</span>
                                    <span class="px-3 py-1 rounded" style="background: #1F2937; color: #94A3B8;">{{ $job['location'] }}</span>
                                    <span class="px-3 py-1 rounded" style="background: #1F2937; color: #94A3B8;">{{ $job['level'] }}</span>
                                    <span class="px-3 py-1 rounded" style="background: rgba(38, 132, 255, 0.1); color: #2684FF;">{{ $job['type'] }}</span>
                                </div>
                            </div>
                        </div>

                        <p class="mb-6" style="color: #94A3B8;">{{ $job['description'] }}</p>

                        <div class="grid md:grid-cols-2 gap-8 mb-6">
                            <div>
                                <h4 class="font-semibold mb-4" style="color: #2684FF;">Requirements</h4>
                                <ul class="space-y-2">
                                    @foreach ($job['requirements'] as $req)
                                        <li class="flex items-start" style="color: #94A3B8;">
                                            <span class="text-blue-400 mr-3" style="color: #2684FF;">✓</span>
                                            {{ $req }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-4" style="color: #2684FF;">What We Offer</h4>
                                <ul class="space-y-2">
                                    @foreach ($job['benefits'] as $benefit)
                                        <li class="flex items-start" style="color: #94A3B8;">
                                            <span class="mr-3">★</span>
                                            {{ $benefit }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="mailto:careers@engineerstechbd.com?subject=Application: {{ urlencode($job['title']) }}"
                               class="inline-block px-6 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                                Apply Now
                            </a>
                            <a href="{{ route('contact') }}"
                               class="inline-block px-6 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #1F2937; color: #94A3B8; border: 1px solid rgba(255,255,255,0.08);" onmouseover="this.style.background='#2F3949';" onmouseout="this.style.background='#1F2937';">
                                Ask Questions
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Application CTA -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
        <div class="rounded-2xl p-12 text-center glass-card" style="background: rgba(17,24,39,0.6); border: 1px solid rgba(255,255,255,0.08);">
            <h2 class="text-3xl font-bold mb-4" style="color: #E2E8F0;">Don't see a perfect fit?</h2>
            <p class="mb-8 max-w-2xl mx-auto" style="color: #94A3B8;">
                We're always looking for talented individuals. Send us your resume and tell us what you're interested in. We'll keep it on file and reach out when the right opportunity comes along.
            </p>
            <a href="mailto:careers@engineerstechbd.com"
               class="inline-block px-8 py-3 rounded-lg font-semibold transition-colors duration-300" style="background: #2684FF; color: white;" onmouseover="this.style.background='#0052CC';" onmouseout="this.style.background='#2684FF';">
                Send Your Resume
            </a>
        </div>
    </div>

    <!-- Culture Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-12 text-center" style="color: #E2E8F0;">Our Culture</h2>
        <p class="text-center max-w-3xl mx-auto mb-12 text-lg" style="color: #94A3B8;">
            We believe in creating an environment where talented engineers can do their best work. We value:</p>
        <div class="grid md:grid-cols-4 gap-6">
            <div class="text-center">
                <p class="text-3xl mb-3">🤝</p>
                <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Collaboration</h3>
                <p style="color: #94A3B8;" class="text-sm">We work together, share knowledge, and support each other's growth.</p>
            </div>
            <div class="text-center">
                <p class="text-3xl mb-3">💪</p>
                <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Excellence</h3>
                <p style="color: #94A3B8;" class="text-sm">We deliver high-quality code and solutions that exceed expectations.</p>
            </div>
            <div class="text-center">
                <p class="text-3xl mb-3">🎯</p>
                <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Ownership</h3>
                <p style="color: #94A3B8;" class="text-sm">We take responsibility for our work and drive projects to success.</p>
            </div>
            <div class="text-center">
                <p class="text-3xl mb-3">🚀</p>
                <h3 class="font-semibold mb-2" style="color: #E2E8F0;">Innovation</h3>
                <p style="color: #94A3B8;" class="text-sm">We embrace new ideas and continuously improve how we work.</p>
            </div>
        </div>
    </div>
</div>
@endsection
