<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Herculean Dragon · SLSU Sogod Intramurals</title>


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

  <!-- ===== HERO ===== -->
  <section class="scale-texture border-b border-dragon-gold/15 relative overflow-hidden">
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-dragon-gold/5 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 left-1/3 w-72 h-72 bg-dragon-gold/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-5 py-20 sm:py-28 relative z-10">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

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

        <div class="relative flex justify-center lg:justify-end">
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

    <div class="relative group">
      <div class="pointer-events-none absolute inset-y-0 left-0 w-24 z-10 bg-gradient-to-r from-dragon-bg to-transparent"></div>
      <div class="pointer-events-none absolute inset-y-0 right-0 w-24 z-10 bg-gradient-to-l from-dragon-bg to-transparent"></div>

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
          <h2 class="font-display text-2xl sm:text-3xl text-dragon-gold tracking-wide whitespace-nowrap">{{ $groupName }}</h2>
          <span class="h-px flex-1 bg-dragon-gold/20"></span>
          <span class="text-xs font-medium text-dragon-muted uppercase tracking-wider">{{ $sports->count() }} categories</span>
        </div>

        <div class="grid grid-cols-1 xs:grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach ($sports as $sport)
            <div class="sport-card bg-dragon-panel border border-dragon-gold/15 rounded-xl p-5 flex flex-col justify-between min-h-[140px] group">
              <div>
                <p class="font-medium text-[15px] leading-snug text-dragon-ink">{{ $sport->name }}</p>

                {{-- Meta line: member range + team/individual --}}
                <p class="mt-1.5 text-xs text-dragon-muted">
                  @if ($sport->min_members === $sport->max_members)
                    {{ $sport->max_members }} {{ Str::plural('member', $sport->max_members) }}
                  @else
                    {{ $sport->min_members }}–{{ $sport->max_members }} members
                  @endif
                </p>
              </div>

              <div class="mt-4 flex items-center justify-between gap-2">
                <button type="button"
                        class="details-btn text-xs font-semibold text-dragon-muted hover:text-dragon-gold transition-colors inline-flex items-center gap-1 cursor-pointer"
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
                   class="text-sm font-semibold text-dragon-gold inline-flex items-center gap-1 group-hover:gap-2 transition-all">
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
  <footer class="border-t border-dragon-gold/15 py-10">
    <div class="max-w-6xl mx-auto px-5 flex flex-col sm:flex-row justify-between items-center gap-3 text-sm text-dragon-muted">
      <p>Herculean Dragon · SLSU Sogod Intramurals</p>
      <p class="text-dragon-gold-soft/80">HTM &amp; Information Technology Department</p>
    </div>
  </footer>

  <!-- ===== DETAILS MODAL ===== -->
  <div id="detailsModal"
       class="fixed inset-0 z-50 hidden items-center justify-center p-4"
       role="dialog" aria-modal="true" aria-labelledby="detailsModalTitle">
    <!-- Backdrop -->
    <div id="modalBackdrop"
         class="absolute inset-0 bg-black/70 backdrop-blur-sm opacity-0 transition-opacity duration-200"></div>

    <!-- Dialog -->
    <div id="modalPanel"
         class="relative z-10 w-full max-w-lg rounded-2xl overflow-hidden opacity-0 scale-95 transition-all duration-200"
         style="background: var(--bg-panel, #191814); border: 1px solid rgba(242,185,12,0.25);">

      <!-- Header -->
      <div class="px-6 pt-6 pb-4 border-b border-[rgba(242,185,12,0.12)] flex items-start justify-between gap-4">
        <div class="min-w-0">
          <span id="modalGroupPill"
                class="inline-block text-[10px] font-semibold uppercase tracking-[0.15em] px-2.5 py-1 rounded-full mb-2"
                style="background: rgba(242,185,12,0.12); color: var(--gold-soft, #C99A1E); border: 1px solid rgba(242,185,12,0.25);">
            Group
          </span>
          <h3 id="detailsModalTitle" class="font-display text-2xl text-dragon-gold leading-tight"></h3>
        </div>
        <button type="button" id="modalClose"
                class="cursor-pointer shrink-0 p-1.5 rounded text-dragon-muted hover:text-dragon-gold hover:bg-dragon-gold/10 transition-colors"
                aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      <!-- Body -->
      <div class="px-6 py-5 space-y-5">
        <!-- Stats row -->
        <dl class="grid grid-cols-2 gap-4">
          <div>
            <dt class="text-[10px] uppercase tracking-[0.15em] text-dragon-muted mb-1">Team size</dt>
            <dd id="modalMembers" class="font-display text-xl text-dragon-ink">—</dd>
          </div>
          <div>
            <dt class="text-[10px] uppercase tracking-[0.15em] text-dragon-muted mb-1">Type</dt>
            <dd id="modalType" class="font-display text-xl text-dragon-ink">—</dd>
          </div>
        </dl>

        <!-- Description -->
        <div>
          <dt class="text-[10px] uppercase tracking-[0.15em] text-dragon-muted mb-1.5">About this category</dt>
          <dd id="modalDescription" class="text-sm text-dragon-muted leading-relaxed">—</dd>
        </div>

        <!-- Note -->
        <div class="rounded-lg p-3 text-xs text-dragon-muted"
             style="background: rgba(242,185,12,0.05); border: 1px solid rgba(242,185,12,0.15);">
          <p class="flex gap-2">
            <span class="shrink-0">💡</span>
            <span id="modalNote">Bring your own gear. Arrive 30 minutes before your scheduled match.</span>
          </p>
        </div>
      </div>

      <!-- Footer / CTA -->
      <div class="px-6 pb-6 pt-2 flex flex-col sm:flex-row gap-3">
        <a id="modalRegisterBtn" href="#"
           class="flex-1 text-center px-5 py-3 rounded-md font-semibold text-black bg-dragon-gold hover:bg-amber-400 transition-colors">
          Register for this category
        </a>
        <button type="button" id="modalCloseFooter"
                class="cursor-pointer px-5 py-3 rounded-md font-semibold border border-dragon-gold/40 text-dragon-gold hover:bg-dragon-gold/10 transition-colors">
          Close
        </button>
      </div>
    </div>
  </div>

  <script>
    // ── Sport details data ─────────────────────────────────────────────
    // Customize descriptions per sport. Fallback uses the category group.
    const SPORT_DETAILS = {
      // Sports
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

      // Athletics
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

      // Visual Arts
      "On the Spot Poster Making": { description: "Create a poster on a surprise theme within the time limit.", note: "Bring your own materials. Paper provided." },
      "Pencil Drawing":            { description: "Freehand pencil drawing. Judged on technique, composition, creativity.", note: "Bring your own pencils and eraser." },
      "Charcoal Rendering":        { description: "Charcoal drawing on paper. Judged on shading and form.", note: "Bring your own charcoal and smudge tools." },
      "Painting":                  { description: "Painting on canvas using your chosen medium.", note: "Bring your own brushes and paints." },

      // Music
      "Pop Solo":              { description: "Solo vocal performance of a pop song. One entry per contestant.", note: "Submit your minus-one track in advance." },
      "Vocal Duet":            { description: "Two-person vocal performance. Any genre.", note: "Coordinate costumes with your partner." },
      "Vocal Solo Kundiman":   { description: "Solo performance of a traditional Filipino kundiman.", note: "Live piano accompaniment provided." },
      "Song Writing":          { description: "Original song composition. Submit lyrics and perform live.", note: "Original work only — no covers." },
      "Piano":                 { description: "Solo piano performance. Any classical or contemporary piece.", note: "Submit sheet music in advance." },

      // Literary-Musical
      "Declamation":              { description: "Dramatic delivery of a memorized piece. Judged on voice, emotion, stage presence.", note: "Memorize your piece — no notes allowed." },
      "Extemporaneous Speaking":  { description: "Impromptu speech on a surprise topic. 3–5 minutes.", note: "You get 5 minutes prep time." },
      "Essay Writing":            { description: "Timed essay on a surprise prompt. Judged on content and style.", note: "Bring your own pen. Paper provided." },
      "Short and Sweet Play Dialog": { description: "Group performance of a short play or dialog. 5–10 minutes.", note: "Rehearse blocking and props." },
      "Pangdalawahang Pag-arte":  { description: "Two-person dramatic performance in Filipino.", note: "Costumes encouraged." },

      // Dance
      "Mass Dance":                    { description: "Large-group dance performance. Open to all year levels.", note: "Choreography must be original or credited." },
      "Folk Dance":                    { description: "Traditional Filipino folk dance performance.", note: "Traditional costumes required." },
      "Pop Dance":                     { description: "Modern pop dance routine. Group or solo.", note: "Submit your music in advance." },
      "Dance Sports - Latin/American": { description: "Ballroom dance sport — Latin or American style. Pairs.", note: "Costumes required. Pairs only." },
      "Dance Sports - Standard":       { description: "Standard ballroom dance sport. Pairs.", note: "Formal attire required." },
      "Dance Sports - Third Kind":     { description: "Contemporary or freestyle dance sport. Pairs.", note: "Costumes encouraged." },
    };

    // Group-level fallback descriptions
    const GROUP_FALLBACKS = {
      "Sports":             "Competitive team or individual sport. Standard intramurals rules apply.",
      "Athletics":          "Track and field event. Heats and finals will be scheduled based on entries.",
      "Visual Arts":        "Individual art competition. Materials and time limits will be announced on the day.",
      "Music":              "Musical performance category. Live performances judged by a panel.",
      "Literary-Musical":   "Literary or theatrical performance. Judged on delivery and stage presence.",
      "Dance":              "Dance performance category. Choreography and execution will be judged.",
    };

    // ── DOM refs ───────────────────────────────────────────────────────
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

    // Sport data passed from Blade (id, name, group, min, max)
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


    // ── Open / close helpers ───────────────────────────────────────────
    let lastFocusedEl = null;

    function openModal(sportId) {
      const sport = SPORTS_BY_ID[sportId];
      if (!sport) return;

      const details = SPORT_DETAILS[sport.name] || {};
      const fallback = GROUP_FALLBACKS[sport.group] || "Details for this category will be announced soon.";

      modalTitle.textContent     = sport.name;
      modalGroupPill.textContent = sport.group;
      modalMembers.textContent   = sport.min === sport.max
        ? `${sport.max}`
        : `${sport.min}–${sport.max}`;
      modalType.textContent      = sport.max === 1 ? "Individual" : "Team";
      modalDescription.textContent = details.description || fallback;
      modalNote.textContent        = details.note || "Bring your own gear. Arrive 30 minutes before your scheduled match.";
      modalRegisterBtn.href        = "{{ route('register.create') }}?sport=" + encodeURIComponent(sport.name);

      lastFocusedEl = document.activeElement;

      modal.classList.remove('hidden');
      modal.classList.add('flex');

      // Trigger transition on next frame
      requestAnimationFrame(() => {
        modalBackdrop.classList.remove('opacity-0');
        modalPanel.classList.remove('opacity-0', 'scale-95');
        modalPanel.classList.add('opacity-100', 'scale-100');
      });

      // Lock body scroll
      document.body.style.overflow = 'hidden';

      // Focus management
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

    // ── Event wiring ───────────────────────────────────────────────────
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
  </script>

</body>
</html>