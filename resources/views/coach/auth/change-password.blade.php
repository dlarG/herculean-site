<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password — Herculean Dragon</title>
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
        <h1 class="display text-3xl text-center mb-2" style="color: var(--gold);">SET A NEW PASSWORD</h1>
        <p class="text-sm text-center mb-8" style="color: var(--ink-muted);">This is your first login — please set a password only you know.</p>

        @if ($errors->any())
            <div class="mb-6 rounded border px-4 py-3 text-sm" style="border-color: #a03b3b; background: rgba(160,59,59,0.12); color: #f2a5a5;">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('coach.password.change') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1.5">Current password</label>
                <input type="password" name="current_password" required class="field w-full rounded px-3 py-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5">New password</label>
                <input type="password" name="password" required class="field w-full rounded px-3 py-2.5">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1.5">Confirm new password</label>
                <input type="password" name="password_confirmation" required class="field w-full rounded px-3 py-2.5">
            </div>
            <button type="submit" class="w-full font-semibold rounded px-4 py-2.5 text-black" style="background: var(--gold);">
                Update password
            </button>
        </form>
    </div>
</body>
</html>