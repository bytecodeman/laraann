<x-layout>
    <div class="mx-4"> 
        <x-card class="p-10 mx-auto">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Delete an Announcement
                </h2>
            </header>
                <div class="flex space-x-5 my-5 justify-center items-center">
                    <span class="text-2xl font-bold">Are you sure you want to delete this announcement?</span>
                    <a href="{{ route('backToProperListing') }}" class="py-2 px-6 text-white rounded-lg bg-laravel hover:opacity-60">No</a>
                    <form class="in-line p-4 rounded-lg hover:opacity-60" method="POST" action="/announcements/{{ $announcement->id }}">
                        @csrf
                        @method("DELETE")
                        <button class="text-red-500"><i class="fa-solid fa-trash"></i> Yes - Delete</button>
                    </form>
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
                    </div>
                </div>
            </x-card>
        </x-card>
    </div>
</x-layout>