<!-- Meta -->
{!! "\t" !!}<meta charset="utf-8">
{!! "\t" !!}<meta name="viewport" content="width=device-width, initial-scale=1.0">
{!! "\t" !!}<meta http-equiv="content-type" content="text/html; charset=UTF-8">
{!! "\t" !!}<meta name="author" content="{{ get_locale_setting('website_title') ?? 'SpaceCode' }}">
{!! "\t" !!}<link rel="author" href="{{ url('') }}">
{!! "\t" !!}<link rel="me" href="https://spacecode.dev">
{!! "\t" !!}<meta name="csrf-token" content="{{ csrf_token() }}">
@if(trim($__env->yieldContent('parent')))
{!! "\t" !!}<link rel="up" href="@yield('parent')">
@endif
@if(trim($__env->yieldContent('paginationFirst')))
{!! "\t" !!}<link rel="first" href="@yield('paginationFirst')">
@endif
@if(trim($__env->yieldContent('paginationLast')))
{!! "\t" !!}<link rel="last" href="@yield('paginationLast')">
@endif
@if(trim($__env->yieldContent('paginationNext')))
{!! "\t" !!}<link rel="next" href="@yield('paginationNext')">
@endif
@if(trim($__env->yieldContent('paginationPrev')))
{!! "\t" !!}<link rel="prev" href="@yield('paginationPrev')">
@endif
{!! "\t" !!}<link rel="canonical" href="{{ url()->current() }}"/>
{!! "\t<!-- End Meta -->\n\n" !!}