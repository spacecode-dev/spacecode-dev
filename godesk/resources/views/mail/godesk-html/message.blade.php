@component('godesk::mail.html.layout')
{{-- Header --}}
@slot('header')
@component('godesk::mail.html.header', ['url' => config('app.url')])
GoDesk
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('godesk::mail.html.subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('godesk::mail.html.footer')
© {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
@endcomponent
@endslot
@endcomponent
