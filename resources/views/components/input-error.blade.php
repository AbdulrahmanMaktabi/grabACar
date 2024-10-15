@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 space-y-1']) }} style="list-style:none; padding: 0px">
        @foreach ((array) $messages as $message)
            <li style="color: red">{{ $message }}</li>
        @endforeach
    </ul>
@endif
