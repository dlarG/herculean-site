<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin — Herculean Dragon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12' fill='none'%3e%3cpath d='M3 4.5L6 7.5L9 4.5' stroke='%23C99A1E' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            padding-right: 2.25rem;
        }
        .field:focus { outline: none; border-color: var(--gold); box-shadow: 0 0 0 3px rgba(242,185,12,0.12); }
        input.field { background-image: none; padding-right: 0.75rem; }
        .pill {
            background: rgba(242,185,12,0.12);
            color: var(--gold-soft);
            border: 1px solid rgba(242,185,12,0.25);
        }

        /* Flash message entrance */
        @keyframes flashIn {
            from { opacity: 0; transform: translateY(-6px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .flash-in { animation: flashIn 0.35s ease-out; }

        /* Row hover accent */
        .entry-row { transition: background-color 0.15s ease; }
        .entry-row:hover { background-color: rgba(242,185,12,0.04); }

        /* Delete button reveal */
        .delete-btn { transition: color 0.15s ease, background-color 0.15s ease, transform 0.1s ease; }
        .delete-btn:hover { transform: scale(1.08); }
        .delete-btn:active { transform: scale(0.94); }

        /* Email copy button reveal */
        .copy-btn { opacity: 0; transition: opacity 0.15s ease; }
        .email-cell:hover .copy-btn { opacity: 1; }
    </style>
</head>
<body class="antialiased">

    <!-- ===== HEADER ===== -->
    <header class="sticky top-0 z-40 bg-dragon-bg/95 backdrop-blur-sm border-b border-dragon-gold/15">
        <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between gap-4">
            <!-- Logo + admin badge -->
            <div class="flex items-center gap-4 min-w-0">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                    <img src="{{ asset('assets/navbar-logo.png') }}"
                        alt="Herculean Dragon Logo"
                        class="h-12 w-auto object-contain transition-opacity group-hover:opacity-90"
                        onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.logo-fallback').style.display='flex';">
                    <span class="logo-fallback hidden font-display text-dragon-gold text-xl tracking-wide">HERCULEAN DRAGON</span>
                </a>
                <span class="hidden sm:inline-flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-[0.15em] px-2.5 py-1 rounded-full"
                      style="background: rgba(242,185,12,0.1); color: var(--gold-soft); border: 1px solid rgba(242,185,12,0.25);">
                    <span class="w-1.5 h-1.5 rounded-full" style="background: var(--gold);"></span>
                    Admin
                </span>
            </div>

            <!-- Logout button (enhanced) -->
            <form method="POST" action="{{ route('logout') }}" class="shrink-0">
                @csrf
                <button type="submit"
                        class="group cursor-pointer inline-flex items-center gap-2 text-sm font-medium px-3.5 py-2 rounded-md border transition-all
                               text-[color:var(--ink-muted)] border-[rgba(242,185,12,0.2)] hover:text-[color:var(--gold)] hover:border-[color:var(--gold)] hover:bg-[rgba(242,185,12,0.06)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="transition-transform group-hover:translate-x-0.5">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span class="hidden sm:inline">Log out</span>
                </button>
            </form>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-5 py-10">

        <!-- ===== PAGE TITLE ===== -->
        <div class="flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="text-sm uppercase tracking-[0.2em]" style="color: var(--gold-soft);">
                    SLSU Sogod · HTM &amp; IT Department
                </p>
                <h1 class="display text-3xl sm:text-4xl mt-3" style="color: var(--gold);">REGISTERED ENTRIES</h1>
                <p class="mt-2 text-sm text-[color:var(--ink-muted)]">
                    {{ $entries->total() }} {{ Str::plural('entry', $entries->total()) }} found across
                    {{ $entries->groupBy(fn($e) => $e->category_id)->count() }} {{ Str::plural('category', $entries->groupBy(fn($e) => $e->category_id)->count()) }}.
                </p>
            </div>
        </div>

        <!-- ===== FLASH MESSAGE ===== -->
        @if (session('success'))
            <div class="flash-in mt-6 rounded-lg px-4 py-3 text-sm flex items-center gap-3"
                 style="background: rgba(63,122,74,0.12); border: 1px solid #3f7a4a; color: #9fe0ab;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="shrink-0">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- ===== FILTERS ===== -->
        <form method="GET" class="mt-8 rounded-xl p-4 sm:p-5" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                <div>
                    <label class="block text-xs font-medium mb-1.5 text-[color:var(--ink-muted)] uppercase tracking-wider">Group</label>
                    <select name="group" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
                        <option value="">All groups</option>
                        @foreach ($groups as $group)
                            <option value="{{ $group }}" @selected(request('group') === $group)>{{ $group }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium mb-1.5 text-[color:var(--ink-muted)] uppercase tracking-wider">Category</label>
                    <select name="category_id" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
                        <option value="">All categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium mb-1.5 text-[color:var(--ink-muted)] uppercase tracking-wider">Gender</label>
                    <select name="gender" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
                        <option value="">All</option>
                        <option value="Male" @selected(request('gender') === 'Male')>Male</option>
                        <option value="Female" @selected(request('gender') === 'Female')>Female</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium mb-1.5 text-[color:var(--ink-muted)] uppercase tracking-wider">Program</label>
                    <select name="program" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
                        <option value="">All programs</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program }}" @selected(request('program') === $program)>{{ $program }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium mb-1.5 text-[color:var(--ink-muted)] uppercase tracking-wider">Search</label>
                    <div class="flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Name or student no."
                            class="field w-full rounded px-3 py-2 text-sm">
                        <button type="submit" class="cursor-pointer rounded px-3 py-2 text-sm font-semibold text-black shrink-0 transition-colors hover:brightness-110" style="background: var(--gold);">
                            Go
                        </button>
                    </div>
                </div>
            </div>

            @if (request()->anyFilled(['group', 'category_id', 'gender', 'program', 'search']))
                <div class="mt-4 pt-4 border-t border-[rgba(242,185,12,0.1)] flex items-center justify-between">
                    <p class="text-xs text-[color:var(--ink-muted)] flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full" style="background: var(--gold);"></span>
                        Filters active
                    </p>
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-medium underline" style="color: var(--gold-soft);">
                        Clear all filters
                    </a>
                </div>
            @endif
        </form>

        <!-- ===== ENTRIES GROUPED BY CATEGORY ===== -->
        @php
            $grouped = $entries->getCollection()->groupBy(fn ($e) => $e->category->group . '|' . $e->category->id);
        @endphp

        <div class="mt-8 space-y-12">
            @forelse ($grouped as $key => $categoryEntries)
                @php
                    [$groupName, $categoryId] = explode('|', $key);
                    $category = $categoryEntries->first()->category;
                @endphp

                <section>
                    <!-- ===== CATEGORY HEADER ===== -->
                    <div class="flex items-center gap-4 mb-5">
                        <div class="flex flex-wrap items-center gap-3 min-w-0">
                            <span class="pill text-xs font-medium rounded-full px-3 py-1 whitespace-nowrap">{{ $groupName }}</span>
                            <h2 class="display text-xl sm:text-2xl text-[color:var(--gold)] truncate">{{ $category->name }}</h2>
                        </div>
                        <span class="h-px flex-1 bg-[rgba(242,185,12,0.18)]"></span>
                        <span class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider whitespace-nowrap">
                            {{ $categoryEntries->count() }} {{ Str::plural('entry', $categoryEntries->count()) }}
                        </span>
                    </div>

                    <!-- ===== ENTRIES TABLE (desktop) ===== -->
                    <div class="hidden sm:block rounded-xl overflow-hidden" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-xs uppercase tracking-wider text-[color:var(--ink-muted)] border-b border-[rgba(242,185,12,0.14)]">
                                    <th class="py-3 px-5 font-medium">Name</th>
                                    <th class="py-3 px-4 font-medium">Stud Id</th>
                                    <th class="py-3 px-4 font-medium">Gender</th>
                                    <th class="py-3 px-4 font-medium">Program</th>
                                    <th class="py-3 px-4 font-medium">Year</th>
                                    <th class="py-3 px-4 font-medium">Contact</th>
                                    <th class="py-3 px-4 font-medium">Facebook</th>
                                    <th class="py-3 px-4 font-medium text-right w-px">Entry</th>
                                    <th class="py-3 px-4 font-medium text-right w-px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categoryEntries as $entry)
                                    @foreach ($entry->members as $memberIndex => $member)
                                        @php $isFirst = $memberIndex === 0; $isLast = $memberIndex === $entry->members->count() - 1; @endphp
                                        <tr class="entry-row border-b border-[rgba(242,185,12,0.06)] {{ $isLast ? 'border-b-2 border-[rgba(242,185,12,0.18)]' : '' }}">
                                            <td class="py-2.5 px-5 font-medium">
                                                <div class="flex items-center gap-2">
                                                    @if (!$isFirst)
                                                        <span class="text-[color:var(--ink-muted)]/40 text-xs" aria-hidden="true">↳</span>
                                                    @endif
                                                    {{ $member->full_name }}
                                                </div>
                                            </td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)] font-mono text-xs">{{ $member->student_number }}</td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)]">{{ $member->gender }}</td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)]">{{ $member->program }}</td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)]">{{ $member->year_level }}</td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)]">{{ $member->contact_number ?: '—' }}</td>
                                            <td class="py-2.5 px-4 text-[color:var(--ink-muted)] email-cell">
                                                @if ($member->email)
                                                    <div class="flex items-center gap-2">
                                                        <a href="mailto:{{ $member->email }}" class="hover:text-[color:var(--gold)] transition-colors break-all">
                                                            {{ $member->email }}
                                                        </a>
                                                        <button type="button"
                                                                onclick="navigator.clipboard.writeText('{{ $member->email }}'); this.textContent='✓'; setTimeout(()=>this.textContent='⧉', 1200);"
                                                                class="copy-btn text-[10px] text-[color:var(--ink-muted)] hover:text-[color:var(--gold)] cursor-pointer shrink-0"
                                                                title="Copy email">
                                                            ⧉
                                                        </button>
                                                    </div>
                                                @else
                                                    —
                                                @endif
                                            </td>

                                            <td class="py-2.5 px-4 text-right w-px">
                                                @if ($isFirst)
                                                    <span class="text-[10px] font-mono text-[color:var(--ink-muted)] bg-[rgba(242,185,12,0.08)] border border-[rgba(242,185,12,0.18)] rounded px-1.5 py-0.5 whitespace-nowrap">
                                                        #{{ $entry->id }}
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="py-2.5 px-4 text-right w-px">
                                                @if ($isFirst)
                                                    <form method="POST"
                                                        action="{{ route('admin.entries.destroy', $entry) }}"
                                                        onsubmit="return confirm('Delete Entry #{{ $entry->id }} ({{ $entry->category->name }})? This cannot be undone.');"
                                                        class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="delete-btn cursor-pointer text-[color:var(--ink-muted)] hover:text-red-400 p-1.5 rounded hover:bg-red-500/10"
                                                                title="Delete entry">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- ===== ENTRIES CARDS (mobile) ===== -->
                    <div class="sm:hidden space-y-3">
                        @foreach ($categoryEntries as $entry)
                            <div class="rounded-xl overflow-hidden" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                                <div class="px-4 py-2.5 border-b border-[rgba(242,185,12,0.1)] flex items-center justify-between gap-2 text-xs text-[color:var(--ink-muted)]">
                                    <span class="font-mono">Entry #{{ $entry->id }}</span>
                                    <div class="flex items-center gap-2">
                                        <span>{{ $entry->created_at->format('M d, Y g:i A') }}</span>
                                        <form method="POST"
                                            action="{{ route('admin.entries.destroy', $entry) }}"
                                            onsubmit="return confirm('Delete Entry #{{ $entry->id }} ({{ $entry->category->name }})? This cannot be undone.');"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="delete-btn cursor-pointer text-[color:var(--ink-muted)] hover:text-red-400 p-1.5 rounded hover:bg-red-500/10"
                                                    title="Delete entry">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M3 6h18M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m3 0v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="divide-y divide-[rgba(242,185,12,0.08)]">
                                    @foreach ($entry->members as $i => $member)
                                        <div class="p-4 space-y-3">
                                            <div class="flex items-start justify-between gap-3">
                                                <div class="min-w-0">
                                                    <p class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider mb-1">
                                                        Member {{ $i + 1 }} of {{ $entry->members->count() }}
                                                    </p>
                                                    <p class="font-semibold text-[15px] truncate">{{ $member->full_name }}</p>
                                                    <p class="text-xs text-[color:var(--ink-muted)] font-mono mt-0.5">{{ $member->student_number }}</p>
                                                </div>
                                                <span class="pill text-xs font-medium rounded-full px-2.5 py-1 shrink-0">{{ $member->gender }}</span>
                                            </div>

                                            <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                                                <div>
                                                    <dt class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider">Program</dt>
                                                    <dd class="mt-0.5">{{ $member->program }}</dd>
                                                </div>
                                                <div>
                                                    <dt class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider">Year</dt>
                                                    <dd class="mt-0.5">{{ $member->year_level }}</dd>
                                                </div>
                                                <div class="col-span-2">
                                                    <dt class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider">Contact</dt>
                                                    <dd class="mt-0.5">{{ $member->contact_number ?: '—' }}</dd>
                                                </div>
                                                <div class="col-span-2">
                                                    <dt class="text-xs text-[color:var(--ink-muted)] uppercase tracking-wider">Facebook</dt>
                                                    <dd class="mt-0.5 break-all">
                                                        @if ($member->email)
                                                            <a href="mailto:{{ $member->email }}" class="text-[color:var(--gold-soft)] hover:text-[color:var(--gold)] transition-colors">
                                                                {{ $member->email }}
                                                            </a>
                                                        @else
                                                            —
                                                        @endif
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="text-center py-20 rounded-xl" style="background: var(--bg-panel); border: 1px dashed rgba(242,185,12,0.2);">
                    <p class="display text-2xl mb-2" style="color: var(--gold-soft);">NO ENTRIES</p>
                    <p class="text-sm text-[color:var(--ink-muted)]">
                        @if (request()->anyFilled(['group', 'category_id', 'gender', 'program', 'search']))
                            No entries match these filters.
                        @else
                            No registrations have been submitted yet.
                        @endif
                    </p>
                    @if (request()->anyFilled(['group', 'category_id', 'gender', 'program', 'search']))
                        <a href="{{ route('admin.dashboard') }}" class="mt-4 inline-block text-sm underline" style="color: var(--gold-soft);">
                            Clear filters
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- ===== PAGINATION ===== -->
        @if ($entries->hasPages())
            <div class="mt-8">
                {{ $entries->links() }}
            </div>
        @endif
    </div>

</body>
</html>