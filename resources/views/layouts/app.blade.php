<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management System - Eloquent Relationships</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        code, pre {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col text-slate-800">

    <!-- Top Navigation Header -->
    <header class="bg-[#1a2d42] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-6 sm:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">College Management System</h1>
                    <p class="text-slate-300 text-sm sm:text-base mt-1 font-medium">Eloquent Relationship Dashboard</p>
                </div>
                @if(!request()->routeIs('dashboard'))
                    <div>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 bg-slate-700 hover:bg-slate-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Dashboard
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-6 py-8 sm:px-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-sm text-slate-500">
        <div class="max-w-7xl mx-auto px-6">
            <p>Laravel Eloquent Relationships Demo &bull; College Management System</p>
        </div>
    </footer>

</body>
</html>
