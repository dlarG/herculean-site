@php
  $logos = [
    ['src' => 'assets/logo.png',        'alt' => 'SLSU Intramurals'],
    ['src' => 'assets/navbar-logo.png', 'alt' => 'SLSU Sogod'],
    ['src' => 'assets/slsu-crop.png',   'alt' => 'Herculean Dragon'],
    ['src' => 'assets/fp-removebg.png', 'alt' => 'Team Phoenix'],
    ['src' => 'assets/gg-removebg.png', 'alt' => 'Team Griffin'],
    ['src' => 'assets/fs-removebg.png', 'alt' => 'Team Falcon'],
  ];
@endphp

<section id="about" class="py-12 overflow-hidden" style="border-bottom: 1px solid var(--border);">
  <div class="max-w-6xl mx-auto px-5 mb-8">
    <p class="text-center text-xs uppercase tracking-[0.3em] font-medium" style="color: var(--gold-soft);">
      Proudly representing · Supported by
    </p>
  </div>

  <div class="relative group">
    <div class="pointer-events-none absolute inset-y-0 left-0 w-24 z-10"
         style="background: linear-gradient(to right, var(--bg), transparent);"></div>
    <div class="pointer-events-none absolute inset-y-0 right-0 w-24 z-10"
         style="background: linear-gradient(to left, var(--bg), transparent);"></div>

    <div class="flex gap-12 animate-marquee group-hover:[animation-play-state:paused] w-max">
      @foreach ($logos as $logo)
        <div class="flex items-center justify-center h-20 w-40 shrink-0 opacity-70 hover:opacity-100 transition-opacity">
          <img src="{{ asset($logo['src']) }}"
               alt="{{ $logo['alt'] }}"
               class="max-h-16 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300">
        </div>
      @endforeach

      @foreach ($logos as $logo)
        <div class="flex items-center justify-center h-20 w-40 shrink-0 opacity-70 hover:opacity-100 transition-opacity" aria-hidden="true">
          <img src="{{ asset($logo['src']) }}"
               alt=""
               class="max-h-16 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300">
        </div>
      @endforeach
    </div>
  </div>
</section>