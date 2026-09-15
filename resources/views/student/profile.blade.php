@extends('student.layouts.app')

@section('title', 'My Profile')
@section('page-title', 'MY PROFILE')

@section('content')

  <div class="mb-8">
    <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2 flex items-center gap-3"
       style="color: var(--gold-soft);">
      <span class="inline-block w-8 h-px" style="background: var(--gold-soft);"></span>
      Account Settings
    </p>
    <h1 class="font-display text-3xl sm:text-4xl leading-tight" style="color: var(--gold);">
      MY PROFILE
    </h1>
    <p class="mt-2 text-sm max-w-xl" style="color: var(--ink-muted);">
      Keep your information up to date — this is what your coach sees when you register for events.
    </p>
  </div>

  @if ($errors->any())
    <div class="mb-6 rounded-lg px-4 py-3 text-sm"
         style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
      <p class="font-semibold mb-1.5">Please fix the following:</p>
      <ul class="list-disc list-inside space-y-0.5 text-xs">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="grid lg:grid-cols-3 gap-6">

    {{-- LEFT: Form --}}
    <div class="lg:col-span-2">
      <form method="POST" action="{{ route('student.profile.update') }}"
            class="rounded-2xl p-6 space-y-5"
            style="background: var(--bg-panel); border: 1px solid var(--border);">
        @csrf

        {{-- Student number (readonly) --}}
        <div>
          <label class="block text-xs uppercase tracking-wider font-medium mb-2"
                 style="color: var(--ink-muted);">
            Student Number
          </label>
          <input type="text" value="{{ $student->student_number }}" readonly
                 class="field w-full rounded-lg px-3.5 py-3 text-sm font-mono opacity-70 cursor-not-allowed">
          <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
            Your student number can't be changed. Contact the committee if it's wrong.
          </p>
        </div>

        {{-- Full name --}}
        <div>
          <label for="full_name" class="block text-xs uppercase tracking-wider font-medium mb-2"
                 style="color: var(--ink-muted);">
            Full Name
          </label>
          <input type="text" name="full_name" id="full_name" required
                 value="{{ old('full_name', $student->full_name) }}"
                 class="field w-full rounded-lg px-3.5 py-3 text-sm">
        </div>

        {{-- Program + Year --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label for="program" class="block text-xs uppercase tracking-wider font-medium mb-2"
                   style="color: var(--ink-muted);">
              Program
            </label>
            <select name="program" id="program" required class="field w-full rounded-lg px-3.5 py-3 text-sm">
              <option value="">Select…</option>
              @foreach (\App\Http\Controllers\RegistrationController::PROGRAMS as $program)
                <option value="{{ $program }}" @selected(old('program', $student->program) === $program)>
                  {{ $program }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label for="year_level" class="block text-xs uppercase tracking-wider font-medium mb-2"
                   style="color: var(--ink-muted);">
              Year Level
            </label>
            <select name="year_level" id="year_level" required class="field w-full rounded-lg px-3.5 py-3 text-sm">
              <option value="">Select…</option>
              @foreach (['1' => '1st Year', '2' => '2nd Year', '3' => '3rd Year', '4' => '4th Year'] as $val => $label)
                <option value="{{ $val }}" @selected((string) old('year_level', $student->year_level) === $val)>
                  {{ $label }}
                </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Gender --}}
        <div>
          <label for="gender" class="block text-xs uppercase tracking-wider font-medium mb-2"
                 style="color: var(--ink-muted);">
            Gender
          </label>
          <select name="gender" id="gender" required class="field w-full rounded-lg px-3.5 py-3 text-sm">
            <option value="">Select…</option>
            <option value="Male" @selected(old('gender', $student->gender) === 'Male')>Male</option>
            <option value="Female" @selected(old('gender', $student->gender) === 'Female')>Female</option>
          </select>
        </div>

        {{-- Contact --}}
        <div>
          <label for="contact_number" class="block text-xs uppercase tracking-wider font-medium mb-2"
                 style="color: var(--ink-muted);">
            Contact Number
          </label>
          <input type="text" name="contact_number" id="contact_number"
                 value="{{ old('contact_number', $student->contact_number) }}"
                 placeholder="e.g. 0917 123 4567"
                 class="field w-full rounded-lg px-3.5 py-3 text-sm">
        </div>

        {{-- Facebook --}}
        <div>
          <label for="facebook_link" class="block text-xs uppercase tracking-wider font-medium mb-2"
                 style="color: var(--ink-muted);">
            Facebook Link
          </label>
          <input type="text" name="facebook_link" id="facebook_link"
                 value="{{ old('facebook_link', $student->facebook_link) }}"
                 placeholder="https://facebook.com/yourprofile"
                 class="field w-full rounded-lg px-3.5 py-3 text-sm">
          <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
            Used by your coach to reach you for schedules and updates.
          </p>
        </div>

        <button type="submit"
                class="w-full font-semibold rounded-lg px-4 py-3 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
                style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
          Save changes
        </button>
      </form>
    </div>

    {{-- RIGHT: Summary --}}
    <aside class="lg:col-span-1 space-y-4">
      <div class="rounded-2xl p-6 text-center"
           style="background: var(--bg-panel); border: 1px solid var(--border);">
        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 font-display text-3xl"
             style="background: var(--gold); color: #000;">
          {{ strtoupper(substr($student->full_name, 0, 1)) }}
        </div>
        <p class="font-semibold text-base leading-tight mb-1">{{ $student->full_name }}</p>
        <p class="font-mono text-xs" style="color: var(--ink-muted);">{{ $student->student_number }}</p>

        <div class="mt-5 pt-5 space-y-2 text-left text-xs"
             style="border-top: 1px solid var(--border);">
          <div class="flex justify-between">
            <span style="color: var(--ink-muted);">Program</span>
            <span class="font-medium text-right">{{ $student->program ?: '—' }}</span>
          </div>
          <div class="flex justify-between">
            <span style="color: var(--ink-muted);">Year</span>
            <span class="font-medium">
              {{ $student->year_level ? $student->year_level . ['st','nd','rd','th'][min((int)$student->year_level, 4) - 1] . ' Year' : '—' }}
            </span>
          </div>
          <div class="flex justify-between">
            <span style="color: var(--ink-muted);">Gender</span>
            <span class="font-medium">{{ $student->gender ?: '—' }}</span>
          </div>
        </div>
      </div>

      <div class="rounded-2xl p-5" style="background: var(--bg-panel-soft); border: 1px solid var(--border);">
        <p class="text-xs uppercase tracking-wider font-semibold mb-2" style="color: var(--gold-soft);">
          Why fill this in?
        </p>
        <p class="text-xs leading-relaxed" style="color: var(--ink-muted);">
          When you register for events, this info is auto-filled. Keeping it accurate means you
          register faster and your coach can reach you when needed.
        </p>
      </div>
    </aside>

  </div>
@endsection