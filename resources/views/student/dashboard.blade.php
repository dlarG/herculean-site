@extends('student.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'DASHBOARD')

@section('content')

  {{-- Welcome --}}
  <div class="mb-8">
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

  <div class="grid lg:grid-cols-3 gap-8">

    {{-- LEFT: My Events (recent) --}}
    <div class="lg:col-span-2">
      <section>
        <div class="flex items-center justify-between gap-3 mb-4">
          <h2 class="font-display text-xl" style="color: var(--gold);">MY EVENTS</h2>
          <a href="{{ route('student.applications') }}"
             class="text-xs font-semibold transition-colors hover:text-[color:var(--gold)]"
             style="color: var(--gold-soft);">
            View all applications →
          </a>
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
            @foreach ($myEntries->take(4) as $m)
              @php $cat = $m->entry->category ?? null; @endphp
              @if ($cat)
                <a href="{{ route('student.applications') }}"
                   class="block rounded-2xl p-5 flex items-start gap-4 transition-all hover:-translate-y-0.5"
                   style="background: var(--bg-panel); border: 1px solid var(--border);">
                  <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 font-display text-lg"
                       style="background: var(--pill-bg); border: 1px solid var(--pill-border); color: var(--gold);">
                    {{ strtoupper(substr($cat->name, 0, 1)) }}
                  </div>
                  <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                      <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                        {{ $cat->group }}
                      </span>
                    </div>
                    <p class="font-semibold text-base leading-snug">{{ $cat->name }}</p>
                    <p class="text-xs mt-1" style="color: var(--ink-muted);">
                      Registered on {{ $m->created_at->format('M j, Y') }}
                    </p>
                  </div>
                  <div class="shrink-0">
                    <span class="pill text-[10px] font-semibold uppercase tracking-wider px-2.5 py-1 rounded-full">
                      Registered
                    </span>
                  </div>
                </a>
              @endif
            @endforeach
          </div>

          @if ($myEntries->count() > 4)
            <div class="mt-4 text-center">
              <a href="{{ route('student.applications') }}"
                 class="text-sm font-semibold transition-colors hover:text-[color:var(--gold)]"
                 style="color: var(--gold-soft);">
                View all {{ $myEntries->count() }} applications →
              </a>
            </div>
          @endif
        @endif
      </section>
    </div>

    {{-- RIGHT: Announcements --}}
    <aside class="lg:col-span-1">
      <div class="lg:sticky lg:top-24 space-y-4">
        <div class="flex items-center justify-between gap-3">
          <h2 class="font-display text-xl" style="color: var(--gold);">ANNOUNCEMENTS</h2>
          <span class="text-xs" style="color: var(--ink-muted);">{{ $announcements->count() }}</span>
        </div>

        @if ($announcements->isEmpty())
          <div class="rounded-2xl p-6 text-center"
               style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
            <p class="text-sm" style="color: var(--ink-muted);">
              No announcements yet.
            </p>
          </div>
        @else
          <div class="space-y-3 max-h-[calc(100vh-12rem)] overflow-y-auto pr-1">
            @foreach ($announcements as $a)
              <div class="rounded-xl p-4"
                   style="background: var(--bg-panel); border: 1px solid var(--border);">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                  <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                    {{ $a->category->name ?? 'General' }}
                  </span>
                  <span class="text-[10px]" style="color: var(--ink-muted);">
                    · {{ $a->created_at->diffForHumans() }}
                  </span>
                </div>

                @if ($a->coach)
                  <p class="text-[11px] mb-2 flex items-center gap-1.5" style="color: var(--ink-muted);">
                    <span>🧑‍🏫</span>
                    <span>{{ $a->coach->name }}</span>
                  </p>
                @endif

                <p class="font-semibold text-sm leading-snug mb-1">{{ $a->title }}</p>
                <p class="text-xs leading-relaxed line-clamp-3" style="color: var(--ink-muted);">
                  {{ $a->body }}
                </p>

                @if ($a->event_at)
                  <div class="mt-3 pt-3 flex flex-wrap gap-x-4 gap-y-1 text-xs"
                       style="border-top: 1px solid var(--border); color: var(--gold);">
                    <span>📅 {{ $a->event_at->format('M j, Y g:i A') }}</span>
                    @if ($a->location)
                      <span>📍 {{ $a->location }}</span>
                    @endif
                  </div>
                @endif

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
@endsection