<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KennGallery</title>
</head>

<body>
    <x-navbar></x-navbar>



    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-20 py-14">
        @foreach ($photos as $pict)
            <div class="bg-white rounded-lg shadow-lg p-4 inline-block h">
                <!-- Gambar -->
                <a href="{{ route('detail.photo', ['slug' => $pict->slug]) }}">
                    <div>
                        <img class="h-auto max-w-full rounded-lg cursor-pointer"
                            src="{{ asset('storage/' . $pict->image_path) }}" alt="Gambar">
                    </div>
                    <!-- Informasi -->
                    <div class="mt-2 flex justify-between items-center">
                        <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>

                        <div class="flex items-center space-x-4">
                            <!-- Like Button -->
                            <form action="{{ route('photo.like', $pict->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center {{ auth()->user() && $pict->like->where('user_id', auth()->id())->count() ? 'text-red-500' : 'text-gray-700' }} hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                        2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09
                                        3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4
                                        6.86-8.55 11.54L12 21.35z"
                                            @if (auth()->user() && $pict->like->where('user_id', auth()->id())->count()) fill="currentColor" @endif />
                                    </svg>
                                    <span class="ml-1 text-sm font-medium">{{ $pict->like->count() }}</span>
                                </button>
                            </form>

                            <!-- Comment Count -->
                            <div class="flex items-center text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 mr-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 10h.01M12 10h.01M16 10h.01M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z" />
                                </svg>

                                <span class="text-sm font-medium">
                                    {{ $comments->where('photo_id', $pict->id)->count() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Deskripsi Foto -->
                    <p class="text-sm text-gray-500 mt-2">{{ $pict->photo_desc }}</p>

                    <!-- User Information -->
                    <div class="flex items-center space-x-4 mt-4 mb-4">
                        <img src="{{ $pict->user->image_path ? asset('storage/' . old('image_path', $pict->user->image_path)) : asset('storage/profiles/Shoyo Hinata.jpg') }}"
                            alt="User Avatar" class="w-10 h-10 rounded-full object-cover">

                        <div class="flex-1">
                            <div class="text-sm font-semibold text-gray-800">
                                {{ $pict->user->username }}
                            </div>
                            <div class="text-xs text-gray-500">
                                <i class="fa fa-clock"></i> {{ $pict->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach


        <!-- Popup -->

</body>

</html>
