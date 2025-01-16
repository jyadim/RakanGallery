<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Document</title>
</head>

<body>
    <x-navbar></x-navbar>
    <div class="flex items-center justify-center p-4 mt-16">


        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full overflow-hidden transition-all duration-300 hover:shadow-indigo-500/50 dark:hover:shadow-blue-900/50">
            <div class="relative h-32 bg-gradient-to-r from-indigo-600 to-blue-700">
                <img src="https://i.pravatar.cc/300" alt=""
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 transition-transform duration-300 hover:scale-105">
            </div>
            <div class="pt-16 pb-6 px-6 text-center">
                @foreach ($profile as $item)
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">{{ $item->name }}</h1>
                    <p class="text-indigo-600 dark:text-indigo-400 font-semibold mb-4">{{$item->username}}</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">Passionate about creating user-friendly web
                        applications and solving complex problems.</p>
                @endforeach
                <div class="px-16 flex items-center gap-x-2">
                    <!-- Form untuk Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                            Logout
                        </button>
                    </form>
                
                    <!-- Tombol Edit Profile -->
                    <a href="">
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Edit Profile
                        </button>
                    </a>
                </div>
                

            </div>
        </div>
    </div>

    <x-album></x-album>
</body>

</html>
