@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="blog-main section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    @foreach($entity->paginatedItems->sortByDesc('created_at')->take(1) as $post)
                        <div class="card latest-one">
                            <a href="{{ $post->url }}">
                                <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{$post->title}}">
                            </a>
                            <div class="card-body">
                                <span class="text-primary">{{ $post->getTags()->count() > 0 ? $post->getTags()->first()['title'] : '' }}</span>
                                <h3 class="card-title">
                                    <a href="{{ $post->url }}" class="text-dark">{{$post->title}}</a>
                                </h3>
                                <p class="card-text">{{$post->excerpt}}</p>
                                <a href="{{ $post->url }}" class="btn btn-primary">Читать</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-5">
                    <div class="row list">
                        @foreach($entity->paginatedItems->sortByDesc('created_at')->slice(1)->take('3') as $post)
                            <div class="col-12">
                                <div class="card latest-mini">
                                    <a href="{{ $post->url }}">
                                        <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{$post->title}}">
                                    </a>
                                    <div class="card-body">
                                        <span class="text-primary">{{ $post->getTags()->count() > 0 ? $post->getTags()->first()['title'] : '' }}</span>
                                        <h4 class="card-title h5">{{$post->limit('title', 55, ' ...')}}</h4>
                                        <a href="{{ $post->url }}" class="btn btn-link link">Читать</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($entity->paginatedItems->count() > 0)
        <div class="blog-popular section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading">
                            <h2>Популярные публикации</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row list">
                            @foreach($entity->paginatedItems->sortByDesc('view')->take(6) as $post)
                                <div class="col-lg-6">
                                    <div class="card popular">
                                        <a href="{{ $post->url }}">
                                            <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{$post->title}}">
                                        </a>
                                        <div class="card-body">
                                            <span class="text-primary">{{ $post->getTags()->count() > 0 ? $post->getTags()->first()['title'] : '' }}</span>
                                            <h4 class="card-title h5">{{$post->title}}</h4>
                                            <a href="{{ $post->url }}" class="btn btn-link link">Читать</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if($entity->paginatedItems->sortByDesc('created_at')->slice(4)->count() > 0)
        <div class="blog-latest section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading">
                            <h2>Последние публикации</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="row list">
                            @foreach($entity->paginatedItems->sortByDesc('created_at')->slice(4)->take(9) as $post)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card latest-new">
                                        <a href="{{ $post->url }}">
                                            <img src="{{ $post->thumbnail }}" class="card-img-top" alt="{{$post->title}}">
                                        </a>
                                        <div class="card-body">
                                            <a href="{{ $post->url }}">
                                                <span class="text-primary">{{ $post->getTags()->count() > 0 ? $post->getTags()->first()['title'] : '' }}</span>
                                                <h3 class="card-title h5">{{$post->title}}</h3>
                                            </a>
                                            <a href="{{ $post->url }}" class="btn btn-link link">Читать</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 pagination-div">
                        {!! str_replace('?page=1', '', $entity->paginatedItems->links()) !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop