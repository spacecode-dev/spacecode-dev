@extends('profile.auth.layout', ['class' => 'login', 'title' => __('Login')])
@section('content')
    @include('profile.include.logo')
    <form class="bg-white shadow rounded-lg p-8 max-w-login mx-auto" method="POST" action="{{ route('profile.login') }}">
        {{ csrf_field() }}
        @include('profile.include.title', ['title' => __('Login')])

        @include('profile.include.errors')

        <div class="mb-6{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="email">{!! __('Email Address') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-6{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="password">{!! __('Password') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="password" type="password" name="password" required>
        </div>

        <div class="flex mb-6">
            <label class="flex items-center block text-xl font-bold">
                <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                <span class="text-base ml-2">{!! __('Remember Me') !!}</span>
            </label>
            <div class="ml-auto">
                <a class="text-primary dim font-bold no-underline text-base" href="{{ route('profile.password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        </div>

        <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">{!! __('Login') !!}</button>
        <div class="add font-bold">
            <span>{!! __('You don\'t have an account?') !!}</span>
            <a class="text-primary dim no-underline mt-2" href="{{ route('profile.register') }}">{!! __('Register Now') !!}</a>
        </div>
    </form>
@endsection