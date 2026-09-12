<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login — Herculean Dragon</title>
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
<body class="antialiased flex items-center justify-center min-h-screen px-5">
    <div class="w-full max-w-sm">
        <p class="text-sm uppercase tracking-[0.2em] text-center mb-2" style="color: var(--gold-soft);">Herculean Dragon</p>
        <h1 class="display text-3xl text-center mb-8" style="color: var(--gold);">STUDENT LOGIN</h1>

        @if ($errors->any())
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #a03b3b; background: rgba(160,59,59,0.12); color: #f2a5a5;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('student.login.attempt') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5">Student number</label>
                <input type="text" name="student_number" required autofocus class="field w-full rounded px-3 py-2.5" value="{{ old('student_number') }}">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5">Password</label>
                <input type="password" name="password" required class="field w-full rounded px-3 py-2.5">
                <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
                    First time logging in? Your password is your student number.
                </p>
            </div>
            <button type="submit" class="w-full font-semibold rounded px-4 py-2.5 text-black" style="background: var(--gold);">
                Log in
            </button>
        </form>
    </div>
</body>
</html>
