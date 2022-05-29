<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <link rel="icon" href="images/favicon_io/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
        <link rel="manifest" href="images/site.webmanifest">

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#5dade2",
                        },
                    },
                },
            };
        </script>
        <title>LaraAnn | Announcements Manager</title>
    </head>
    <body>
        <nav class="flex justify-between items-center mb-1">
            <a href="/" class="bg-laravel py-8 px-4 text-4xl font-bold uppercase text-white">Announcements</a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                    <li><span class="font-bold uppercase">Welcome {{ (auth()->user()->isAdmin() ? "ADMIN " : "") . auth()->user()->name }}</span></li>
                    @if (auth()->user()->isAdmin)
                        <li>
                            <a href="{{ route("users-manage") }}">Users</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route("announcements-manage") }}" class="hover:text-laravel"
                                ><i class="fa-solid fa-gear"></i> Manage</a
                            >
                        </li>
                    @endif                    
                    <li>
                    <form class="inline" method="POST" action="{{ route("user-logout") }}">
                        @csrf
                        <button><i class="fa-solid fa-door-closed"></i> Logout</button></form>
                    </li> 
                @else
                    <li>
                        <a href="{{ route("user-register") }}" class="hover:text-laravel"
                            ><i class="fa-solid fa-user-plus"></i> Register</a
                        >
                    </li>
                    <li>
                        <a href="{{ route("user-login-form") }}" class="hover:text-laravel"
                            ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                            Login</a
                        >
                    </li> 
                @endauth
            </ul>
        </nav>
        <main>
            {{ $slot }}
        </main>
        <footer
            class="sticky bottom-0 left-0 w-full flex flex-col gap-y-10 items-center p-10 justify-start font-bold bg-laravel text-white mt-12 opacity-80 md:justify-end md:flex-row md:gap-x-24"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

            <a
                href="/announcements/create"
                class="top-1/3 right-10 bg-black text-white py-2 px-5"
                >Post Announcement</a
            >
        </footer>
        <x-flash-message message="message"></x-flash-message>
        <script src="//unpkg.com/alpinejs" defer></script>
    </body>
</html>
