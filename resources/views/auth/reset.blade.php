@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Password</h2>

    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" class="form-control" placeholder="Email">

        <input type="password" name="password" class="form-control mt-2" placeholder="Password">

        <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirm Password">

        <button class="btn btn-primary mt-3" type="submit">
            Reset Password
        </button>
    </form>
</div>
@endsection
