<section id="categories" class="max-w-6xl mx-auto px-5 pb-24 pt-8">
  @foreach ($groups as $groupName => $sports)
    <div class="mb-16 last:mb-0">
      <div class="flex items-center gap-4 mb-7">
        <h2 class="font-display text-2xl sm:text-3xl tracking-wide whitespace-nowrap" style="color: var(--gold);">{{ $groupName }}</h2>
        <span class="h-px flex-1" style="background: var(--border);"></span>
        <span class="text-xs font-medium uppercase tracking-wider" style="color: var(--ink-muted);">{{ $sports->count() }} categories</span>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach ($sports as $sport)
          @php
            // Convention-based image path, with graceful fallback
            $slug = \Illuminate\Support\Str::slug($sport->name);
            $imgPath = file_exists(public_path("assets/sports/{$slug}.jpg"))
              ? asset("assets/sports/{$slug}.jpg")
              : asset('assets/sports/_default.jpg');

            // Member count label
            if ($sport->has_variants) {
                // Parent category: derive range from its variants
                $mins = $sport->variants->pluck('min_members');
                $maxs = $sport->variants->pluck('max_members');

                if ($sport->name === 'Mass Dance') {
                    // Special case: sum both variants' capacity as a combined range
                    $totalMax = $maxs->sum();
                    $memberLabel = '1–' . $totalMax . ' members';
                } else {
                    $min = $mins->min();
                    $max = $maxs->max();

                    $memberLabel = $min === $max
                        ? $max . ' ' . \Illuminate\Support\Str::plural('member', $max)
                        : $min . '–' . $max . ' members';
                }
            } else {
                // Standalone categories: use their own min/max
                $memberLabel = $sport->min_members === $sport->max_members
                    ? $sport->max_members . ' ' . \Illuminate\Support\Str::plural('member', $sport->max_members)
                    : $sport->min_members . '–' . $sport->max_members . ' members';
            }

            // Decide if this card is team-based.
            // - Parents with variants: check if ANY child is a team event
            // - Standalone categories: check its own max_members
            $isTeam = $sport->has_variants
                ? $sport->variants->contains(fn ($v) => $v->max_members > 1)
                : $sport->max_members > 1;
          @endphp

          <div class="sport-card-modern group relative rounded-2xl overflow-hidden flex flex-col">

            {{-- Image with gradient overlay --}}
            <div class="relative h-44 sm:h-48 overflow-hidden">
              <img src="{{ $imgPath }}"
                   alt="{{ $sport->name }}"
                   loading="lazy"
                   class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

              {{-- Bottom gradient for text legibility --}}
              <div class="absolute inset-0"
                   style="background: linear-gradient(180deg, rgba(0,0,0,0.15) 0%, rgba(0,0,0,0.55) 55%, rgba(0,0,0,0.92) 100%);"></div>

              {{-- Top pill: team or individual --}}
              <div class="absolute top-3 right-3">
                <span class="text-[10px] font-semibold uppercase tracking-[0.12em] px-2.5 py-1 rounded-full backdrop-blur-sm"
                      style="background: rgba(0,0,0,0.55); color: var(--gold); border: 1px solid rgba(242,185,12,0.4);">
                  {{ $isTeam ? 'Team' : 'Individual' }}
                </span>
              </div>

              {{-- Sport name over image --}}
              <div class="absolute bottom-0 left-0 right-0 p-4">
                <h3 class="font-display text-lg sm:text-xl text-white leading-tight"
                    style="text-shadow: 0 2px 12px rgba(0,0,0,0.6);">
                  {{ $sport->name }}
                </h3>
                <p class="mt-1 text-xs text-white/75">
                  {{ $memberLabel }}
                </p>
              </div>
            </div>

            {{-- Body with actions --}}
            <div class="flex-1 p-4 flex items-center justify-between gap-3"
                 style="background: var(--bg-panel); border-top: 1px solid var(--border);">
              <button type="button"
                      class="details-btn text-xs font-semibold inline-flex items-center gap-1.5 cursor-pointer transition-colors hover:text-[color:var(--gold)]"
                      style="color: var(--ink-muted);"
                      data-sport-id="{{ $sport->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10"/>
                  <line x1="12" y1="16" x2="12" y2="12"/>
                  <line x1="12" y1="8" x2="12.01" y2="8"/>
                </svg>
                Details
              </button>

              <a href="{{ route('register.create', ['sport' => $sport->name]) }}"
                 class="inline-flex items-center gap-1 text-xs font-bold uppercase tracking-wider px-3 py-2 rounded-md text-black transition-all hover:gap-2"
                 style="background: var(--gold);">
                Register <span class="text-base leading-none">→</span>
              </a>
            </div>

          </div>
        @endforeach
      </div>
    </div>
  @endforeach
</section>