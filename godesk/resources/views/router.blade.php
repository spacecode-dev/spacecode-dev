@extends('godesk::layout')

@section('content')
    <loading ref="loading"></loading>

    <fade-transition>
        <router-view :key="$route.name + ($route.params.resourceName || '')"></router-view>
    </fade-transition>

    <portal-target name="modals" transition="fade-transition"></portal-target>
    <portal-target name="dropdowns" transition="fade-transition"></portal-target>
@endsection
