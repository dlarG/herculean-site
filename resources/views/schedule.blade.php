<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Schedule · Herculean Dragon</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/HD_Logo_DARK.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --bg: #0d0d0c;
      --bg-panel: #131a30;
      --bg-panel-soft: rgba(16, 21, 43, 0.4);
      --border: rgba(242, 185, 12, 0.14);
      --border-strong: rgba(16, 21, 43, 0.6);
      --gold: #3a4a8a;
      --gold-soft: #252e4d;
      --ink: #f4f1e8;
      --ink-muted: #b9b4a6;
      --pill-bg: rgba(58, 74, 138, 0.2);
      --pill-border: rgba(58, 74, 138, 0.4);
      --shadow-gold: rgba(16, 21, 43, 0.6);
      --overlay: rgba(0, 0, 0, 0.7);
      --hero-overlay-top: rgba(0, 0, 0, 0.55);
      --hero-overlay-mid: rgba(0, 0, 0, 0.75);
      --hero-overlay-bottom: rgba(0, 0, 0, 0.9);
      --hero-tint-opacity: 0.28;
    }
    body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
    .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }

    .pill {
      background: var(--pill-bg);
      color: var(--gold-soft);
      border: 1px solid var(--pill-border);
    }

    /* Calendar cells */
    .cal-day {
      aspect-ratio: 1 / 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
      padding: 6px 4px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.15s ease, border-color 0.15s ease;
      border: 1px solid transparent;
      position: relative;
    }
    .cal-day:hover {
      background: var(--bg-panel-soft);
      border-color: var(--border);
    }
    .cal-day.today {
      border-color: var(--gold-soft);
    }
    .cal-day.has-event {
      background: var(--pill-bg);
      border-color: var(--pill-border);
    }
    .cal-day.has-event:hover {
      border-color: var(--gold);
    }
    .cal-day.other-month {
      opacity: 0.25;
      cursor: default;
      pointer-events: none;
    }
    .cal-day .day-number {
      font-size: 13px;
      font-weight: 600;
      color: var(--ink);
    }
    .cal-day.other-month .day-number {
      color: var(--ink-muted);
    }
    .cal-day .event-dot {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--gold);
      margin-top: 4px;
    }
    .cal-day .event-count {
      font-size: 10px;
      font-weight: 600;
      color: #000;
      background: var(--gold);
      border-radius: 999px;
      padding: 1px 6px;
      margin-top: 3px;
      line-height: 1.2;
    }

    /* Modal */
    #scheduleModal { transition: opacity 0.2s ease; }
    #scheduleModalPanel { transition: all 0.2s ease; }
  </style>
</head>
<body class="antialiased">

  {{-- ===== HEADER ===== --}}
  <header class="sticky p-3 top-0 z-30 backdrop-blur-sm"
          style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-bottom: 1px solid var(--border);">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
        <img src="{{ asset('assets/HD_Logo_LIGHT_Horizontal.png') }}"
             alt="Herculean Dragon Logo"
             class="h-16 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.style.display='none';">
      </a>
      <a href="{{ route('home') }}"
         class="text-sm inline-flex items-center gap-2 transition-colors hover:text-[color:var(--gold)]"
         style="color: var(--ink-muted);">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        Back to home
      </a>
    </div>
  </header>

  {{-- ===== MAIN ===== --}}
  <main class="max-w-6xl mx-auto px-5 py-10 sm:py-14">

    {{-- Page title --}}
    <div class="mb-10">
      <p class="text-xs sm:text-sm uppercase tracking-[0.25em] font-semibold mb-3 flex items-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        Tryouts · Auditions · Screenings
      </p>
      <h1 class="font-display text-4xl sm:text-5xl leading-tight" style="color: var(--gold);">
        SCHEDULE
      </h1>
      <p class="mt-3 text-base max-w-xl" style="color: var(--ink-muted);">
        Upcoming tryouts and auditions posted by your coaches. Click a highlighted date to see details and apply.
      </p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">

      {{-- ===== LEFT: CALENDAR ===== --}}
      <div class="lg:col-span-2">
        <div class="rounded-2xl p-5 sm:p-6" style="background: var(--bg-panel); border: 1px solid var(--border);">

          {{-- Calendar header --}}
          <div class="flex items-center justify-between mb-5">
            <button type="button" id="prevMonth"
                    class="cursor-pointer p-2 rounded-lg transition-colors hover:text-[color:var(--gold)]"
                    style="color: var(--ink-muted); border: 1px solid var(--border);">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="15 18 9 12 15 6"/>
              </svg>
            </button>

            <h2 id="calMonthLabel" class="font-display text-xl sm:text-2xl tracking-wide" style="color: var(--gold);">
              <!-- filled by JS -->
            </h2>

            <button type="button" id="nextMonth"
                    class="cursor-pointer p-2 rounded-lg transition-colors hover:text-[color:var(--gold)]"
                    style="color: var(--ink-muted); border: 1px solid var(--border);">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                   stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"/>
              </svg>
            </button>
          </div>

          {{-- Weekday labels --}}
          <div class="grid grid-cols-7 gap-1 mb-2">
            @foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
              <div class="text-center text-[10px] uppercase tracking-wider font-semibold py-2"
                   style="color: var(--ink-muted);">
                {{ $day }}
              </div>
            @endforeach
          </div>

          {{-- Calendar grid --}}
          <div id="calGrid" class="grid grid-cols-7 gap-1"></div>

          {{-- Legend --}}
          <div class="mt-5 pt-4 flex flex-wrap items-center gap-4 text-xs"
               style="border-top: 1px solid var(--border); color: var(--ink-muted);">
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded-full" style="background: var(--gold);"></span>
              Has tryouts
            </div>
            <div class="flex items-center gap-2">
              <span class="w-3 h-3 rounded" style="border: 1px solid var(--gold-soft);"></span>
              Today
            </div>
          </div>
        </div>
      </div>

      {{-- ===== RIGHT: UPCOMING LIST ===== --}}
      <aside class="lg:col-span-1">
        <div class="lg:sticky lg:top-24">
          <div class="rounded-2xl p-5" style="background: var(--bg-panel); border: 1px solid var(--border);">
            <h3 class="font-display text-lg mb-4" style="color: var(--gold);">UPCOMING</h3>

            @php
                $upcoming = $payload
                    ->filter(fn ($a) => \Carbon\Carbon::parse($a['event_at'])->isFuture())
                    ->take(8);
            @endphp

            @if ($upcoming->isEmpty())
                <p class="text-sm" style="color: var(--ink-muted);">
                    No upcoming tryouts scheduled yet. Check back soon.
                </p>
            @else
                <div class="space-y-3">
                    @foreach ($upcoming as $a)
                        <button type="button"
                                class="w-full text-left rounded-lg p-3 transition-colors hover:bg-[color:var(--bg-panel-soft)] cursor-pointer flex gap-3"
                                style="border: 1px solid var(--border);"
                                onclick="openScheduleModal('{{ \Carbon\Carbon::parse($a['event_at'])->format('Y-m-d') }}')">

                            {{-- Date chip OR image thumbnail --}}
                            @if (!empty($a['image_url']))
                                <img src="{{ $a['image_url'] }}"
                                    alt=""
                                    class="w-12 h-12 rounded-md object-cover shrink-0"
                                    style="border: 1px solid var(--border);">
                            @else
                                <div class="rounded-md flex flex-col items-center justify-center shrink-0 w-12 py-1.5"
                                    style="background: var(--pill-bg); border: 1px solid var(--pill-border);">
                                    <span class="text-[9px] uppercase tracking-wider font-semibold" style="color: var(--gold-soft);">
                                        {{ \Carbon\Carbon::parse($a['event_at'])->format('M') }}
                                    </span>
                                    <span class="font-display text-lg leading-none" style="color: var(--gold);">
                                        {{ \Carbon\Carbon::parse($a['event_at'])->format('j') }}
                                    </span>
                                </div>
                            @endif

                            <div class="min-w-0 flex-1">
                                <p class="font-semibold text-sm leading-snug truncate">{{ $a['title'] }}</p>
                                <p class="text-xs mt-0.5 truncate" style="color: var(--ink-muted);">
                                    {{ $a['category_name'] }}
                                </p>
                                <p class="text-xs mt-0.5 truncate" style="color: var(--ink-muted);">
                                    {{ $a['coach_name'] }}
                                </p>
                                @if (!empty($a['location']))
                                    <p class="text-xs mt-0.5 truncate" style="color: var(--ink-muted);">
                                        📍 {{ $a['location'] }}
                                    </p>
                                @endif
                            </div>
                        </button>
                    @endforeach
                </div>
            @endif
          </div>
        </div>
      </aside>

    </div>
  </main>

  {{-- ===== SCHEDULE MODAL ===== --}}
  <div id="scheduleModal"
       class="fixed inset-0 z-50 hidden items-center justify-center p-4 opacity-0"
       role="dialog" aria-modal="true" aria-labelledby="scheduleModalTitle">
    <div id="scheduleModalBackdrop"
         class="absolute inset-0 backdrop-blur-sm"
         style="background: rgba(0,0,0,0.7);"></div>

    <div id="scheduleModalPanel"
         class="relative z-10 w-full max-w-3xl rounded-2xl overflow-hidden opacity-0 scale-95 flex flex-col max-h-[90vh]"
         style="background: var(--bg-panel); border: 1px solid var(--border-strong);">

      {{-- Header --}}
      <div class="px-6 pt-6 pb-4 flex items-start justify-between gap-4 shrink-0"
           style="border-bottom: 1px solid var(--border);">
        <div class="min-w-0">
          <p class="text-[10px] uppercase tracking-[0.15em] font-semibold mb-2"
             style="color: var(--gold-soft);">Tryouts on</p>
          <h3 id="scheduleModalTitle" class="font-display text-2xl leading-tight" style="color: var(--gold);"></h3>
        </div>
        <button type="button" id="scheduleModalClose"
                class="cursor-pointer shrink-0 p-1.5 rounded transition-colors hover:text-[color:var(--gold)]"
                style="color: var(--ink-muted);" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>

      {{-- Body (scrollable) --}}
      <div id="scheduleModalBody" class="overflow-y-auto flex-1 px-6 py-5 space-y-4"></div>

      {{-- Footer --}}
      <div class="px-6 pb-6 pt-4 shrink-0" style="border-top: 1px solid var(--border);">
        <button type="button" id="scheduleModalCloseFooter"
                class="w-full cursor-pointer px-5 py-3 rounded-md font-semibold transition-colors"
                style="border: 1px solid var(--border-strong); color: var(--gold);">
          Close
        </button>
      </div>
    </div>
  </div>

  <script>
    // ============================================================
    // Data from Laravel
    // ============================================================
    const BY_DATE = @json($byDate);
    // Example shape: { "2025-03-15": [ {...}, {...} ], ... }

    // ============================================================
    // Calendar
    // ============================================================
    const calGrid = document.getElementById('calGrid');
    const calMonthLabel = document.getElementById('calMonthLabel');
    const prevBtn = document.getElementById('prevMonth');
    const nextBtn = document.getElementById('nextMonth');

    let current = new Date();
    current.setDate(1);

    const MONTH_NAMES = ['January','February','March','April','May','June','July','August','September','October','November','December'];

    function fmtDate(y, m, d) {
      return `${y}-${String(m + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
    }

    function renderCalendar() {
      const year = current.getFullYear();
      const month = current.getMonth();

      calMonthLabel.textContent = `${MONTH_NAMES[month]} ${year}`;

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();
      const daysInPrev = new Date(year, month, 0).getDate();

      const today = new Date();
      const todayStr = fmtDate(today.getFullYear(), today.getMonth(), today.getDate());

      const cells = [];

      // Leading days from previous month
      for (let i = firstDay - 1; i >= 0; i--) {
        cells.push({ day: daysInPrev - i, otherMonth: true });
      }
      // Days of the current month
      for (let d = 1; d <= daysInMonth; d++) {
        cells.push({ day: d, otherMonth: false, dateStr: fmtDate(year, month, d) });
      }
      // Trailing days to fill the last row
      let total = cells.length;
      let trailing = (7 - (total % 7)) % 7;
      for (let d = 1; d <= trailing; d++) {
        cells.push({ day: d, otherMonth: true });
      }

      calGrid.innerHTML = '';
      cells.forEach(cell => {
        const el = document.createElement('div');
        el.className = 'cal-day';
        if (cell.otherMonth) el.classList.add('other-month');
        if (cell.dateStr === todayStr) el.classList.add('today');

        const events = cell.dateStr ? (BY_DATE[cell.dateStr] || []) : [];
        if (events.length > 0) el.classList.add('has-event');

        const day = document.createElement('div');
        day.className = 'day-number';
        day.textContent = cell.day;
        el.appendChild(day);

        if (events.length > 0) {
          const count = document.createElement('div');
          count.className = 'event-count';
          count.textContent = events.length;
          el.appendChild(count);
        }

        if (cell.dateStr) {
          el.addEventListener('click', () => openScheduleModal(cell.dateStr));
        }

        calGrid.appendChild(el);
      });
    }

    prevBtn.addEventListener('click', () => {
      current.setMonth(current.getMonth() - 1);
      renderCalendar();
    });
    nextBtn.addEventListener('click', () => {
      current.setMonth(current.getMonth() + 1);
      renderCalendar();
    });

    renderCalendar();

    // ============================================================
    // Modal
    // ============================================================
    const modal = document.getElementById('scheduleModal');
    const modalBackdrop = document.getElementById('scheduleModalBackdrop');
    const modalPanel = document.getElementById('scheduleModalPanel');
    const modalTitle = document.getElementById('scheduleModalTitle');
    const modalBody = document.getElementById('scheduleModalBody');

    let lastFocusedEl = null;

    function openScheduleModal(dateStr) {
    const events = BY_DATE[dateStr] || [];
    if (!events.length) return;

    const [y, m, d] = dateStr.split('-');
    const dateObj = new Date(y, m - 1, d);
    modalTitle.textContent = dateObj.toLocaleDateString('en-US', {
        weekday: 'long', month: 'long', day: 'numeric', year: 'numeric',
    });

    modalBody.innerHTML = '';

    events.forEach((e) => {
        const time = e.event_time || '';
        const coachName = e.coach_name || 'Unknown coach';
        const categoryName = e.category_name || 'General';
        const registerUrl = `/register?sport=${encodeURIComponent(categoryName)}`;

        const card = document.createElement('div');
        card.className = 'rounded-2xl overflow-hidden';
        card.style.background = 'var(--bg-panel)';
        card.style.border = '1px solid var(--border)';

        // ── Image block (only if uploaded) ─────────────────
        const imageBlock = e.image_url
        ? `
            <div class="relative w-full h-[90vh] overflow-hidden" style="border-bottom: 1px solid var(--border);">
            <img src="${e.image_url}" alt="" class="w-full h-full object-cover" loading="lazy">
            <div class="absolute inset-0" style="background: linear-gradient(180deg, rgba(0,0,0,0) 40%, rgba(0,0,0,0.6) 100%);"></div>
            <span class="absolute top-3 left-3 text-[10px] font-semibold uppercase tracking-[0.12em] px-2.5 py-1 rounded-full backdrop-blur-sm"
                    style="background: rgba(0,0,0,0.55); color: var(--gold); border: 1px solid rgba(242,185,12,0.4);">
                ${categoryName}
            </span>
            </div>
        `
        : '';

        // ── Header with category pill (when no image) ──────
        const headerPill = !e.image_url
        ? `
            <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="pill text-[10px] uppercase tracking-wider px-2.5 py-1 rounded-full">
                ${categoryName}
            </span>
            </div>
        `
        : '';

        // ── Meta row (time + location) ──────────────────────
        const metaItems = [];
        if (time) metaItems.push(`🕐 ${time}`);
        if (e.location) metaItems.push(`📍 ${e.location}`);
        const metaRow = metaItems.length
        ? `
            <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs mb-3"
                style="color: var(--ink-muted);">
            ${metaItems.map(item => `<span>${item}</span>`).join('')}
            </div>
        `
        : '';

        // ── Coach attribution ───────────────────────────────
        const coachRow = `
        <div class="flex items-center gap-2.5 mt-4 pt-4" style="border-top: 1px solid var(--border);">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-[11px] font-bold shrink-0"
                style="background: var(--gold); color: #000;">
            ${coachName.charAt(0).toUpperCase()}
            </div>
            <div class="min-w-0">
            <p class="text-[10px] uppercase tracking-wider" style="color: var(--ink-muted);">
                Posted by
            </p>
            <p class="text-sm font-semibold truncate" style="color: var(--ink);">
                ${coachName}
            </p>
            </div>
        </div>
        `;

        card.innerHTML = `
        ${imageBlock}
        <div class="p-5">
            ${headerPill}

            <h4 class="font-display text-xl leading-tight mb-2" style="color: var(--ink);">
            ${e.title}
            </h4>

            ${metaRow}

            <p class="text-sm leading-relaxed" style="color: var(--ink-muted);">
            ${e.body || ''}
            </p>

            ${coachRow}

            <div class="mt-5">
            <a href="${registerUrl}"
                class="w-full inline-flex items-center justify-center gap-2 text-sm font-bold uppercase tracking-wider px-5 py-3 rounded-lg text-black transition-all hover:scale-[1.01] active:scale-[0.99]"
                style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
                Apply / Register
                <span class="text-base leading-none">→</span>
            </a>
            </div>
        </div>
        `;

        modalBody.appendChild(card);
    });

    lastFocusedEl = document.activeElement;

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    requestAnimationFrame(() => {
        modal.classList.remove('opacity-0');
        modalPanel.classList.remove('opacity-0', 'scale-95');
        modalPanel.classList.add('opacity-100', 'scale-100');
    });
    document.body.style.overflow = 'hidden';
    document.getElementById('scheduleModalClose').focus();
    }

    function closeScheduleModal() {
      modal.classList.add('opacity-0');
      modalPanel.classList.add('opacity-0', 'scale-95');
      modalPanel.classList.remove('opacity-100', 'scale-100');
      setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
        if (lastFocusedEl) lastFocusedEl.focus();
      }, 200);
    }

    document.getElementById('scheduleModalClose').addEventListener('click', closeScheduleModal);
    document.getElementById('scheduleModalCloseFooter').addEventListener('click', closeScheduleModal);
    modalBackdrop.addEventListener('click', closeScheduleModal);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeScheduleModal();
      }
    });
  </script>

</body>
</html>