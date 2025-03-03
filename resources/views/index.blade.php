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

    <!-- Dropdown Filter -->
    <div class="flex flex-wrap justify-start mt-6 px-4 md:px-20 space-x-3">
        <!-- Filter: Latest Photo -->
        <a href="?filter=latest"
            class="py-2 px-4 shadow-md no-underline rounded-full font-sans font-semibold text-sm border border-blue transition-colors duration-300
                  {{ request('filter') == 'latest' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700 hover:bg-blue-700 hover:text-white' }}">
            Newest Photo
        </a>

        <!-- Filter: Most Like -->
        <a href="?filter=most_like"
            class="py-2 px-4 shadow-md no-underline rounded-full font-sans font-semibold text-sm border border-blue transition-colors duration-300
                  {{ request('filter') == 'most_like' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700 hover:bg-blue-700 hover:text-white' }}">
            Most Like
        </a>

        <!-- Filter: Most Comments -->
        <a href="?filter=most_comments"
            class="py-2 px-4 shadow-md no-underline rounded-full font-sans font-semibold text-sm border border-blue transition-colors duration-300
                  {{ request('filter') == 'most_comments' ? 'bg-blue-700 text-white' : 'bg-white text-gray-700 hover:bg-blue-700 hover:text-white' }}">
            Most Comments
        </a>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-20 py-14">
        @foreach ($photos as $pict)
            <div
                class="bg-white rounded-lg shadow-lg p-4 transition-transform transform hover:scale-105 hover:shadow-2xl">
                @if (auth()->check())
                    <a href="{{ route('detail.photo', ['slug' => $pict->slug]) }}">
                    @else
                        <a href="{{ route('guest.detail.photo', ['slug' => $pict->slug]) }}">
                @endif
                <!-- Gambar -->
                <div>
                    <img class="h-auto max-w-full rounded-lg cursor-pointer"
                        src="{{ asset('storage/' . $pict->image_path) }}" alt="Gambar">
                </div>

                <!-- Informasi -->
                <div class="mt-2 flex justify-between items-center">
                    <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>
                    <div class="flex items-center space-x-4">
                        <!-- Like Button -->
                        <!-- Like Button -->
                        @if (auth()->check())
                            <form action="{{ route('photo.like', $pict->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="flex items-center {{ auth()->user() && $pict->likes->where('user_id', auth()->id())->count() ? 'text-red-500' : 'text-gray-700' }} hover:text-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
            2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09
            3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4
            6.86-8.55 11.54L12 21.35z" @if (auth()->user() && $pict->likes->where('user_id', auth()->id())->count()) fill="currentColor" @endif />
                                    </svg>
                                    <span class="ml-1 text-sm font-medium">{{ $pict->likes->count() }}</span>
                                </button>
                            </form>
                        @else
                            <button class="flex items-center text-gray-700 cursor-not-allowed opacity-50"
                                title="Login to like">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5
                                            2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09
                                            3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4
                                            6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <span class="ml-1 text-sm font-medium">{{ $pict->likes->count() }}</span>
                            </button>
                        @endif

                        <!-- Comment Count -->
                        <div class="flex items-center text-gray-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
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
                    <img src="{{ $pict->user->image_path ? asset('storage/' . old('image_path', $pict->user->image_path)) : asset('storage/profiles/default.jpg') }}"
                        alt="User Avatar" class="w-10 h-10 rounded-full object-cover">

                    <div class="flex-1">
                        <div class="text-sm font-semibold text-gray-800">
                            {{ $pict->user->username }}
                        </div>
                        <div class="text-xs text-gray-500">
                            <i class="fa fa-clock"></i>
                            @if ($pict->created_at->diffInDays(now()) > 2)
                                {{ $pict->created_at->format('d M Y') }}
                            @else
                                {{ $pict->created_at->diffForHumans() }}
                            @endif
                        </div>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
    </div>

    <!-- JavaScript untuk Filter -->
    <script>
        document.getElementById('filterDropdown').addEventListener('change', function() {
            let filter = this.value;
            window.location.href = `?filter=${filter}`;
        });
    </script>

</body>

</html>
