<!-- GDPR Cookie Consent Banner -->
<div id="cookie-consent" class="fixed bottom-20 right-6 z-40 hidden max-w-sm" style="background:rgba(10,14,26,0.95);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.1);border-radius:12px">
    <div class="px-5 py-5">
        <div class="flex items-start gap-3 mb-4">
            <svg class="w-5 h-5 text-yellow-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 8a1 1 0 00-1-1H4a1 1 0 00-1 1v12a1 1 0 001 1h16a1 1 0 001-1V8zm-2 11H5V9h14v10zm-2-6h-8v2h8v-2z"/></svg>
            <div>
                <h3 class="text-xs font-semibold mb-1.5">Cookie Preferences</h3>
                <p class="text-xs" style="color:var(--muted);line-height:1.4">
                    We use cookies to enhance your experience. Read our 
                    <a href="{{ route('privacy') }}" class="nav-link hover:text-white underline" target="_blank">Privacy Policy</a> to learn more.
                </p>
            </div>
        </div>
        
        <!-- Floating Buttons Below -->
        <div class="flex items-center gap-2 pt-3 border-t" style="border-color:rgba(255,255,255,0.1)">
            <button id="cookie-decline" class="flex-1 px-3 py-2 rounded-lg text-xs font-medium transition-colors" style="border:1px solid rgba(255,255,255,0.2);color:var(--muted);background:transparent;hover:background:rgba(255,255,255,0.05)">Decline</button>
            <button id="cookie-accept" class="flex-1 px-3 py-2 rounded-lg text-xs font-medium text-white gradient-bg hover:opacity-90 transition-opacity">Accept</button>
        </div>
    </div>
</div>

<script>
(function() {
    const cookieConsent = document.getElementById('cookie-consent');
    const cookieAccept = document.getElementById('cookie-accept');
    const cookieDecline = document.getElementById('cookie-decline');
    
    // Check if user has already made a choice
    if (!localStorage.getItem('cookieConsent')) {
        // Show banner after 1.5 seconds
        setTimeout(() => {
            cookieConsent.classList.remove('hidden');
            // Add entrance animation
            cookieConsent.style.animation = 'slideUp 0.3s ease-out';
        }, 1500);
    }
    
    cookieAccept.addEventListener('click', () => {
        localStorage.setItem('cookieConsent', 'accepted');
        cookieConsent.style.animation = 'slideDown 0.3s ease-out';
        setTimeout(() => cookieConsent.classList.add('hidden'), 300);
        console.log('Cookies accepted');
    });
    
    cookieDecline.addEventListener('click', () => {
        localStorage.setItem('cookieConsent', 'declined');
        cookieConsent.style.animation = 'slideDown 0.3s ease-out';
        setTimeout(() => cookieConsent.classList.add('hidden'), 300);
        console.log('Cookies declined');
    });
})();
</script>

<style>
@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideDown {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(20px);
    }
}
</style>
