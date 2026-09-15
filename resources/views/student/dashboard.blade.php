<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>My Dashboard · Herculean Dragon</title>
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
    body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
    .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }

    .pill {
      background: var(--pill-bg);
      color: white;
      border: 1px solid var(--pill-border);
    }
  </style>
</head>
<body class="antialiased">

  {{-- ===== HEADER ===== --}}
  <header class="sticky top-0 z-30 backdrop-blur-sm"
          style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-bottom: 1px solid var(--border);">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
        <img src="{{ asset('assets/navbar-logo.png') }}" alt="Herculean Dragon"
             class="h-12 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.style.display='none';">
      </a>

      <div class="flex items-center gap-2 sm:gap-4">
        {{-- Student identity --}}
        <div class="hidden sm:flex items-center gap-2.5">
          <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
               style="background: var(--gold); color: #000;">
            {{ strtoupper(substr($student->full_name, 0, 1)) }}
          </div>
          <div class="text-right">
            <p class="text-[10px] leading-tight uppercase tracking-wider" style="color: var(--ink-muted);">
              Student
            </p>
            <p class="text-sm font-semibold leading-tight truncate max-w-[150px]">{{ $student->full_name }}</p>
          </div>
        </div>

        {{-- Change password --}}
        <a href="{{ route('student.password.change') }}"
           class="hidden sm:inline-flex items-center gap-2 text-sm font-medium px-3 py-2 rounded-md transition-colors hover:text-[color:var(--gold)]"
           style="color: var(--ink-muted); border: 1px solid var(--border-strong);"
           title="Change password">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
          </svg>
          <span class="hidden lg:inline">Password</span>
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('student.logout') }}" class="shrink-0">
          @csrf
          <button type="submit"
                  class="group cursor-pointer inline-flex items-center gap-2 text-sm font-medium px-3 py-2 rounded-md transition-all hover:text-[color:var(--gold)]"
                  style="color: var(--ink-muted); border: 1px solid var(--border-strong);">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
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
    </div>
  </header>

  {{-- ===== MAIN ===== --}}
  <main class="max-w-6xl mx-auto px-5 py-10">

    {{-- Welcome --}}
    <div class="mb-10">
      <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2 flex items-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        Student Portal
      </p>
      <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
        HI, {{ strtoupper(explode(' ', $student->full_name)[0]) }}
      </h1>
      <p class="mt-2 text-sm" style="color: var(--ink-muted);">
        Your registered events and the latest updates from your coaches.
      </p>
    </div>

    {{-- Flash success --}}
    @if (session('success'))
      <div class="mb-6 rounded-lg px-4 py-3 text-sm flex items-center gap-3"
           style="background: rgba(63,122,74,0.12); border: 1px solid #3f7a4a; color: #9fe0ab;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        <span>{{ session('success') }}</span>
      </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">

      {{-- ===== LEFT: MY EVENTS ===== --}}
      <div class="lg:col-span-2 space-y-8">

        {{-- My events --}}
        <section>
          <div class="flex items-center justify-between gap-3 mb-4">
            <h2 class="font-display text-xl" style="color: var(--gold);">MY EVENTS</h2>
            <span class="text-xs" style="color: var(--ink-muted);">
              {{ $myEntries->count() }} {{ Str::plural('registration', $myEntries->count()) }}
            </span>
          </div>

          @if ($myEntries->isEmpty())
            <div class="rounded-2xl p-8 text-center"
                 style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
              <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                   class="mx-auto mb-3" style="color: var(--gold-soft);">
                <rect x="3" y="4" width="18" height="16" rx="2"/>
                <path d="M8 2v4M16 2v4M3 10h18"/>
              </svg>
              <p class="text-sm font-medium mb-1" style="color: var(--ink);">No events yet</p>
              <p class="text-xs mb-4" style="color: var(--ink-muted);">
                You haven't registered for any events. Browse the categories and join a team.
              </p>
              <a href="{{ route('home') }}#categories"
                 class="inline-flex items-center gap-2 text-sm font-semibold transition-all hover:gap-3"
                 style="color: var(--gold);">
                Browse events
                <span class="text-base leading-none">→</span>
              </a>
            </div>
          @else
            <div class="space-y-3">
              @foreach ($myEntries as $m)
                @php
                  $cat = $m->entry->category ?? null;
                @endphp
                @if ($cat)
                  <div class="rounded-2xl p-5 flex items-start gap-4"
                       style="background: var(--bg-panel); border: 1px solid var(--border);">

                    {{-- Left: category initial or icon --}}
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 font-display text-lg"
                         style="background: var(--pill-bg); border: 1px solid var(--pill-border); color: var(--gold);">
                      {{ strtoupper(substr($cat->name, 0, 1)) }}
                    </div>

                    {{-- Middle: category info --}}
                    <div class="min-w-0 flex-1">
                      <div class="flex flex-wrap items-center gap-2 mb-1">
                        <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                          {{ $cat->group }}
                        </span>
                        @if ($cat->has_variants)
                          <span class="text-[10px]" style="color: var(--ink-muted);">
                            (variant)
                          </span>
                        @endif
                      </div>
                      <p class="font-semibold text-base leading-snug">{{ $cat->name }}</p>

                      <dl class="grid grid-cols-2 gap-x-4 gap-y-1.5 mt-3 text-xs">
                        <div>
                          <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Registered as</dt>
                          <dd class="mt-0.5 font-medium">{{ $m->full_name }}</dd>
                        </div>
                        <div>
                          <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Student No.</dt>
                          <dd class="mt-0.5 font-mono">{{ $m->student_number }}</dd>
                        </div>
                        <div>
                          <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Program</dt>
                          <dd class="mt-0.5">{{ $m->program }}</dd>
                        </div>
                        <div>
                          <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Year</dt>
                          <dd class="mt-0.5">{{ $m->year_level }}</dd>
                        </div>
                        <div class="col-span-2">
                          <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Registered on</dt>
                          <dd class="mt-0.5">{{ $m->created_at->format('M j, Y g:i A') }}</dd>
                        </div>
                      </dl>
                    </div>

                    {{-- Right: status pill --}}
                    <div class="shrink-0">
                      <span class="pill text-[10px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full">
                        Registered
                      </span>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          @endif
        </section>

      </div>

      {{-- ===== RIGHT: ANNOUNCEMENTS ===== --}}
      <aside class="lg:col-span-1">
        <div class="lg:sticky lg:top-24 space-y-4">

          <div class="flex items-center justify-between gap-3">
            <h2 class="font-display text-xl" style="color: var(--gold);">ANNOUNCEMENTS</h2>
            <span class="text-xs" style="color: var(--ink-muted);">
              {{ $announcements->count() }}
            </span>
          </div>

          @if ($announcements->isEmpty())
            <div class="rounded-2xl p-6 text-center"
                 style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
              <p class="text-sm" style="color: var(--ink-muted);">
                No announcements yet. Your coaches will post updates here.
              </p>
            </div>
          @else
            <div class="space-y-3 max-h-[calc(100vh-12rem)] overflow-y-auto pr-1">
              @foreach ($announcements as $a)
                <div class="rounded-xl p-4"
                     style="background: var(--bg-panel); border: 1px solid var(--border);">

                  {{-- Meta --}}
                  <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                      {{ $a->category->name ?? 'General' }}
                    </span>
                    <span class="text-[10px] uppercase tracking-wider" style="color: var(--ink-muted);">
                      {{ $a->type }}
                    </span>
                    <span class="text-[10px]" style="color: var(--ink-muted);">
                      · {{ $a->created_at->diffForHumans() }}
                    </span>
                  </div>

                  {{-- Coach --}}
                  @if ($a->coach)
                    <p class="text-[11px] mb-2 flex items-center gap-1.5" style="color: var(--ink-muted);">
                      <span>🧑‍🏫</span>
                      <span>{{ $a->coach->name }}</span>
                    </p>
                  @endif

                  {{-- Title + body --}}
                  <p class="font-semibold text-sm leading-snug mb-1">{{ $a->title }}</p>
                  <p class="text-xs leading-relaxed line-clamp-3" style="color: var(--ink-muted);">
                    {{ $a->body }}
                  </p>

                  {{-- Event details --}}
                  @if ($a->event_at)
                    <div class="mt-3 pt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs"
                         style="border-top: 1px solid var(--border); color: var(--gold);">
                      <span>📅 {{ $a->event_at->format('M j, Y g:i A') }}</span>
                      @if ($a->location)
                        <span>📍 {{ $a->location }}</span>
                      @endif
                    </div>
                  @endif

                  {{-- Image --}}
                  @if ($a->image_path)
                    <div class="mt-3 -mx-4 -mb-4">
                      <img src="{{ Storage::url($a->image_path) }}"
                           alt=""
                           class="w-full h-32 object-cover">
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
          @endif

        </div>
      </aside>

    </div>
  </main>

</body>
</html>