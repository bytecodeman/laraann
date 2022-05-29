<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Edit/View a User
        </h2>
    </header>

    <form method="POST" action="{{ route('user-update', ["user"=>$user->id]) }}">
        @CSRF
        @method("PUT")

        <div class="mb-6">
            <label for="name" class="inline-block text-lg mb-2">
                Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name"
                id="name"
                value="{{ old('name', $user->name) }}"
            />
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Email</label
            >
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                id="email"
                value="{{ old('email', $user->email) }}"
            />
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-6">
            <input
            type="checkbox"
            name="isAdmin"
            id="isAdmin"
            value="isAdmin"
            {{ $user->isAdmin ? 'checked=checked' : '' }}
            />
            <label for="isAdmin" class="text-lg">Is Admin?</label>
        </div>

        <div class="mb-6">
            <label
                for="password"
                class="inline-block text-lg mb-2"
            >
                Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
                id="password"
                value=""
            />
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    
        <div class="mb-6">
            <label
                for="password_confirmation"
                class="inline-block text-lg mb-2"
            >
                Confirm Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password_confirmation"
                id="password_confirmation"
                value=""
            />
            @error('password_confirmation')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    
    
        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Update User
            </button>

            <a href="{{ route('users-manage') }}" class="text-black ml-4"> Back </a>
        </div>
    </form>
    </x-card>
</x-layout>