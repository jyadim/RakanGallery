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
                    src="{{ asset('storage/' . $pict->image_path) }}" alt="Gambar"
                    onclick="openPopup('{{ $pict->photo_name }}', '{{ $pict->photo_desc }}', '{{ asset('storage/' . $pict->image_path) }}', '{{ $pict->album->user->username }}', '{{ $pict->album->album_name }}')">
            </div>
            <!-- Informasi -->
            <div class="mt-2">
                <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>
                <p class="text-sm text-gray-500">{{ $pict->photo_desc }}</p>
            </div>
            <!-- Like dan Comment -->
            <div class="mt-4 flex justify-between items-center">
                <!-- Like -->
                <button onclick="handleLike()" class="flex items-center text-gray-700 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                </button>
            </div>
        </div>
    @endforeach
    

    <!-- Popup -->
    <div id="popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center overflow-y-auto">
        <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 md:w-1/2 relative max-h-[90vh] overflow-y-auto">
            <!-- Close Button -->
            <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closePopup()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <!-- Content -->
            <div>
                <img id="popup-image" class="w-full h-auto rounded-lg mb-4" src="" alt="">
                <div class="flex items-center justify-between">
                    <!-- Username -->
                    <h2 id="popup-title" class="text-lg font-bold">Title</h2>
                    <!-- Like Button -->
                    <button onclick="handleLike()" class="flex items-center text-gray-700 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                </div>
    
                <p id="popup-description" class="text-sm text-gray-600 mb-1"></p>
                <span id="popup-username"
                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-4 inline-block">
                    Default
                </span>
                <span id="popup-album"
                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 mb-4 inline-block">
                    Default
                </span>
    
                <div class="flex justify-between items-center mb-6 mt-6">
                    <textarea id="popup-comment" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300"
                        placeholder="Add a comment"></textarea>
                    <button onclick="submitComment()" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Open popup
        function openPopup(title, description, imageUrl, username, album) {
            document.getElementById('popup').classList.remove('hidden');
            document.getElementById('popup-image').src = imageUrl;
            document.getElementById('popup-title').textContent = title;
            document.getElementById('popup-description').textContent = description;
            document.getElementById('popup-username').textContent = username;
            document.getElementById('popup-album').textContent = album;
        }

        // Close popup
        function closePopup() {
            document.getElementById('popup').classList.add('hidden');
        }

        // Like handler
        function handleLike() {
            console.log('Image liked!');
        }

        // Submit comment
        function submitComment() {
            const comment = document.getElementById('popup-comment').value;
            console.log(`Comment submitted: ${comment}`);
            // Logic for submitting comment to backend
        }
    </script>


</body>

</html>
