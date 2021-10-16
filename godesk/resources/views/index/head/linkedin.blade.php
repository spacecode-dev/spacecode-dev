@if($settings->tracking->linkedin)
<!-- LinkedIn Insight Tag -->
{!! "<script type='text/javascript'>\n" !!}
{!! "_linkedin_partner_id = " . $settings->tracking->linkedin . ";\n" !!}
{!! "window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];\n" !!}
{!! "window._linkedin_data_partner_ids.push(_linkedin_partner_id);\n" !!}
{!! "</script>\n" !!}
{!! "<script type='text/javascript'>\n" !!}
{!! "(function(){var s = document.getElementsByTagName('script')[0];\n" !!}
{!! "var b = document.createElement('script');\n" !!}
{!! "b.type = 'text/javascript';b.async = true;\n" !!}
{!! "b.src = 'https://snap.licdn.com/li.lms-analytics/insight.min.js';\n" !!}
{!! "s.parentNode.insertBefore(b, s);})();\n" !!}
{!! "</script>\n" !!}
{!! "<noscript>\n" !!}
{!! "<img height='1' width='1' style='display:none;' alt='' src='https://px.ads.linkedin.com/collect/?pid=3445161&fmt=gif' />\n" !!}
{!! "</noscript>\n" !!}
@endif