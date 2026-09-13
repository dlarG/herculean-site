<div id="detailsModal"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     role="dialog" aria-modal="true" aria-labelledby="detailsModalTitle">
  <div id="modalBackdrop"
       class="absolute inset-0 backdrop-blur-sm opacity-0 transition-opacity duration-200"
       style="background: var(--overlay);"></div>

  <div id="modalPanel"
       class="relative z-10 w-full max-w-3xl rounded-2xl overflow-hidden opacity-0 scale-95 transition-all duration-200 flex flex-col max-h-[90vh]"
       style="background: var(--bg-panel); border: 1px solid var(--border-strong);">

    {{-- ===== HEADER (fixed) ===== --}}
    <div class="px-6 pt-6 pb-4 flex items-start justify-between gap-4 shrink-0"
         style="border-bottom: 1px solid var(--border);">
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

    {{-- ===== SCROLLABLE BODY ===== --}}
    <div class="modal-body overflow-y-auto flex-1 px-6 py-5 space-y-5">
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
      <div id="modalImageWrapper" class="hidden rounded-xl overflow-hidden"
           style="border: 1px solid var(--border);">
        <img id="modalImage"
             src=""
             alt=""
             loading="lazy"
             class="w-full h-70 object-cover">
      </div>
      <div>
        <dt class="text-[10px] uppercase tracking-[0.15em] mb-1.5" style="color: var(--ink-muted);">About this category</dt>
        <dd id="modalDescription" class="text-sm leading-relaxed" style="color: var(--ink-muted);">—</dd>
      </div>

      <div class="rounded-lg p-3 text-xs" style="background: var(--bg-panel-soft); border: 1px solid var(--border); color: var(--ink-muted);">
        <p class="flex gap-2">
          <span id="modalNote">Bring your own gear. Arrive 30 minutes before your scheduled match.</span>
        </p>
      </div>

    </div>

    {{-- ===== FOOTER (fixed) ===== --}}
    <div class="px-6 pb-6 pt-4 flex flex-col sm:flex-row gap-3 shrink-0"
         style="border-top: 1px solid var(--border);">
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

<style>
  /* Custom slim scrollbar for the modal body */
  .modal-body::-webkit-scrollbar {
    width: 6px;
  }
  .modal-body::-webkit-scrollbar-track {
    background: transparent;
  }
  .modal-body::-webkit-scrollbar-thumb {
    background: var(--border-strong);
    border-radius: 3px;
  }
  .modal-body::-webkit-scrollbar-thumb:hover {
    background: var(--gold-soft);
  }

  /* Firefox */
  .modal-body {
    scrollbar-width: thin;
    scrollbar-color: var(--border-strong) transparent;
  }
</style>