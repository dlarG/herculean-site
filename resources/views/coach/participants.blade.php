@extends('coach.layouts.app')

@section('title', 'Participants')

@section('content')
  <div class="mb-6">
    <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2" style="color: var(--gold-soft);">
      Participants
    </p>
    <h1 class="font-display text-3xl sm:text-4xl" style="color: var(--gold);">
      MY PARTICIPANTS
    </h1>
    <p class="mt-2 text-sm" style="color: var(--ink-muted);">
      Students registered under your assigned events.
    </p>
  </div>

  {{-- Filters --}}
  <form method="GET" class="rounded-xl p-4 mb-6"
        style="background: var(--bg-panel); border: 1px solid var(--border);">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
      <div>
        <label class="block text-xs uppercase tracking-wider mb-1.5" style="color: var(--ink-muted);">Category</label>
        <select name="category_id" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
          <option value="">All my events</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected((string) request('category_id') === (string) $cat->id)>
              {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-wider mb-1.5" style="color: var(--ink-muted);">Gender</label>
        <select name="gender" class="field w-full rounded px-3 py-2 text-sm" onchange="this.form.submit()">
          <option value="">All</option>
          <option value="Male" @selected(request('gender') === 'Male')>Male</option>
          <option value="Female" @selected(request('gender') === 'Female')>Female</option>
        </select>
      </div>

      <div>
        <label class="block text-xs uppercase tracking-wider mb-1.5" style="color: var(--ink-muted);">Search</label>
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Name or student no."
               class="field w-full rounded px-3 py-2 text-sm">
      </div>

      <div class="flex items-end gap-2">
        <button type="submit"
                class="flex-1 rounded px-3 py-2 text-sm font-semibold text-black transition-colors hover:brightness-110"
                style="background: var(--gold);">
          Filter
        </button>
        @if (request()->anyFilled(['category_id', 'gender', 'search']))
          <a href="{{ route('coach.participants') }}"
             class="rounded px-3 py-2 text-sm font-medium transition-colors hover:text-[color:var(--gold)]"
             style="color: var(--ink-muted); border: 1px solid var(--border-strong);">
            Clear
          </a>
        @endif
      </div>
    </div>
  </form>

  {{-- Results summary + export --}}
  <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
    <p class="text-sm" style="color: var(--ink-muted);">
      {{ $participants->total() }} {{ Str::plural('participant', $participants->total()) }} found
    </p>
    <a href="{{ route('coach.export', request()->only(['category_id', 'gender', 'search'])) }}"
       class="inline-flex items-center gap-2 text-xs font-semibold px-3 py-2 rounded-md transition-all hover:scale-[1.02]"
       style="background: var(--gold); color: #000;">
      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
           stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="7 10 12 15 17 10"/>
        <line x1="12" y1="15" x2="12" y2="3"/>
      </svg>
      Export PDF
    </a>
  </div>

  {{-- Desktop table --}}
  <div class="hidden sm:block rounded-xl overflow-hidden"
       style="background: var(--bg-panel); border: 1px solid var(--border);">
    <table class="w-full text-sm">
      <thead>
        <tr class="text-left text-xs uppercase tracking-wider border-b"
            style="color: var(--ink-muted); border-color: var(--border);">
          <th class="py-3 px-5 font-medium">Name</th>
          <th class="py-3 px-4 font-medium">Student ID</th>
          <th class="py-3 px-4 font-medium">Gender</th>
          <th class="py-3 px-4 font-medium">Program</th>
          <th class="py-3 px-4 font-medium">Contact</th>
          <th class="py-3 px-4 font-medium">Facebook</th>
          <th class="py-3 px-4 font-medium">Event</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($participants as $p)
          @php
            $fbUrl = $p->email;
            if ($fbUrl && !\Illuminate\Support\Str::startsWith($fbUrl, ['http://', 'https://'])) {
                $fbUrl = 'https://' . ltrim($fbUrl, '/');
            }
          @endphp
          <tr class="border-b transition-colors last:border-0 hover:bg-[color:var(--bg-panel-soft)]"
              style="border-color: var(--border);">
            <td class="py-2.5 px-5 font-medium">{{ $p->full_name }}</td>
            <td class="py-2.5 px-4 font-mono text-xs" style="color: var(--ink-muted);">{{ $p->student_number }}</td>
            <td class="py-2.5 px-4" style="color: var(--ink-muted);">{{ $p->gender }}</td>
            <td class="py-2.5 px-4" style="color: var(--ink-muted);">{{ $p->program }}</td>
            <td class="py-2.5 px-4" style="color: var(--ink-muted);">{{ $p->contact_number ?: '—' }}</td>
            <td class="py-2.5 px-4" style="color: var(--ink-muted);">
              @if ($fbUrl)
                <a href="{{ $fbUrl }}" target="_blank" rel="noopener noreferrer"
                   class="break-all transition-colors hover:text-[color:var(--gold)] inline-flex items-center gap-1">
                  {{ $p->email }}
                  <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                       stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                       class="shrink-0 opacity-60">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                    <polyline points="15 3 21 3 21 9"/>
                    <line x1="10" y1="14" x2="21" y2="3"/>
                  </svg>
                </a>
              @else
                —
              @endif
            </td>
            <td class="py-2.5 px-4">
              <span class="pill text-[10px] font-medium rounded-full px-2.5 py-1 whitespace-nowrap">
                {{ $p->entry->category->name }}
              </span>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="py-16 text-center" style="color: var(--ink-muted);">
              <div class="flex flex-col items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                     style="color: var(--gold-soft);">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                  <circle cx="8.5" cy="7" r="4"/>
                  <line x1="20" y1="8" x2="20" y2="14"/>
                  <line x1="23" y1="11" x2="17" y2="11"/>
                </svg>
                <p class="text-sm font-medium" style="color: var(--ink);">No participants yet</p>
                <p class="text-xs">
                  @if (request()->anyFilled(['category_id', 'gender', 'search']))
                    No participants match these filters.
                  @else
                    No one has registered for your events yet.
                  @endif
                </p>
              </div>
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Mobile cards --}}
  <div class="sm:hidden space-y-3">
    @forelse ($participants as $p)
      @php
        $fbUrl = $p->email;
        if ($fbUrl && !\Illuminate\Support\Str::startsWith($fbUrl, ['http://', 'https://'])) {
            $fbUrl = 'https://' . ltrim($fbUrl, '/');
        }
      @endphp
      <div class="rounded-xl p-4" style="background: var(--bg-panel); border: 1px solid var(--border);">
        <div class="flex items-start justify-between gap-3 mb-3">
          <div class="min-w-0">
            <p class="font-semibold text-sm truncate">{{ $p->full_name }}</p>
            <p class="font-mono text-xs mt-0.5" style="color: var(--ink-muted);">{{ $p->student_number }}</p>
          </div>
          <span class="pill text-[10px] font-medium rounded-full px-2 py-0.5 shrink-0">{{ $p->gender }}</span>
        </div>
        <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-xs">
          <div>
            <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Program</dt>
            <dd class="mt-0.5">{{ $p->program }}</dd>
          </div>
          <div>
            <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Event</dt>
            <dd class="mt-0.5">{{ $p->entry->category->name }}</dd>
          </div>
          <div class="col-span-2">
            <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Contact</dt>
            <dd class="mt-0.5">{{ $p->contact_number ?: '—' }}</dd>
          </div>
          @if ($fbUrl)
            <div class="col-span-2">
              <dt class="uppercase tracking-wider" style="color: var(--ink-muted);">Facebook</dt>
              <dd class="mt-0.5 break-all">
                <a href="{{ $fbUrl }}" target="_blank" rel="noopener noreferrer"
                   class="transition-colors hover:text-[color:var(--gold)]" style="color: var(--gold-soft);">
                  {{ $p->email }}
                </a>
              </dd>
            </div>
          @endif
        </dl>
      </div>
    @empty
      <div class="rounded-xl p-8 text-center"
           style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
        <p class="text-sm font-medium mb-1" style="color: var(--ink);">No participants yet</p>
        <p class="text-xs" style="color: var(--ink-muted);">
          No one has registered for your events yet.
        </p>
      </div>
    @endforelse
  </div>

  {{-- Pagination --}}
  @if ($participants->hasPages())
    <div class="mt-8">
      {{ $participants->links() }}
    </div>
  @endif
@endsection