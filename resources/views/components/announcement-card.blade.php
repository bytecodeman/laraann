@props(['announcement'])

<x-card>
    <div class="flex flex-row">
        <a href="/announcements/{{ $announcement->id }}" class="hidden max-w-[20%] h-auto object-contain object-top mr-4 md:block"><img
               src={{ asset($announcement->logo ? "storage/".$announcement->logo : "images/no-image.png") }}
            alt=""
        /></a>
        <div>
            <h3 class="text-2xl">
                <a href="/announcements/{{ $announcement->id }}">{{ $announcement->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $announcement->school }}</div>
            <div>Posted by: {{ $announcement->user->name }}</div>
            <x-listing-tags :tagsCsv="$announcement->tags" />
            <div class="mb-5">
                @if (auth()->user()->isAdmin || Auth()->id() == $announcement->user_id)
                    <a href="/announcements/{{ $announcement->id}}/edit" class="bg-black text-white  px-3 py-1 rounded-lg hover:opacity-60">
                        <i class="fa-solid fa-pencil"></i> Edit
                    </a>
                    <a href="/announcements/{{ $announcement->id}}/delete" class="text-red-500 px-3 py-1">
                        <i class="fa-solid fa-trash"></i> Delete
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-card>
