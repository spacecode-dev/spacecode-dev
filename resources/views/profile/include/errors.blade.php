@if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('name'))
            {{ $errors->first('name') }}
        @elseif ($errors->has('email'))
            {{ $errors->first('email') }}
        @elseif ($errors->has('password'))
            {{ $errors->first('password') }}
        @endif
    </p>
@endif