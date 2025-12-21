@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reset Your Password</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <input type="email" name="email" class="form-control" placeholder="Enter email">
        <button class="btn btn-primary mt-3" type="submit">
            Send reset link
        </button>
    </form>
</div>
@endsection
