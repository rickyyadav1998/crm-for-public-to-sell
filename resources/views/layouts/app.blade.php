<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CRM') · {{ config('app.name') }}</title>
    <style>
        :root{--bg:#f5f6fb;--panel:#fff;--text:#172033;--muted:#7b8497;--line:#e6e8ef;--primary:#6757ef;--danger:#d95165;--success:#269a60}
        *{box-sizing:border-box}body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:var(--bg);color:var(--text)}
        a{color:inherit;text-decoration:none}.shell{min-height:100vh}.top{height:64px;background:var(--panel);border-bottom:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;padding:0 28px;position:sticky;top:0;z-index:10}
        .brand{font-weight:800;font-size:18px}.brand span{color:var(--primary)}.nav{display:flex;gap:8px;align-items:center}.nav a,.nav button{border:0;background:transparent;padding:9px 12px;border-radius:9px;color:var(--muted);font:inherit;cursor:pointer}.nav a.active,.nav a:hover,.nav button:hover{background:#f0efff;color:var(--primary)}
        .main{max-width:1200px;margin:0 auto;padding:28px}.row{display:flex;align-items:center;justify-content:space-between;gap:16px}.muted{color:var(--muted)}.panel{background:var(--panel);border:1px solid var(--line);border-radius:14px;padding:20px}
        .btn{display:inline-flex;align-items:center;justify-content:center;border:0;border-radius:9px;padding:10px 15px;font-weight:700;cursor:pointer;background:var(--primary);color:#fff}.btn.secondary{background:#eef0f5;color:var(--text)}.btn.danger{background:#fff0f2;color:var(--danger)}
        .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}.stat{padding:18px}.stat .label{font-size:12px;color:var(--muted)}.stat .value{font-size:28px;font-weight:800;margin-top:7px}
        table{width:100%;border-collapse:collapse}.table-wrap{overflow:auto}th,td{text-align:left;padding:13px 10px;border-bottom:1px solid var(--line);font-size:13px;white-space:nowrap}th{font-size:11px;text-transform:uppercase;letter-spacing:.05em;color:var(--muted)}
        .badge{display:inline-flex;padding:5px 8px;border-radius:999px;font-size:11px;font-weight:700;background:#f0efff;color:var(--primary)}.form-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:16px}.field{display:flex;flex-direction:column;gap:7px}.field.full{grid-column:1/-1}label{font-size:12px;font-weight:700}.input,.select{width:100%;padding:11px 12px;border:1px solid #dfe2ea;border-radius:9px;background:#fff;font:inherit}.error{font-size:12px;color:var(--danger)}.success{padding:12px 14px;border-radius:10px;background:#eaf8f1;color:#187044;margin-bottom:16px}.info{padding:12px 14px;border-radius:10px;background:#eef4ff;color:#31558f;margin-bottom:16px}
        .pagination{display:flex;gap:6px;flex-wrap:wrap;margin-top:18px}.pagination a,.pagination span{padding:7px 10px;border:1px solid var(--line);border-radius:7px;font-size:12px}.pagination .active{background:var(--primary);color:#fff;border-color:var(--primary)}
        .timeline{display:grid;gap:12px}.activity{border-left:3px solid #e4e1ff;padding:10px 14px;background:#fafaff;border-radius:0 10px 10px 0}.activity strong{font-size:13px}.activity small{color:var(--muted)}
        @media(max-width:800px){.grid,.form-grid{grid-template-columns:1fr}.top{padding:0 14px}.nav a{display:none}.main{padding:18px}.row{align-items:flex-start;flex-direction:column}.table-wrap{margin:0 -10px;padding:0 10px}}
    </style>
    @stack('head')
</head>
<body>
<div class="shell">
    <header class="top">
        <a class="brand" href="{{ route('dashboard') }}">CRM<span>.</span></a>
        <nav class="nav">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            <a href="{{ route('leads.*') }}" class="{{ request()->routeIs('leads.*') ? 'active' : '' }}">Leads</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">@csrf<button type="submit">Logout</button></form>
        </nav>
    </header>
    <main class="main">
        @if(session('success'))<div class="success">{{ session('success') }}</div>@endif
        @if(session('info'))<div class="info">{{ session('info') }}</div>@endif
        @yield('content')
    </main>
</div>
</body>
</html>
