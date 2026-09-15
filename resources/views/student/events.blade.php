@extends('student.layouts.app')

@section('title', 'Events')
@section('page-title', 'BROWSE EVENTS')

@section('content')

  {{-- Header --}}
  <div class="mb-8">
    <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2 flex items-center gap-3"
       style="color: var(--gold-soft);">
      <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
      Student Portal
    </p>
    <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
      BROWSE EVENTS
    </h1>
    <p class="mt-2 text-sm max-w-xl" style="color: var(--ink-muted);">
      Apply directly with your saved profile info. You can join up to 3 events — 1 team event + 2 individuals, or 3 individuals.
    </p>
  </div>

  {{-- Eligibility summary --}}
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Total events joined</p>
      <p class="font-display text-3xl" style="color: var(--gold);">{{ $totalEvents }} <span class="text-lg" style="color: var(--ink-muted);">/ 3</span></p>
    </div>
    <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Team events joined</p>
      <p class="font-display text-3xl" style="color: var(--gold);">{{ $teamEvents }} <span class="text-lg" style="color: var(--ink-muted);">/ 1</span></p>
    </div>
    <div class="rounded-xl p-5"
         style="background: var(--bg-panel); border: 1px solid {{ $canAddMore ? 'var(--border)' : 'rgba(224,122,122,0.4)' }};">
      <p class="text-xs uppercase tracking-wider mb-1" style="color: var(--ink-muted);">Status</p>
      @if (!$canAddMore)
        <p class="font-semibold text-sm" style="color: #e07a7a;">Maximum reached</p>
      @elseif (!$canJoinTeam)
        <p class="font-semibold text-sm" style="color: #e0b37a;">Individuals only</p>
      @else
        <p class="font-semibold text-sm" style="color: #9fe0ab;">Can join more</p>
      @endif
    </div>
  </div>

  {{-- Profile completeness warning --}}
  @if (blank($student->program) || blank($student->year_level) || blank($student->gender))
    <div class="mb-6 rounded-lg px-4 py-3 text-sm flex items-start gap-3"
         style="background: rgba(224, 179, 122, 0.1); border: 1px solid rgba(224, 179, 122, 0.4); color: #e0b37a;">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <div class="flex-1">
        <p class="font-semibold">Complete your profile first</p>
        <p class="text-xs mt-1">
          We need your program, year level, and gender to apply for events.
          <a href="{{ route('student.profile') }}" class="underline font-semibold">Complete profile →</a>
        </p>
      </div>
    </div>
  @endif

  {{-- Categories grouped --}}
  @foreach ($categories as $groupName => $items)
    <section class="mb-10 last:mb-0">
      <div class="flex items-center gap-4 mb-5">
        <h2 class="font-display text-xl sm:text-2xl tracking-wide whitespace-nowrap" style="color: var(--gold);">
          {{ $groupName }}
        </h2>
        <span class="h-px flex-1" style="background: var(--border);"></span>
        <span class="text-xs uppercase tracking-wider" style="color: var(--ink-muted);">
          {{ $items->count() }} {{ Str::plural('event', $items->count()) }}
        </span>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($items as $cat)
          @php
            $alreadyApplied = in_array($cat->id, $appliedCategoryIds);

            // Eligibility per category
            $blockedReason = null;
            if ($alreadyApplied) {
                $blockedReason = 'Already applied';
            } elseif (!$canAddMore) {
                $blockedReason = 'Maximum reached';
            } elseif ($cat->is_team_event && !$canJoinTeam) {
                $blockedReason = 'Team event already joined';
            } elseif (blank($student->program) || blank($student->year_level) || blank($student->gender)) {
                $blockedReason = 'Complete profile first';
            }

            $canApply = $blockedReason === null;
          @endphp

          <div class="rounded-2xl p-5 flex flex-col"
               style="background: var(--bg-panel); border: 1px solid var(--border);">

            {{-- Top: group + tag --}}
            <div class="flex items-center justify-between gap-2 mb-3">
              <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                {{ $cat->group }}
              </span>
              <span class="text-[10px] font-semibold uppercase tracking-wider px-2 py-0.5 rounded-full"
                    style="background: rgba(0,0,0,0.3); color: var(--gold); border: 1px solid var(--pill-border);">
                {{ $cat->is_team_event ? 'Team' : 'Individual' }}
              </span>
            </div>

            {{-- Name --}}
            <p class="font-semibold text-base leading-snug mb-1">{{ $cat->name }}</p>

            {{-- Member range --}}
            <p class="text-xs mb-4" style="color: var(--ink-muted);">
              @if ($cat->min_members === $cat->max_members)
                {{ $cat->max_members }} {{ Str::plural('member', $cat->max_members) }}
              @else
                {{ $cat->min_members }}–{{ $cat->max_members }} members
              @endif
            </p>

            {{-- Action --}}
            <div class="mt-auto pt-4" style="border-top: 1px solid var(--border);">
              @if ($alreadyApplied)
                <div class="flex items-center gap-2 text-xs font-semibold"
                     style="color: #9fe0ab;">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"/>
                  </svg>
                  Applied
                </div>
              @elseif ($canApply)
                <form method="POST" action="{{ route('student.events.apply', $cat) }}">
                  @csrf
                  <button type="submit"
                          class="w-full inline-flex items-center justify-center gap-2 text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-md text-black transition-all hover:scale-[1.02] active:scale-[0.98]"
                          style="background: var(--gold);">
                    Apply now
                    <span class="text-base leading-none">→</span>
                  </button>
                </form>
              @else
                <div class="text-center">
                  <button type="button" disabled
                          class="w-full text-xs font-bold uppercase tracking-wider px-4 py-2.5 rounded-md cursor-not-allowed"
                          style="background: rgba(255,255,255,0.05); color: var(--ink-muted); border: 1px solid var(--border);">
                    {{ $blockedReason }}
                  </button>
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </section>
  @endforeach

  @if ($categories->isEmpty())
    <div class="rounded-2xl p-12 text-center"
         style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
      <p class="font-display text-xl mb-2" style="color: var(--gold-soft);">NO EVENTS OPEN</p>
      <p class="text-sm" style="color: var(--ink-muted);">
        No events are currently open for registration. Check back soon.
      </p>
    </div>
  @endif

@endsection