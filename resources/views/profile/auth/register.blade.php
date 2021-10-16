@extends('profile.auth.layout', ['class' => 'register', 'title' => __('Sing Up')])
@section('content')
    @include('profile.include.logo')
    <form class="bg-white shadow rounded-lg p-8 max-w-login mx-auto" method="POST" action="{{ route('profile.register') }}">
        {{ csrf_field() }}
        @include('profile.include.title', ['title' => __('Sing Up')])

        @include('profile.include.errors')

        <div class="mb-6{{ $errors->has('name') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="email">{!! __('Name') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="name" type="text" value="{{ old('name') }}" name="name" required autofocus>
        </div>

        <div class="mb-6{{ $errors->has('email') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="email">{!! __('Email Address') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="email" type="email" value="{{ old('email') }}" name="email" required>
        </div>

        <div class="mb-6{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="password">{!! __('Password') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="password" type="password" value="{{ old('password') }}" name="password" required>
        </div>

        <div class="mb-6{{ $errors->has('password') ? ' has-error' : '' }}">
            <label class="block font-bold mb-1" for="confirm_password">{!! __('Confirm Password') !!}</label>
            <input class="form-control form-input form-input-bordered w-full" id="confirm_password" type="password" name="password_confirmation" required>
        </div>

        <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">{!! __('Sing Up') !!}</button>
        <div class="add font-bold">
            <span>{!! __('You have an account?') !!}</span>
            <a class="text-primary dim no-underline mt-2" href="{{ route('profile.login') }}">{!! __('Go to Login') !!}</a>
        </div>
    </form>
@endsection