<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Herculean Dragon · Entries Export</title>
  <style>
    @page {
      margin: 40px 32px 60px 32px;
    }
    * { box-sizing: border-box; }
    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
      color: #1a1712;
      font-size: 11px;
      line-height: 1.45;
    }

    /* Header */
    .header {
      border-bottom: 3px solid #F2B90C;
      padding-bottom: 14px;
      margin-bottom: 20px;
    }
    .header-top {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .brand {
      font-size: 22px;
      font-weight: 800;
      letter-spacing: 1px;
      color: #1a1712;
      margin: 0;
    }
    .brand span { color: #C99A1E; }
    .subtitle {
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #8a7c56;
      margin-top: 3px;
    }
    .meta {
      text-align: right;
      font-size: 10px;
      color: #666;
    }
    .meta strong { color: #1a1712; }

    /* Summary stats */
    .stats {
      display: flex;
      gap: 20px;
      margin-bottom: 18px;
      padding: 10px 14px;
      background: #faf7ee;
      border-left: 3px solid #F2B90C;
    }
    .stats .label {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #8a7c56;
      margin-bottom: 2px;
    }
    .stats .value {
      font-size: 16px;
      font-weight: 700;
      color: #1a1712;
    }

    /* Section per category */
    .category-section {
      margin-bottom: 22px;
      page-break-inside: avoid;
    }
    .category-header {
      font-size: 13px;
      font-weight: 700;
      color: #1a1712;
      padding: 6px 0;
      border-bottom: 2px solid #F2B90C;
      margin-bottom: 8px;
    }
    .category-header .group {
      font-size: 9px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #C99A1E;
      margin-right: 8px;
    }
    .category-header .count {
      float: right;
      font-size: 10px;
      font-weight: 500;
      color: #8a7c56;
    }

    /* Table */
    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 10px;
    }
    thead {
      background: #f5f0e0;
    }
    thead th {
      text-align: left;
      font-weight: 700;
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #5a4a1e;
      padding: 6px 8px;
      border-bottom: 1.5px solid #d4b860;
    }
    tbody td {
      padding: 6px 8px;
      border-bottom: 0.5px solid #e6ddc0;
      vertical-align: top;
    }
    tbody tr:last-child td {
      border-bottom: 1px solid #d4b860;
    }
    tbody tr:nth-child(even) td {
      background: #fdfbf4;
    }
    .name { font-weight: 600; color: #1a1712; }
    .muted { color: #666; }

    /* Footer */
    .footer {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      height: 40px;
      font-size: 9px;
      color: #8a7c56;
      text-align: center;
      border-top: 1px solid #e6ddc0;
      padding-top: 8px;
    }
    .footer .page:after {
      content: counter(page) " / " counter(pages);
    }
    /* Signatures */
    .signatures {
      margin-top: 40px;
      padding-top: 20px;
      border-top: 2px solid #F2B90C;
      page-break-inside: avoid;
    }
    .signatures-title {
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 2px;
      color: #8a7c56;
      margin-bottom: 24px;
      text-align: center;
    }
    .signatures-grid {
      display: flex;
      justify-content: space-between;
      gap: 26px;
      margin-bottom: 25px;
    }
    .signature-line {
      flex: 1;
      width: 40%;
      text-align: center;
    }
    .signature-underline {
      border-bottom: 1px solid #1a1712;
      height: 34px;
      margin-bottom: 6px;
    }
    .signature-label {
      font-size: 9px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #5a4a1e;
      font-weight: 600;
    }
    .signatures-note {
      font-size: 9px;
      color: #8a7c56;
      text-align: center;
      font-style: italic;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  {{-- ===== HEADER ===== --}}
  <div class="header">
    <div class="header-top">
      <div>
        <p class="brand">HERCULEAN <span>DRAGON</span></p>
        <p class="subtitle">SLSU Sogod Intramurals · Official Entries</p>
      </div>
      <div class="meta">
        <div>Generated: <strong>{{ $generated->timezone('Asia/Manila')->format('M d, Y g:i A') }}</strong> <span style="color:#8a7c56;">PHT</span></div>
        <div>Filter: <strong>{{ $filterNote ?: 'Custom selection' }}</strong></div>
      </div>
    </div>
  </div>
  @php
    $grouped = $members->groupBy(fn($m) => $m->entry->category->group . '|' . $m->entry->category->id);
  @endphp

  @foreach ($grouped as $key => $categoryMembers)
    @php
      [$groupName, $categoryId] = explode('|', $key);
      $category = $categoryMembers->first()->entry->category;
    @endphp

    <div class="category-section">
      <div class="category-header">
        <span class="group">{{ $category->name }}</span>
        <span class="count">{{ $categoryMembers->count() }} {{ Str::plural('member', $categoryMembers->count()) }}</span>
      </div>

      <table>
        <thead>
          <tr>
            <th style="width: 22%;">Name</th>
            <th style="width: 12%;">Student ID</th>
            <th style="width: 8%;">Gender</th>
            <th style="width: 20%;">Program</th>
            <th style="width: 8%;">Year</th>
            <th style="width: 15%;">Contact</th>
            <th style="width: 15%;">Facebook</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categoryMembers as $member)
            <tr>
              <td class="name">{{ $member->full_name }}</td>
              <td class="muted">{{ $member->student_number }}</td>
              <td class="muted">{{ $member->gender }}</td>
              <td class="muted">{{ $member->program }}</td>
              <td class="muted">{{ $member->year_level }}</td>
              <td class="muted">{{ $member->contact_number ?: '—' }}</td>
              <td class="muted">{{ $member->email ?: '—' }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endforeach
  {{-- ===== SIGNATURES ===== --}}
  @if ($members->isNotEmpty())
    <div class="signatures">
      <div class="signatures-title">Signatures</div>
      <div class="signatures-grid">
        @for ($i = 1; $i <= 5; $i++)
          <div class="signature-line">
            <div class="signature-underline"></div>
            <div class="signature-label">Coach {{ $i }}</div>
          </div>
        @endfor
      </div>
      <div class="signatures-note">
        By signing above, the coach confirms the accuracy of the listed entries.
      </div>
    </div>
  @endif


</body>
</html>