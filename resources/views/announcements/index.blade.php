<x-layout>
<x-hero />
@include("partials._search")

<div class="grid lg:grid-cols-3 md:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
@unless (count($announcements) === 0)
  @foreach ( $announcements as $announcement )
    <x-announcement-card :announcement="$announcement"></x-announcement-card>
  @endforeach
@else
    <p>No Announcements Found!!!</p>
@endunless
</div>
<div class="mt-6 p-4">{{ $announcements->links() }}</div>
</x-layout>