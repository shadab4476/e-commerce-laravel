@if ($user->name)
    <h1>Hello {{ $user->name }}</h1>
@else
    <h1>Hello</h1>
@endif
<h3>Your OTP: <strong>{{ $user->otp }}</strong></h3>
<h4>Thank You..</h4>
