<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Register · Herculean Dragon</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --bg: #0D0D0C;
      --bg-panel: #191814;
      --bg-panel-soft: rgba(242, 185, 12, 0.04);
      --border: rgba(242, 185, 12, 0.14);
      --border-strong: rgba(242, 185, 12, 0.25);
      --gold: #F2B90C;
      --gold-soft: #C99A1E;
      --ink: #F4F1E8;
      --ink-muted: #B9B4A6;
      --pill-bg: rgba(242, 185, 12, 0.12);
      --pill-border: rgba(242, 185, 12, 0.25);
    }
    body {
      background: var(--bg);
      color: var(--ink);
      font-family: 'Inter', sans-serif;
    }
    .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }

    .field {
      background: var(--bg-panel);
      border: 1px solid var(--border-strong);
      color: var(--ink);
      transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }
    .field:focus {
      outline: none;
      border-color: var(--gold);
      box-shadow: 0 0 0 3px rgba(242, 185, 12, 0.12);
    }
    .field::placeholder { color: var(--ink-muted); opacity: 0.6; }

    select.field {
      appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12' fill='none'%3e%3cpath d='M3 4.5L6 7.5L9 4.5' stroke='%23C99A1E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 0.75rem center;
      padding-right: 2.25rem;
    }

    .pill {
      background: var(--pill-bg);
      color: var(--gold-soft);
      border: 1px solid var(--pill-border);
    }

    .member-row {
      background: var(--bg-panel);
      border: 1px solid var(--border);
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-4px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    /* Smooth reveal for the variant dropdown */
    #variantWrapper {
      animation: fadeIn 0.25s ease;
    }

    @media (max-width: 1023px) {
      .mobile-submit-bar {
        position: sticky;
        bottom: 0;
        background: linear-gradient(to top, var(--bg) 60%, transparent);
        padding-top: 1rem;
        padding-bottom: 1rem;
        margin-top: 1.5rem;
      }
    }
  </style>
</head>
<body class="antialiased">

  <!-- ===== HEADER ===== -->
  <header class="sticky top-0 z-30 backdrop-blur-sm"
          style="background: color-mix(in srgb, var(--bg) 92%, transparent); border-bottom: 1px solid var(--border);">
    <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
      <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
        <img src="{{ asset('assets/navbar-logo.png') }}"
             alt="Herculean Dragon Logo"
             class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90"
             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='inline-block';">
        <span class="hidden font-display text-lg" style="color: var(--gold);">HERCULEAN DRAGON</span>
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

  <!-- ===== MAIN ===== -->
  <main class="max-w-6xl mx-auto px-5 py-10 sm:py-14">

    <div class="mb-10">
      <p class="text-xs sm:text-sm uppercase tracking-[0.25em] font-semibold mb-3 flex items-center gap-3"
         style="color: var(--gold-soft);">
        <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
        SLSU Sogod · FHTM &amp; FCIS Department
      </p>
      <h1 class="font-display text-4xl sm:text-5xl leading-tight" style="color: var(--gold);">
        REGISTER
      </h1>
      <p class="mt-3 text-base max-w-xl" style="color: var(--ink-muted);">
        Pick a category, fill in your team's details, and submit. Your entry will be recorded instantly.
      </p>
    </div>

    @if (session('success'))
      <div class="mb-8 rounded-xl px-5 py-4 text-sm flex items-start gap-3"
           style="background: rgba(63,122,74,0.12); border: 1px solid #3f7a4a; color: #9fe0ab;">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5">
          <polyline points="20 6 9 17 4 12"/>
        </svg>
        <div>{{ session('success') }}</div>
      </div>
    @endif

    @if ($errors->any())
      <div class="mb-8 rounded-xl px-5 py-4 text-sm"
           style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
        <p class="font-semibold mb-2 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10"/>
            <line x1="12" y1="8" x2="12" y2="12"/>
            <line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          Please fix the following:
        </p>
        <ul class="list-disc list-inside space-y-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">

      <!-- ===== LEFT: FORM ===== -->
      <div class="lg:col-span-2">
        <form method="POST" action="{{ route('register.store') }}" id="regForm" class="space-y-8">
          @csrf

          <!-- ===== STEP 1: Category ===== -->
          <section>
            <div class="flex items-center gap-3 mb-4">
              <span class="flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold"
                    style="background: var(--gold); color: #000;">1</span>
              <h2 class="font-display text-xl tracking-wide" style="color: var(--ink);">Choose a category</h2>
            </div>

            <!-- Parent category -->
            <div>
              <label class="block text-sm font-medium mb-2" for="category_id" style="color: var(--ink-muted);">
                Which sport or art category are you registering for?
              </label>
              <select name="category_id" id="category_id" required class="field w-full rounded-lg px-4 py-3">
                <option value="">Select a category…</option>
                @foreach ($categories as $group => $items)
                  <optgroup label="{{ $group }}">
                    @foreach ($items as $item)
                      <option
                        value="{{ $item->id }}"
                        data-has-variants="{{ $item->has_variants ? '1' : '0' }}"
                        @selected($preselectedId === $item->id)>
                        {{ $item->name }}
                      </option>
                    @endforeach
                  </optgroup>
                @endforeach
              </select>
            </div>

            <!-- Variant dropdown (only shown when parent has variants) -->
            <div id="variantWrapper" class="hidden mt-4">
              <label class="block text-sm font-medium mb-2 flex items-center gap-2"
                     for="variant_id" style="color: var(--ink-muted);">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     style="color: var(--gold);">
                  <polyline points="9 18 15 12 9 6"/>
                </svg>
                Choose a specific event under <span id="variantParentName" style="color: var(--gold);"></span>
              </label>
              <select id="variant_id" class="field w-full rounded-lg px-4 py-3">
                <option value="">Select a variant…</option>
                {{-- Populated by JS --}}
              </select>
            </div>
          </section>

          <!-- ===== STEP 2: Members ===== -->
          <section>
            <div class="flex items-center justify-between gap-3 mb-4">
              <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold"
                      style="background: var(--gold); color: #000;">2</span>
                <h2 class="font-display text-xl tracking-wide" style="color: var(--ink);">Add your members</h2>
              </div>
              <span id="memberHint" class="text-xs font-medium pill px-3 py-1 rounded-full whitespace-nowrap"></span>
            </div>

            <!-- Empty state -->
            <div id="emptyState"
                class="rounded-xl p-8 text-center"
                style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
              <div class="flex justify-center mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    style="color: var(--gold-soft);">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="8.5" cy="7" r="4"/>
                  <line x1="20" y1="8" x2="20" y2="14"/>
                  <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
              </div>
              <p id="emptyStateTitle" class="text-sm font-medium mb-1" style="color: var(--ink);">No category selected yet</p>
              <p class="text-xs" style="color: var(--ink-muted);" id="emptyStateHint">
                Pick a category above and the member form will appear here.
              </p>
            </div>

            <div id="membersContainer" class="space-y-4 hidden"></div>

            <button type="button" id="addMemberBtn"
                    class="hidden mt-4 w-full text-sm font-medium rounded-lg px-4 py-3 border border-dashed transition-colors hover:bg-[color:var(--bg-panel-soft)]"
                    style="border-color: var(--border-strong); color: var(--gold);">
              + Add another member
            </button>
          </section>

          <!-- ===== STEP 3: Submit ===== -->
          <section class="hidden lg:block">
            <div class="flex items-center gap-3 mb-4">
              <span class="flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold"
                    style="background: var(--gold); color: #000;">3</span>
              <h2 class="font-display text-xl tracking-wide" style="color: var(--ink);">Submit your registration</h2>
            </div>
            <button type="submit"
                    class="w-full font-semibold rounded-lg px-6 py-4 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
                    style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
              Submit registration
            </button>
            <p class="mt-3 text-xs text-center" style="color: var(--ink-muted);">
              By submitting, you confirm that all details are correct.
            </p>
          </section>
        </form>
      </div>

      <!-- ===== RIGHT: HELP PANEL ===== -->
      <aside class="lg:col-span-1">
        <div class="lg:sticky lg:top-24 space-y-5">
          <div class="rounded-2xl p-6" style="background: var(--bg-panel); border: 1px solid var(--border);">
            <h3 class="font-display text-lg mb-4" style="color: var(--gold);">Before you register</h3>
            <ul class="space-y-3 text-sm" style="color: var(--ink-muted);">
              <li class="flex gap-3">
                <span style="color: var(--gold);">✓</span>
                <span>All members must be enrolled SLSU Sogod students.</span>
              </li>
              <li class="flex gap-3">
                <span style="color: var(--gold);">✓</span>
                <span>Double-check student numbers — no edits after submission.</span>
              </li>
              <li class="flex gap-3">
                <span style="color: var(--gold);">✓</span>
                <span>Facebook link is important because it helps coordinators reach you.</span>
              </li>
            </ul>
          </div>

          <div class="rounded-2xl p-6" style="background: var(--bg-panel); border: 1px solid var(--border);">
            <h3 class="font-display text-lg mb-3" style="color: var(--gold);">Need help?</h3>
            <p class="text-sm mb-4" style="color: var(--ink-muted);">
              Reach out to the intramurals committee if you have questions about eligibility or categories.
            </p>
            <a href="mailto:intramurals@slsu.edu.ph"
               class="inline-flex items-center gap-2 text-sm font-medium transition-colors hover:gap-3"
               style="color: var(--gold);">
              intramurals@slsu.edu.ph
              <span class="text-base leading-none">→</span>
            </a>
          </div>
        </div>
      </aside>

    </div>

    <!-- ===== MOBILE STICKY SUBMIT ===== -->
    <div class="lg:hidden mobile-submit-bar">
      <button type="submit" form="regForm"
              class="w-full font-semibold rounded-lg px-6 py-4 text-black text-base"
              style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
        Submit registration
      </button>
    </div>

  </main>

  <!-- ===== MEMBER FIELD TEMPLATE ===== -->
  <template id="memberFieldTemplate">
    <div class="member-row rounded-xl p-5 relative">
      <div class="flex items-center justify-between mb-4 pb-3" style="border-bottom: 1px solid var(--border);">
        <div class="flex items-center gap-2.5">
          <span class="member-number flex items-center justify-center w-6 h-6 rounded-full text-[11px] font-bold"
                style="background: var(--gold); color: #000;">1</span>
          <span class="text-sm font-semibold" style="color: var(--ink);">Member details</span>
        </div>
        <button type="button"
                class="removeMemberBtn hidden cursor-pointer text-xs transition-colors hover:text-[color:var(--gold)] px-2 py-1 rounded hover:bg-[color:var(--bg-panel-soft)]"
                style="color: var(--ink-muted);">
          ✕ Remove
        </button>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="sm:col-span-2">
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Full name</label>
          <input type="text" class="member-full_name field w-full rounded-lg px-3.5 py-2.5 text-sm" required>
        </div>

        <div>
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Student number</label>
          <input type="text" class="member-student_number field w-full rounded-lg px-3.5 py-2.5 text-sm" required>
        </div>

        <div>
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Gender</label>
          <select class="member-gender field w-full rounded-lg px-3.5 py-2.5 text-sm" required>
            <option value="">Select…</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>

        <div>
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Program</label>
          <select class="member-program field w-full rounded-lg px-3.5 py-2.5 text-sm" required>
            <option value="">Select…</option>
            @foreach ($programs as $program)
              <option value="{{ $program }}">{{ $program }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Year level</label>
          <select class="member-year_level field w-full rounded-lg px-3.5 py-2.5 text-sm" required>
            <option value="">Select…</option>
            <option value="1">1st Year</option>
            <option value="2">2nd Year</option>
            <option value="3">3rd Year</option>
            <option value="4">4th Year</option>
          </select>
        </div>

        <div class="sm:col-span-2">
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">Contact number</label>
          <input type="text" class="member-contact_number field w-full rounded-lg px-3.5 py-2.5 text-sm">
        </div>

        <div class="sm:col-span-2">
          <label class="block text-xs font-medium mb-1.5" style="color: var(--ink-muted);">
            Facebook account link <span class="text-[10px] opacity-60">(optional)</span>
          </label>
          <input type="text" class="member-email field w-full rounded-lg px-3.5 py-2.5 text-sm"
                 placeholder="https://facebook.com/yourprofile">
        </div>
      </div>
    </div>
  </template>

  <script>
    // ── Blade data ─────────────────────────────────────────────
    const categories          = @json($categories->flatten()->keyBy('id'));
    const variantsByParent    = @json($variantsByParent);
    const preselectedId       = @json($preselectedId);
    const allCategoriesById = @json($allCategoriesById);
    const preselectedVariantId = @json($preselectedVariantId);
    const emptyStateTitle  = document.getElementById('emptyStateTitle');
    // ── DOM refs ───────────────────────────────────────────────
    const membersContainer = document.getElementById('membersContainer');
    const addMemberBtn     = document.getElementById('addMemberBtn');
    const memberHint       = document.getElementById('memberHint');
    const categorySelect   = document.getElementById('category_id');
    const variantWrapper   = document.getElementById('variantWrapper');
    const variantSelect    = document.getElementById('variant_id');
    const variantParentName = document.getElementById('variantParentName');
    const emptyStateHint   = document.getElementById('emptyStateHint');
    const template         = document.getElementById('memberFieldTemplate');
    const form             = document.getElementById('regForm');
    const emptyState       = document.getElementById('emptyState');

    let currentMax = 1;
    let currentCategoryId = null;

    // ── Member rows ────────────────────────────────────────────
    function addMemberRow() {
      if (membersContainer.children.length >= currentMax) return;

      const clone = template.content.cloneNode(true);
      const row = clone.querySelector('.member-row');
      const removeBtn = row.querySelector('.removeMemberBtn');

      removeBtn.addEventListener('click', () => {
        row.remove();
        refreshRemoveButtons();
        renumberMembers();
      });

      membersContainer.appendChild(clone);
      refreshRemoveButtons();
      renumberMembers();
    }

    function renumberMembers() {
      const rows = membersContainer.querySelectorAll('.member-row');
      rows.forEach((row, i) => {
        const badge = row.querySelector('.member-number');
        if (badge) badge.textContent = i + 1;
      });
    }

    function refreshRemoveButtons() {
      const rows = membersContainer.querySelectorAll('.member-row');
      rows.forEach((row) => {
        const btn = row.querySelector('.removeMemberBtn');
        btn.classList.toggle('hidden', rows.length <= 1);
      });
      addMemberBtn.classList.toggle('hidden', rows.length >= currentMax);
    }

    // ── Variant handling ───────────────────────────────────────
    function getVariantsFor(parentId) {
      const list = variantsByParent[parentId];
      return Array.isArray(list) ? list : [];
    }

    function renderVariantDropdown(parentId) {
      const parentCat = categories[parentId];
      const variants = getVariantsFor(parentId);

      if (!parentCat || variants.length === 0) {
        variantWrapper.classList.add('hidden');
        variantSelect.innerHTML = '<option value="">Select a variant…</option>';
        return;
      }

      // Show the wrapper and label
      variantParentName.textContent = parentCat.name;
      variantWrapper.classList.remove('hidden');

      // Populate options
      variantSelect.innerHTML = '<option value="">Select a variant…</option>';
      variants.forEach((v) => {
        const opt = document.createElement('option');
        opt.value = v.id;
        opt.textContent = v.name;
        // Preselect if this variant was preselected
        if (preselectedVariantId && Number(v.id) === Number(preselectedVariantId)) {
          opt.selected = true;
        }
        variantSelect.appendChild(opt);
      });
    }

    // ── Category selection ─────────────────────────────────────
    function loadCategoryFromId(catId) {
      // catId is the FINAL category (variant if a variant is chosen, else parent)
      const cat = allCategoriesById[catId];
      currentCategoryId = catId;

      membersContainer.innerHTML = '';

      if (!cat) {
        emptyState.classList.remove('hidden');
        membersContainer.classList.add('hidden');
        addMemberBtn.classList.add('hidden');
        memberHint.textContent = '';
        return;
      }

      emptyState.classList.add('hidden');
      membersContainer.classList.remove('hidden');

      currentMax = cat.max_members || 1;

      memberHint.textContent = cat.min_members === cat.max_members
        ? `${cat.max_members} ${cat.max_members === 1 ? 'member' : 'members'}`
        : `${cat.min_members}–${cat.max_members} members`;

      addMemberRow();
    }

    function handleParentChange(parentId) {
      // Reset member form first
      membersContainer.innerHTML = '';
      emptyState.classList.remove('hidden');
      membersContainer.classList.add('hidden');
      addMemberBtn.classList.add('hidden');
      memberHint.textContent = '';

      if (!parentId) {
        variantWrapper.classList.add('hidden');
        variantSelect.innerHTML = '<option value="">Select a variant…</option>';
        emptyStateTitle.textContent = 'No category selected yet';
        emptyStateHint.textContent = 'Pick a category above and the member form will appear here.';
        return;
      }

      const parentCat = categories[parentId];
      const variants = getVariantsFor(parentId);

      if (parentCat && parentCat.has_variants && variants.length > 0) {
        // Parent with variants — show variant dropdown, wait for user to pick
        renderVariantDropdown(parentId);
        emptyStateTitle.textContent = 'Now choose a specific event';
        emptyStateHint.textContent = 'Pick from the "' + parentCat.name + '" dropdown above to continue.';
      } else {
        // Standalone category — no variants, load the member form directly
        variantWrapper.classList.add('hidden');
        variantSelect.innerHTML = '<option value="">Select a variant…</option>';
        emptyStateTitle.textContent = 'No category selected yet';
        emptyStateHint.textContent = 'Pick a category above and the member form will appear here.';
        loadCategoryFromId(parentId);
      }
    }

    function handleVariantChange(variantId) {
      if (!variantId) {
        // Variant cleared — hide member form
        membersContainer.innerHTML = '';
        emptyState.classList.remove('hidden');
        membersContainer.classList.add('hidden');
        addMemberBtn.classList.add('hidden');
        memberHint.textContent = '';
        emptyStateTitle.textContent = 'Now choose a specific event';
        emptyStateHint.textContent = 'Pick from the dropdown above to continue.';
        return;
      }

      // Load the variant's member form
      emptyState.classList.add('hidden');
      membersContainer.classList.remove('hidden');
      loadCategoryFromId(variantId);
    }

    // ── Event wiring ───────────────────────────────────────────
    categorySelect.addEventListener('change', () => {
      handleParentChange(categorySelect.value);
    });

    variantSelect.addEventListener('change', () => {
      handleVariantChange(variantSelect.value);
    });

    addMemberBtn.addEventListener('click', addMemberRow);

    // ── Preselection on load ───────────────────────────────────
    if (preselectedId) {
      categorySelect.value = String(preselectedId);
      handleParentChange(String(preselectedId));

      // If a variant was also preselected, apply it and load members
      if (preselectedVariantId) {
        variantSelect.value = String(preselectedVariantId);
        handleVariantChange(String(preselectedVariantId));
      }
    }

    // ── Submit — inject hidden member inputs ───────────────────
    form.addEventListener('submit', (e) => {
      // Ensure the correct category_id is submitted
      // If a variant is chosen, use the variant's ID
      const parentId = categorySelect.value;
      const variantId = variantSelect.value;
      const hasVariantDropdownVisible = !variantWrapper.classList.contains('hidden');

      if (hasVariantDropdownVisible && !variantId) {
        e.preventDefault();
        alert('Please choose a specific event from the dropdown.');
        return;
      }

      // Clear previous injected inputs
      form.querySelectorAll('input[data-member-input]').forEach(el => el.remove());

      const rows = membersContainer.querySelectorAll('.member-row');
      rows.forEach((row, i) => {
        ['full_name', 'student_number', 'gender', 'program', 'year_level', 'contact_number', 'email'].forEach(field => {
          const input = row.querySelector('.member-' + field);
          if (!input) return;
          const hidden = document.createElement('input');
          hidden.type = 'hidden';
          hidden.name = `members[${i}][${field}]`;
          hidden.value = input.value;
          hidden.setAttribute('data-member-input', 'true');
          form.appendChild(hidden);
        });
      });

      // Override category_id with the variant if one is selected
      if (hasVariantDropdownVisible && variantId) {
        // Remove any existing category_id input (there may be one from the select)
        form.querySelectorAll('input[name="category_id"]').forEach(el => el.remove());

        const hiddenCat = document.createElement('input');
        hiddenCat.type = 'hidden';
        hiddenCat.name = 'category_id';
        hiddenCat.value = variantId;
        form.appendChild(hiddenCat);
      }
    });
  </script>
</body>
</html>