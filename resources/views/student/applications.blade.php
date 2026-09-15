@extends('student.layouts.app')

@section('title', 'My Applications')
@section('page-title', 'MY APPLICATIONS')

@section('content')
    <div class="mb-8">
      <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2 flex items-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        Student Portal
      </p>
      <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
        MY APPLICATIONS
      </h1>
      <p class="mt-2 text-sm max-w-xl" style="color: var(--ink-muted);">
        Every event you've registered for. You can withdraw an application as long as it hasn't been finalized by your coach.
      </p>
    </div>

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

    @if ($entries->isEmpty())
      <div class="rounded-2xl p-10 text-center"
           style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
             class="mx-auto mb-4" style="color: var(--gold-soft);">
          <rect x="3" y="4" width="18" height="16" rx="2"/>
          <path d="M8 2v4M16 2v4M3 10h18"/>
        </svg>
        <p class="text-base font-medium mb-1" style="color: var(--ink);">No applications yet</p>
        <p class="text-sm mb-6" style="color: var(--ink-muted);">
          You haven't registered for any events. Browse the categories and apply.
        </p>
        <a href="{{ route('home') }}#categories"
           class="inline-flex items-center gap-2 text-sm font-semibold transition-all hover:gap-3"
           style="color: var(--gold);">
          Browse events
          <span class="text-base leading-none">→</span>
        </a>
      </div>
    @else
      <p class="text-sm mb-4" style="color: var(--ink-muted);">
        {{ $entries->total() }} {{ Str::plural('application', $entries->total()) }}
      </p>

      <div class="space-y-3">
        @foreach ($entries as $m)
          @php $cat = $m->entry->category ?? null; @endphp
          @if ($cat)
            <div class="rounded-2xl p-5 flex flex-col sm:flex-row items-start gap-4"
                 style="background: var(--bg-panel); border: 1px solid var(--border);">

              {{-- Icon --}}
              <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 font-display text-lg"
                   style="background: var(--pill-bg); border: 1px solid var(--pill-border); color: var(--gold);">
                {{ strtoupper(substr($cat->name, 0, 1)) }}
              </div>

              {{-- Info --}}
              <div class="min-w-0 flex-1">
                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                  <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                    {{ $cat->group }}
                  </span>
                  <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
                    Registered
                  </span>
                  @if ($cat->has_variants)
                    <span class="text-[10px]" style="color: var(--ink-muted);">(variant)</span>
                  @endif
                </div>

                <p class="font-semibold text-base leading-snug">{{ $cat->name }}</p>

                <dl class="grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-2 mt-3 text-xs">
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
                  <div class="col-span-2 sm:col-span-4">
                    <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Applied on</dt>
                    <dd class="mt-0.5">{{ $m->created_at->format('M j, Y g:i A') }} · {{ $m->created_at->diffForHumans() }}</dd>
                  </div>
                </dl>
              </div>

              {{-- Actions --}}
              <div class="shrink-0 w-full sm:w-auto">
                <form method="POST"
                      action="{{ route('student.applications.destroy', $m->entry) }}"
                      onsubmit="return confirm('Withdraw your application for {{ $cat->name }}? This cannot be undone.');">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          class="w-full sm:w-auto cursor-pointer inline-flex items-center justify-center gap-2 text-xs font-semibold px-3 py-2 rounded-md transition-all hover:bg-red-500/10"
                          style="color: #e07a7a; border: 1px solid rgba(224, 122, 122, 0.3);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                    </svg>
                    Withdraw
                  </button>
                </form>
              </div>
            </div>
          @endif
        @endforeach
      </div>

      {{-- Pagination --}}
      @if ($entries->hasPages())
        <div class="mt-8">
          {{ $entries->links() }}
        </div>
      @endif
    @endif
@endsection