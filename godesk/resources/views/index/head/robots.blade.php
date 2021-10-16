<!-- Robots -->
@if(!get_setting('hide_from_index'))
{!! "\t" !!}<meta name="robots" content="@yield('robotsAll')">
{!! "\t" !!}<meta name="googlebot" content="@yield('robotsGoogle')">
{!! "\t" !!}<meta name="yandex" content="@yield('robotsYandex')">
{!! "\t" !!}<meta name="bingbot" content="@yield('robotsBing')">
{!! "\t" !!}<meta name="duckduckbot" content="@yield('robotsDuck')">
{!! "\t" !!}<meta name="baiduspider" content="@yield('robotsBaidu')">
{!! "\t" !!}<meta name="slurp" content="@yield('robotsYahoo')">
@else
{!! "\t" !!}<meta name="robots" content="noindex, nofollow">
@endif
{!! "\t<!-- End Robots -->\n\n" !!}