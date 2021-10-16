@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section-inverse">
        <div class="container">
            <div class="row d-flex">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb inverse">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="heading">
                        <h1 class="text-light">{{ $entity->title }}</h1>
                        <p>Let's get to know each other? Tell us a little about you next project</p>
                        <ul class="mb-0 list-unstyled">
                            <li class="d-flex flex-column">
                                <div class="top d-flex align-items-center">
                                    <span class="icon icon-location-pin"></span>
                                    <span class="name h6">Location</span>
                                </div>
                                <p class="m-0">Lõõtsa tn 8a, 11415 Tallinn, Estonia</p>
                            </li>
                            <li class="d-flex flex-column">
                                <div class="top d-flex align-items-center">
                                    <span class="icon icon-email"></span>
                                    <span class="name h6">Email</span>
                                </div>
                                <p class="m-0">support@spacecode.dev</p>
                            </li>
{{--                            <li class="d-flex chat">--}}
{{--                                @foreach(get_setting('website_social') as $key => $link)--}}
{{--                                    @if(\Illuminate\Support\Str::startsWith($key, 'chat_'))--}}
{{--                                        <a href="{{ $link }}" target="_blank" rel="nofollow">--}}
{{--                                            <img src="{{ GoDesk::image('website/chat/' . $key . '.png') }}" alt="{{\Illuminate\Support\Str::title($key)}} SpaceCode">--}}
{{--                                        </a>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </li>--}}
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12" id="contactFormDiv">
                    <contact-form contact-data='{!! json_encode($entity->contactData) !!}'></contact-form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop