<x-layout>
@include("partials._search")

<div class="mx-4 relative">            
    <div class="absolute top-1 left-1 flex space-x-5">
        <a href="{{ route('backToProperListing') }}" class="p-4 text-white rounded-lg bg-laravel hover:opacity-60">
        <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        @if (Auth()->id() == $announcement->user_id)
            <a href="/announcements/{{ $announcement->id}}/edit" class="bg-black text-white p-4 rounded-lg hover:opacity-60">
                <i class="fa-solid fa-pencil"></i> Edit
            </a>
            <a href="/announcements/{{ $announcement->id}}/delete" class="text-red-500 p-4">
                <i class="fa-solid fa-pencil"></i> Delete
            </a>
        @endif
    </div>
    <x-card class="p-10">
        <div
            class="flex flex-col items-center justify-center"
        >
            <img
                class="w-48 mr-6 mb-6"
                src={{ asset($announcement->logo ? "storage/".$announcement->logo : "images/no-image.png") }}
                alt=""
            />

            <h3 class="text-2xl mb-2">{{ $announcement->title }}</h3>
            <div class="text-xl font-bold mb-4">{{ $announcement->school }}</div>
            <x-listing-tags :tagsCsv="$announcement->tags" />
            <div class="border border-gray-200 w-full mb-6"></div>
            <div>
                <h3 class="text-3xl font-bold mb-4 text-center">
                    Description
                </h3>
                <div class="text-lg space-y-6">
                    {{ $announcement->description }}
                </div>
                <div class="text-center">
                    <a
                        href="mailto:test@test.com"
                        class="inline-block bg-laravel text-white mt-6 p-4 rounded-xl hover:opacity-80"
                        ><i class="fa-solid fa-envelope"></i>
                        {{ $announcement->email }}</a
                    >
                </div>
            </div>
        </div>
    </x-card>
</div>
</x-layout>
