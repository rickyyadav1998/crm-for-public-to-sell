<!doctype html>
<html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>First setup · {{ config('app.name') }}</title>
<style>body{margin:0;min-height:100vh;display:grid;place-items:center;background:#f5f6fb;font-family:system-ui,-apple-system,sans-serif;color:#172033}.box{width:min(460px,calc(100% - 32px));background:#fff;border:1px solid #e5e7ef;border-radius:16px;padding:28px}.logo{font-size:24px;font-weight:800}.logo span{color:#6757ef}.muted{color:#7b8497;font-size:13px}.field{margin-top:15px}.field label{display:block;font-size:12px;font-weight:700;margin-bottom:7px}.input{width:100%;box-sizing:border-box;padding:12px;border:1px solid #dfe2ea;border-radius:9px;font:inherit}.btn{width:100%;margin-top:20px;padding:12px;border:0;border-radius:9px;background:#6757ef;color:#fff;font-weight:800}.error{font-size:12px;color:#d95165;margin-top:6px}</style></head>
<body><div class="box"><div class="logo">CRM<span>.</span></div><h1>First-time setup</h1><p class="muted">Create the first Owner account. This page stops working automatically after the first user is created.</p>
@if($errors->any())<div class="error">{{ $errors->first() }}</div>@endif
<form method="POST" action="{{ route('setup.store') }}">@csrf
<div class="field"><label>Name</label><input class="input" name="name" value="{{old('name')}}" required></div>
<div class="field"><label>Email</label><input class="input" type="email" name="email" value="{{old('email')}}" required></div>
<div class="field"><label>Password</label><input class="input" type="password" name="password" minlength="8" required></div>
<div class="field"><label>Confirm password</label><input class="input" type="password" name="password_confirmation" minlength="8" required></div>
<button class="btn" type="submit">Create Owner Account</button></form>
<p class="muted" style="margin-top:20px"><a href="{{route('login')}}" style="color:#6757ef;font-weight:700">Back to sign in</a></p></div></body></html>