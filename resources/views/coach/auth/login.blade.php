<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Coach Login · Herculean Dragon</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    :root {
      --bg: #0D0D0C;
      --bg-panel: #191814;
      --bg-panel-soft: rgba(242, 185, 12, 0.04);
      --border: rgba(242, 185, 12, 0.14);
      --border-strong: rgba(242, 185, 12, 0.25);
      --gold: #F2B90C;
      --gold-soft: #C99A1E;
      --ink: #F4F1E8;
      --ink-muted: #B9B4A6;
      --pill-bg: rgba(242, 185, 12, 0.12);
      --pill-border: rgba(242, 185, 12, 0.25);
    }
    body {
      background: var(--bg);
      color: var(--ink);
      font-family: 'Inter', sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
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

    /* Subtle gold glow behind the logo */
    .logo-glow {
      filter: drop-shadow(0 0 40px rgba(242, 185, 12, 0.25));
    }

    /* Gradient border around the card */
    .auth-card {
      background: var(--bg-panel);
      border: 1px solid var(--border-strong);
      box-shadow: 0 30px 80px -40px rgba(0, 0, 0, 0.8);
    }

    /* Slight entrance animation */
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .auth-card { animation: fadeUp 0.4s ease-out; }
  </style>
</head>
<body class="antialiased">

  {{-- ===== TOP BAR ===== --}}
  <header class="w-full px-5 py-4 flex items-center justify-between max-w-6xl mx-auto"
          style="border-bottom: 1px solid var(--border);">
    <a href="{{ route('home') }}" class="flex items-center gap-2.5 group">
      <img src="{{ asset('assets/navbar-logo.png') }}"
           alt="Herculean Dragon"
           class="h-9 w-auto object-contain transition-opacity group-hover:opacity-90"
           onerror="this.style.display='none';">
      <span class="hidden sm:inline font-display text-sm tracking-wider" style="color: var(--gold);">
        HERCULEAN DRAGON
      </span>
    </a>

    <a href="{{ route('home') }}"
       class="text-sm inline-flex items-center gap-2 transition-colors hover:text-[color:var(--gold)]"
       style="color: var(--ink-muted);">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"/>
        <polyline points="12 19 5 12 12 5"/>
      </svg>
      Back to home
    </a>
  </header>

  {{-- ===== MAIN ===== --}}
  <main class="flex-1 flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-md">

      {{-- Hero dragon logo --}}
      <div class="flex justify-center mb-8">
        <img src="{{ asset('assets/hero-dragon.png') }}"
             alt="Herculean Dragon mascot"
             class="h-40 sm:h-48 w-auto object-contain logo-glow"
             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
        <div class="hidden flex-col items-center justify-center"
             style="color: var(--gold);">
          <span class="text-6xl mb-2">🐉</span>
          <p class="font-display text-lg">DRAGON</p>
        </div>
      </div>

      {{-- Heading --}}
      <div class="text-center mb-8">
        <p class="text-xs uppercase tracking-[0.3em] font-semibold mb-3 flex items-center justify-center gap-3"
           style="color: var(--gold-soft);">
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
          Coach Portal
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
        </p>

        <p class="mt-3 text-sm" style="color: var(--ink-muted);">
          Sign in to manage your events, participants, and announcements.
        </p>
      </div>

      {{-- Error alert --}}
      @if ($errors->any())
        <div class="mb-6 rounded-lg px-4 py-3 text-sm flex items-start gap-3 auth-card"
             style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <div>{{ $errors->first() }}</div>
        </div>
      @endif

      {{-- Login card --}}
      <div class="rounded-2xl p-6 sm:p-8 auth-card">
        <form method="POST" action="{{ route('coach.login') }}" class="space-y-5">
          @csrf

          {{-- Username --}}
          <div>
            <label for="username" class="block text-xs font-medium uppercase tracking-wider mb-2"
                   style="color: var(--ink-muted);">
              Username
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                    style="color: var(--ink-muted);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                  <circle cx="12" cy="7" r="4"/>
                </svg>
              </span>
              <input type="text"
                     name="username"
                     id="username"
                     required
                     autofocus
                     autocomplete="username"
                     placeholder="e.g. gsiega"
                     class="field w-full rounded-lg pl-11 pr-3.5 py-3 text-sm"
                     value="{{ old('username') }}">
            </div>
          </div>

          {{-- Password --}}
          <div>
            <label for="password" class="block text-xs font-medium uppercase tracking-wider mb-2"
                   style="color: var(--ink-muted);">
              Password
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                    style="color: var(--ink-muted);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                  <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
              </span>
              <input type="password"
                     name="password"
                     id="password"
                     required
                     autocomplete="current-password"
                     placeholder="••••••••"
                     class="field w-full rounded-lg pl-11 pr-11 py-3 text-sm">
              {{-- Show/hide toggle --}}
              <button type="button"
                      onclick="togglePassword(this)"
                      class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer p-1.5 rounded transition-colors hover:text-[color:var(--gold)]"
                      style="color: var(--ink-muted);"
                      aria-label="Toggle password visibility">
                <svg class="icon-eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
                <svg class="icon-eye-off hidden" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
              </button>
            </div>
          </div>

          {{-- Remember me --}}
          <label class="flex items-center gap-2.5 text-sm cursor-pointer select-none"
                 style="color: var(--ink-muted);">
            <input type="checkbox" name="remember"
                   class="cursor-pointer rounded"
                   style="accent-color: var(--gold);">
            Remember me on this device
          </label>

          {{-- Submit --}}
          <button type="submit"
                  class="w-full font-semibold rounded-lg px-4 py-3 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
                  style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
            Log in to Coach Portal
          </button>
        </form>

        {{-- Divider --}}
        <div class="flex items-center gap-3 my-6">
          <span class="h-px flex-1" style="background: var(--border);"></span>
          <span class="text-xs uppercase tracking-wider" style="color: var(--ink-muted);">Need help?</span>
          <span class="h-px flex-1" style="background: var(--border);"></span>
        </div>

        {{-- Help text --}}
        <div class="rounded-lg p-3.5 text-xs leading-relaxed"
             style="background: var(--bg-panel-soft); border: 1px solid var(--border); color: var(--ink-muted);">
          <p class="flex gap-2">
            <span>
              Coaches' accounts are created by the intramurals committee.
              If you can't log in, contact the admin at
              <a href="mailto:intramurals@slsu.edu.ph"
                 class="font-medium transition-colors hover:text-[color:var(--gold)]"
                 style="color: var(--gold-soft);">
                intramurals@slsu.edu.ph
              </a>.
            </span>
          </p>
        </div>
      </div>

      {{-- Footer credit --}}
      <p class="mt-8 text-center text-xs" style="color: var(--ink-muted);">
        Herculean Dragon · SLSU Sogod Intramurals
      </p>

    </div>
  </main>

  <script>
    // Show/hide password toggle
    function togglePassword(btn) {
      const input = btn.previousElementSibling;
      const eye = btn.querySelector('.icon-eye');
      const eyeOff = btn.querySelector('.icon-eye-off');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      eye.classList.toggle('hidden', isHidden);
      eyeOff.classList.toggle('hidden', !isHidden);
    }
  </script>
</body>
</html>