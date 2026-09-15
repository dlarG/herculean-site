<footer style="border-top: 1px solid var(--border); background: var(--bg-panel);">
  <div class="max-w-6xl mx-auto px-5 py-14">

    {{-- Top grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-10 lg:gap-8">

      {{-- Brand + logos --}}
      <div class="lg:col-span-5">
        <div class="flex items-center gap-4 mb-5">
          {{-- SLSU logo --}}
          <img src="{{ asset('assets/slsu-crop.png') }}"
               alt="SLSU Sogod"
               class="h-14 w-auto object-contain">

          {{-- Divider --}}
          <span class="w-px h-10" style="background: var(--border);"></span>

          {{-- Intramurals logo --}}
          <img src="{{ asset('assets/HD_Logo_DARK_Horizontal.png') }}"
               alt="SLSU Intramurals"
               class="h-14 w-auto object-contain">
        </div>

        <p class="font-display text-lg tracking-wide mb-2" style="color: var(--gold);">
          HERCULEAN DRAGON
        </p>
        <p class="text-sm leading-relaxed max-w-sm" style="color: var(--ink-muted);">
          Official intramurals registration portal of SLSU Sogod. One team, one form, every victory — uniting the HTM and Information Technology departments under one banner.
        </p>

        {{-- Social / contact icons --}}
        <div class="flex items-center gap-2 mt-6">
          <a href="mailto:intramurals@slsu.edu.ph"
             class="flex items-center justify-center w-9 h-9 rounded-md transition-colors hover:text-[color:var(--gold)]"
             style="border: 1px solid var(--border); color: var(--ink-muted);"
             aria-label="Email">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
          </a>
          <a href="#"
             class="flex items-center justify-center w-9 h-9 rounded-md transition-colors hover:text-[color:var(--gold)]"
             style="border: 1px solid var(--border); color: var(--ink-muted);"
             aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
          </a>
          <a href="#"
             class="flex items-center justify-center w-9 h-9 rounded-md transition-colors hover:text-[color:var(--gold)]"
             style="border: 1px solid var(--border); color: var(--ink-muted);"
             aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
            </svg>
          </a>
        </div>
      </div>

      {{-- Explore --}}
      <div class="lg:col-span-3">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] mb-4" style="color: var(--gold-soft);">
          Explore
        </p>
        <ul class="space-y-3 text-sm">
          <li>
            <a href="#about" class="transition-colors hover:text-[color:var(--gold)]" style="color: var(--ink-muted);">
              About the event
            </a>
          </li>
          <li>
            <a href="#categories" class="transition-colors hover:text-[color:var(--gold)]" style="color: var(--ink-muted);">
              Sports &amp; categories
            </a>
          </li>
          <li>
            <a href="{{ route('register.create') }}" class="transition-colors hover:text-[color:var(--gold)]" style="color: var(--ink-muted);">
              Register now
            </a>
          </li>
          <li>
            <a href="#" class="transition-colors hover:text-[color:var(--gold)]" style="color: var(--ink-muted);">
              Schedule &amp; results
            </a>
          </li>
        </ul>
      </div>

      {{-- Contact --}}
      <div class="lg:col-span-4">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] mb-4" style="color: var(--gold-soft);">
          Get in touch
        </p>
        <ul class="space-y-3 text-sm" style="color: var(--ink-muted);">
          <li class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="mt-0.5 shrink-0" style="color: var(--gold);">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span>Southern Leyte State University – Sogod<br>San Roque, Sogod, Southern Leyte</span>
          </li>
          <li class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="mt-0.5 shrink-0" style="color: var(--gold);">
              <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
              <polyline points="22,6 12,13 2,6"/>
            </svg>
            <a href="mailto:intramurals@slsu.edu.ph" class="transition-colors hover:text-[color:var(--gold)]">
              intramurals@slsu.edu.ph
            </a>
          </li>
          <li class="flex items-start gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="mt-0.5 shrink-0" style="color: var(--gold);">
              <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>
            </svg>
            <span>(053) 123-4567</span>
          </li>
        </ul>
      </div>

    </div>

    {{-- Bottom bar --}}
    <div class="mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs"
         style="border-top: 1px solid var(--border); color: var(--ink-muted);">
      <p>© {{ date('Y') }} Herculean Dragon · SLSU Sogod Intramurals</p>
      <p>
        Built by
        <span style="color: var(--gold-soft);">HTM &amp; Information Technology Department</span>
      </p>
    </div>

  </div>
</footer>