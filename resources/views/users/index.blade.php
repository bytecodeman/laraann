<x-layout>
    <div class="bg-gray-50 border border-gray-200 p-10 rounded  w-[60%] mx-auto">
    <header class="relative flex-col gap-4 md:flex-row md:justify-between">
        <h1 class="text-3xl text-center font-bold my-6 uppercase">
            Users
        </h1>
        <a href="{{ route("user-create") }}" class="absolute right-0 top-0 px-4 py-2 text-white rounded-lg bg-laravel hover:opacity-60">Create User</a>
    </header>

    <table class="table-auto rounded-sm w-full">
        <tbody>
            @foreach($users as $user)
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg {{ $user->isAdmin ? 'text-red-700 font-bold' : '' }}"
                >
                    {{ $user->name }}
                    </td>
                <td
                class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                
                    {{ $user->email }}
              
            </td>
            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                <a
                href="{{ route("user-edit", ["user" => $user->id]) }}"
                class="text-blue-400 px-6 py-2 rounded-xl"
                ><i
                    class="fa-solid fa-pen-to-square"
                ></i>
                Edit</a
                >
                </td>            
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <form method="POST" action="{{ route("user-delete", ['user' => $user->id]) }}">
                        @CSRF
                        @method("DELETE")
                        <button class="text-red-600">
                            <i
                                class="fa-solid fa-trash-can"
                            ></i>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</x-layout>