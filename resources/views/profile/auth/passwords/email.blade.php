@extends('profile.auth.layout', ['class' => 'email', 'title' => __('Reset Password')])
@section('content')
    @include('profile.include.logo')
    <form class="bg-white shadow rounded-lg p-8 max-w-login mx-auto" method="POST" action="{{ route('profile.password.email') }}">
        {{ csrf_field() }}
        @include('profile.include.title', ['title' => __('Reset Password')])

        @if (session('status'))
            <div class="text-success text-center font-semibold my-3 text-base">
                {{ session('status') }}
            </div>
        @endif

        @include('profile.include.errors')

        <div class="mb-6{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="email">{{ __('Email Address') }}</label>
            <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
            {{ __('Send Password Reset Link') }}
        </button>
        <div class="add font-bold">
            <a class="text-primary dim no-underline mt-2" href="{{ route('profile.login') }}">{!! __('Back to Login') !!}</a>
        </div>
    </form>
@endsection