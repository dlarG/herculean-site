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

    /* Password strength bar */
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

  {{-- ===== TOP BAR ===== --}}
  <header class="w-full px-5 py-4 flex items-center justify-between max-w-6xl mx-auto"
          style="border-bottom: 1px solid var(--border);">
    <a href="{{ route('coach.dashboard') }}" class="flex items-center gap-2.5 group">
      <img src="{{ asset('assets/navbar-logo.png') }}"
           alt="Herculean Dragon"
           class="h-9 w-auto object-contain transition-opacity group-hover:opacity-90"
           onerror="this.style.display='none';">
      <span class="hidden sm:inline font-display text-sm tracking-wider" style="color: var(--gold);">
        COACH PORTAL
      </span>
    </a>

    <a href="{{ route('coach.dashboard') }}"
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

  {{-- ===== MAIN ===== --}}
  <main class="flex-1 flex items-center justify-center px-5 py-10">

    <div class="w-full max-w-md">

      {{-- Heading --}}
      <div class="text-center mb-8">
        <p class="text-xs uppercase tracking-[0.3em] font-semibold mb-3 flex items-center justify-center gap-3"
           style="color: var(--gold-soft);">
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
          Account security
          <span class="inline-block w-6 h-px" style="background: var(--gold-soft);"></span>
        </p>
        <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
          @if ($coach->must_change_password ?? false)
            SET A NEW PASSWORD
          @else
            CHANGE PASSWORD
          @endif
        </h1>
        <p class="mt-3 text-sm max-w-sm mx-auto" style="color: var(--ink-muted);">
          @if ($coach->must_change_password ?? false)
            This is your first login, <strong style="color: var(--ink);">{{ $coach->name }}</strong>.
            Please set a password only you know.
          @else
            Choose a new password to keep your account secure, <strong style="color: var(--ink);">{{ $coach->name }}</strong>.
          @endif
        </p>
      </div>

      {{-- Error alert --}}
      @if ($errors->any())
        <div class="mb-6 rounded-lg px-4 py-3 text-sm auth-card"
             style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
          <p class="font-semibold mb-1.5 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            Please fix the following
          </p>
          <ul class="list-disc list-inside space-y-0.5 text-xs">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Info banner (only on first-login) --}}
      @if ($coach->must_change_password ?? false)
        <div class="mb-6 rounded-lg px-4 py-3 text-xs leading-relaxed flex gap-2.5"
             style="background: var(--bg-panel-soft); border: 1px solid var(--border); color: var(--ink-muted);">
          <span class="shrink-0">🔐</span>
          <span>
            Your account was created with a <strong style="color: var(--ink);">default password</strong>.
            Set a new one to activate full access to the coach portal.
          </span>
        </div>
      @endif

      {{-- Card --}}
      <div class="rounded-2xl p-6 sm:p-8 auth-card">
        <form method="POST" action="{{ route('coach.password.change') }}" class="space-y-5" id="changePasswordForm">
          @csrf

          {{-- Current password --}}
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
              <input type="password"
                     name="current_password"
                     id="current_password"
                     required
                     autofocus
                     autocomplete="current-password"
                     placeholder="Your current password"
                     class="field w-full rounded-lg pl-11 pr-3.5 py-3 text-sm">
            </div>
            @if ($coach->must_change_password ?? false)
              <p class="mt-2 text-xs" style="color: var(--ink-muted);">
                Hint: your current password is the one given by the committee.
              </p>
            @endif
          </div>

          {{-- New password --}}
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
                  <path d="M12 2v20M2 12h20"/>
                  <circle cx="12" cy="12" r="10"/>
                </svg>
              </span>
              <input type="password"
                     name="password"
                     id="password"
                     required
                     autocomplete="new-password"
                     placeholder="At least 8 characters"
                     class="field w-full rounded-lg pl-11 pr-11 py-3 text-sm"
                     minlength="8">
              <button type="button"
                      onclick="togglePassword(this, 'password')"
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

            {{-- Strength bar --}}
            <div class="strength-bar">
              <div id="strengthFill"></div>
            </div>
            <p id="strengthLabel" class="mt-2 text-xs" style="color: var(--ink-muted);">
              Use 8+ characters with letters and numbers.
            </p>
          </div>

          {{-- Confirm new password --}}
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
              <input type="password"
                     name="password_confirmation"
                     id="password_confirmation"
                     required
                     autocomplete="new-password"
                     placeholder="Repeat your new password"
                     class="field w-full rounded-lg pl-11 pr-3.5 py-3 text-sm">
            </div>
            <p id="matchLabel" class="mt-2 text-xs hidden" style="color: #e07a7a;">
              Passwords do not match.
            </p>
          </div>

          {{-- Submit --}}
          <button type="submit"
                  class="w-full font-semibold rounded-lg px-4 py-3 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
                  style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
            Update password
          </button>
        </form>

        {{-- Requirements --}}
        <div class="mt-6 pt-5 border-t" style="border-color: var(--border);">
          <p class="text-xs font-semibold uppercase tracking-wider mb-3" style="color: var(--gold-soft);">
            Password requirements
          </p>
          <ul class="space-y-2 text-xs" style="color: var(--ink-muted);">
            <li class="flex items-center gap-2.5" id="req-length">
              <span class="req-icon shrink-0" style="color: var(--ink-muted);">○</span>
              <span>At least 8 characters</span>
            </li>
            <li class="flex items-center gap-2.5" id="req-letter">
              <span class="req-icon shrink-0" style="color: var(--ink-muted);">○</span>
              <span>Contains at least one letter</span>
            </li>
            <li class="flex items-center gap-2.5" id="req-number">
              <span class="req-icon shrink-0" style="color: var(--ink-muted);">○</span>
              <span>Contains at least one number</span>
            </li>
          </ul>
        </div>
      </div>

      {{-- Cancel link (only when NOT forced) --}}
      @unless ($coach->must_change_password ?? false)
        <div class="mt-6 text-center">
          <a href="{{ route('coach.dashboard') }}"
             class="text-sm transition-colors hover:text-[color:var(--gold)]"
             style="color: var(--ink-muted);">
            Cancel and return to dashboard
          </a>
        </div>
      @endunless

      <p class="mt-8 text-center text-xs" style="color: var(--ink-muted);">
        Herculean Dragon · SLSU Sogod Intramurals
      </p>

    </div>
  </main>

  <script>
    // Show/hide password toggle
    function togglePassword(btn, inputId) {
      const input = document.getElementById(inputId);
      const eye = btn.querySelector('.icon-eye');
      const eyeOff = btn.querySelector('.icon-eye-off');
      const isHidden = input.type === 'password';
      input.type = isHidden ? 'text' : 'password';
      eye.classList.toggle('hidden', isHidden);
      eyeOff.classList.toggle('hidden', !isHidden);
    }

    // Live password strength + requirement checking
    (function () {
      const passwordInput = document.getElementById('password');
      const confirmInput = document.getElementById('password_confirmation');
      const strengthFill = document.getElementById('strengthFill');
      const strengthLabel = document.getElementById('strengthLabel');
      const matchLabel = document.getElementById('matchLabel');
      const form = document.getElementById('changePasswordForm');

      const reqLength = document.getElementById('req-length');
      const reqLetter = document.getElementById('req-letter');
      const reqNumber = document.getElementById('req-number');

      function markReq(el, passed) {
        const icon = el.querySelector('.req-icon');
        icon.textContent = passed ? '●' : '○';
        icon.style.color = passed ? 'var(--gold)' : 'var(--ink-muted)';
        el.style.color = passed ? 'var(--ink)' : 'var(--ink-muted)';
      }

      function scorePassword(pw) {
        let score = 0;
        const hasLength = pw.length >= 8;
        const hasLetter = /[a-zA-Z]/.test(pw);
        const hasNumber = /[0-9]/.test(pw);
        const hasSpecial = /[^a-zA-Z0-9]/.test(pw);

        if (hasLength) score++;
        if (hasLetter) score++;
        if (hasNumber) score++;
        if (hasSpecial) score++;
        if (pw.length >= 12) score++; // bonus for long passwords

        return { score, hasLength, hasLetter, hasNumber, hasSpecial };
      }

      function updateStrength() {
        const pw = passwordInput.value;
        const { score, hasLength, hasLetter, hasNumber } = scorePassword(pw);

        markReq(reqLength, hasLength);
        markReq(reqLetter, hasLetter);
        markReq(reqNumber, hasNumber);

        // Fill the strength bar
        const pct = Math.min(score / 4, 1) * 100;
        strengthFill.style.width = pct + '%';
        strengthFill.className = '';

        if (!pw) {
          strengthFill.style.width = '0%';
          strengthLabel.textContent = 'Use 8+ characters with letters and numbers.';
          strengthLabel.style.color = 'var(--ink-muted)';
        } else if (score <= 1) {
          strengthFill.classList.add('strength-weak');
          strengthLabel.textContent = 'Weak password';
          strengthLabel.style.color = '#e07a7a';
        } else if (score === 2) {
          strengthFill.classList.add('strength-fair');
          strengthLabel.textContent = 'Fair — add numbers or symbols';
          strengthLabel.style.color = '#e0b37a';
        } else if (score === 3) {
          strengthFill.classList.add('strength-good');
          strengthLabel.textContent = 'Good password';
          strengthLabel.style.color = '#8fc98f';
        } else {
          strengthFill.classList.add('strength-strong');
          strengthLabel.textContent = 'Strong password ✓';
          strengthLabel.style.color = 'var(--gold)';
        }
      }

      function updateMatch() {
        const pw = passwordInput.value;
        const cf = confirmInput.value;
        if (!cf) {
          matchLabel.classList.add('hidden');
          return;
        }
        if (pw === cf) {
          matchLabel.classList.add('hidden');
        } else {
          matchLabel.classList.remove('hidden');
        }
      }

      passwordInput.addEventListener('input', () => {
        updateStrength();
        updateMatch();
      });
      confirmInput.addEventListener('input', updateMatch);

      form.addEventListener('submit', (e) => {
        if (passwordInput.value !== confirmInput.value) {
          e.preventDefault();
          matchLabel.classList.remove('hidden');
          confirmInput.focus();
        }
      });
    })();
  </script>
</body>
</html>