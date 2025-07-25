<textarea {!! $attributes->merge(['class' => 'bg-gray border-gray-300 focus:border-indigo-500 focus:right-indigo-500 rounded-md shadow-sm resize-none'])!!}>
    {{-- //contenido variable  el slot--}}
    {{$slot}}
</textarea>