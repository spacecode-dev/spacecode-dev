<!-- CSS -->
{!! "\t" !!}@include('godesk-index::inc.css')
@if(trim($__env->yieldContent('css')))
{!! "\t" !!}@yield('css')
@endif
{!! "\t<!-- End CSS -->\n\n" !!}