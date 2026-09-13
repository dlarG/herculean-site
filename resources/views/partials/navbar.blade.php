<header class="p-2 sticky top-0 z-40 backdrop-blur-sm"
        style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-bottom: 1px solid var(--border);">
  <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
    <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
      {{-- Dark-mode logo --}}
      <img src="{{ asset('assets/intrams-white.png') }}"
           alt="Herculean Dragon Logo"
           class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90 logo-dark">

      {{-- Light-mode logo --}}
      <img src="{{ asset('assets/intrams-black.png') }}"
           alt="Herculean Dragon Logo"
           class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90 logo-light hidden">
    </a>

    <div class="flex items-center gap-3 sm:gap-6">
      <nav class="hidden sm:flex items-center gap-8 text-sm font-medium" style="color: var(--ink-muted);">
        <a href="#about" class="hover:text-[color:var(--gold)] transition-colors">About</a>
        <a href="#categories" class="hover:text-[color:var(--gold)] transition-colors">Categories</a>
        <a href="{{ route('schedule') }}" class="hover:text-[color:var(--gold)] transition-colors">Schedule</a>
        <a href="#faq" class="hover:text-[color:var(--gold)] transition-colors">FAQ</a>
      </nav>

      {{-- Theme toggle --}}
      <button type="button" id="themeToggle"
              class="cursor-pointer p-2 rounded-md transition-colors hover:text-[color:var(--gold)]"
              style="color: var(--ink-muted);"
              aria-label="Toggle theme">
        <svg id="themeIconSun" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="4"/>
          <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
        </svg>
        <svg id="themeIconMoon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
          <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
        </svg>
      </button>

      {{-- ===== LOG IN (desktop) ===== --}}
      <a href="{{ route('student.login') }}"
         class="hidden sm:inline-flex items-center gap-2 text-sm font-medium px-3.5 py-2 rounded-md transition-all
                hover:text-[color:var(--gold)]"
         style="color: var(--ink-muted); border: 1px solid var(--border-strong, rgba(242,185,12,0.25));">
        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
          <polyline points="10 17 15 12 10 7"/>
          <line x1="15" y1="12" x2="3" y2="12"/>
        </svg>
        <span>Log in</span>
      </a>

      {{-- ===== REGISTER (desktop) ===== --}}
      <a href="{{ route('register.create') }}"
         class="hidden sm:inline-block px-5 py-2 rounded-md font-semibold text-black transition-colors shadow-sm"
         style="background: var(--gold);">
        Register
      </a>

      {{-- ===== LOG IN (mobile) ===== --}}
      <a href="{{ route('student.login') }}"
         class="sm:hidden p-2 rounded-md transition-colors hover:text-[color:var(--gold)]"
         style="color: var(--ink-muted); border: 1px solid var(--border-strong, rgba(242,185,12,0.25));"
         aria-label="Log in">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
          <polyline points="10 17 15 12 10 7"/>
          <line x1="15" y1="12" x2="3" y2="12"/>
        </svg>
      </a>

      {{-- ===== REGISTER (mobile) ===== --}}
      <a href="{{ route('register.create') }}"
         class="sm:hidden px-4 py-1.5 rounded-md text-black text-sm font-semibold transition-colors"
         style="background: var(--gold);">
        Register
      </a>
    </div>
  </div>
</header>