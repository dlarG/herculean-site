<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements — Herculean Dragon</title>
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
        <div class="max-w-3xl mx-auto px-5 h-16 flex items-center justify-between">
            <a href="{{ route('coach.dashboard') }}" class="text-sm" style="color: var(--ink-muted);">&larr; Dashboard</a>
            <a href="{{ route('coach.announcements.create') }}" class="text-sm font-semibold rounded px-4 py-2" style="background: var(--gold); color: #000;">
                + New
            </a>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-5 py-10">
        @if (session('success'))
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #3f7a4a; background: rgba(63,122,74,0.12); color: #9fe0ab;">
                {{ session('success') }}
            </div>
        @endif

        <h1 class="display text-3xl mb-6" style="color: var(--gold);">ANNOUNCEMENTS</h1>

        @forelse ($announcements as $a)
            <div class="rounded-xl p-5 mb-4 flex gap-4" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                @if ($a->image_path)
                    <img src="{{ Storage::url($a->image_path) }}" class="w-20 h-20 rounded-lg object-cover shrink-0">
                @endif
                <div class="flex-1">
                    <p class="text-xs uppercase tracking-wide mb-1" style="color: var(--gold-soft);">
                        {{ $a->category->name ?? 'General' }} &middot; {{ $a->type }}
                    </p>
                    <p class="font-semibold">{{ $a->title }}</p>
                    <p class="text-sm mt-1 line-clamp-2" style="color: var(--ink-muted);">{{ $a->body }}</p>
                    <div class="flex gap-4 mt-3 text-xs">
                        <a href="{{ route('coach.announcements.edit', $a) }}" style="color: var(--gold);">Edit</a>
                        <form method="POST" action="{{ route('coach.announcements.destroy', $a) }}" onsubmit="return confirm('Delete this announcement?');">
                            @csrf @method('DELETE')
                            <button type="submit" style="color: #e07a7a;">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-sm" style="color: var(--ink-muted);">No announcements yet.</p>
        @endforelse
    </main>
</body>
</html>