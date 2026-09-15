<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Change Password · Herculean Dragon</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/HD_Logo_DARK.png') }}">
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

    .auth-card {
      background: var(--bg-panel);
      border: 1px solid var(--border-strong);
      box-shadow: 0 30px 80px -40px rgba(0, 0, 0, 0.8);
      animation: fadeUp 0.4s ease-out;
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(8px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .strength-bar {
      height: 4px;
      border-radius: 2px;
      background: var(--border);
      overflow: hidden;
      margin-top: 8px;
    }
    .strength-bar > div {
      height: 100%;
      width: 0%;
      transition: width 0.25s ease, background-color 0.25s ease;
    }
    .strength-weak   { background: #e07a7a !important; }
    .strength-fair   { background: #e0b37a !important; }
    .strength-good   { background: #8fc98f !important; }
    .strength-strong { background: var(--gold) !important; }
  </style>
</head>
<body class="antialiased">

  {{-- Top bar --}}
  <header class="w-full px-5 py-4 flex items-center justify-between max-w-6xl mx-auto"
          style="border-bottom: 1px solid var(--border);">
    <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2.5 group">
      <img src="{{ asset('assets/navbar-logo.png') }}" alt="Herculean Dragon"
           class="h-9 w-auto object-contain transition-opacity group-hover:opacity-90"
           onerror="this.style.display='none';">
    </a>
    <a href="{{ route('student.dashboard') }}"
       class="text-sm inline-flex items-center gap-2 transition-colors hover:text-[color:var(--gold)]"
       style="color: var(--ink-muted);">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"/>
        <polyline points="12 19 5 12 12 5"/>
      </svg>
      Back to dashboard
    </a>
  </header>

  <main class="flex-1 flex items-center justify-center px-5 py-10">
    <div class="w-full max-w-md">

      <div class="text-center mb-8">
        <p class="text-xs uppercase tracking-[0.3em] font-semibold mb-3 flex items-center justify-center gap-3"
           style="color: var(--gold-soft);">
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
          Account security
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
        </p>
        <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
          @if ($student->must_change_password ?? false)
            SET A NEW PASSWORD
          @else
            CHANGE PASSWORD
          @endif
        </h1>
        <p class="mt-3 text-sm max-w-sm mx-auto" style="color: var(--ink-muted);">
          @if ($student->must_change_password ?? false)
            This is your first login, <strong style="color: var(--ink);">{{ $student->full_name }}</strong>.
            Please set a password only you know.
          @else
            Choose a new password to keep your account secure, <strong style="color: var(--ink);">{{ $student->full_name }}</strong>.
          @endif
        </p>
      </div>

      @if ($errors->any())
        <div class="mb-6 rounded-lg px-4 py-3 text-sm auth-card"
             style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
          <p class="font-semibold mb-1.5">Please fix the following</p>
          <ul class="list-disc list-inside space-y-0.5 text-xs">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @if ($student->must_change_password ?? false)
        <div class="mb-6 rounded-lg px-4 py-3 text-xs leading-relaxed flex gap-2.5"
             style="background: var(--bg-panel-soft); border: 1px solid var(--border); color: var(--ink-muted);">
          <span class="shrink-0">🔐</span>
          <span>
            Your account was created with your <strong style="color: var(--ink);">student number</strong> as the default password.
            Set a new one to secure your account.
          </span>
        </div>
      @endif

      <div class="rounded-2xl p-6 sm:p-8 auth-card">
        <form method="POST" action="{{ route('student.password.update') }}" class="space-y-5" id="changePasswordForm">
          @csrf

          {{-- Current --}}
          <div>
            <label for="current_password" class="block text-xs font-medium uppercase tracking-wider mb-2"
                   style="color: var(--ink-muted);">
              Current password
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
              <input type="password" name="current_password" id="current_password" required autofocus
                     autocomplete="current-password"
                     placeholder="Your current password"
                     class="field w-full rounded-lg pl-11 pr-3.5 py-3 text-sm">
            </div>
            @if ($student->must_change_password ?? false)
              <p class="mt-2 text-xs" style="color: var(--ink-muted);">
                Hint: your current password is your student number.
              </p>
            @endif
          </div>

          {{-- New --}}
          <div>
            <label for="password" class="block text-xs font-medium uppercase tracking-wider mb-2"
                   style="color: var(--ink-muted);">
              New password
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                    style="color: var(--ink-muted);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <path d="M12 2v20M2 12h20"/>
                </svg>
              </span>
              <input type="password" name="password" id="password" required
                     autocomplete="new-password"
                     placeholder="At least 8 characters"
                     class="field w-full rounded-lg pl-11 pr-11 py-3 text-sm" minlength="8">
              <button type="button" onclick="togglePassword(this, 'password')"
                      class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer p-1.5 rounded transition-colors hover:text-[color:var(--gold)]"
                      style="color: var(--ink-muted);" aria-label="Toggle password">
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
            <div class="strength-bar"><div id="strengthFill"></div></div>
            <p id="strengthLabel" class="mt-2 text-xs" style="color: var(--ink-muted);">
              Use 8+ characters with letters and numbers.
            </p>
          </div>

          {{-- Confirm --}}
          <div>
            <label for="password_confirmation" class="block text-xs font-medium uppercase tracking-wider mb-2"
                   style="color: var(--ink-muted);">
              Confirm new password
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                    style="color: var(--ink-muted);">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polyline points="20 6 9 17 4 12"/>
                </svg>
              </span>
              <input type="password" name="password_confirmation" id="password_confirmation" required
                     autocomplete="new-password"
                     placeholder="Repeat your new password"
                     class="field w-full rounded-lg pl-11 pr-3.5 py-3 text-sm">
            </div>
            <p id="matchLabel" class="mt-2 text-xs hidden" style="color: #e07a7a;">Passwords do not match.</p>
          </div>

          <button type="submit"
                  class="w-full font-semibold rounded-lg px-4 py-3 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
                  style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
            Update password
          </button>
        </form>
      </div>

      <p class="mt-8 text-center text-xs" style="color: var(--ink-muted);">
        Herculean Dragon · SLSU Sogod Intramurals
      </p>

    </div>
  </main>

  <script>
    function togglePassword(btn, inputId) {
      const input = document.getElementById(inputId);
      const eye = btn.querySelector('.icon-eye');
      const eyeOff = btn.querySelector('.icon-eye-off');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      eye.classList.toggle('hidden', isHidden);
      eyeOff.classList.toggle('hidden', !isHidden);
    }

    (function () {
      const pw = document.getElementById('password');
      const cf = document.getElementById('password_confirmation');
      const fill = document.getElementById('strengthFill');
      const label = document.getElementById('strengthLabel');
      const match = document.getElementById('matchLabel');
      const form = document.getElementById('changePasswordForm');

      function updateStrength() {
        const v = pw.value;
        let score = 0;
        if (v.length >= 8) score++;
        if (/[a-zA-Z]/.test(v)) score++;
        if (/[0-9]/.test(v)) score++;
        if (/[^a-zA-Z0-9]/.test(v)) score++;
        if (v.length >= 12) score++;

        fill.style.width = Math.min(score / 4, 1) * 100 + '%';
        fill.className = '';
        if (!v) {
          label.textContent = 'Use 8+ characters with letters and numbers.';
          label.style.color = 'var(--ink-muted)';
        } else if (score <= 1) {
          fill.classList.add('strength-weak');
          label.textContent = 'Weak password';
          label.style.color = '#e07a7a';
        } else if (score === 2) {
          fill.classList.add('strength-fair');
          label.textContent = 'Fair — add numbers or symbols';
          label.style.color = '#e0b37a';
        } else if (score === 3) {
          fill.classList.add('strength-good');
          label.textContent = 'Good password';
          label.style.color = '#8fc98f';
        } else {
          fill.classList.add('strength-strong');
          label.textContent = 'Strong password ✓';
          label.style.color = 'var(--gold)';
        }
      }

      function updateMatch() {
        if (!cf.value) { match.classList.add('hidden'); return; }
        match.classList.toggle('hidden', pw.value === cf.value);
      }

      pw.addEventListener('input', () => { updateStrength(); updateMatch(); });
      cf.addEventListener('input', updateMatch);
      form.addEventListener('submit', (e) => {
        if (pw.value !== cf.value) {
          e.preventDefault();
          match.classList.remove('hidden');
          cf.focus();
        }
      });
    })();
  </script>
</body>
</html>