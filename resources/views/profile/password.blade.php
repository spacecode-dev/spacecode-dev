@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="main section">
        <div class="container-fluid">
            <div class="row min-vh-100 flex-row">
                @include('profile.include.aside')
                <main>
                    <form class="form" method="POST" action="{{ route('profile.update') }}">
                        {{ csrf_field() }}
                        <h1 class="h5">{!! __('Password Settings') !!}</h1>
                        <div class="form-div mb-3">
                            <label for="inputOldPassword" class="form-label">{!! __('Old Password') !!}</label>
                            <input type="password" class="form-control" id="inputOldPassword" name="oldPassword" placeholder="{!! __('Enter your current password here') !!}" required>
                            @if ($errors->has('oldPassword'))
                                <div class="invalid-feedback">{{ $errors->first('oldPassword') }}</div>
                            @endif
                        </div>
                        <div class="form-div mb-3">
                            <label for="inputPassword" class="form-label">{!! __('Password') !!}</label>
                            <input type="password" class="form-control" id="inputPassword" name="password" placeholder="{!! __('Enter your new password') !!}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="form-div mb-3">
                            <label for="inputConfirm" class="form-label">{!! __('Confirm') !!}</label>
                            <input type="password" class="form-control" id="inputConfirm" name="password_confirmation" placeholder="{!! __('Confirm your new password') !!}" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <input type="hidden" name="type" value="password">
                        <button type="submit" class="btn btn-primary">{!! __('Update') !!}</button>
                    </form>
                </main>
            </div>
        </div>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success animated fadeInDown" data-notify="container" role="alert">
            {!! session()->get('success') !!}
        </div>
    @endif
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop