@extends('coach.layouts.app')

@section('title', 'Announcements')

@section('content')
  <div class="flex items-center justify-between gap-3 mb-6">
    <div>
      <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2" style="color: var(--gold-soft);">
        Announcements
      </p>
      <h1 class="font-display text-3xl sm:text-4xl" style="color: var(--gold);">
        YOUR POSTS
      </h1>
    </div>
    <a href="{{ route('coach.announcements.create') }}"
       class="text-sm font-semibold rounded-md px-4 py-2.5 text-black transition-all hover:scale-[1.02]"
       style="background: var(--gold);">
      + New
    </a>
  </div>

  @forelse ($announcements as $a)
    <div class="rounded-xl p-5 mb-4 flex gap-4"
         style="background: var(--bg-panel); border: 1px solid var(--border);">
      @if ($a->image_path)
        <img src="{{ Storage::url($a->image_path) }}"
             class="w-20 h-20 rounded-lg object-cover shrink-0" alt="">
      @endif
      <div class="flex-1 min-w-0">
        <div class="flex flex-wrap items-center gap-2 mb-1.5">
          <span class="pill text-[10px] uppercase tracking-wider px-2 py-0.5 rounded-full">
            {{ $a->category->name ?? 'General' }}
          </span>
          <span class="text-[10px] uppercase tracking-wider" style="color: var(--ink-muted);">
            {{ $a->type }}
          </span>
          <span class="text-[10px]" style="color: var(--ink-muted);">
            · {{ $a->created_at->diffForHumans() }}
          </span>
        </div>
        <p class="font-semibold">{{ $a->title }}</p>
        <p class="text-sm mt-1 line-clamp-2" style="color: var(--ink-muted);">{{ $a->body }}</p>
        <div class="flex gap-4 mt-3 text-xs">
          <a href="{{ route('coach.announcements.edit', $a) }}"
             class="font-medium transition-colors hover:text-[color:var(--gold)]"
             style="color: var(--gold-soft);">
            Edit
          </a>
          <form method="POST" action="{{ route('coach.announcements.destroy', $a) }}"
                onsubmit="return confirm('Delete this announcement?');">
            @csrf @method('DELETE')
            <button type="submit" class="cursor-pointer transition-colors hover:text-red-400"
                    style="color: #e07a7a;">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="rounded-xl p-12 text-center"
         style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);">
      <p class="font-display text-xl mb-2" style="color: var(--gold-soft);">NO ANNOUNCEMENTS</p>
      <p class="text-sm mb-4" style="color: var(--ink-muted);">
        You haven't posted any announcements yet.
      </p>
      <a href="{{ route('coach.announcements.create') }}"
         class="inline-flex items-center gap-2 text-sm font-semibold"
         style="color: var(--gold);">
        Post your first announcement →
      </a>
    </div>
  @endforelse
@endsection