<body id="wrapper__body" class="{{body_class($entity)}}">
{!! "\t" !!}@include('godesk::index.head.gtm-body')
@include('godesk-index::header', ['entity' => $entity])
{!! "\t" !!}<div id="wrapper__content">@if (trim($__env->yieldContent('content')))@yield('content')@endif</div>
@include('godesk-index::footer', ['entity' => $entity])
@include('godesk-index::inc.js')
@if (trim($__env->yieldContent('js')))@yield('js')@endif
</body>
