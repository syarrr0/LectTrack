<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification | LectTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc;
            background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            position: relative;
            overflow-x: hidden;
            min-height: 100vh;
        }

        .bg-glow-top {
            position: absolute;
            top: -5%;
            right: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.08) 0%, transparent 70%);
            z-index: -1;
        }

        .bg-glow-bottom {
            position: absolute;
            bottom: -5%;
            left: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.05) 0%, transparent 70%);
            z-index: -1;
        }
        
        .fade-in { animation: fadeIn 0.5s ease-out forwards; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .scale-up { animation: scaleUp 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        @keyframes scaleUp {
            from { transform: scale(0); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body class="antialiased text-slate-900">

    <div class="bg-glow-top"></div>
    <div class="bg-glow-bottom"></div>

    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-xl shadow-lg">
                    <i data-lucide="bell" class="w-5 h-5 text-white"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-tight text-slate-800">System Notification</h1>
                    <p class="text-[10px] text-blue-600 font-black uppercase tracking-[0.2em]">LectTrack Admin Area</p>
                </div>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-blue-600 transition-all bg-slate-100 px-4 py-2 rounded-xl">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-6 py-16 relative">
        
        @if(!session('success'))
        <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl shadow-slate-200/50 p-1 fade-in">
            <div class="bg-white rounded-[2.2rem] p-8 md:p-10">
                <h2 class="text-2xl font-bold text-slate-800 mb-8 flex items-center gap-3">
                    <span class="w-8 h-1 bg-blue-600 rounded-full"></span>
                    New Announcement
                </h2>

                <form action="{{ route('admin.notifications.store') }}" method="POST" onsubmit="showLoading()">
                    @csrf
                    
                    <div class="space-y-8">
                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Title</label>
                            <input type="text" name="title" placeholder="What is this about?" 
                                   class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl px-6 py-4 focus:outline-none focus:border-blue-500 focus:bg-white transition-all font-medium text-slate-700 shadow-sm" required>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Date</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-600 transition-colors">
                                    <i data-lucide="calendar" class="w-5 h-5"></i>
                                </div>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}"
                                       class="w-full bg-slate-50 border-2 border-slate-100 rounded-2xl pl-14 pr-6 py-4 focus:outline-none focus:border-blue-500 focus:bg-white transition-all font-medium text-slate-700 shadow-sm" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Message Content</label>
                            <textarea name="content" rows="6" placeholder="Type your full message here..." 
                                      class="w-full bg-slate-50 border-2 border-slate-100 rounded-3xl px-6 py-5 focus:outline-none focus:border-blue-500 focus:bg-white transition-all resize-none font-medium text-slate-700 shadow-sm" required></textarea>
                        </div>

                        <button type="submit" id="sendBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-2xl font-bold text-lg shadow-xl shadow-blue-200 transition-all flex items-center justify-center gap-3 active:scale-95">
                            <i data-lucide="send" class="w-5 h-5" id="btnIcon"></i> 
                            <span id="sendText">Send Announcement</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @else
        <div class="bg-white border border-slate-100 rounded-[3rem] shadow-2xl p-12 text-center fade-in">
            <div class="flex justify-center mb-8">
                <div class="bg-green-50 p-8 rounded-full scale-up relative">
                    <div class="absolute inset-0 bg-green-200 rounded-full animate-ping opacity-20"></div>
                    <i data-lucide="check-circle" class="w-20 h-20 text-green-500 relative z-10"></i>
                </div>
            </div>
            
            <h2 class="text-3xl font-black text-slate-900 mb-3">Message Sent!</h2>
            <p class="text-slate-500 mb-12 text-lg max-w-sm mx-auto font-medium">Your message is now live and visible to everyone.</p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('admin.dashboard') }}" class="flex-1 bg-slate-900 hover:bg-black text-white py-4 rounded-2xl font-bold flex items-center justify-center gap-2 transition-all shadow-lg active:scale-95">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Back to Dashboard
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="flex-1 bg-white border-2 border-slate-100 text-slate-600 py-4 rounded-2xl font-bold hover:bg-slate-50 transition-all active:scale-95">
                    Send Another
                </a>
            </div>
        </div>
        @endif

    </main>

    <footer class="py-10 text-center">
        <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">LectTrack Messaging &copy; 2026</p>
    </footer>

    <script>
        lucide.createIcons();

        function showLoading() {
            const btn = document.getElementById('sendBtn');
            const text = document.getElementById('sendText');
            const icon = document.getElementById('btnIcon');
            
            btn.classList.add('opacity-70', 'pointer-events-none', 'bg-blue-800');
            text.innerText = 'Sending...';
            if(icon) icon.classList.add('animate-pulse');
        }
    </script>
</body>
</html>