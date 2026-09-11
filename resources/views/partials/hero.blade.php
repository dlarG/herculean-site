@php
  $heroImages = [
    'assets/intrams-02.jpg',
    'assets/intrams-01.jpg',
    'assets/intrams-08.jpg',
    'assets/intrams-09.jpg',
    'assets/intrams-05.jpg',
    'assets/intrams-06.jpg',
    'assets/intrams-07.jpg',
    'assets/intrams-08.jpg',
    'assets/intrams-09.jpg',
    'assets/intrams-10.jpg',
  ];
@endphp

<section class="max-h-screen relative overflow-hidden min-h-[90vh] sm:min-h-[85vh] flex items-center"
         style="border-bottom: 1px solid var(--border);">

  <div class="absolute inset-0 z-0" id="heroCarousel">
    @foreach ($heroImages as $i => $img)
      <div class="hero-slide absolute inset-0 transition-opacity duration-[1400ms] ease-in-out {{ $i === 0 ? 'opacity-100' : 'opacity-0' }}"
           data-slide="{{ $i }}"
           style="background-image: url('{{ asset($img) }}');
                  background-size: cover;
                  background-position: center;
                  background-repeat: no-repeat;">
      </div>
    @endforeach

    <div class="absolute inset-0"
        style="background: linear-gradient(
            180deg,
            var(--hero-overlay-top) 0%,
            var(--hero-overlay-mid) 60%,
            var(--hero-overlay-bottom) 100%
        );"></div>

    {{-- Gold tint wash — theme-aware intensity --}}
    <div class="absolute inset-0 mix-blend-overlay"
        style="background: radial-gradient(
            ellipse at 30% 50%,
            rgba(242, 185, 12, var(--hero-tint-opacity)) 0%,
            transparent 65%
        );"></div>

    <div class="absolute inset-x-0 bottom-0 h-40"
         style="background: linear-gradient(to bottom, transparent, var(--bg));"></div>
  </div>

  <div class="max-w-6xl mx-auto px-5 py-24 sm:py-32 relative z-10 w-full">
    <div class="max-w-3xl">
      <p class="text-xs sm:text-sm uppercase tracking-[0.3em] font-semibold mb-6 flex items-center gap-3"
         style="color: var(--gold);">
        <span class="inline-block w-8 h-px" style="background: var(--gold);"></span>
        SLSU Sogod · Intramurals 2026
      </p>

      <h1 class="font-display leading-[0.85] text-white"
          style="font-size: clamp(3.5rem, 11vw, 6.5rem); text-shadow: 0 4px 40px rgba(0,0,0,0.5);">
        HERCULEAN<br>
        <span style="color: var(--gold);">DRAGON</span>
      </h1>

      <p class="mt-8 font-display text-lg sm:text-2xl tracking-[0.08em] text-white/90 max-w-2xl">
        ONE TEAM. ONE FORM. EVERY VICTORY.
      </p>

      <p class="mt-5 text-base sm:text-lg leading-relaxed text-white/70 max-w-xl">
        Rise with the Dragon. One registration form covers every sport and art category in this year's SLSU Sogod Intramurals. Step up. Sign up. Represent.
      </p>

      <div class="mt-10 flex flex-wrap gap-4">
        <a href="#categories"
           class="px-7 py-3.5 rounded-md font-semibold text-black transition-all hover:scale-[1.02] active:scale-[0.98]"
           style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.6);">
          View Categories
        </a>
        <a href="{{ route('register.create') }}"
           class="px-7 py-3.5 rounded-md font-semibold text-white backdrop-blur-sm transition-all hover:bg-white/10"
           style="border: 1.5px solid rgba(255,255,255,0.4);">
          Register Now
        </a>
      </div>
    </div>
  </div>

  <div class="absolute bottom-6 left-1/2 -translate-x-1/2 z-20 flex gap-2" id="heroDots">
    @foreach ($heroImages as $i => $img)
      <button type="button"
              class="hero-dot cursor-pointer rounded-full transition-all duration-300"
              data-slide="{{ $i }}"
              aria-label="Show slide {{ $i + 1 }}"
              style="width: {{ $i === 0 ? '24px' : '8px' }}; height: 8px; background: {{ $i === 0 ? 'var(--gold)' : 'rgba(255,255,255,0.4)' }};">
      </button>
    @endforeach
  </div>
</section>