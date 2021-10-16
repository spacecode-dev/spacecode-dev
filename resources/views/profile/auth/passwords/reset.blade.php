@extends('profile.auth.layout', ['class' => 'reset', 'title' => __('Reset Password')])
@section('content')
    <form class="bg-white shadow rounded-lg p-8 max-w-login mx-auto" method="POST" action="{{ route('profile.password.request') }}">
        {{ csrf_field() }}
        @include('profile.include.title', ['title' => __('Reset Password')])

        @include('profile.include.errors')

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="email">{{ __('Email Address') }}</label>
            <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
        </div>

        <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="password">{{ __('Password') }}</label>
            <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password" required>
        </div>

        <div class="mb-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="password-confirm">{{ __('Confirm Password') }}</label>
            <input class="form-control form-input form-input-bordered w-full" id="password-confirm" type="password" name="password_confirmation" required>
        </div>

        <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
            {{ __('Reset Password') }}
        </button>
    </form>
@endsection