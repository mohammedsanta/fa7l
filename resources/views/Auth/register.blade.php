@extends('Auth.layouts.app')

@section('title','Register')

@section('content')

<div class="card">

<h2 style="text-align:center;">📝 Create Account</h2>

<form method="POST" action="{{ route('register.store') }}">
@csrf

{{-- Name --}}
<div class="input-group">
<i class="fa fa-user"></i>
<input type="text" name="name" placeholder="Full Name">
</div>
@error('name')
<div class="error" style="display:block;">{{ $message }}</div>
@enderror

{{-- Email --}}
<div class="input-group">
<i class="fa fa-envelope"></i>
<input type="email" name="email" placeholder="Email">
</div>
@error('email')
<div class="error" style="display:block;">{{ $message }}</div>
@enderror

{{-- Password --}}
<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password" placeholder="Password">
</div>
@error('password')
<div class="error" style="display:block;">{{ $message }}</div>
@enderror

{{-- Confirm --}}
<div class="input-group">
<i class="fa fa-lock"></i>
<input type="password" name="password_confirmation" placeholder="Confirm Password">
</div>

{{-- Toggle --}}
<div class="toggle-btn">
<button type="button" onclick="togglePassword()">
👁 Show / Hide Password
</button>
</div>

<button type="submit" class="login-btn">
Register
</button>

</form>

<div class="link">
Already have account?
<a href="{{ route('login') }}">Login</a>
</div>

</div>

@endsection


@push('scripts')
<script>

/* Toggle Password */
function togglePassword(){

let inputs = document.querySelectorAll("input[type='password']");

inputs.forEach(input=>{
input.type = input.type === "password" ? "text" : "password";
});

}

</script>
@endpush