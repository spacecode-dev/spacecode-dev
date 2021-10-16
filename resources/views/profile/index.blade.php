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
                        <h1 class="h5">{!! __('Contact Information') !!}</h1>
                        <p class="help-text">{!! __('When changing your email address, we will send you an email with a confirmation link to confirm the address change.') !!}</p>
                        <div class="form-div mb-3">
                            <label for="inputName" class="form-label">{!! __('Name') !!}</label>
                            <input type="text" class="form-control" id="inputName" name="name" value="{!! $entity->user->name !!}" placeholder="{!! __('Enter your name here') !!}" required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                        <div class="form-div mb-3">
                            <label for="inputEmail" class="form-label">{!! __('Email') !!}</label>
                            <input type="email" class="form-control" id="inputEmail" name="email" value="{!! $entity->user->email !!}" placeholder="{!! __('Enter your email here') !!}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <input type="hidden" name="type" value="contacts">
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