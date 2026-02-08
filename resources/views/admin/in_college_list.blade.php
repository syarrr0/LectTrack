<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>In College List | LectTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen p-6">

    <div class="max-w-5xl mx-auto">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                    <i data-lucide="map-pin" class="text-green-600"></i> Staff In College Today
                </h1>
                <p class="text-slate-500">Senarai pensyarah yang berada di kampus pada {{ date('d F Y') }}</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-100 transition-all shadow-sm">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Back
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-600">
                    <tr>
                        <th class="px-6 py-4 font-semibold uppercase text-xs">No</th>
                        <th class="px-6 py-4 font-semibold uppercase text-xs">Staff Name</th>
                        <th class="px-6 py-4 font-semibold uppercase text-xs text-center">Location Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($lecturersInCollege as $index => $lecturer)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-slate-500">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="font-medium text-slate-800">{{ $lecturer->nama }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Inside Campus
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-slate-400 italic">
                            Tiada staf di kolej pada waktu ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>