<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Albums</title>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="w-full mb-6 lg:mb-0 flex flex-col items-start gap-4 px-14 lg:px-20 lg:py-16"> <!-- Added padding -->
        <div>
            <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-gray-900">
                {{ $album->album_name }}'s Album
            </h1>
            <div class="h-1 w-60 bg-blue-700 rounded"></div>
        </div>
        <div class="flex flex-col items-start gap-4 mt-6 justify-between">
            <!-- Button to open the create album form -->
            <button id="openFormButton"
                class="flex items-center text-indigo-700 border border-indigo-600 py-2 px-6 gap-2 rounded">
                <span>Add New Photo</span>
                <svg class="w-6 h-6 text-gray-800 dark:text-indigo-700" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4.243a1 1 0 1 0-2 0V11H7.757a1 1 0 1 0 0 2H11v3.243a1 1 0 1 0 2 0V13h3.243a1 1 0 1 0 0-2H13V7.757Z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div id="createAlbumForm" class="hidden mt-4 p-6 bg-white rounded-lg shadow-md w-full max-w-lg mx-auto">
                <form action="{{ route('photo.store', ['slug' => $album->slug]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="photo_title" class="block text-gray-700">Photo Title</label>
                        <input type="text" name="photo_title" id="photo_title" placeholder="Enter Photo Title"
                            class="w-full p-4 border border-indigo-600 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="desc" class="block text-gray-700">Album Desc</label>
                        <input type="text" name="desc" id="desc" placeholder="Enter Album Desc"
                            class="w-full p-4 border border-indigo-600 rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700">Photo</label>
                        <input type="file" name="photo" id="photo" class="w-full p-4 border border-indigo-600 rounded-lg" required>
                    </div>



                    <div class="flex justify-between items-center">
                        <button type="submit" class="py-2 px-6 bg-indigo-600 text-white rounded-lg">Upload
                            Photo</button>
                        <button type="button" id="closeFormButton"
                            class="py-2 px-6 bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Hidden Create Album Form -->


    <!-- JavaScript to toggle form visibility -->
    <script>
        document.getElementById("openFormButton").addEventListener("click", function() {
            document.getElementById("createAlbumForm").classList.remove("hidden");
        });

        document.getElementById("closeFormButton").addEventListener("click", function() {
            document.getElementById("createAlbumForm").classList.add("hidden");
        });
    </script>
    </div>


    <!-- Display Photos or Notification -->
    @if ($album->Photo->isEmpty())
    <div class="text-center py-10">
        <p class="text-lg text-gray-700">No photos available. Please add new photos to display.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-20 py-14">
        @foreach ($album->Photo as $pict)
            <div class="grid gap-4 bg-white rounded-lg shadow-lg p-4">
                <!-- Photo -->
                <div>
                    <img class="h-auto max-w-full rounded-lg cursor-pointer"
                        src="{{ asset('storage/' . $pict->image_path) }}" alt="Photo"
                        onclick="openPopup('{{ $pict->photo_name }}', '{{ $pict->photo_desc ?? 'No description available' }}', '{{ asset('storage/' . $pict->image_path) }}')">
                </div>
                <!-- Info -->
                <div class="mt-2">
                    <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>
                    <p class="text-sm text-gray-500">{{ $pict->photo_desc ?? 'No description available' }}</p>
                </div>
                <!-- Like Button -->
                <!-- Update Button -->
<button onclick="openUpdateForm('{{ $pict->id }}', '{{ $pict->photo_name }}', '{{ $pict->photo_desc }}')"
    class="py-2 px-4 bg-yellow-500 text-white rounded-lg">
    Edit
</button>
<!-- Delete Button -->
<form action="{{ route('photo.destroy', $pict->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this photo?')">
    @csrf
    @method('DELETE')
    <button type="submit" class="py-2 px-4 bg-red-600 text-white rounded-lg">Delete</button>
</form>

<!-- Update Form Modal -->
<div id="updateForm-{{ $pict->id }}" class="hidden mt-4 p-6 bg-white rounded-lg shadow-md w-full max-w-lg mx-auto">
    <form action="{{ route('photo.update', $pict->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="photo_id" value="{{ $pict->id }}">
        <div class="mb-4">
            <label class="block text-gray-700">Photo Title</label>
            <input type="text" name="photo_title" value="{{ $pict->photo_name }}" class="w-full p-4 border border-indigo-600 rounded-lg" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <input type="text" name="desc" value="{{ $pict->photo_desc }}" class="w-full p-4 border border-indigo-600 rounded-lg">
        </div>

        <div class="flex justify-between items-center">
            <button type="submit" class="py-2 px-6 bg-indigo-600 text-white rounded-lg">Update</button>
            <button type="button" onclick="closeUpdateForm('{{ $pict->id }}')" class="py-2 px-6 bg-gray-300 text-gray-700 rounded-lg">Cancel</button>
        </div>
    </form>
</div>
<script>
    function openUpdateForm(id, title, desc) {
        document.getElementById(`updateForm-${id}`).classList.remove("hidden");
    }

    function closeUpdateForm(id) {
        document.getElementById(`updateForm-${id}`).classList.add("hidden");
    }
</script>

            </div>
        @endforeach
    </div>
@endif

</body>

</html>
