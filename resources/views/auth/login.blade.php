<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Herculean Dragon · SLSU Sogod Intramurals</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex items-center justify-center px-5">

    <div class="w-full max-w-sm">
        <div class="flex flex-col items-center mb-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('assets/hero-dragon.png') }}" 
             alt="Herculean Dragon Logo" 
             class="h-44 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.logo-fallback').style.display='flex';">
      </a>
            <p class="text-sm uppercase tracking-[0.2em]" style="color: var(--gold-soft);">Herculean Dragon</p>
            <h1 class="display text-3xl mt-1" style="color: var(--gold);">ADMIN LOGIN</h1>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #a03b3b; background: rgba(160,59,59,0.12); color: #f2a5a5;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.attempt') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block font-medium mb-1.5 text-sm" for="username">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" required autofocus
                    class="field w-full rounded px-3 py-2.5">
            </div>

            <div>
                <label class="block font-medium mb-1.5 text-sm" for="password">Password</label>
                <input type="password" name="password" id="password" required
                    class="field w-full rounded px-3 py-2.5">
            </div>

            <label class="flex items-center gap-2 text-sm text-[color:var(--ink-muted)]">
                <input type="checkbox" name="remember" class="rounded" style="accent-color: var(--gold);">
                Remember me
            </label>

            <button type="submit"
                class="w-full font-semibold rounded px-4 py-3 text-black" style="background: var(--gold);">
                Log in
            </button>
        </form>
    </div>

</body>
</html>