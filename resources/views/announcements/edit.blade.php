<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-1">
                Edit an Announcement
            </h2>
            <p class="mb-4">Edit an Announcement</p>
        </header>

        <form method="POST" action="{{ route('announcement-update', ['announcement'=>$announcement->id]) }}" enctype="multipart/form-data">
            @CSRF
            @method("PUT")
            <div class="mb-6">
                <label for="title" class="inline-block text-lg mb-2"
                    >Title</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="title"
                    id="title"
                    value="{{ old('title', $announcement->title) }}"
                />
                @error("title")
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="school"
                    class="inline-block text-lg mb-2"
                    >School</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="school"
                    id="school"
                    value="{{ old('school', $announcement->school) }}"
                />
                @error("school")
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="inline-block text-lg mb-2"
                    >Contact Email</label
                >
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="email"
                    id="email"
                    value="{{ old('email', $announcement->email) }}"
                />
                @error("email")
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">
                <label for="tags" class="inline-block text-lg mb-2">
                    Tags (Comma Separated)
                </label>
                <input
                    type="text"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="tags"
                    id="tags"
                    placeholder="Example: Laravel, Backend, Postgres, etc"
                    value="{{ old('tags', $announcement->tags) }}"
                />
                @error("tags")
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="logo" class="inline-block text-lg mb-2">
                    Company Logo
                </label>
                <input
                    type="file"
                    class="border border-gray-200 rounded p-2 w-full"
                    name="logo"
                    value="{{ old('logo', $announcement->logo) }}"
                />
                <p><img src="/Storage/{{ $announcement->logo }}" alt=""></p>
                @error("logo")
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label
                    for="description"
                    class="inline-block text-lg mb-2"
                >
                    Job Description
                </label>
                <textarea
                    class="border border-gray-200 rounded p-2 w-full"
                    name="description"
                    rows="10"
                    id="description"
                >{{ old('description', $announcement->description) }}</textarea>
                @error("description")
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

            </div>

            <div class="mb-6">
                <button
                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                >
                    Update
                </button>

                <a href="{{ route('backToProperListing') }}" class="text-black ml-4"> Back </a>
            </div>
        </form>
    </x-card>
</x-layout>