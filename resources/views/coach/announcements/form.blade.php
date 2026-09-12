
@section('title', $announcement->exists ? 'Edit Announcement' : 'New Announcement')

@section('content')
  <div class="max-w-2xl mx-auto">
    <div class="mb-6">
      <a href="{{ route('coach.announcements.index') }}"
         class="text-sm inline-flex items-center gap-1.5 transition-colors hover:text-[color:var(--gold)]"
         style="color: var(--ink-muted);">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        Back to announcements
      </a>
    </div>

    <h1 class="font-display text-3xl mb-6" style="color: var(--gold);">
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
  </div>
@endsection