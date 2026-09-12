<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Coach Dashboard — Herculean Dragon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --bg:#0D0D0C; --bg-panel:#191814; --gold:#F2B90C; --gold-soft:#C99A1E; --ink:#F4F1E8; --ink-muted:#B9B4A6; }
        body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
        .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }
    </style>
</head>
<body class="antialiased">
    <header class="border-b" style="border-color: rgba(242,185,12,0.14);">
        <div class="max-w-5xl mx-auto px-5 h-16 flex items-center justify-between">
            <span class="font-semibold">Coach {{ $coach->name }}</span>
            <nav class="flex items-center gap-5 text-sm" style="color: var(--ink-muted);">
                <a href="{{ route('coach.announcements.index') }}" class="hover:text-[color:var(--gold)]">Announcements</a>
                <a href="{{ route('coach.export') }}" class="hover:text-[color:var(--gold)]">Export PDF</a>
                <form method="POST" action="{{ route('coach.logout') }}">
                    @csrf
                    <button type="submit" class="hover:text-[color:var(--gold)]">Log out</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="max-w-5xl mx-auto px-5 py-10">
        @if (session('success'))
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #3f7a4a; background: rgba(63,122,74,0.12); color: #9fe0ab;">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="display text-3xl mb-1" style="color: var(--gold);">YOUR CATEGORIES</h1>
        <p class="text-sm mb-6" style="color: var(--ink-muted);">Events you're assigned to coach.</p>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            @forelse ($categories as $cat)
                <div class="rounded-xl p-5" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                    <p class="text-xs uppercase tracking-wide mb-1" style="color: var(--gold-soft);">{{ $cat->group }}</p>
                    <p class="font-semibold text-lg">{{ $cat->name }}</p>
                    <p class="text-sm mt-2" style="color: var(--ink-muted);">{{ $cat->entries_count }} {{ Str::plural('registration', $cat->entries_count) }}</p>
                </div>
            @empty
                <p class="text-sm" style="color: var(--ink-muted);">No categories assigned to you yet.</p>
            @endforelse
        </div>

        <div class="flex items-center justify-between mb-4">
            <h2 class="display text-2xl" style="color: var(--gold);">RECENT ANNOUNCEMENTS</h2>
            <a href="{{ route('coach.announcements.create') }}" class="text-sm font-semibold rounded px-4 py-2" style="background: var(--gold); color: #000;">
                + New announcement
            </a>
        </div>

        @forelse ($announcements->take(5) as $a)
            <div class="rounded-xl p-4 mb-3" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                <p class="text-xs uppercase tracking-wide" style="color: var(--gold-soft);">{{ $a->category->name ?? 'General' }}</p>
                <p class="font-semibold">{{ $a->title }}</p>
            </div>
        @empty
            <p class="text-sm" style="color: var(--ink-muted);">You haven't posted any announcements yet.</p>
        @endforelse
    </main>
</body>
</html>