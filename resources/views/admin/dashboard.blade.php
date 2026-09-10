<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin — Herculean Dragon</title>
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
        .field:focus { outline: none; border-color: var(--gold); }
        .pill {
            background: rgba(242,185,12,0.12);
            color: var(--gold-soft);
            border: 1px solid rgba(242,185,12,0.25);
        }
    </style>
</head>
<body class="antialiased">

    <header class="border-b border-[rgba(242,185,12,0.14)]">
        <div class="max-w-6xl mx-auto px-5 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <span class="w-8 h-8 rounded-full border-2 flex items-center justify-center text-sm font-bold display"
                      style="border-color: var(--gold); color: var(--gold);">HD</span>
                <span class="font-semibold tracking-wide text-[15px]">Admin &middot; Entries</span>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-[color:var(--ink-muted)] hover:text-[color:var(--gold)]">
                    Log out
                </button>
            </form>
        </div>
    </header>

    <div class="max-w-6xl mx-auto px-5 py-10">
        <p class="text-sm uppercase tracking-[0.2em]" style="color: var(--gold-soft);">SLSU Sogod &middot; HTM &amp; IT Department</p>
        <h1 class="display text-4xl mt-3" style="color: var(--gold);">REGISTERED ENTRIES</h1>
        <p class="mt-2 text-[color:var(--ink-muted)]">
            {{ $entries->total() }} {{ Str::plural('entry', $entries->total()) }} found.
        </p>

        <form method="GET" class="mt-8 grid grid-cols-1 sm:grid-cols-4 gap-3">
            <div>
                <label class="block text-sm font-medium mb-1.5">Group</label>
                <select name="group" class="field w-full rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All groups</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group }}" @selected(request('group') === $group)>{{ $group }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Category</label>
                <select name="category_id" class="field w-full rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected((string) request('category_id') === (string) $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Gender</label>
                <select name="gender" class="field w-full rounded px-3 py-2" onchange="this.form.submit()">
                    <option value="">All</option>
                    <option value="Male" @selected(request('gender') === 'Male')>Male</option>
                    <option value="Female" @selected(request('gender') === 'Female')>Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Search</label>
                <div class="flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Name or student no."
                        class="field w-full rounded px-3 py-2">
                    <button type="submit" class="rounded px-3 py-2 text-sm font-medium text-black" style="background: var(--gold);">
                        Go
                    </button>
                </div>
            </div>
        </form>

        @if (request()->anyFilled(['group', 'category_id', 'gender', 'search']))
            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="text-sm underline" style="color: var(--gold-soft);">
                    Clear filters
                </a>
            </div>
        @endif

        <div class="mt-8 space-y-4">
            @forelse ($entries as $entry)
                <div class="rounded-lg p-5" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                        <div>
                            <span class="pill text-xs font-medium rounded-full px-2.5 py-1">{{ $entry->category->group }}</span>
                            <span class="font-semibold ml-2">{{ $entry->category->name }}</span>
                            @if ($entry->team_name)
                                <span class="text-[color:var(--ink-muted)]"> &middot; {{ $entry->team_name }}</span>
                            @endif
                        </div>
                        <span class="text-xs text-[color:var(--ink-muted)]">
                            Entry #{{ $entry->id }} &middot; {{ $entry->created_at->format('M d, Y g:i A') }}
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="text-left text-[color:var(--ink-muted)] border-b border-[rgba(242,185,12,0.14)]">
                                    <th class="py-1.5 pr-4">Name</th>
                                    <th class="py-1.5 pr-4">Student No.</th>
                                    <th class="py-1.5 pr-4">Gender</th>
                                    <th class="py-1.5 pr-4">Program</th>
                                    <th class="py-1.5 pr-4">Year</th>
                                    <th class="py-1.5 pr-4">Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($entry->members as $member)
                                    <tr class="border-b border-[rgba(242,185,12,0.06)] last:border-0">
                                        <td class="py-1.5 pr-4">{{ $member->full_name }}</td>
                                        <td class="py-1.5 pr-4">{{ $member->student_number }}</td>
                                        <td class="py-1.5 pr-4">{{ $member->gender }}</td>
                                        <td class="py-1.5 pr-4">{{ $member->program }}</td>
                                        <td class="py-1.5 pr-4">{{ $member->year_level }}</td>
                                        <td class="py-1.5 pr-4">{{ $member->contact_number ?: '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 text-[color:var(--ink-muted)]">
                    No entries match these filters.
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $entries->links() }}
        </div>
    </div>

</body>
</html>