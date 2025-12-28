<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Notifications | LectTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            /* Ganti URL gambar di bawah dengan gambar pilihan anda atau guna Unsplash */
            background: linear-gradient(rgba(248, 250, 252, 0.8), rgba(248, 250, 252, 0.8)), 
                        url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .glass-container {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .input-group:focus-within label {
            color: #2563eb;
        }
    </style>
</head>
<body class="min-h-screen">

    <header class="bg-white/70 backdrop-blur-md border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 p-2 rounded-lg shadow-lg shadow-blue-200">
                    <i data-lucide="megaphone" class="text-white w-6 h-6"></i>
                </div>
                <div>
                    <h1 class="text-xl font-extrabold text-slate-800 tracking-tight">LectTrack Broadcast</h1>
                    <p class="text-[10px] uppercase tracking-[2px] font-bold text-blue-600">Admin Command Center</p>
                </div>
            </div>
            
            <a href="{{ route('admin.dashboard') }}" class="group flex items-center gap-2 bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-full text-sm font-bold transition-all shadow-lg active:scale-95">
                <i data-lucide="chevron-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                Return Home
            </a>
        </div>
    </header>

    <main class="py-12 px-6">
        <div class="max-w-4xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <div class="lg:col-span-4 space-y-6">
                <div class="glass-container p-6 rounded-[32px]">
                    <div class="bg-blue-50 w-12 h-12 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="info" class="text-blue-600"></i>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg mb-2">Smart Broadcast</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Notifications will be sent in real-time to all active lecturers. Ensure details are accurate before broadcasting.
                    </p>
                </div>
                <div class="glass-container p-6 rounded-[32px] bg-gradient-to-br from-blue-600 to-indigo-700 text-white border-none">
                    <i data-lucide="shield-check" class="w-10 h-10 mb-4 opacity-50"></i>
                    <h3 class="font-bold text-lg mb-1">Secure Channel</h3>
                    <p class="text-blue-100 text-xs leading-relaxed opacity-80">
                        This action is encrypted and logged for security auditing purposes.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-8">
                <div class="glass-container p-8 md:p-10 rounded-[32px]">
                    <form action="{{ route('admin.notifications.store') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            
                            <div class="input-group">
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                    <i data-lucide="type" class="w-4 h-4"></i> Notification Title
                                </label>
                                <input type="text" name="title" placeholder="Enter headline..." 
                                       class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="input-group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                        <i data-lucide="calendar-days" class="w-4 h-4"></i> Select Day
                                    </label>
                                    <select name="day" class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all" required>
                                        <option value="">Choose Day</option>
                                        <option>Monday</option><option>Tuesday</option><option>Wednesday</option>
                                        <option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                        <i data-lucide="clock" class="w-4 h-4"></i> Date
                                    </label>
                                    <input type="date" name="date" 
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all" required>
                                </div>
                            </div>

                            <div class="input-group">
                                <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-2">
                                    <i data-lucide="align-left" class="w-4 h-4"></i> Message Description
                                </label>
                                <textarea name="content" rows="4" placeholder="Type your message here..." 
                                          class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-5 py-4 text-slate-800 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all resize-none" required></textarea>
                            </div>

                            <button type="submit" class="group w-full bg-blue-600 hover:bg-blue-700 text-white py-5 rounded-2xl font-extrabold text-lg shadow-xl shadow-blue-200 transition-all flex items-center justify-center gap-3 active:scale-[0.98]">
                                <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i> 
                                Broadcast Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Mission Accomplished!',
            text: "{{ session('success') }}",
            icon: 'success',
            background: '#ffffff',
            confirmButtonColor: '#2563eb',
            customClass: {
                popup: 'rounded-[32px]',
                confirmButton: 'rounded-xl px-8 py-3'
            }
        });
    </script>
    @endif

    <script>lucide.createIcons();</script>
</body>
</html>