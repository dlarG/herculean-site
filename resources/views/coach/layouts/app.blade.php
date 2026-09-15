<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Coach Dashboard') — Herculean Dragon</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/HD_Logo_DARK.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    :root {
      --bg: #0d0d0c;
      --bg-panel: #131a30;
      --bg-panel-soft: rgba(16, 21, 43, 0.4);
      --border: rgba(255, 255, 255, 0.15); /* Was 0.08 — now more visible */
      --border-strong: rgba(255, 255, 255, 0.35);
      --gold: #3a4a8a;
      --gold-soft: #252e4d;
      --ink: #f4f1e8;
      --ink-muted: #b9b4a6;
      --pill-bg: rgba(58, 74, 138, 0.2);
      --pill-border: rgba(58, 74, 138, 0.4);
    }
    body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
    .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }

    .field {
      background: var(--bg-panel);
      border: 1px solid var(--border-strong);
      color: var(--ink);
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .field:focus {
      outline: none;
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(242, 185, 12, 0.12);
    }
    .field::placeholder { color: var(--ink-muted); opacity: 0.6; }

    select.field {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12' fill='none'%3e%3cpath d='M3 4.5L6 7.5L9 4.5' stroke='%23C99A1E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      padding-right: 2.25rem;
    }

    .pill {
      background: var(--pill-bg);
      color: var(--gold-soft);
      border: 1px solid var(--pill-border);
    }

    /* Sidebar nav link */
    .side-link {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.65rem 0.9rem;
      border-radius: 0.5rem;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--ink-muted);
      transition: color 0.15s ease, background-color 0.15s ease;
    }
    .side-link:hover {
      color: var(--gold);
      background: var(--bg-panel-soft);
    }
    .side-link.active {
      color: var(--gold);
      background: var(--pill-bg);
      border: 1px solid var(--pill-border);
    }
    .side-link svg { width: 16px; height: 16px; flex-shrink: 0; }
  </style>
</head>
<body class="antialiased">

  <div class="min-h-screen lg:flex">

    {{-- ============ SIDEBAR ============ --}}
    <aside id="coachSidebar"
       class="fixed inset-y-0 left-0 z-50 w-[260px] h-screen flex flex-col transform -translate-x-full
              lg:translate-x-0 lg:sticky lg:top-0 lg:shrink-0
              transition-transform duration-200 ease-out"
       style="background: var(--bg-panel); border-right: 1px solid var(--border);">

    {{-- Sidebar header (fixed height) --}}
    <div class="h-16 shrink-0 px-5 flex items-center justify-between border-b" style="border-color: var(--border);">
        <a href="{{ route('coach.dashboard') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('assets/navbar-logo.png') }}"
            alt="Herculean Dragon"
            class="h-9 w-auto object-contain"
            onerror="this.style.display='none';">
        </a>
        <button type="button" id="closeSidebar"
                class="lg:hidden cursor-pointer p-1.5 rounded transition-colors hover:text-[color:var(--gold)]"
                style="color: var(--ink-muted);" aria-label="Close menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
        </button>
    </div>


    {{-- Nav (scrollable if too many items) --}}
    <nav class="flex-1 overflow-y-auto p-3 space-y-1">
        <a href="{{ route('coach.dashboard') }}"
        class="side-link {{ request()->routeIs('coach.dashboard') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="7"/>
            <rect x="14" y="3" width="7" height="7"/>
            <rect x="14" y="14" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/>
        </svg>
        Dashboard
        </a>

        <a href="{{ route('coach.participants') }}"
        class="side-link {{ request()->routeIs('coach.participants') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="8.5" cy="7" r="4"/>
            <path d="M20 8v6M23 11h-6"/>
        </svg>
        Participants
        </a>

        <a href="{{ route('coach.announcements.index') }}"
        class="side-link {{ request()->routeIs('coach.announcements.*') ? 'active' : '' }}">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 11l18-5v12L3 14v-3z"/>
            <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>
        </svg>
        Announcements
        </a>
    </nav>

    {{-- Footer actions (pinned to bottom) --}}
    <div class="shrink-0 p-3 border-t" style="border-color: var(--border);">
        <a href="{{ route('coach.password.change') }}"
        class="side-link">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
        </svg>
        Change password
        </a>
    </div>
    </aside>


    {{-- Sidebar backdrop (mobile) --}}
    <div id="sidebarBackdrop"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    {{-- ============ MAIN ============ --}}
    <div class="flex-1 min-w-0 flex flex-col lg:h-screen lg:overflow-y-auto">

      {{-- Top bar (mobile) --}}
      <header class="sticky top-0 z-30 h-16 shrink-0 px-5 flex items-center justify-between gap-4 border-b backdrop-blur-sm"
        style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-color: var(--border);">

    {{-- Left: hamburger (mobile) + page title --}}
    <div class="flex items-center gap-3 min-w-0">
        <button type="button" id="openSidebar"
                class="lg:hidden cursor-pointer p-2 rounded-md transition-colors hover:text-[color:var(--gold)]"
                style="color: var(--ink-muted);" aria-label="Open menu">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="6" x2="21" y2="6"/>
            <line x1="3" y1="12" x2="21" y2="12"/>
            <line x1="3" y1="18" x2="21" y2="18"/>
        </svg>
        </button>

        {{-- Page title --}}
        <div class="min-w-0">
        <p class="font-display text-sm sm:text-base tracking-wider truncate" style="color: var(--gold);">
            @yield('page-title', 'COACH PORTAL')
        </p>
        </div>
    </div>

    {{-- Right: coach name + logout --}}
    <div class="flex items-center gap-2 sm:gap-3 shrink-0">

        {{-- Coach name (hidden on very small screens) --}}
        <div class="hidden sm:block text-right">
        <p class="text-xs leading-tight" style="color: var(--ink-muted);">Signed in as</p>
        <p class="text-sm font-semibold leading-tight truncate max-w-[180px]">{{ $coach->name ?? 'Coach' }}</p>
        </div>

        {{-- Coach avatar (mobile + desktop) --}}
        @if ($coach ?? false)
        <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
            style="background: var(--gold); color: #000;">
            {{ strtoupper(substr($coach->name, 0, 1)) }}
        </div>
        @endif

        {{-- Logout button --}}
        <form method="POST" action="{{ route('coach.logout') }}" class="shrink-0">
        @csrf
        <button type="submit"
                class="group cursor-pointer inline-flex items-center gap-2 text-sm font-medium px-3 py-2 rounded-md border transition-all
                        hover:text-[color:var(--gold)] hover:border-[color:var(--gold)] hover:bg-[color:var(--bg-panel-soft)]"
                style="color: var(--ink-muted); border-color: var(--border-strong);"
                title="Log out">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="transition-transform group-hover:translate-x-0.5">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
            <polyline points="16 17 21 12 16 7"/>
            <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            <span class="hidden sm:inline">Log out</span>
        </button>
        </form>
    </div>
    </header>

      {{-- Flash messages --}}
      <div class="max-w-6xl w-full mx-auto px-5 pt-6">
        @if (session('success'))
          <div class="rounded-lg px-4 py-3 text-sm flex items-center gap-3"
               style="background: rgba(63,122,74,0.12); border: 1px solid #3f7a4a; color: #9fe0ab;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
              <polyline points="20 6 9 17 4 12"/>
            </svg>
            <span>{{ session('success') }}</span>
          </div>
        @endif
        @if (session('error'))
          <div class="rounded-lg px-4 py-3 text-sm"
               style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
            {{ session('error') }}
          </div>
        @endif
      </div>

      {{-- Page content --}}
      <main class="flex-1 max-w-6xl w-full mx-auto px-5 py-8">
        @yield('content')
      </main>

    </div>
  </div>

  <script>
    // Sidebar toggle (mobile only)
    (function () {
      const sidebar = document.getElementById('coachSidebar');
      const backdrop = document.getElementById('sidebarBackdrop');
      const openBtn = document.getElementById('openSidebar');
      const closeBtn = document.getElementById('closeSidebar');

      function open() {
        sidebar.classList.remove('-translate-x-full');
        backdrop.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
      }
      function close() {
        sidebar.classList.add('-translate-x-full');
        backdrop.classList.add('hidden');
        document.body.style.overflow = '';
      }

      openBtn?.addEventListener('click', open);
      closeBtn?.addEventListener('click', close);
      backdrop?.addEventListener('click', close);
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') close();
      });
    })();
  </script>
</body>
</html>