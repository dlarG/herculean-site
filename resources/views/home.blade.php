<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Herculean Dragon · SLSU Sogod Intramurals</title>

  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

  {{-- Apply saved theme before CSS renders to avoid flash --}}
  <script>
    (function () {
      const saved = localStorage.getItem('theme');
      const prefersLight = window.matchMedia('(prefers-color-scheme: light)').matches;
      const theme = saved || (prefersLight ? 'light' : 'dark');
      document.documentElement.setAttribute('data-theme', theme);
    })();
  </script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background: var(--bg); color: var(--ink);">

  <!-- ===== NAVBAR ===== -->
  <header class="p-2 sticky top-0 z-40 backdrop-blur-sm"
          style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-bottom: 1px solid var(--border);">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
        <img src="{{ asset('assets/panag-nobg.png') }}"
             alt="Herculean Dragon Logo"
             class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
        <span class="hidden font-display text-xl" style="color: var(--gold);">HERCULEAN DRAGON</span>
      </a>

      <div class="flex items-center gap-3 sm:gap-6">
        <nav class="hidden sm:flex items-center gap-8 text-sm font-medium" style="color: var(--ink-muted);">
          <a href="#categories" class="hover:text-[color:var(--gold)] transition-colors">Categories</a>
          <a href="#about" class="hover:text-[color:var(--gold)] transition-colors">About</a>
        </nav>

        {{-- Theme toggle --}}
        <button type="button" id="themeToggle"
                class="cursor-pointer p-2 rounded-md transition-colors hover:text-[color:var(--gold)]"
                style="color: var(--ink-muted);"
                aria-label="Toggle theme">
          {{-- Sun (shown in dark mode) --}}
          <svg id="themeIconSun" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="4"/>
            <path d="M12 2v2M12 20v2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M2 12h2M20 12h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
          </svg>
          {{-- Moon (shown in light mode) --}}
          <svg id="themeIconMoon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
          </svg>
        </button>

        {{-- Desktop register --}}
        <a href="{{ route('register.create') }}"
           class="hidden sm:inline-block px-5 py-2 rounded-md font-semibold text-black transition-colors shadow-sm"
           style="background: var(--gold);">
          Register
        </a>

        {{-- Mobile register --}}
        <a href="{{ route('register.create') }}"
           class="sm:hidden px-4 py-1.5 rounded-md text-black text-sm font-semibold transition-colors"
           style="background: var(--gold);">
          Register
        </a>
      </div>
    </div>
  </header>

  <!-- ===== HERO ===== -->
  <section class="scale-texture relative overflow-hidden" style="border-bottom: 1px solid var(--border);">
    <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full blur-3xl pointer-events-none"
         style="background: var(--bg-panel-soft);"></div>
    <div class="absolute bottom-0 left-1/3 w-72 h-72 rounded-full blur-3xl pointer-events-none"
         style="background: var(--bg-panel-soft);"></div>

    <div class="max-w-6xl mx-auto px-5 py-20 sm:py-28 relative z-10">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

        <div>
          <p class="text-sm uppercase tracking-[0.25em] font-medium" style="color: var(--gold-soft);">
            SLSU Sogod · FITM &amp; FCIS Department
          </p>
          <h1 class="font-display leading-[0.9] mt-4 text-6xl sm:text-7xl md:text-8xl lg:text-[7.5rem]"
              style="color: var(--gold);">
            HERCULEAN<br>DRAGON
          </h1>
          <p class="mt-6 font-display text-xl sm:text-2xl tracking-wide" style="color: var(--ink);">
            ONE TEAM. ONE FORM. EVERY VICTORY.
          </p>
          <p class="mt-8 max-w-xl text-lg leading-relaxed" style="color: var(--ink-muted);">
            Rise with the Dragon. One registration form covers every sport and art category in this year's SLSU Sogod Intramurals. Step up. Sign up. Represent.
          </p>
          <div class="mt-10 flex flex-wrap gap-4">
            <a href="#categories"
               class="px-7 py-3.5 rounded-md font-semibold text-black transition-colors"
               style="background: var(--gold); box-shadow: 0 10px 30px -12px var(--shadow-gold);">
              View Categories
            </a>
            <a href="{{ route('register.create') }}"
               class="px-7 py-3.5 rounded-md font-semibold transition-colors"
               style="border: 1px solid var(--border-strong); color: var(--gold);">
              Register Now
            </a>
          </div>
        </div>

        <div class="relative flex justify-center lg:justify-end">
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="w-72 h-72 sm:w-96 sm:h-96 rounded-full" style="border: 1px solid var(--border);"></div>
            <div class="absolute w-80 h-80 sm:w-[26rem] sm:h-[26rem] rounded-full" style="border: 1px solid var(--border);"></div>
          </div>

          <img src="{{ asset('assets/hero-dragon.png') }}"
               alt="Herculean Dragon mascot"
               class="relative z-10 w-64 sm:w-80 lg:w-[28rem] h-auto object-contain hero-image-glow"
               onerror="this.onerror=null; this.parentElement.innerHTML='<div class=&quot;relative z-10 flex flex-col items-center justify-center w-64 sm:w-80 lg:w-[28rem] h-64 sm:h-80 lg:h-[28rem] rounded-2xl border-2 border-dashed text-center p-8&quot; style=&quot;border-color: var(--border-strong); background: var(--bg-panel); color: var(--gold);&quot;><span class=&quot;text-6xl mb-4&quot;>🐉</span><p class=&quot;font-display text-xl&quot;>DRAGON</p><p class=&quot;text-xs mt-2&quot; style=&quot;color: var(--ink-muted);&quot;>Add your image at<br><code style=&quot;color: var(--gold-soft);&quot;>public/assets/hero-dragon.png</code></p></div>';">
        </div>

      </div>
    </div>
  </section>

  <!-- ===== ABOUT STRIP (Logo Carousel) ===== -->
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

  <!-- ===== CATEGORY SHOWCASE ===== -->
  <section id="categories" class="max-w-6xl mx-auto px-5 pb-24 pt-8">
    @foreach ($groups as $groupName => $sports)
      <div class="mb-16 last:mb-0">
        <div class="flex items-center gap-4 mb-7">
          <h2 class="font-display text-2xl sm:text-3xl tracking-wide whitespace-nowrap" style="color: var(--gold);">{{ $groupName }}</h2>
          <span class="h-px flex-1" style="background: var(--border);"></span>
          <span class="text-xs font-medium uppercase tracking-wider" style="color: var(--ink-muted);">{{ $sports->count() }} categories</span>
        </div>

        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach ($sports as $sport)
            <div class="sport-card rounded-xl p-5 flex flex-col justify-between min-h-[140px] group">
              <div>
                <p class="font-medium text-[15px] leading-snug" style="color: var(--ink);">{{ $sport->name }}</p>

                <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
                  @if ($sport->min_members === $sport->max_members)
                    {{ $sport->max_members }} {{ Str::plural('member', $sport->max_members) }}
                  @else
                    {{ $sport->min_members }}–{{ $sport->max_members }} members
                  @endif
                </p>
              </div>

              <div class="mt-4 flex items-center justify-between gap-2">
                <button type="button"
                        class="details-btn text-xs font-semibold inline-flex items-center gap-1 cursor-pointer transition-colors hover:text-[color:var(--gold)]"
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
                   class="text-sm font-semibold inline-flex items-center gap-1 group-hover:gap-2 transition-all"
                   style="color: var(--gold);">
                  Register <span class="text-lg leading-none">→</span>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  </section>

  <!-- ===== FOOTER ===== -->
  <footer class="py-10" style="border-top: 1px solid var(--border);">
    <div class="max-w-6xl mx-auto px-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm" style="color: var(--ink-muted);">
      <p>Herculean Dragon · SLSU Sogod Intramurals</p>
      <p style="color: var(--gold-soft);">HTM &amp; Information Technology Department</p>
    </div>
  </footer>

  <!-- ===== DETAILS MODAL ===== -->
  <div id="detailsModal"
       class="fixed inset-0 z-50 hidden items-center justify-center p-4"
       role="dialog" aria-modal="true" aria-labelledby="detailsModalTitle">
    <div id="modalBackdrop"
         class="absolute inset-0 backdrop-blur-sm opacity-0 transition-opacity duration-200"
         style="background: var(--overlay);"></div>

    <div id="modalPanel"
         class="relative z-10 w-full max-w-lg rounded-2xl overflow-hidden opacity-0 scale-95 transition-all duration-200"
         style="background: var(--bg-panel); border: 1px solid var(--border-strong);">

      <div class="px-6 pt-6 pb-4 flex items-start justify-between gap-4" style="border-bottom: 1px solid var(--border);">
        <div class="min-w-0">
          <span id="modalGroupPill"
                class="inline-block text-[10px] font-semibold uppercase tracking-[0.15em] px-2.5 py-1 rounded-full mb-2"
                style="background: var(--pill-bg); color: var(--gold-soft); border: 1px solid var(--pill-border);">
            Group
          </span>
          <h3 id="detailsModalTitle" class="font-display text-2xl leading-tight" style="color: var(--gold);"></h3>
        </div>
        <button type="button" id="modalClose"
                class="cursor-pointer shrink-0 p-1.5 rounded transition-colors hover:text-[color:var(--gold)]"
                style="color: var(--ink-muted);"
                aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      <div class="px-6 py-5 space-y-5">
        <dl class="grid grid-cols-2 gap-4">
          <div>
            <dt class="text-[10px] uppercase tracking-[0.15em] mb-1" style="color: var(--ink-muted);">Team size</dt>
            <dd id="modalMembers" class="font-display text-xl" style="color: var(--ink);">—</dd>
          </div>
          <div>
            <dt class="text-[10px] uppercase tracking-[0.15em] mb-1" style="color: var(--ink-muted);">Type</dt>
            <dd id="modalType" class="font-display text-xl" style="color: var(--ink);">—</dd>
          </div>
        </dl>

        <div>
          <dt class="text-[10px] uppercase tracking-[0.15em] mb-1.5" style="color: var(--ink-muted);">About this category</dt>
          <dd id="modalDescription" class="text-sm leading-relaxed" style="color: var(--ink-muted);">—</dd>
        </div>

        <div class="rounded-lg p-3 text-xs" style="background: var(--bg-panel-soft); border: 1px solid var(--border); color: var(--ink-muted);">
          <p class="flex gap-2">
            <span class="shrink-0">💡</span>
            <span id="modalNote">Bring your own gear. Arrive 30 minutes before your scheduled match.</span>
          </p>
        </div>
      </div>

      <div class="px-6 pb-6 pt-2 flex flex-col sm:flex-row gap-3">
        <a id="modalRegisterBtn" href="#"
           class="flex-1 text-center px-5 py-3 rounded-md font-semibold text-black transition-colors"
           style="background: var(--gold);">
          Register for this category
        </a>
        <button type="button" id="modalCloseFooter"
                class="cursor-pointer px-5 py-3 rounded-md font-semibold transition-colors"
                style="border: 1px solid var(--border-strong); color: var(--gold);">
          Close
        </button>
      </div>
    </div>
  </div>

  <script>
    const SPORT_DETAILS = {
      "Badminton":            { description: "Singles or doubles badminton match. Best of 3 sets, 21-point rally scoring.", note: "Bring your own racket and shuttlecocks." },
      "Basketball 5x5":       { description: "Full-court 5-on-5 basketball. Four 10-minute quarters, FIBA rules.", note: "Team jersey required. Bring your own ball for warm-up." },
      "Basketball 3x3":       { description: "Half-court 3-on-3 basketball. 10-minute games or first to 21 points.", note: "One substitute allowed per team." },
      "Chess":                { description: "Standard FIDE-rules chess. Swiss system, 15 minutes per player.", note: "Bring your own chess set if possible." },
      "Futsal":               { description: "Indoor 5-a-side futsal. Two 20-minute halves.", note: "Futsal shoes required — no cleats." },
      "Lawn Tennis":          { description: "Singles or doubles tennis. Best of 3 sets.", note: "Bring your own racket." },
      "Swimming":             { description: "Freestyle, breaststroke, backstroke, or butterfly — 50m and 100m events.", note: "Bring goggles, cap, and towel." },
      "Table Tennis":         { description: "Singles or doubles table tennis. Best of 5 games to 11 points.", note: "Bring your own paddle if preferred." },
      "Volleyball":           { description: "Indoor 6-on-6 volleyball. Best of 3 sets to 25 points.", note: "Knee pads recommended." },
      "Beach Volleyball":     { description: "2-on-2 beach volleyball. Best of 3 sets to 21 points.", note: "Played outdoors — bring sunscreen." },
      "Baseball":             { description: "Standard 9-inning baseball game with 9 fielders per team.", note: "Bring your own glove and cleats." },
      "Football":             { description: "Full 11-a-side football. Two 45-minute halves.", note: "Shin guards required. Cleats recommended." },
      "Softball":             { description: "Standard 7-inning softball game with 9 fielders per team.", note: "Bring your own glove." },

      "100m Sprint":          { description: "100-meter dash. Heats and finals based on seed times.", note: "Spikes recommended. Warm up thoroughly." },
      "200m Sprint":          { description: "200-meter dash around the curve. Heats and finals.", note: "Spikes recommended." },
      "400m Sprint":          { description: "One full lap around the track. Heats and finals.", note: "Pace yourself — it's a sprinter's endurance race." },
      "4x100m Relay":         { description: "Four runners, 100m each. Baton exchange within designated zones.", note: "Practice handoffs before race day." },
      "4x400m Relay":         { description: "Four runners, 400m each. One lap per runner.", note: "Order matters — place your fastest anchor last." },
      "Long Jump":            { description: "Three attempts. Best mark advances to finals.", note: "Spikes recommended for the runway." },
      "Triple Jump":          { description: "Hop, step, and jump — three attempts, best mark counts.", note: "Spikes recommended." },
      "Shot Put":             { description: "Three throws. Best mark advances to finals.", note: "Technique matters more than raw strength." },
      "Discus":               { description: "Three throws. Best mark advances to finals.", note: "Bring your own discus if allowed." },
      "Javelin":              { description: "Three throws. Best mark advances to finals.", note: "Proper footwear and grip required." },

      "On the Spot Poster Making": { description: "Create a poster on a surprise theme within the time limit.", note: "Bring your own materials. Paper provided." },
      "Pencil Drawing":            { description: "Freehand pencil drawing. Judged on technique, composition, creativity.", note: "Bring your own pencils and eraser." },
      "Charcoal Rendering":        { description: "Charcoal drawing on paper. Judged on shading and form.", note: "Bring your own charcoal and smudge tools." },
      "Painting":                  { description: "Painting on canvas using your chosen medium.", note: "Bring your own brushes and paints." },

      "Pop Solo":              { description: "Solo vocal performance of a pop song. One entry per contestant.", note: "Submit your minus-one track in advance." },
      "Vocal Duet":            { description: "Two-person vocal performance. Any genre.", note: "Coordinate costumes with your partner." },
      "Vocal Solo Kundiman":   { description: "Solo performance of a traditional Filipino kundiman.", note: "Live piano accompaniment provided." },
      "Song Writing":          { description: "Original song composition. Submit lyrics and perform live.", note: "Original work only — no covers." },
      "Piano":                 { description: "Solo piano performance. Any classical or contemporary piece.", note: "Submit sheet music in advance." },

      "Declamation":              { description: "Dramatic delivery of a memorized piece. Judged on voice, emotion, stage presence.", note: "Memorize your piece — no notes allowed." },
      "Extemporaneous Speaking":  { description: "Impromptu speech on a surprise topic. 3–5 minutes.", note: "You get 5 minutes prep time." },
      "Essay Writing":            { description: "Timed essay on a surprise prompt. Judged on content and style.", note: "Bring your own pen. Paper provided." },
      "Short and Sweet Play Dialog": { description: "Group performance of a short play or dialog. 5–10 minutes.", note: "Rehearse blocking and props." },
      "Pangdalawahang Pag-arte":  { description: "Two-person dramatic performance in Filipino.", note: "Costumes encouraged." },

      "Mass Dance":                    { description: "Large-group dance performance. Open to all year levels.", note: "Choreography must be original or credited." },
      "Folk Dance":                    { description: "Traditional Filipino folk dance performance.", note: "Traditional costumes required." },
      "Pop Dance":                     { description: "Modern pop dance routine. Group or solo.", note: "Submit your music in advance." },
      "Dance Sports - Latin/American": { description: "Ballroom dance sport — Latin or American style. Pairs.", note: "Costumes required. Pairs only." },
      "Dance Sports - Standard":       { description: "Standard ballroom dance sport. Pairs.", note: "Formal attire required." },
      "Dance Sports - Third Kind":     { description: "Contemporary or freestyle dance sport. Pairs.", note: "Costumes encouraged." },
    };

    const GROUP_FALLBACKS = {
      "Sports":             "Competitive team or individual sport. Standard intramurals rules apply.",
      "Athletics":          "Track and field event. Heats and finals will be scheduled based on entries.",
      "Visual Arts":        "Individual art competition. Materials and time limits will be announced on the day.",
      "Music":              "Musical performance category. Live performances judged by a panel.",
      "Literary-Musical":   "Literary or theatrical performance. Judged on delivery and stage presence.",
      "Dance":              "Dance performance category. Choreography and execution will be judged.",
    };

    const modal          = document.getElementById('detailsModal');
    const modalBackdrop  = document.getElementById('modalBackdrop');
    const modalPanel     = document.getElementById('modalPanel');
    const modalTitle     = document.getElementById('detailsModalTitle');
    const modalGroupPill = document.getElementById('modalGroupPill');
    const modalMembers   = document.getElementById('modalMembers');
    const modalType      = document.getElementById('modalType');
    const modalDescription = document.getElementById('modalDescription');
    const modalNote      = document.getElementById('modalNote');
    const modalRegisterBtn = document.getElementById('modalRegisterBtn');

    @php
      $sportsForJs = $groups->flatten()->map(function ($s) {
          return [
              'id'    => $s->id,
              'name'  => $s->name,
              'group' => $s->group,
              'min'   => $s->min_members,
              'max'   => $s->max_members,
          ];
      })->values();
    @endphp

    const SPORTS = @json($sportsForJs);
    const SPORTS_BY_ID = Object.fromEntries(SPORTS.map(s => [s.id, s]));

    let lastFocusedEl = null;

    function openModal(sportId) {
      const sport = SPORTS_BY_ID[sportId];
      if (!sport) return;

      const details = SPORT_DETAILS[sport.name] || {};
      const fallback = GROUP_FALLBACKS[sport.group] || "Details for this category will be announced soon.";

      modalTitle.textContent     = sport.name;
      modalGroupPill.textContent = sport.group;
      modalMembers.textContent   = sport.min === sport.max ? `${sport.max}` : `${sport.min}–${sport.max}`;
      modalType.textContent      = sport.max === 1 ? "Individual" : "Team";
      modalDescription.textContent = details.description || fallback;
      modalNote.textContent        = details.note || "Bring your own gear. Arrive 30 minutes before your scheduled match.";
      modalRegisterBtn.href        = "{{ route('register.create') }}?sport=" + encodeURIComponent(sport.name);

      lastFocusedEl = document.activeElement;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      requestAnimationFrame(() => {
        modalBackdrop.classList.remove('opacity-0');
        modalPanel.classList.remove('opacity-0', 'scale-95');
        modalPanel.classList.add('opacity-100', 'scale-100');
      });

      document.body.style.overflow = 'hidden';
      document.getElementById('modalClose').focus();
    }

    function closeModal() {
      modalBackdrop.classList.add('opacity-0');
      modalPanel.classList.add('opacity-0', 'scale-95');
      modalPanel.classList.remove('opacity-100', 'scale-100');

      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        if (lastFocusedEl) lastFocusedEl.focus();
      }, 200);
    }

    document.querySelectorAll('.details-btn').forEach(btn => {
      btn.addEventListener('click', () => openModal(btn.dataset.sportId));
    });

    document.getElementById('modalClose').addEventListener('click', closeModal);
    document.getElementById('modalCloseFooter').addEventListener('click', closeModal);
    modalBackdrop.addEventListener('click', closeModal);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });

    // ── Theme toggle ────────────────────────────────────────────────
    (function () {
      const root = document.documentElement;
      const toggleBtn = document.getElementById('themeToggle');
      const iconSun = document.getElementById('themeIconSun');
      const iconMoon = document.getElementById('themeIconMoon');

      function applyIcons(theme) {
        if (theme === 'dark') {
          iconSun.classList.remove('hidden');
          iconMoon.classList.add('hidden');
        } else {
          iconSun.classList.add('hidden');
          iconMoon.classList.remove('hidden');
        }
      }

      // Sync icons with the theme set in <head>
      applyIcons(root.getAttribute('data-theme') || 'dark');

      toggleBtn.addEventListener('click', () => {
        const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
        root.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
        applyIcons(next);
      });
    })();
  </script>

</body>
</html>