<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Herculean Dragon · SLSU Sogod Intramurals</title>

  <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">

  {{-- Apply saved theme before CSS renders to avoid flash --}}
  <script>
    (function () {
      const saved = localStorage.getItem('theme');
      const prefersLight = window.matchMedia('(prefers-color-scheme: light)').matches;
      const theme = saved || (prefersLight ? 'light' : 'dark');
      document.documentElement.setAttribute('data-theme', theme);
    })();
  </script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased" style="background: var(--bg); color: var(--ink);">

  @include('partials.navbar')
  @include('partials.hero')
  @include('partials.about-carousel')
  @include('partials.category-grid')
  @include('partials.faq')
  @include('partials.footer')
  @include('partials.details-modal')

  {{-- Pass Blade data to JS in a clean, lint-friendly way --}}
  @php
    $sportsForJs = $groups->flatten()->map(function ($s) {
        return [
            'id'    => $s->id,
            'name'  => $s->name,
            'group' => $s->group,
            'min'   => $s->min_members,
            'max'   => $s->max_members,
        ];
    })->values();
  @endphp

  <script type="application/json" id="sports-data">@json($sportsForJs)</script>
  <script>
    window.__SPORTS__ = JSON.parse(document.getElementById('sports-data').textContent);
    window.__REGISTER_URL__ = "{{ route('register.create') }}";
  </script>

</body>
</html>