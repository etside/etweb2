<nav class="fixed top-0 left-0 right-0 z-50" style="background:rgba(10,14,26,0.85);backdrop-filter:blur(20px);border-bottom:1px solid rgba(255,255,255,0.06)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 flex-shrink-0">
            <img src="{{ asset('logo.svg') }}" alt="engineersTech Logo" class="h-10 w-auto">
        </a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-1 ml-8">
            <a href="{{ route('home') }}" class="nav-link text-sm font-medium px-3 py-2 rounded {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('services') }}" class="nav-link text-sm font-medium px-3 py-2 rounded {{ request()->routeIs('services*') ? 'active' : '' }}">Services</a>
            <a href="{{ route('portfolio') }}" class="nav-link text-sm font-medium px-3 py-2 rounded {{ request()->routeIs('portfolio*') ? 'active' : '' }}">Portfolio</a>
            <a href="{{ route('about') }}" class="nav-link text-sm font-medium px-3 py-2 rounded {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            
            <!-- Dropdown Menu -->
            <div class="relative group">
                <button class="nav-link text-sm font-medium px-3 py-2 rounded flex items-center gap-1">
                    More <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </button>
                <div class="absolute left-0 mt-0 w-48 rounded-lg shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200" style="background:rgba(10,14,26,0.95);border:1px solid rgba(255,255,255,0.1)">
                    <a href="{{ route('industries') }}" class="block px-4 py-2.5 text-sm nav-link hover:bg-white/5 first:rounded-t-lg">Industries</a>
                    <a href="{{ route('careers') }}" class="block px-4 py-2.5 text-sm nav-link hover:bg-white/5">Careers</a>
                    <a href="{{ route('products') }}" class="block px-4 py-2.5 text-sm nav-link hover:bg-white/5">Products</a>
                    <a href="{{ route('faq') }}" class="block px-4 py-2.5 text-sm nav-link hover:bg-white/5">FAQ</a>
                    <a href="{{ route('blog') }}" class="block px-4 py-2.5 text-sm nav-link hover:bg-white/5 last:rounded-b-lg">Blog</a>
                </div>
            </div>
        </div>

        <!-- Desktop CTA & Mobile Toggle -->
        <div class="flex items-center gap-3">
            <a href="{{ route('contact') }}" class="hidden md:inline-flex items-center px-5 py-2 rounded-lg text-sm font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Get Started</a>
            <button id="mobile-menu-btn" class="md:hidden text-white p-2 hover:bg-white/5 rounded">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-2" style="background:rgba(10,14,26,0.95)">
        <a href="{{ route('home') }}" class="block py-2 text-sm nav-link rounded px-2 {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('services') }}" class="block py-2 text-sm nav-link rounded px-2 {{ request()->routeIs('services*') ? 'active' : '' }}">Services</a>
        <a href="{{ route('portfolio') }}" class="block py-2 text-sm nav-link rounded px-2 {{ request()->routeIs('portfolio*') ? 'active' : '' }}">Portfolio</a>
        <a href="{{ route('about') }}" class="block py-2 text-sm nav-link rounded px-2 {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <button id="mobile-more-btn" class="w-full text-left py-2 text-sm nav-link rounded px-2 flex items-center justify-between">
            More <svg class="w-4 h-4 transition-transform" id="mobile-more-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </button>
        <div id="mobile-more-menu" class="hidden pl-2 space-y-1 border-l" style="border-color:rgba(255,255,255,0.1)">
            <a href="{{ route('industries') }}" class="block py-2 text-sm nav-link rounded px-2">Industries</a>
            <a href="{{ route('careers') }}" class="block py-2 text-sm nav-link rounded px-2">Careers</a>
            <a href="{{ route('products') }}" class="block py-2 text-sm nav-link rounded px-2">Products</a>
            <a href="{{ route('faq') }}" class="block py-2 text-sm nav-link rounded px-2">FAQ</a>
            <a href="{{ route('blog') }}" class="block py-2 text-sm nav-link rounded px-2">Blog</a>
        </div>
        <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium text-white gradient-bg rounded px-2 mt-3">Get Started</a>
    </div>
</nav>

<script>
document.getElementById('mobile-menu-btn').addEventListener('click', () => {
    document.getElementById('mobile-menu').classList.toggle('hidden');
});
document.getElementById('mobile-more-btn').addEventListener('click', () => {
    const menu = document.getElementById('mobile-more-menu');
    const icon = document.getElementById('mobile-more-icon');
    menu.classList.toggle('hidden');
    icon.style.transform = menu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
});
</script>
