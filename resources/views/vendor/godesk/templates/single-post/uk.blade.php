@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="post-main section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb" class="text-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Головна</a></li>
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 6, $entity->locale) }}">Блог</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="offset-xl-1 col-lg-12 col-xl-10">
                    <div class="heading text-center">
                        <span class="text-primary">{{ $entity->getTags()->count() > 0 ? $entity->getTags()->first()['title'] : '' }}</span>
                        <h1>{{$entity->title}}</h1>
                        <p>{{$entity->excerpt}}</p>
                    </div>
                    <div class="date text-center">
                        Опубліковано: {{$entity->created_at->diffForHumans()}}
                    </div>
                    <div class="image">
                        <img src="{{ $entity->thumbnail }}" alt="{{$entity->title}}">
                    </div>
                    <div class="body">
                        {!! $entity->content !!}
                    </div>
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