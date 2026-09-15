<!-- ===== FAQ ===== -->
<section id="faq" class="py-20 sm:py-24" style="border-top: 1px solid var(--border);">
  <div class="max-w-4xl mx-auto px-5">

    {{-- Section header --}}
    <div class="text-center mb-12">
      <p class="text-xs uppercase tracking-[0.3em] font-semibold mb-3 flex items-center justify-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        Frequently Asked
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
      </p>
      <h2 class="font-display text-3xl sm:text-4xl md:text-5xl leading-tight" style="color: var(--ink);">
        Got <span style="color: var(--gold);">questions</span>?
      </h2>
      <p class="mt-3 text-base max-w-lg mx-auto" style="color: var(--ink-muted);">
        Everything you need to know about registering for the SLSU Sogod Intramurals.
      </p>
    </div>

    {{-- FAQ items --}}
  @php
    $faqs = [
      [
        'q' => 'Who is eligible to participate in the Intramural Meet?',
        'a' => 'All bona fide students of SLSU Sogod Campus with verified credentials and medical clearance from the University medical physician are eligible. However, 2026 Regional SCUAA athletes cannot play as athletes, pre-2026 SCUAA players must play a different sport, active Basketball trainees are excluded from all events, and members of performing groups under the Office of Arts, Culture, and Global Heritage cannot compete in arts or dance events.',
      ],
      [
        'q' => 'How and when must official rosters be submitted?',
        'a' => 'Official lists of players and athlete galleries, along with medical consent, must be submitted by the General Athletic Managers (GAMs) directly to the SSC Screening Technical Committee on or before October 9, 2026.',
      ],
      [
        'q' => 'How many events can a single participant join?',
        'a' => 'Each player may join a maximum of three (3) events: either one (1) team game and two (2) individual events, or three (3) individual events with no team game.',
      ],
      [
        'q' => 'What is the attendance policy and grace period on game days?',
        'a' => 'Participants must strictly follow the schedule. A grace period of ten (10) minutes from the designated event schedule is enforced; failing to appear by the last call (10 minutes before the event) results in default and disqualification.',
      ],
      [
        'q' => 'What is the required uniform for sports competitions?',
        'a' => 'Participants must wear their Official Team Uniform for the 1st Game and Championship Games. Matching team colors are permitted for subsequent games. Non-compliance results in immediate disqualification.',
      ],
      [
        'q' => 'What tournament formats are used for sports events?',
        'a' => 'Most sports follow a single-elimination format, except for Swimming and Athletics. Chess uses a round-robin format, while a Modified Single Elimination bracket is used to determine 3rd and 4th place winners.',
      ],
      [
        'q' => 'What is the Technical and Solidarity Meeting, and who must attend?',
        'a' => 'Scheduled for October 14, 2026, at 9:00 AM at the MPC, this meeting sets ground rules, team seeds, and match draws. Attendance is mandatory for Coaches, Assistant Coaches, Team Captains, Delegation Officials, and GAMs. Missing the meeting waives the right to contest proceedings.',
      ],
      [
        'q' => 'How are official complaints and protests filed?',
        'a' => 'No verbal complaints are accepted. Written complaints using the official Intramural Protest Form must be submitted on the day of the incident, signed by the Student GAM, Faculty GAM, and Team Captain, noted by the Faculty Dean, and directed to the Overall Chairman. Decisions of the Intramural Committee, TMs, and Board of Judges are final.',
      ],
      [
        'q' => 'Are outside trainers or choreographers allowed for cultural events?',
        'a' => 'Hiring outside choreographers and professional assistance is allowed specifically for the Dance Sports Competition. Active coaching during competitions by team advisers or prohibited performing group members is strictly banned in other categories.',
      ],
    ];
  @endphp

    {{-- Accordion --}}
    <div class="space-y-3">
      @foreach ($faqs as $i => $faq)
        <details class="faq-item group rounded-xl overflow-hidden transition-colors"
                 style="background: var(--bg-panel); border: 1px solid var(--border);"
                 {{ $i === 0 ? 'open' : '' }}>
          <summary class="faq-summary cursor-pointer list-none flex items-center justify-between gap-4 px-5 py-4 sm:px-6 sm:py-5 transition-colors">
            <span class="flex items-center gap-4 min-w-0">
              <span class="hidden sm:flex items-center justify-center w-7 h-7 rounded-full text-[11px] font-bold shrink-0 transition-colors"
                    style="background: var(--pill-bg); color: var(--gold-soft); border: 1px solid var(--pill-border);">
                {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
              </span>
              <span class="font-display text-base sm:text-lg tracking-wide truncate"
                    style="color: var(--ink);">
                {{ $faq['q'] }}
              </span>
            </span>

            {{-- Chevron --}}
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="faq-chevron shrink-0 transition-transform duration-300"
                 style="color: var(--gold);">
              <polyline points="6 9 12 15 18 9"/>
            </svg>
          </summary>

          <div class="faq-body px-5 sm:px-6 pb-5 sm:pb-6">
            <div class="pt-1 pl-0 sm:pl-11 text-sm sm:text-[15px] leading-relaxed"
                 style="color: var(--ink-muted);">
              {{ $faq['a'] }}
            </div>
          </div>
        </details>
      @endforeach
    </div>

    {{-- Still have questions CTA --}}
    <div class="mt-12 text-center">
      <p class="text-sm mb-4" style="color: var(--ink-muted);">
        Still have questions?
      </p>
      <a href="mailto:intramurals@slsu.edu.ph"
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-white transition-all hover:scale-[1.02] active:scale-[0.98]"
         style="background: var(--gold);">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
          <polyline points="22,6 12,13 2,6"/>
        </svg>
        Email the committee
      </a>
    </div>

  </div>
</section>