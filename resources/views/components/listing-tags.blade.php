@props(["tagsCsv"])

@php
    $tags = explode(",", $tagsCsv);
@endphp

<ul class="flex my-4">
    @foreach($tags as $tag)
    <li>
        <a href="{{ route('home') }}?tag={{ $tag }}" class="bg-black text-white rounded-xl px-3 py-1 mr-2">{{ $tag }}</a>
    </li>
    @endforeach
</ul>
