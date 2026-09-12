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
          'q' => 'Who can join the Intramurals?',
          'a' => 'All currently enrolled SLSU Sogod students from the FHTM and FCIS departments are eligible to join. Every member listed in a registration must be an active student of the university.',
        ],
        [
          'q' => 'How do I register for an event?',
          'a' => 'Click the Register button on the homepage, choose your category (like Basketball or Sprint), pick a specific event if needed, then fill in the details of every member joining. You can register for as many categories as you want — one submission per category.',
        ],
        [
          'q' => 'Can I join more than one event?',
          'a' => 'Yes. There is no limit to how many categories you can register for. Just make sure event schedules don\'t overlap so you can attend all your matches.',
        ],
        [
          'q' => 'What is a "team event" vs an "individual event"?',
          'a' => 'Individual events (like Chess, 100m Sprint, or Pop Solo) only require one member. Team events (like Basketball, Volleyball, or Mass Dance) require a specific number of members — you\'ll see the required range shown on each category card.',
        ],
        [
          'q' => 'How many members can I add to a team?',
          'a' => 'Each sport has its own roster rules — for example, Basketball 5x5 allows up to 12 members, Beach Volleyball allows up to 4. The exact range is shown on every category card and in the registration form.',
        ],
        [
          'q' => 'What information do I need to prepare?',
          'a' => 'For each member: full name, student number, gender, program, year level, contact number, and their Facebook account link. The Facebook link is important — it\'s how your coach will contact you with schedule updates.',
        ],
        [
          'q' => 'Can I edit my registration after submitting?',
          'a' => 'No. Once you submit, your entry is final. Please double-check every detail — especially student numbers and spelling of names — before clicking Submit.',
        ],
        [
          'q' => 'How do I know if I\'ve been accepted?',
          'a' => 'After submitting, you\'ll see a confirmation message on screen. Your coach will then reach out through the Facebook account you provided with further instructions, so keep your Messenger and lines open.',
        ],
        [
          'q' => 'Who do I contact for questions?',
          'a' => 'Reach out to the intramurals committee at intramurals@slsu.edu.ph, or message your event coach directly. Coach assignments are listed on each category card.',
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
         class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold text-black transition-all hover:scale-[1.02] active:scale-[0.98]"
         style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
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