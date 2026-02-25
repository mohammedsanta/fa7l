@extends('Auth.layouts.app')

@section('title','Login')

@section('content')

<div class="card">

<h2 style="text-align:center;">🔐 Login</h2>

{{-- ✅ Form حقيقي --}}
<form method="POST" action="{{ route('login.store') }}">
@csrf

{{-- Email --}}
<div class="input-group">
<i class="fa fa-envelope"></i>
<input type="email" name="email" value="{{ old('email') }}" placeholder="Email">
</div>

@error('email')
<div class="error" style="display:block;">
{{ $message }}
</div>
@enderror

{{-- Password --}}
<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password" placeholder="Password">
</div>

@error('password')
<div class="error" style="display:block;">
{{ $message }}
</div>
@enderror

{{-- Toggle --}}
<div class="toggle-btn">
<button type="button" onclick="togglePassword()">
👁 Show / Hide Password
</button>
</div>

{{-- Button --}}
<button type="submit" class="login-btn">
Login
</button>

</form>

<div class="link">
Don't have account?
<a href="{{ route('register') }}">Register</a>
</div>

</div>

@endsection


@push('scripts')
<script>

/* Toggle Password */
function togglePassword(){

let pass = document.querySelector("input[name='password']");
pass.type = pass.type === "password" ? "text" : "password";

}

</script>
@endpush