<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @vite('resources/css/app.css')

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KennGallery</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://preline.co/assets/js/hs-apexcharts-helpers.js"></script>

</head>

<body>
    <x-navbar></x-navbar>
    <!-- Legend Indicator -->

    <!-- End Legend Indicator -->


    <div class="w-full mb-6 lg:mb-0 flex flex-col items-start gap-4 px-20 lg:px-20 lg:py-6"> <!-- Added padding -->
        <div>
            @if (Session::has('success'))
                <div class="bg-blue-700 text-white p-3 rounded mt-4 mb-2">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
                <div class="bg-red-500 text-white p-3 rounded mt-4 mb-2">
                    {{ Session::get('error') }}
                </div>
            @endif
            <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-gray-900">
                {{ $album->album_name }}'s Album
            </h1>
            <div class="h-1 w-60 bg-blue-700 rounded"></div>
        </div>

        <div class="flex flex-col items-start gap-4  justify-between">
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
                            class="w-full p-4 border border-indigo-600 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="desc" class="block text-gray-700">Album Desc</label>
                        <input type="text" name="desc" id="desc" placeholder="Enter Album Desc"
                            class="w-full p-4 border border-indigo-600 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="photo" class="block text-gray-700">Photo</label>
                        <input type="file" name="photo" id="photo"
                            class="w-full p-4 border border-indigo-600 rounded-lg" required>
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

    {{-- <div class="flex justify-center sm:justify-end items-center gap-x-4 mb-3 sm:mb-6 px-10 py-8">
        <div class="inline-flex items-center">
            <span class="size-2.5 inline-block bg-blue-600 rounded-sm me-2"></span>
            <span class="text-[13px] text-gray-600">
                Like
            </span>
        </div>
        <div class="inline-flex items-center">
            <span class="size-2.5 inline-block bg-purple-600 rounded-sm me-2"></span>
            <span class="text-[13px] text-gray-600">
                Comment
            </span>
        </div>
    </div>
    <div id="hs-multiple-area-charts"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'area',
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                series: [{
                        name: 'Income',
                        data: [18000, 51000, 60000, 38000, 88000, 50000, 40000, 52000, 88000, 80000, 60000,
                            70000
                        ]
                    },
                    {
                        name: 'Outcome',
                        data: [27000, 38000, 60000, 77000, 40000, 50000, 49000, 29000, 42000, 27000, 42000,
                            50000
                        ]
                    }
                ],
                xaxis: {
                    categories: [
                        '25 Jan', '26 Jan', '27 Jan', '28 Jan', '29 Jan', '30 Jan', '31 Jan',
                        '1 Feb', '2 Feb', '3 Feb', '4 Feb', '5 Feb'
                    ]
                }
            };

            var chart = new ApexCharts(document.querySelector("#hs-multiple-area-charts"), options);
            chart.render();
        });
    </script> --}}
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
    @if ($photos->isEmpty())
        <div class="text-center py-10">
            <p class="text-lg text-gray-700">No photos available. Please add new photos to display.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-20 py-2">
            @foreach ($photos as $pict)
                <div class="grid gap-4 bg-white rounded-lg shadow-lg p-4">
                    <div>
                        <img class="h-auto max-w-full rounded-lg cursor-pointer"
                            src="{{ asset('storage/' . $pict->image_path) }}" alt="Photo">
                    </div>
                    <div class="mt-2">
                        <h2 class="text-lg font-semibold">{{ $pict->photo_name }}</h2>
                        <p class="text-sm text-gray-500">{{ $pict->photo_desc ?? 'No description available' }}</p>
                    </div>
                    <div class="flex space-x-6">
                        <button
                            onclick="openUpdateForm('{{ $pict->id }}', '{{ $pict->photo_name }}', '{{ $pict->photo_desc }}')"
                            class="py-2 px-4 w-28 bg-yellow-500 text-white rounded-lg">Edit</button>

                        <form action="{{ route('photo.destroy', $pict->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this photo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="py-2 px-4 w-28 bg-red-600 text-white rounded-lg">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 mb-8 flex justify-center">
            {{ $photos->links() }}
        </div>
    @endif



</body>

</html>
