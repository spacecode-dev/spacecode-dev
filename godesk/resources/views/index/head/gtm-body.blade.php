@if($settings->tracking->gtm)
<!-- Google Tag Manager (noscript) -->
{!! "\t<noscript><iframe src='https://www.googletagmanager.com/ns.html?id=" . $settings->tracking->gtm . "' height='0' width='0' style='display:none;visibility:hidden'></iframe></noscript>" !!}
{!! "\t<!-- End Google Tag Manager (noscript) -->\n" !!}
@endif