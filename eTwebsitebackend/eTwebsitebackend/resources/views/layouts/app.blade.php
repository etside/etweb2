<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'engineersTech') — AI-Driven Software Engineering</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root { --primary: #0052CC; --primary-light: #2684FF; --bg: #0A0E1A; --fg: #F8FAFC; --muted: #94A3B8; --card: #111827; --border: rgba(255,255,255,0.08); }
        body { background: var(--bg); color: var(--fg); font-family: 'Poppins', sans-serif; }
        .gradient-text { background: linear-gradient(135deg, #0052CC, #2684FF); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .gradient-bg { background: linear-gradient(135deg, #0052CC, #2684FF); }
        .glass-card { background: rgba(17,24,39,0.6); backdrop-filter: blur(12px); border: 1px solid var(--border); }
        .nav-link { color: var(--muted); transition: color 0.2s; }
        .nav-link:hover, .nav-link.active { color: var(--primary-light); }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    @include('components.navbar')
    <main class="flex-1">
        @yield('content')
    </main>
    @include('components.footer')
    @include('components.cookie-consent')
    
    <!-- Floating Chat & Support Buttons -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end gap-4">
        <!-- Chat Popup Container -->
        <div id="chatPopup" class="absolute bottom-20 right-0 mb-2 w-72 sm:w-80 rounded-2xl shadow-2xl overflow-hidden hidden transition-all duration-300" style="background: #000000; opacity: 0; transform: scale(0.95); pointer-events: none; border: 1px solid rgba(255,255,255,0.1);">
            <!-- Chat Header -->
            <div class="gradient-bg p-4 flex items-center justify-between">
                <div>
                    <span class="text-sm font-semibold text-primary-foreground block">engineersTech Assistant</span>
                    <span class="text-xs text-primary-foreground/70">Powered by ChatGPT</span>
                </div>
                <button id="closeChatBtn" class="text-primary-foreground/80 hover:text-primary-foreground transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                </button>
            </div>
            
            <!-- Chat Messages -->
            <div id="chatMessages" class="h-64 sm:h-80 overflow-y-auto p-4 space-y-4" style="background: #0a0a0a; border-bottom: 1px solid rgba(255,255,255,0.1);">
                <div class="flex justify-start animate-slideIn" style="animation-delay: 0s;">
                    <div class="max-w-[85%] px-4 py-3 rounded-2xl text-sm bg-secondary text-foreground rounded-bl-none shadow-sm" style="background: rgba(20,20,20,0.8);">
                        <p class="font-medium mb-1">Hi! 👋</p>
                        <p class="text-sm leading-relaxed">I'm the engineersTech AI assistant. I can help you with:</p>
                        <ul class="text-xs mt-2 space-y-1 ml-2">
                            <li>• Our services & expertise</li>
                            <li>• Project recommendations</li>
                            <li>• Product showcase</li>
                            <li>• Pricing & capabilities</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Chat Input -->
            <div class="p-3 flex gap-2" style="background: #000000; border-top: 1px solid rgba(255,255,255,0.1);">
                <input id="chatInput" placeholder="Ask me anything..." class="flex-1 rounded-lg px-3 py-2 text-sm text-foreground outline-none placeholder:text-muted-foreground border transition-colors" style="background: rgba(30,30,30,0.8); border-color: rgba(255,255,255,0.15); color: #f8fafc;" />
                <button id="sendChatBtn" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-lg text-sm font-medium ring-offset-background transition-all duration-200 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-white hover:bg-primary/90 hover:scale-105 active:scale-95 shrink-0 h-9 w-9">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-send"><path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z"></path><path d="m21.854 2.147-10.94 10.939"></path></svg>
                </button>
            </div>
        </div>
        
        <!-- Chat Toggle Button -->
        <button id="chatToggle" class="w-14 h-14 sm:w-16 sm:h-16 rounded-full flex items-center justify-center shadow-xl hover:scale-110 hover:shadow-2xl transition-all duration-300 animate-pulse-glow group" title="Chat with AI Assistant" style="background: #000000;">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle group-hover:scale-110 transition-transform">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
            </svg>
        </button>
        
        <!-- WhatsApp Button -->
        <a href="https://wa.me/8801873722228" target="_blank" class="w-14 h-14 sm:w-16 sm:h-16 bg-green-500 rounded-full flex items-center justify-center shadow-xl hover:scale-110 hover:shadow-2xl hover:bg-green-400 transition-all duration-300 group">
            <svg viewBox="0 0 24 24" fill="white" class="w-8 h-8 sm:w-9 sm:h-9 group-hover:scale-110 transition-transform"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </a>
    </div>
    
    <!-- Chat Toggle & Message Handler Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatToggle = document.getElementById('chatToggle');
            const chatPopup = document.getElementById('chatPopup');
            const closeBtn = document.getElementById('closeChatBtn');
            const sendBtn = document.getElementById('sendChatBtn');
            const chatInput = document.getElementById('chatInput');
            const chatMessages = document.getElementById('chatMessages');
            
            let isOpen = false;
            
            // Toggle chat popup
            chatToggle.addEventListener('click', function() {
                isOpen = !isOpen;
                if (isOpen) {
                    chatPopup.classList.remove('hidden');
                    setTimeout(() => {
                        chatPopup.style.opacity = '1';
                        chatPopup.style.transform = 'scale(1)';
                        chatPopup.style.pointerEvents = 'auto';
                    }, 10);
                    chatInput.focus();
                } else {
                    chatPopup.style.opacity = '0';
                    chatPopup.style.transform = 'scale(0.95)';
                    chatPopup.style.pointerEvents = 'none';
                    setTimeout(() => chatPopup.classList.add('hidden'), 300);
                }
            });
            
            // Close chat popup
            closeBtn.addEventListener('click', function() {
                isOpen = false;
                chatPopup.style.opacity = '0';
                chatPopup.style.transform = 'scale(0.95)';
                chatPopup.style.pointerEvents = 'none';
                setTimeout(() => chatPopup.classList.add('hidden'), 300);
            });
            
            // Send message
            function sendMessage() {
                const message = chatInput.value.trim();
                if (!message) return;
                
                // Add user message
                const userDiv = document.createElement('div');
                userDiv.className = 'flex justify-end animate-slideIn';
                userDiv.innerHTML = `
                    <div class="max-w-[85%] px-4 py-3 rounded-2xl text-sm gradient-bg text-primary-foreground rounded-br-none shadow-sm">
                        ${message}
                    </div>
                `;
                chatMessages.appendChild(userDiv);
                
                // Clear input
                chatInput.value = '';
                
                // Auto-scroll to bottom
                setTimeout(() => {
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 50);
                
                // Simulate response with typing indicator
                const typingDiv = document.createElement('div');
                typingDiv.className = 'flex justify-start animate-slideIn';
                typingDiv.innerHTML = `
                    <div class="max-w-[85%] px-4 py-3 rounded-2xl text-sm bg-secondary text-foreground rounded-bl-none shadow-sm">
                        <div class="flex gap-1">
                            <div class="w-2 h-2 bg-muted-foreground rounded-full animate-bounce" style="animation-delay: 0s"></div>
                            <div class="w-2 h-2 bg-muted-foreground rounded-full animate-bounce" style="animation-delay: 0.1s"></div>
                            <div class="w-2 h-2 bg-muted-foreground rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        </div>
                    </div>
                `;
                chatMessages.appendChild(typingDiv);
                
                setTimeout(() => {
                    chatMessages.removeChild(typingDiv);
                    
                    const botDiv = document.createElement('div');
                    botDiv.className = 'flex justify-start animate-slideIn';
                    
                    // Smart responses based on keywords
                    let response = '';
                    const lowerMsg = message.toLowerCase();
                    
                    if (lowerMsg.includes('service') || lowerMsg.includes('what do you')) {
                        response = '🎯 We specialize in:<br>• Enterprise SaaS Solutions<br>• Web & Mobile Apps<br>• UI/UX Design<br>• AI Consulting<br><br>Would you like details on any service?';
                    } else if (lowerMsg.includes('project') || lowerMsg.includes('portfolio')) {
                        response = '📋 Check out our portfolio! We\'ve delivered:<br>• GlowUp (Beauty Platform)<br>• Restaurant POS Systems<br>• Tour Booking Platforms<br>• HRM Suites<br><br>Interested in a similar project?';
                    } else if (lowerMsg.includes('product')) {
                        response = '🛍️ Our Products:<br>• GlowUp - Beauty & Wellness<br>• Restaurant POS<br>• Tour Booking System<br>• Hotel Management<br>• CRM Platform<br><br>Which interests you?';
                    } else if (lowerMsg.includes('price') || lowerMsg.includes('cost')) {
                        response = '💰 Pricing is customized based on your project scope. Let\'s discuss your requirements! 📅 Ready to schedule a call?';
                    } else if (lowerMsg.includes('team') || lowerMsg.includes('company')) {
                        response = '👥 We\'re a lean team of expert engineers focused on quality & affordability.<br><br>Want to meet the team? Let\'s connect! 🤝';
                    } else {
                        response = '✨ Great question! We can help you build enterprise-grade software with AI integration. 🚀<br><br>Tell me more about your project needs!';
                    }
                    
                    botDiv.innerHTML = `<div class="max-w-[85%] px-4 py-3 rounded-2xl text-sm bg-secondary text-foreground rounded-bl-none shadow-sm">${response}</div>`;
                    chatMessages.appendChild(botDiv);
                    chatMessages.scrollTop = chatMessages.scrollHeight;
                }, 800);
            }
            
            sendBtn.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') sendMessage();
            });
        });
    </script>
    
    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slideIn {
            animation: slideIn 0.3s ease-out;
        }
    </style>
    
    <style>
        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(38, 132, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(38, 132, 255, 0.6);
            }
        }
        
        .animate-pulse-glow {
            animation: pulse-glow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</body>
</html>
