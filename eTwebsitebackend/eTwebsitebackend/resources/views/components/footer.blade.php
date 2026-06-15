<footer style="background:#060914;border-top:1px solid rgba(255,255,255,0.06)" class="mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Main Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-8 mb-8">
            <!-- Brand -->
            <div class="lg:col-span-1">
                <img src="{{ asset('logo.svg') }}" alt="engineersTech Logo" class="h-10 w-auto mb-4">
                <p class="text-xs leading-relaxed" style="color:var(--muted)">AI-Driven Software Engineering. Enterprise-grade solutions from a lean team of skilled engineers.</p>
            </div>

            <!-- Products -->
            <div>
                <h4 class="text-sm font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('services') }}" class="text-xs nav-link">All Services</a></li>
                    <li><a href="{{ route('services.show', 'enterprise-saas') }}" class="text-xs nav-link">Enterprise SaaS</a></li>
                    <li><a href="{{ route('services.show', 'web-mobile') }}" class="text-xs nav-link">Web & Mobile</a></li>
                    <li><a href="{{ route('services.show', 'ui-ux') }}" class="text-xs nav-link">UI/UX Design</a></li>
                </ul>
            </div>

            <!-- Explore -->
            <div>
                <h4 class="text-sm font-semibold mb-4">Explore</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('portfolio') }}" class="text-xs nav-link">Portfolio</a></li>
                    <li><a href="{{ route('blog') }}" class="text-xs nav-link">Blog</a></li>
                    <li><a href="{{ route('industries') }}" class="text-xs nav-link">Industries</a></li>
                    <li><a href="{{ route('careers') }}" class="text-xs nav-link">Careers</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-sm font-semibold mb-4">Support</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('faq') }}" class="text-xs nav-link">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-xs nav-link">Contact Us</a></li>
                    <li><a href="{{ route('about') }}" class="text-xs nav-link">About Us</a></li>
                    <li><a href="https://e-cab.net/" target="_blank" class="text-xs nav-link">e-CAB Member</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-sm font-semibold mb-4">Contact</h4>
                <ul class="space-y-2 text-xs" style="color:var(--muted)">
                    <li class="hover:text-white transition-colors"><a href="mailto:info@engineerstechbd.com">info@engineerstechbd.com</a></li>
                    <li class="hover:text-white transition-colors"><a href="tel:+8801873722228">+880-18737-22228</a></li>
                    <li>01689877007</li>
                    <li>Dhaka, Bangladesh</li>
                </ul>
            </div>
        </div>

        <!-- Divider -->
        <div style="border-top:1px solid rgba(255,255,255,0.06);margin:2rem 0"></div>

        <!-- Bottom Section -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-xs" style="color:var(--muted)">
            <div>&copy; {{ date('Y') }} engineersTech. All rights reserved. #drivenByEngineers</div>
            <div class="flex items-center gap-6">
                <span>Reg: TRAD/DNCC/025495/2025</span>
                <a href="{{ route('privacy') }}" class="nav-link hover:text-white transition-colors">Privacy</a>
                <a href="{{ route('terms') }}" class="nav-link hover:text-white transition-colors">Terms</a>
            </div>
        </div>
    </div>
</footer>
