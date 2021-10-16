@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    <div class="title section">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ GoDesk::urlById('page', 1, $entity->locale) }}">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $entity->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-12">
                    <div class="heading text-center">
                        <p class="pre h6">Мы SpaceCode</p>
                        <h1>Наши последние работы</h1>
                        <p>Посмотрите, что мы можем создать вместе, плечо к плечу. Отличное общение и хорошо выстроенные процессы - ключ к миру идеально согласованных проектов.</p>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row list">
                        @foreach($entity->paginatedItems->sortByDesc('created_at') as $portfolio)
                            <div class="col-lg-4 col-md-6">
                                <div class="card latest">
                                    <a href="{{ $portfolio->url }}">
                                        <img src="{{ $portfolio->thumbnail }}" class="card-img-top" alt="{{ $portfolio->title }}">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{ $portfolio->url }}">
                                            <h3 class="card-title h5">{{ $portfolio->title }}</h3>
                                        </a>
                                        <a href="{{ $portfolio->url }}" class="btn btn-link link">Подробнее</a>
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
@stop

@section('css')
    {{----}}
@stop

@section('js')
    {{----}}
@stop