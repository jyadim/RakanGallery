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
    <div class="grid gap-4 bg-white rounded-lg shadow-lg p-4">
        <!-- Gambar -->
        <div>
            <img class="h-auto max-w-full rounded-lg cursor-pointer" 
                src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" 
                alt="Gambar"
                onclick="openPopup('username123', 'This is a sample description.', 'https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg')">
        </div>
        <!-- Informasi -->
        <div class="mt-2">
            <h2 class="text-lg font-semibold">Username</h2>
            <p class="text-sm text-gray-500">Short description</p>
        </div>
        <!-- Like dan Comment -->
        <div class="mt-4 flex justify-between items-center">
            <!-- Like -->
            <button onclick="handleLike()" class="flex items-center text-gray-700 hover:text-red-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 3.5c-.857 0-1.631.34-2.222.933-.592.592-.933 1.365-.933 2.222 0 .858.34 1.632.933 2.223l4.789 4.788-5.455 5.455c-.39.39-.884.61-1.41.61a2 2 0 01-1.41-.586l-5.364-5.363a2 2 0 010-2.828l5.364-5.364a2 2 0 012.828 0l4.788 4.788c.592.592 1.365.933 2.223.933.857 0 1.631-.341 2.223-.933.592-.592.933-1.366.933-2.223 0-.857-.341-1.63-.933-2.222-.592-.592-1.366-.933-2.223-.933z" />
                </svg>
                <span class="ml-2">Likes</span>
            </button>
        </div>
    </div>
</div>

<!-- Popup -->
<div id="popup" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-3/4 md:w-1/2 relative">
        <!-- Close Button -->
        <button class="absolute top-2 right-2 text-gray-500 hover:text-gray-800" onclick="closePopup()">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Content -->
        <div>
            <img id="popup-image" class="w-full h-auto rounded-lg mb-4" src="" alt="">
            <h2 id="popup-username" class="text-lg font-bold"></h2>
            <p id="popup-description" class="text-sm text-gray-600 mb-4"></p>
            <!-- Like and Comment -->
            <div class="flex justify-between items-center mb-4">
                <button onclick="handleLike()" class="flex items-center text-gray-700 hover:text-red-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.5 3.5c-.857 0-1.631.34-2.222.933-.592.592-.933 1.365-.933 2.222 0 .858.34 1.632.933 2.223l4.789 4.788-5.455 5.455c-.39.39-.884.61-1.41.61a2 2 0 01-1.41-.586l-5.364-5.363a2 2 0 010-2.828l5.364-5.364a2 2 0 012.828 0l4.788 4.788c.592.592 1.365.933 2.223.933.857 0 1.631-.341 2.223-.933.592-.592.933-1.366.933-2.223 0-.857-.341-1.63-.933-2.222-.592-.592-1.366-.933-2.223-.933z" />
                    </svg>
                    <span class="ml-2">Likes</span>
                </button>
                <textarea id="popup-comment" class="w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300" placeholder="Add a comment"></textarea>
                <button onclick="submitComment()" class="ml-4 bg-blue-500 text-white px-4 py-2 rounded-lg">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Open popup
    function openPopup(username, description, imageUrl) {
        document.getElementById('popup').classList.remove('hidden');
        document.getElementById('popup-image').src = imageUrl;
        document.getElementById('popup-username').textContent = username;
        document.getElementById('popup-description').textContent = description;
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