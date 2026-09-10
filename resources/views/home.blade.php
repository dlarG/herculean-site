<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Herculean Dragon · SLSU Sogod Intramurals</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dragon-bg text-dragon-ink font-sans antialiased">

  <!-- ===== NAVBAR ===== -->
  <header class="p-2 sticky top-0 z-40 bg-dragon-bg/95 backdrop-blur-sm border-b border-dragon-gold/15">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group">
        <img src="{{ asset('assets/navbar-logo.png') }}" 
             alt="Herculean Dragon Logo" 
             class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.logo-fallback').style.display='flex';">
      </a>

      <nav class="hidden sm:flex items-center gap-8 text-sm font-medium text-dragon-muted">
        <a href="#categories" class="hover:text-dragon-gold transition-colors">Categories</a>
        <a href="#about" class="hover:text-dragon-gold transition-colors">About</a>
        <a href="{{ route('register.create') }}"
           class="px-5 py-2 rounded-md bg-dragon-gold text-black font-semibold hover:bg-amber-400 transition-colors shadow-sm shadow-dragon-gold/20">
          Register
        </a>
      </nav>

      <a href="{{ route('register.create') }}"
         class="sm:hidden px-4 py-1.5 rounded-md bg-dragon-gold text-black text-sm font-semibold hover:bg-amber-400 transition-colors">
        Register
      </a>
    </div>
  </header>

  <!-- ===== HERO (now with image on the right) ===== -->
  <section class="scale-texture border-b border-dragon-gold/15 relative overflow-hidden">
    <!-- subtle gold glow blobs -->
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-dragon-gold/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-dragon-gold/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-5 py-20 sm:py-28 relative z-10">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

        <!-- LEFT: Text content -->
        <div>
          <p class="text-sm uppercase tracking-[0.25em] text-dragon-gold-soft font-medium">
            SLSU Sogod · FITM &amp; FCIS Department
          </p>
          <h1 class="font-display leading-[0.9] mt-4 text-dragon-gold text-6xl sm:text-7xl md:text-8xl lg:text-[7.5rem]">
            HERCULEAN<br>DRAGON
          </h1>
          <p class="mt-6 font-display text-dragon-ink text-xl sm:text-2xl tracking-wide">
           ONE TEAM. ONE FORM. EVERY VICTORY.
          </p>
          <p class="mt-8 max-w-xl text-lg text-dragon-muted leading-relaxed">
            Rise with the Dragon. One registration form covers every sport and art category in this year's SLSU Sogod Intramurals. Step up. Sign up. Represent.
          </p>
          <div class="mt-10 flex flex-wrap gap-4">
            <a href="#categories"
               class="px-7 py-3.5 rounded-md font-semibold text-black bg-dragon-gold hover:bg-amber-400 transition-colors shadow-lg shadow-dragon-gold/20">
              View Categories
            </a>
            <a href="{{ route('register.create') }}"
               class="px-7 py-3.5 rounded-md font-semibold border border-dragon-gold/70 text-dragon-gold hover:bg-dragon-gold/10 transition-colors">
              Register Now
            </a>
          </div>
        </div>

        <!-- RIGHT: Hero image -->
        <div class="relative flex justify-center lg:justify-end">
          <!-- decorative frame behind image -->
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-72 h-72 sm:w-96 sm:h-96 rounded-full border border-dragon-gold/20"></div>
            <div class="absolute w-80 h-80 sm:w-[26rem] sm:h-[26rem] rounded-full border border-dragon-gold/10"></div>
          </div>

          <img src="{{ asset('assets/hero-dragon.png') }}"
               alt="Herculean Dragon mascot"
               class="relative z-10 w-64 sm:w-80 lg:w-[28rem] h-auto object-contain hero-image-glow"
               onerror="this.onerror=null; this.parentElement.innerHTML='<div class=&quot;relative z-10 flex flex-col items-center justify-center w-64 sm:w-80 lg:w-[28rem] h-64 sm:h-80 lg:h-[28rem] rounded-2xl border-2 border-dashed border-dragon-gold/30 bg-dragon-panel/50 text-dragon-gold/70 text-center p-8&quot;><span class=&quot;text-6xl mb-4&quot;>🐉</span><p class=&quot;font-display text-xl text-dragon-gold&quot;>DRAGON</p><p class=&quot;text-xs text-dragon-muted mt-2&quot;>Add your image at<br><code class=&quot;text-dragon-gold-soft&quot;>public/assets/hero-dragon.png</code></p></div>';">
        </div>

      </div>
    </div>
  </section>

  <!-- ===== ABOUT STRIP (Logo Carousel) ===== -->
    <section id="about" class="border-b border-dragon-gold/10 py-12 overflow-hidden">
    <div class="max-w-6xl mx-auto px-5 mb-8">
        <p class="text-center text-xs uppercase tracking-[0.3em] text-dragon-gold-soft font-medium">
        Proudly representing · Supported by
        </p>
    </div>

    <!-- Carousel wrapper -->
    <div class="relative group">
        <!-- Edge fades -->
        <div class="pointer-events-none absolute inset-y-0 left-0 w-24 z-10 bg-gradient-to-r from-dragon-bg to-transparent"></div>
        <div class="pointer-events-none absolute inset-y-0 right-0 w-24 z-10 bg-gradient-to-l from-dragon-bg to-transparent"></div>

        <!-- Scrolling track -->
        <div class="flex gap-12 animate-marquee group-hover:[animation-play-state:paused] w-max">
        <!-- First set -->
        @php
            $logos = [
            ['src' => 'assets/logo.png',   'alt' => 'SLSU Intramurals'],
            ['src' => 'assets/navbar-logo.png', 'alt' => 'SLSU '],
            ['src' => 'assets/slsu-crop.png', 'alt' => 'Herculean Dragon'],
            ['src' => 'assets/fp-removebg.png','alt' => 'SLSU Sogod'],
            ['src' => 'assets/slsu-crop.png', 'alt' => 'Herculean Dragon'],
            ['src' => 'assets/navbar-logo.png', 'alt' => 'SLSU '],
            ['src' => 'assets/gg-removebg.png',         'alt' => 'Team 2'],
            ['src' => 'assets/slsu-crop.png', 'alt' => 'Herculean Dragon'],
            ['src' => 'assets/navbar-logo.png', 'alt' => 'SLSU '],
            ['src' => 'assets/fs-removebg.png',         'alt' => 'Team 3'],
            ];
        @endphp

        @foreach ($logos as $logo)
            <div class="flex items-center justify-center h-20 w-40 shrink-0 opacity-70 hover:opacity-100 transition-opacity">
            <img src="{{ asset($logo['src']) }}"
                alt="{{ $logo['alt'] }}"
                class="max-h-18 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-300">
            </div>
        @endforeach

        <!-- Duplicate set for seamless loop -->
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

  <!-- ===== CATEGORY SHOWCASE ===== -->
  <section id="categories" class="max-w-6xl mx-auto px-5 pb-24 pt-8">
    @foreach ($groups as $groupName => $sports)
      <div class="mb-16 last:mb-0">
        <div class="flex items-center gap-4 mb-7">
          <h2 class="font-display text-2xl sm:text-3xl text-dragon-gold tracking-wide whitespace-nowrap">{{ $groupName }}</h2>
          <span class="h-px flex-1 bg-dragon-gold/20"></span>
          <span class="text-xs font-medium text-dragon-muted uppercase tracking-wider">{{ $sports->count() }} categories</span>
        </div>

        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach ($sports as $sport)
            <div class="sport-card bg-dragon-panel border border-dragon-gold/15 rounded-xl p-5 flex flex-col justify-between min-h-[120px] group">
              <p class="font-medium text-[15px] leading-snug text-dragon-ink">{{ $sport }}</p>
              <a href="{{ route('register.create', ['sport' => $sport]) }}"
                 class="mt-4 text-sm font-semibold self-start text-dragon-gold inline-flex items-center gap-1 group-hover:gap-2 transition-all">
                Register <span class="text-lg leading-none">→</span>
              </a>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </section>

  <!-- ===== FOOTER ===== -->
  <footer class="border-t border-dragon-gold/15 py-10">
    <div class="max-w-6xl mx-auto px-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-dragon-muted">
      <p>Herculean Dragon · SLSU Sogod Intramurals</p>
      <p class="text-dragon-gold-soft/80">HTM &amp; Information Technology Department</p>
    </div>
  </footer>

</body>
</html>


