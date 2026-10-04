<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Sign in · {{ config('app.name') }}</title>
<style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#f5f6fb;font-family:system-ui,-apple-system,sans-serif;color:#172033}.box{width:min(420px,calc(100% - 32px));background:#fff;border:1px solid #e5e7ef;border-radius:16px;padding:28px;box-shadow:0 12px 40px #17203312}.logo{font-size:24px;font-weight:800}.logo span{color:#6757ef}.muted{color:#7b8497;font-size:13px}.field{margin-top:16px}.field label{display:block;font-size:12px;font-weight:700;margin-bottom:7px}.input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #dfe2ea;border-radius:9px;font:inherit}.btn{width:100%;margin-top:20px;padding:12px;border:0;border-radius:9px;background:#6757ef;color:#fff;font-weight:800;cursor:pointer}.error{font-size:12px;color:#d95165;margin-top:6px}.alert{padding:11px 12px;border-radius:9px;background:#eef4ff;color:#31558f;font-size:13px;margin:15px 0}</style></head>
<body><div class="box"><div class="logo">CRM<span>.</span></div><h1>Welcome back</h1><p class="muted">Sign in to manage your leads.</p>
@if(session('success'))<div class="alert">{{session('success')}}</div>@endif
@if(session('info'))<div class="alert">{{session('info')}}</div>@endif
@if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('login') }}">@csrf
<div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{ old('email') }}" required autofocus></div>
<div class="field"><label>Password</label><input class="input" type="password" name="password" required></div>
<div class="field"><label style="font-weight:500"><input type="checkbox" name="remember" value="1"> Remember me</label></div>
<button class="btn" type="submit">Sign in</button></form>
<p class="muted" style="margin-top:20px;text-align:center">First-time setup? <a href="{{ route('setup') }}" style="color:#6757ef;font-weight:700">Create owner account</a></p>
</div></body></html>