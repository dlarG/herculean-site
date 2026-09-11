<section id="about" class="py-16 sm:py-20" style="border-bottom: 1px solid var(--border);">
  <div class="max-w-6xl mx-auto px-5">

    {{-- ===== 3-LOGO ROW ===== --}}
    <div class="grid grid-cols-3 items-center gap-6 sm:gap-10 max-w-3xl mx-auto">

      {{-- Left: Intramurals logo --}}
      <div class="flex justify-center sm:justify-end">
        <img src="{{ asset('assets/slsu-crop.png') }}"
             alt="SLSU Intramurals"
             class="h-16 sm:h-20 lg:h-24 w-auto object-contain transition-transform duration-300 hover:scale-105">
      </div>

      {{-- Center: SLSU logo (larger) --}}
      <div class="flex justify-center">
        <img src="{{ asset('assets/navbar-logo.png') }}"
             alt="SLSU Sogod"
             class="h-20 sm:h-28 lg:h-32 w-auto object-contain transition-transform duration-300 hover:scale-105">
      </div>

      {{-- Right: Herculean Dragon logo --}}
      <div class="flex justify-center sm:justify-start">
        <img src="{{ asset('assets/logo.png') }}"
             alt="Herculean Dragon"
             class="h-16 sm:h-20 lg:h-24 w-auto object-contain transition-transform duration-300 hover:scale-105">
      </div>

    </div>

    {{-- ===== ABOUT TEXT ===== --}}
    <div class="max-w-3xl mx-auto mt-12 sm:mt-16 text-center">

      {{-- Eyebrow --}}
      <p class="text-xs uppercase tracking-[0.3em] font-semibold mb-4 flex items-center justify-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        About the Intramurals
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
      </p>

      {{-- Heading --}}
      <h2 class="font-display text-2xl sm:text-3xl lg:text-4xl leading-tight mb-6"
          style="color: var(--ink);">
        Where <span style="color: var(--gold);">sports</span>,
        <span style="color: var(--gold);">arts</span>, and
        <span style="color: var(--gold);">school spirit</span> collide
      </h2>

      {{-- Body --}}
      <p class="text-sm sm:text-base leading-relaxed mb-4" style="color: var(--ink-muted);">
        The SLSU Sogod Intramurals is the university's annual celebration of athleticism, creativity, and camaraderie bringing together students from every department and year level to compete, perform, and represent their teams.
      </p>

      <p class="text-sm sm:text-base leading-relaxed" style="color: var(--ink-muted);">
        This year, <span style="color: var(--gold); font-weight: 600;">Team Herculean Dragon</span> fields student-athletes and artists from the <span style="color: var(--gold); font-weight: 600;">HTM</span> and <span style="color: var(--gold); font-weight: 600;">Information Technology</span> departments united under one banner, one form, and one goal: victory.
      </p>

      <div class="mt-8">
        <a href="#categories"
           class="inline-block px-6 py-3 rounded-md font-semibold transition-colors"
           style="background: var(--gold); color: var(--black);">
          Explore Categories
        </a>
    </div>

  </div>
</section>