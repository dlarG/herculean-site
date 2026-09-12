@extends('coach.layouts.app')

@section('title', $announcement->exists ? 'Edit Announcement' : 'New Announcement')
@section('page-title', $announcement->exists ? 'Edit Announcement' : 'New Announcement')

@section('content')

  {{-- Header --}}
  <div class="mb-6 flex items-center justify-between gap-3">
    <div>
      <a href="{{ route('coach.announcements.index') }}"
         class="text-xs inline-flex items-center gap-1.5 mb-3 transition-colors hover:text-[color:var(--gold)]"
         style="color: var(--ink-muted);">
        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"/>
          <polyline points="12 19 5 12 12 5"/>
        </svg>
        Back to announcements
      </a>
      <p class="text-xs uppercase tracking-[0.25em] font-semibold mb-2" style="color: var(--gold-soft);">
        Announcements
      </p>
      <h1 class="font-display text-3xl sm:text-4xl" style="color: var(--gold);">
        {{ $announcement->exists ? 'EDIT POST' : 'NEW POST' }}
      </h1>
      <p class="mt-2 text-sm" style="color: var(--ink-muted);">
        {{ $announcement->exists
            ? 'Update the details of your announcement below.'
            : 'Share an announcement or schedule an audition with your students.' }}
      </p>
    </div>
  </div>

  {{-- Errors --}}
  @if ($errors->any())
    <div class="mb-6 rounded-xl px-4 py-3 text-sm"
         style="background: rgba(160,59,59,0.12); border: 1px solid #a03b3b; color: #f2a5a5;">
      <p class="font-semibold mb-1.5 flex items-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"/>
          <line x1="12" y1="8" x2="12" y2="12"/>
          <line x1="12" y1="16" x2="12.01" y2="16"/>
        </svg>
        Please fix the following:
      </p>
      <ul class="list-disc list-inside space-y-0.5 text-xs">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Form --}}
  <form method="POST"
        action="{{ $announcement->exists
            ? route('coach.announcements.update', $announcement)
            : route('coach.announcements.store') }}"
        enctype="multipart/form-data"
        class="space-y-6"
        id="announcementForm">
    @csrf
    @if ($announcement->exists)
      @method('PUT')
    @endif

    {{-- Type + Category --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label for="type" class="block text-xs uppercase tracking-wider font-medium mb-2"
               style="color: var(--ink-muted);">
          Type
        </label>
        <select name="type" id="type" required class="field w-full rounded-lg px-3.5 py-3 text-sm">
          <option value="announcement" @selected(old('type', $announcement->type) === 'announcement')>
            Announcement
          </option>
          <option value="audition" @selected(old('type', $announcement->type) === 'audition')>
            Audition / Tryout
          </option>
        </select>
      </div>

      <div>
        <label for="category_id" class="block text-xs uppercase tracking-wider font-medium mb-2"
               style="color: var(--ink-muted);">
          Category
        </label>
        <select name="category_id" id="category_id" class="field w-full rounded-lg px-3.5 py-3 text-sm">
          <option value="">All my events (General)</option>
          @foreach ($categories as $cat)
            <option value="{{ $cat->id }}"
                    @selected((string) old('category_id', $announcement->category_id) === (string) $cat->id)>
              {{ $cat->group }} — {{ $cat->name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>

    {{-- Title --}}
    <div>
      <label for="title" class="block text-xs uppercase tracking-wider font-medium mb-2"
             style="color: var(--ink-muted);">
        Title
      </label>
      <input type="text"
             name="title"
             id="title"
             required
             maxlength="150"
             placeholder="e.g. Basketball tryouts this Saturday"
             class="field w-full rounded-lg px-3.5 py-3 text-sm"
             value="{{ old('title', $announcement->title) }}">
      <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
        Keep it short and clear — students will see this first.
      </p>
    </div>

    {{-- Body --}}
    <div>
      <label for="body" class="block text-xs uppercase tracking-wider font-medium mb-2"
             style="color: var(--ink-muted);">
        Message
      </label>
      <textarea name="body"
                id="body"
                rows="6"
                required
                placeholder="Write the full details here. Include what students need to bring, when to arrive, etc."
                class="field w-full rounded-lg px-3.5 py-3 text-sm leading-relaxed">{{ old('body', $announcement->body) }}</textarea>
    </div>

    {{-- Date + Location --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div>
        <label for="event_at" class="block text-xs uppercase tracking-wider font-medium mb-2"
               style="color: var(--ink-muted);">
          Date &amp; Time <span class="text-[10px] opacity-60 normal-case">(optional)</span>
        </label>
        <input type="datetime-local"
               name="event_at"
               id="event_at"
               class="field w-full rounded-lg px-3.5 py-3 text-sm"
               value="{{ old('event_at', optional($announcement->event_at)->format('Y-m-d\TH:i')) }}">
      </div>

      <div>
        <label for="location" class="block text-xs uppercase tracking-wider font-medium mb-2"
               style="color: var(--ink-muted);">
          Location <span class="text-[10px] opacity-60 normal-case">(optional)</span>
        </label>
        <input type="text"
               name="location"
               id="location"
               maxlength="150"
               placeholder="e.g. SLSU Gymnasium"
               class="field w-full rounded-lg px-3.5 py-3 text-sm"
               value="{{ old('location', $announcement->location) }}">
      </div>
    </div>

    {{-- Image --}}
    <div>
      <label class="block text-xs uppercase tracking-wider font-medium mb-2"
             style="color: var(--ink-muted);">
        Image <span class="text-[10px] opacity-60 normal-case">(optional)</span>
      </label>

      {{-- Existing image --}}
      @if ($announcement->image_path)
        <div class="mb-3 flex items-center gap-3" id="existingImageWrapper">
          <img src="{{ Storage::url($announcement->image_path) }}"
               alt="Current image"
               class="w-24 h-24 rounded-lg object-cover border"
               style="border-color: var(--border);">
          <div>
            <p class="text-xs font-medium mb-1" style="color: var(--ink);">Current image</p>
            <label class="inline-flex items-center gap-2 cursor-pointer text-xs" style="color: #e07a7a;">
              <input type="checkbox" name="remove_image" value="1" class="accent-red-400">
              Remove this image
            </label>
          </div>
        </div>
      @endif

      {{-- Drop zone --}}
      <label for="image"
             class="cursor-pointer flex flex-col items-center justify-center gap-2 rounded-xl p-6 text-center transition-colors hover:bg-[color:var(--bg-panel-soft)]"
             style="background: var(--bg-panel-soft); border: 1px dashed var(--border-strong);"
             id="dropZone">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
             style="color: var(--gold-soft);">
          <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
          <polyline points="17 8 12 3 7 8"/>
          <line x1="12" y1="3" x2="12" y2="15"/>
        </svg>
        <p class="text-sm font-medium" style="color: var(--ink);" id="dropZoneLabel">
          Click to upload an image
        </p>
        <p class="text-xs" style="color: var(--ink-muted);">
          JPG, PNG, or WEBP · Max 4MB
        </p>
        <input type="file"
               name="image"
               id="image"
               accept="image/*"
               class="hidden">
      </label>

      {{-- Preview of the newly selected image --}}
      <div id="newImagePreview" class="hidden mt-3">
        <img id="newImagePreviewImg" src="" alt="Preview"
             class="w-32 h-32 rounded-lg object-cover border"
             style="border-color: var(--border);">
        <p class="mt-1.5 text-xs" style="color: var(--ink-muted);">
          Preview — this image will be uploaded when you save.
        </p>
      </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col sm:flex-row gap-3 pt-2">
      <button type="submit"
              class="flex-1 font-semibold rounded-lg px-6 py-3.5 text-black text-base transition-all hover:scale-[1.01] active:scale-[0.99]"
              style="background: var(--gold); box-shadow: 0 14px 40px -12px rgba(242,185,12,0.5);">
        {{ $announcement->exists ? 'Save changes' : 'Post announcement' }}
      </button>

      <a href="{{ route('coach.announcements.index') }}"
         class="px-6 py-3.5 text-center font-semibold rounded-lg transition-colors hover:bg-[color:var(--bg-panel-soft)]"
         style="color: var(--ink-muted); border: 1px solid var(--border-strong);">
        Cancel
      </a>
    </div>

  </form>

  <script>
    (function () {
      const fileInput = document.getElementById('image');
      const dropZone = document.getElementById('dropZone');
      const dropZoneLabel = document.getElementById('dropZoneLabel');
      const preview = document.getElementById('newImagePreview');
      const previewImg = document.getElementById('newImagePreviewImg');

      // Click handler already handled by <label for="image">

      // Drag-and-drop
      ['dragenter', 'dragover'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
          e.preventDefault();
          dropZone.style.borderColor = 'var(--gold)';
          dropZone.style.background = 'var(--pill-bg)';
        });
      });

      ['dragleave', 'drop'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
          e.preventDefault();
          dropZone.style.borderColor = 'var(--border-strong)';
          dropZone.style.background = 'var(--bg-panel-soft)';
        });
      });

      dropZone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
          fileInput.files = files;
          handleFile(files[0]);
        }
      });

      fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
          handleFile(fileInput.files[0]);
        }
      });

      function handleFile(file) {
        if (!file.type.startsWith('image/')) {
          alert('Please select an image file.');
          fileInput.value = '';
          return;
        }
        if (file.size > 4 * 1024 * 1024) {
          alert('Image is too large. Max size is 4MB.');
          fileInput.value = '';
          return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
          previewImg.src = e.target.result;
          preview.classList.remove('hidden');
          dropZoneLabel.textContent = 'Change image — ' + file.name;
        };
        reader.readAsDataURL(file);
      }
    })();
  </script>

@endsection