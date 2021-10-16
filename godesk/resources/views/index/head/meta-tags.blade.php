<!-- Meta Tags -->
{!! "\t" !!}<title>@yield('metaTitle')</title>
@if(trim($__env->yieldContent('metaDescription')))
{!! "\t" !!}<meta name="description" content="@yield('metaDescription')">
@endif
@if(trim($__env->yieldContent('metaKeywords')))
{!! "\t" !!}<meta name="keywords" content="@yield('metaKeywords')">
@endif
{!! "\t<!-- End Meta Tags -->\n\n" !!}