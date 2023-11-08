<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/favicon.ico">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700&family=Roboto:wght@300;400;500;700;900&display=swap"
        rel="stylesheet">


    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <script src="//unpkg.com/alpinejs" defer></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>

<body>

    <nav class="flex justify-between items-center mb-4">
        <a href="/">
            <img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo" />
        </a>
        <ul class="flex space-x-6 mr-6 text-lg">

            @auth
                <li>
                    <span class="font-bold uppercase text-laravel">
                        Welcome {{ auth()->user()->name }}
                    </span>
                </li>
                <li>
                    <a href="/listings/manage" class="hover:text-laravel">
                        <i class="fa-solid fa-gear"></i> Manage Listings
                    </a>
                </li>

                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="hover:text-laravel">
                        <i class="fas fa-door-closed"></i> Logout
                    </button>
                </form>
            @else
                <li>
                    <a href="/register" class="hover:text-laravel">
                        <i class="fa-solid fa-user-plus"></i> Register
                    </a>
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                    </a>
                </li>
            @endauth

        </ul>
    </nav>

    <main>
        {{-- @yield('content') --}}
        {{ $slot }}
    </main>



    <footer
        class="relative w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Post Job</a>
    </footer>

    <x-flash-message />

</body>

</html>
