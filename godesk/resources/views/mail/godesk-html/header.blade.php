<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@include('godesk::partials.simple-logo', ['width' => '35', 'margin' => 'margin-left:auto;margin-right:auto;margin-bottom: 6px;'])
    {{ $slot }}
</a>
</td>
</tr>
