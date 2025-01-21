<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <x-navbar></x-navbar>



    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-20 py-14">
        @foreach ($photos as $pict)
            <div class="bg-white rounded-lg shadow-lg p-4 inline-block h">
                <!-- Gambar -->
                <div>
                        <img class="h-auto max-w-full rounded-lg cursor-pointer"
                            src="{{ asset('storage/' . $pict->image_path) }}" alt="Gambar">
                </div>
                <!-- Informasi -->
                <div class="mt-2">
                    <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>
                    <p class="text-sm text-gray-500">{{ $pict->photo_desc }}</p>
                </div>
                <!-- Like dan Comment -->
                <div class="mt-4 flex justify-between items-center mb-3">
                    <!-- Like Button -->
                    <form action="{{ route('photo.like', $pict->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center {{ auth()->user() && $pict->like->where('user_id', auth()->id())->count() ? 'text-red-500' : 'text-gray-700' }} hover:text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 
                                    2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 
                                    3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 
                                    6.86-8.55 11.54L12 21.35z" 
                                    @if(auth()->user() && $pict->like->where('user_id', auth()->id())->count())
                                    fill="currentColor"
                                    @endif />
                            </svg>
                            <span class="ml-2">{{ $pict->like->count() }}</span>
                        </button>
                    </form>
                    
                
                    <!-- Comment Count -->
                    <div class="flex items-center text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" 
                            class="w-5 h-5 text-gray-500 mr-1" 
                            fill="none" 
                            viewBox="0 0 24 24" 
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M8 10h.01M12 10h.01M16 10h.01M9 21h6a2 2 0 002-2v-1
                                a4 4 0 00-4-4H9a4 4 0 00-4 4v1a2 2 0 002 2zM15 5a3 3 
                                0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-sm font-medium">{{ $comments->count() }} Comments</span>
                    </div>
                </div>
                
                
                <a href="{{ route('detail.photo', ['slug' => $pict->slug]) }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    View Photo
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            </div>
        @endforeach


        <!-- Popup -->

</body>

</html>
