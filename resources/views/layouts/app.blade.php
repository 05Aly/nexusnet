<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="{ mode: localStorage.getItem('nexus_theme') || 'nexus_mockup', showDemoBanner: true }"
      x-init="$watch('mode', val => localStorage.setItem('nexus_theme', val))">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings->site_name ?? 'NexusNet' }} — Social Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Threads DESIGN.md Tokens */
            --color-ink: #000000;
            --color-paper: #fafafa;
            --color-concrete: #d5d5d5;
            --color-graphite: #969696;
            --color-charcoal: #424242;
            --color-hover-mist: #efefef;
            --color-verified-indigo: #385898;
            --color-signal-blue: #0095f6;

            /* NexusNet Mockup Tokens */
            --nexus-dark-bg: #12100e;
            --nexus-panel-dark: #181614;
            --nexus-cream-card: #f7f4ef;
            --nexus-cream-inner: #efeae2;
            --nexus-orange: #c85a32;
            --nexus-teal: #3b7a75;
            --nexus-border-Warm: #e2dcd3;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'IBM Plex Sans Arabic', 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
        }

        /* Theme 1: NexusNet Mockup (Screenshot Match) */
        body.theme-nexus {
            background-color: var(--nexus-dark-bg);
            color: #1c1917;
        }

        /* Theme 2: Threads Monochrome Paper (DESIGN.md Match) */
        body.theme-threads {
            background-color: var(--color-paper);
            color: var(--color-ink);
        }
    </style>
</head>
<body :class="mode === 'threads_paper' ? 'theme-threads' : 'theme-nexus'" class="min-h-screen flex flex-col">

    <!-- Top Global Header Bar (Matches Screenshot) -->
    <header :class="mode === 'threads_paper' ? 'bg-white border-b border-[#d5d5d5] text-black' : 'bg-[#141210] border-b border-[#262320] text-white'"
            class="h-14 px-4 lg:px-6 flex items-center justify-between sticky top-0 z-50">

        <!-- Right Side (User Profile + Notifications + Admin Link) -->
        <div class="flex items-center gap-3">
            @auth
            <div class="flex items-center gap-2.5 pl-2">
                <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-[#d5d5d5]">
                <span class="text-[13px] font-semibold" dir="ltr">{{ Auth::user()->name }}</span>
                <i data-lucide="chevron-down" class="w-3.5 h-3.5 opacity-60"></i>
            </div>
            @endauth

            <a href="{{ route('admin.index') }}"
               :class="mode === 'threads_paper' ? 'bg-black text-white' : 'bg-[#c85a32] text-white'"
               class="text-[12px] font-semibold px-3.5 py-1.5 rounded-full transition hover:opacity-90 flex items-center gap-1.5">
                <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                <span>لوحة الأدمن (CMS)</span>
            </a>

            <!-- Style Mode Switcher (Mockup vs Threads DESIGN.md) -->
            <button type="button"
                    @click="mode = (mode === 'nexus_mockup' ? 'threads_paper' : 'nexus_mockup')"
                    :class="mode === 'threads_paper' ? 'border-[#d5d5d5] text-black hover:bg-[#efefef]' : 'border-[#332f2c] text-zinc-300 hover:bg-[#221f1d]'"
                    class="text-[12px] font-semibold px-3 py-1.5 rounded-full border transition flex items-center gap-1.5">
                <i data-lucide="palette" class="w-3.5 h-3.5"></i>
                <span x-text="mode === 'nexus_mockup' ? 'تفعيل ستايل Threads Paper' : 'تفعيل ستايل NexusNet الداكن'"></span>
            </button>
        </div>

        <!-- Center Search Bar -->
        <form method="GET" action="{{ route('feed') }}" class="hidden md:flex items-center w-96">
            <div :class="mode === 'threads_paper' ? 'bg-[#fafafa] border-[#d5d5d5] text-black' : 'bg-[#1c1a18] border-[#2c2825] text-zinc-200'"
                 class="w-full flex items-center gap-2 px-3.5 py-1.5 rounded-full border text-[13px]">
                <i data-lucide="search" class="w-4 h-4 text-[#969696]"></i>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for people, posts, or topics..."
                       class="bg-transparent w-full outline-none text-[13px] placeholder-[#969696]" dir="ltr">
            </div>
        </form>

        <!-- Left Side Brand Logo (NexusNet) -->
        <a href="{{ route('feed') }}" class="flex items-center gap-2.5" dir="ltr">
            <div class="w-8 h-8 rounded-[8px] flex items-center justify-center font-black text-lg"
                 :class="mode === 'threads_paper' ? 'bg-black text-white' : 'bg-gradient-to-br from-[#c85a32] to-[#3b7a75] text-white'">
                N
            </div>
            <span class="font-bold text-lg tracking-tight" :class="mode === 'threads_paper' ? 'text-black' : 'text-white'">NexusNet</span>
        </a>
    </header>

    <!-- Main Workspace Container -->
    <div class="flex-grow">
        @yield('content')
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
