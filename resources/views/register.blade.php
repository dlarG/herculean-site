<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register — Herculean Dragon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --bg: #0D0D0C;
            --bg-panel: #191814;
            --gold: #F2B90C;
            --gold-soft: #C99A1E;
            --ink: #F4F1E8;
            --ink-muted: #B9B4A6;
        }
        body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
        .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }
        .field {
            background: var(--bg-panel);
            border: 1px solid rgba(242, 185, 12, 0.2);
            color: var(--ink);
        }
        .field:focus {
            outline: none;
            border-color: var(--gold);
        }
    </style>
</head>
<body class="antialiased">

    <header class="p-2 border-b border-[rgba(242,185,12,0.14)]">
        <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('assets/navbar-logo.png') }}" 
                    alt="Herculean Dragon Logo" 
                    class="h-14 w-auto object-contain transition-opacity group-hover:opacity-90"
                    onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.logo-fallback').style.display='flex';">
            </a>
            <a href="{{ route('home') }}" class="text-sm text-[color:var(--ink-muted)] hover:text-[color:var(--gold)]">
                &larr; Back to home
            </a>
        </div>
    </header>

    <div class="max-w-2xl mx-auto px-5 py-12">
        <p class="text-sm uppercase tracking-[0.2em]" style="color: var(--gold-soft);">SLSU Sogod &middot; HTM &amp; IT Department</p>
        <h1 class="display text-4xl mt-3" style="color: var(--gold);">REGISTER</h1>
        <p class="mt-2 text-[color:var(--ink-muted)]">Pick a category and enter your details below.</p>

        @if (session('success'))
            <div class="mt-6 rounded border px-4 py-3 text-sm" style="border-color: #3f7a4a; background: rgba(63,122,74,0.12); color: #9fe0ab;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mt-6 rounded border px-4 py-3 text-sm" style="border-color: #a03b3b; background: rgba(160,59,59,0.12); color: #f2a5a5;">
                <p class="font-semibold mb-1">Please fix the following:</p>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.store') }}" id="regForm" class="space-y-6 mt-8">
            @csrf

            <div>
                <label class="block font-medium mb-1.5 text-sm" for="category_id">Category</label>
                <select name="category_id" id="category_id" required class="field w-full rounded px-3 py-2.5">
                    <option value="">Select a category…</option>
                    @foreach ($categories as $group => $items)
                        <optgroup label="{{ $group }}">
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}" @selected($preselectedId === $item->id)>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label class="font-medium text-sm">Members</label>
                    <span id="memberHint" class="text-sm text-[color:var(--ink-muted)]"></span>
                </div>
                <div id="membersContainer" class="space-y-4"></div>
                <button type="button" id="addMemberBtn"
                    class="mt-3 hidden text-sm font-medium rounded px-3 py-1.5 border"
                    style="border-color: var(--gold); color: var(--gold);">
                    + Add member
                </button>
            </div>

            <button type="submit"
                class="w-full font-semibold rounded px-4 py-3 text-black" style="background: var(--gold);">
                Submit registration
            </button>
        </form>
    </div>

    <template id="memberFieldTemplate">
        <div class="member-row rounded-lg p-4 relative" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
            <button type="button" class="removeMemberBtn hidden absolute top-3 right-3 text-[color:var(--ink-muted)] hover:text-[color:var(--gold)] text-sm">✕</button>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium mb-1">Full name</label>
                    <input type="text" class="member-full_name field w-full rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Student number</label>
                    <input type="text" class="member-student_number field w-full rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Gender</label>
                    <select class="member-gender field w-full rounded px-3 py-2" required>
                        <option value="">Select…</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Program</label>
                    <select class="member-program field w-full rounded px-3 py-2" required>
                        <option value="">Select…</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program }}">{{ $program }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Year level</label>
                    <select class="member-year_level field w-full rounded px-3 py-2" required>
                        <option value="">Select…</option>
                        <option value="1">1st Year</option>
                        <option value="2">2nd Year</option>
                        <option value="3">3rd Year</option>
                        <option value="4">4th Year</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Contact number</label>
                    <input type="text" class="member-contact_number field w-full rounded px-3 py-2">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" class="member-email field w-full rounded px-3 py-2">
                </div>
            </div>
        </div>
    </template>

    <script>
        const categories = @json($categories->flatten()->keyBy('id'));
        const preselectedId = @json($preselectedId);
        const membersContainer = document.getElementById('membersContainer');
        const addMemberBtn = document.getElementById('addMemberBtn');
        const memberHint = document.getElementById('memberHint');
        const categorySelect = document.getElementById('category_id');
        const template = document.getElementById('memberFieldTemplate');
        const form = document.getElementById('regForm');

        let currentMax = 1;

        function addMemberRow() {
            if (membersContainer.children.length >= currentMax) return;
            const clone = template.content.cloneNode(true);
            const row = clone.querySelector('.member-row');
            const removeBtn = row.querySelector('.removeMemberBtn');
            removeBtn.addEventListener('click', () => {
                row.remove();
                refreshRemoveButtons();
            });
            membersContainer.appendChild(clone);
            refreshRemoveButtons();
        }

        function refreshRemoveButtons() {
            const rows = membersContainer.querySelectorAll('.member-row');
            rows.forEach((row) => {
                const btn = row.querySelector('.removeMemberBtn');
                btn.classList.toggle('hidden', rows.length <= 1);
            });
            addMemberBtn.classList.toggle('hidden', rows.length >= currentMax);
        }

        function loadCategory(catId) {
            const cat = categories[catId];
            membersContainer.innerHTML = '';
            if (!cat) return;

            currentMax = cat.max_members;

            memberHint.textContent = cat.min_members === cat.max_members
                ? `Exactly ${cat.max_members} member(s)`
                : `${cat.min_members}–${cat.max_members} members`;

            addMemberRow();
        }

        categorySelect.addEventListener('change', () => loadCategory(categorySelect.value));
        addMemberBtn.addEventListener('click', addMemberRow);

        if (preselectedId) {
            loadCategory(preselectedId);
        }

        form.addEventListener('submit', () => {
            const rows = membersContainer.querySelectorAll('.member-row');
            rows.forEach((row, i) => {
                ['full_name', 'student_number', 'gender', 'program', 'year_level', 'contact_number', 'email'].forEach(field => {
                    const input = row.querySelector('.member-' + field);
                    const hidden = document.createElement('input');
                    hidden.type = 'hidden';
                    hidden.name = `members[${i}][${field}]`;
                    hidden.value = input.value;
                    form.appendChild(hidden);
                });
            });
        });
    </script>
</body>
</html>
