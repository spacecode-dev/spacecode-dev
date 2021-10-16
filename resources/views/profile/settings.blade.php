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
                        <h1 class="h5">{!! __('User Settings') !!}</h1>
                        <div class="form-div mb-3">
                            <label for="inputLang" class="form-label">{!! __('Language') !!}</label>
                            <select class="form-control" id="inputLang" name="lang">
                                <option value="">{!! __('Choose language') !!}</option>
                                @foreach(config('godesk.langs') as $lang)
                                    <option value="{!! $lang !!}"{!! $entity->locale === $lang ? ' selected' : null !!}>{!! __(\SpaceCode\GoDesk\GoDesk::localeValue($lang)) !!}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('lang'))
                                <div class="invalid-feedback">{{ $errors->first('lang') }}</div>
                            @endif
                        </div>
                        <input type="hidden" name="type" value="settings">
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