<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dashboard — Herculean Dragon</title>
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
            <span class="font-semibold">Hi, {{ $student->full_name }}</span>
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="text-sm" style="color: var(--ink-muted);">Log out</button>
            </form>
        </div>
    </header>

    <main class="max-w-3xl mx-auto px-5 py-10">
        <h1 class="display text-3xl mb-1" style="color: var(--gold);">ANNOUNCEMENTS</h1>
        <p class="text-sm mb-8" style="color: var(--ink-muted);">Updates from your coach for the events you're registered in.</p>

        @forelse ($announcements as $a)
            <div class="rounded-xl p-5 mb-4" style="background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.14);">
                <p class="text-xs uppercase tracking-wide mb-1" style="color: var(--gold-soft);">
                    {{ $a->category->name ?? 'General' }} &middot; {{ $a->created_at->diffForHumans() }}
                </p>
                <h2 class="font-semibold text-lg mb-2">{{ $a->title }}</h2>
                <p class="text-sm whitespace-pre-line" style="color: var(--ink-muted);">{{ $a->body }}</p>
                @if ($a->event_at)
                    <p class="text-xs mt-3" style="color: var(--gold);">
                        📅 {{ $a->event_at->format('M j, Y g:i A') }}
                        @if ($a->location) &middot; {{ $a->location }} @endif
                    </p>
                @endif
            </div>
        @empty
            <p class="text-sm" style="color: var(--ink-muted);">No announcements yet.</p>
        @endforelse
    </main>
</body>
</html>
