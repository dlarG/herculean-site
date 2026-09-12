@extends('coach.layouts.app')

@section('title', 'Dashboard')

@section('content')
  <div class="mb-8">
    <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2" style="color: var(--gold-soft);">
      Coach Dashboard
    </p>
    <h1 class="font-display text-3xl sm:text-4xl" style="color: var(--gold);">
      WELCOME, {{ strtoupper(explode(' ', $coach->name)[0]) }}
    </h1>
    <p class="mt-2 text-sm" style="color: var(--ink-muted);">
      Manage your events, view participants, and post announcements to your students.
    </p>
  </div>

  {{-- Quick stats --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">My events</p>
      <p class="font-display text-3xl" style="color: var(--gold);">{{ $categories->count() }}</p>
    </div>
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Total participants</p>
      <p class="font-display text-3xl" style="color: var(--gold);">{{ $categories->sum('entries_count') }}</p>
    </div>
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Announcements</p>
      <p class="font-display text-3xl" style="color: var(--gold);">{{ $announcements->count() }}</p>
    </div>
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Last post</p>
      <p class="font-display text-lg mt-1" style="color: var(--ink);">
        {{ $announcements->first()?->created_at?->diffForHumans() ?? '—' }}
      </p>
    </div>
  </div>

  {{-- My events --}}
  <section class="mb-10">
    <div class="flex items-center justify-between gap-3 mb-4">
      <h2 class="font-display text-xl" style="color: var(--gold);">MY EVENTS</h2>
      <a href="{{ route('coach.participants') }}"
         class="text-xs font-semibold transition-colors hover:text-[color:var(--gold)]"
         style="color: var(--gold-soft);">
        View all participants →
      </a>
    </div>

    @if ($categories->isEmpty())
      <div class="rounded-xl p-8 text-center"
           style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
        <p class="text-sm" style="color: var(--ink-muted);">
          You're not assigned to any categories yet. Contact the committee if this is a mistake.
        </p>
      </div>
    @else
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($categories as $cat)
          <a href="{{ route('coach.participants', ['category_id' => $cat->id]) }}"
             class="group rounded-xl p-5 transition-all hover:-translate-y-0.5"
             style="background: var(--bg-panel); border: 1px solid var(--border);">
            <p class="text-[10px] uppercase tracking-[0.15em] mb-1.5" style="color: var(--gold-soft);">
              {{ $cat->group }}
            </p>
            <p class="font-semibold text-base leading-snug">{{ $cat->name }}</p>
            <p class="text-xs mt-3 flex items-center gap-1.5" style="color: var(--ink-muted);">
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="8.5" cy="7" r="4"/>
              </svg>
              {{ $cat->entries_count }} {{ Str::plural('participant', $cat->entries_count) }}
            </p>
            <p class="text-xs mt-3 font-medium transition-all group-hover:gap-2 inline-flex items-center gap-1"
               style="color: var(--gold);">
              View participants
              <span>→</span>
            </p>
          </a>
        @endforeach
      </div>
    @endif
  </section>

  {{-- Recent announcements --}}
  <section>
    <div class="flex items-center justify-between gap-3 mb-4">
      <h2 class="font-display text-xl" style="color: var(--gold);">RECENT ANNOUNCEMENTS</h2>
      <div class="flex items-center gap-4">
        <a href="{{ route('coach.announcements.index') }}"
           class="text-xs font-semibold transition-colors hover:text-[color:var(--gold)]"
           style="color: var(--gold-soft);">
          View all →
        </a>
        <a href="{{ route('coach.announcements.create') }}"
           class="text-xs font-semibold rounded-md px-3 py-1.5 text-black transition-all hover:scale-[1.02]"
           style="background: var(--gold);">
          + New
        </a>
      </div>
    </div>

    @if ($announcements->isEmpty())
      <div class="rounded-xl p-8 text-center"
           style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
        <p class="text-sm mb-3" style="color: var(--ink-muted);">
          You haven't posted any announcements yet.
        </p>
        <a href="{{ route('coach.announcements.create') }}"
           class="inline-flex items-center gap-2 text-sm font-semibold"
           style="color: var(--gold);">
          Post your first announcement →
        </a>
      </div>
    @else
      <div class="space-y-3">
        @foreach ($announcements->take(5) as $a)
          <div class="rounded-xl p-4 flex items-start gap-4"
               style="background: var(--bg-panel); border: 1px solid var(--border);">
            @if ($a->image_path)
              <img src="{{ Storage::url($a->image_path) }}"
                   alt=""
                   class="w-14 h-14 rounded-lg object-cover shrink-0">
            @endif
            <div class="flex-1 min-w-0">
              <div class="flex flex-wrap items-center gap-2 mb-1">
                <span class="text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full pill">
                  {{ $a->category->name ?? 'General' }}
                </span>
                <span class="text-[10px] uppercase tracking-wider" style="color: var(--ink-muted);">
                  {{ $a->type }}
                </span>
                <span class="text-[10px]" style="color: var(--ink-muted);">
                  · {{ $a->created_at->diffForHumans() }}
                </span>
              </div>
              <p class="font-semibold text-sm truncate">{{ $a->title }}</p>
              <p class="text-xs mt-0.5 line-clamp-1" style="color: var(--ink-muted);">{{ $a->body }}</p>
            </div>
          </a>
        @endforeach
      </div>
    @endif
  </section>
@endsection