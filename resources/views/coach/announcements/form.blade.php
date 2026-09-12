<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $announcement->exists ? 'Edit' : 'New' }} Announcement — Herculean Dragon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root { --bg:#0D0D0C; --bg-panel:#191814; --gold:#F2B90C; --gold-soft:#C99A1E; --ink:#F4F1E8; --ink-muted:#B9B4A6; }
        body { background: var(--bg); color: var(--ink); font-family: 'Inter', sans-serif; }
        .display { font-family: 'Anton', sans-serif; letter-spacing: 0.01em; }
        .field { background: var(--bg-panel); border: 1px solid rgba(242,185,12,0.25); color: var(--ink); }
        .field:focus { outline: none; border-color: var(--gold); }
    </style>
</head>
<body class="antialiased">
    <header class="border-b" style="border-color: rgba(242,185,12,0.14);">
        <div class="max-w-2xl mx-auto px-5 h-16 flex items-center">
            <a href="{{ route('coach.announcements.index') }}" class="text-sm" style="color: var(--ink-muted);">&larr; Announcements</a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-5 py-10">
        <h1 class="display text-3xl mb-6" style="color: var(--gold);">
            {{ $announcement->exists ? 'EDIT' : 'NEW' }} ANNOUNCEMENT
        </h1>

        @if ($errors->any())
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #a03b3b; background: rgba(160,59,59,0.12); color: #f2a5a5;">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ $announcement->exists ? route('coach.announcements.update', $announcement) : route('coach.announcements.store') }}"
              enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if ($announcement->exists) @method('PUT') @endif

            <div>
                <label class="block text-sm font-medium mb-1.5">Category</label>
                <select name="category_id" class="field w-full rounded px-3 py-2.5">
                    <option value="">General (all students)</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected($announcement->category_id === $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Type</label>
                <select name="type" class="field w-full rounded px-3 py-2.5">
                    <option value="announcement" @selected($announcement->type === 'announcement')>Announcement</option>
                    <option value="audition" @selected($announcement->type === 'audition')>Audition / Tryout</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Title</label>
                <input type="text" name="title" required class="field w-full rounded px-3 py-2.5" value="{{ old('title', $announcement->title) }}">
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Message</label>
                <textarea name="body" rows="5" required class="field w-full rounded px-3 py-2.5">{{ old('body', $announcement->body) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1.5">Date/time <span class="text-xs opacity-60">(optional)</span></label>
                    <input type="datetime-local" name="event_at" class="field w-full rounded px-3 py-2.5"
                           value="{{ old('event_at', optional($announcement->event_at)->format('Y-m-d\TH:i')) }}">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1.5">Location <span class="text-xs opacity-60">(optional)</span></label>
                    <input type="text" name="location" class="field w-full rounded px-3 py-2.5" value="{{ old('location', $announcement->location) }}">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1.5">Image <span class="text-xs opacity-60">(optional)</span></label>
                @if ($announcement->image_path)
                    <img src="{{ Storage::url($announcement->image_path) }}" class="w-32 h-32 rounded-lg object-cover mb-2">
                @endif
                <input type="file" name="image" accept="image/*" class="field w-full rounded px-3 py-2.5">
            </div>

            <button type="submit" class="w-full font-semibold rounded px-4 py-3 text-black" style="background: var(--gold);">
                {{ $announcement->exists ? 'Save changes' : 'Post announcement' }}
            </button>
        </form>
    </main>
</body>
</html>