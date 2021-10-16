@include('godesk::index.inc.slot')
@extends('godesk::index.index')
@section('content')
    {!! $entity->content !!}
@stop
