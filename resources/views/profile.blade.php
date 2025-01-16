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
        @foreach ($profile as $item)
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full overflow-hidden transition-all duration-300 hover:shadow-indigo-500/50 dark:hover:shadow-blue-900/50">
            <div class="relative h-32 bg-gradient-to-r from-indigo-600 to-blue-700">
                <img src="{{ asset('storage/'.$item->image_path) }}" alt=""
                    class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 w-24 h-24 rounded-full border-4 border-white dark:border-gray-800 transition-transform duration-300 hover:scale-105">
            </div>
            <div class="pt-16 pb-6 px-6 text-center">
               
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-1">{{ $item->name }}</h1>
                    <p class="text-indigo-600 dark:text-indigo-400 font-semibold mb-4">{{$item->username}}</p>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">{{$item->status}}</p>
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
                    <!-- Button to Trigger Modal -->
<button type="button" 
class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
onclick="toggleModal()">
Edit Profile
</button>

<!-- Modal -->
<div id="editModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">

    
    <!-- Edit Profile Form -->

        <form action="{{route('edit.profile.proccess')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <section class="py-16 my-auto dark:bg-gray-900">
                <div class="lg:w-[80%] md:w-[90%] xs:w-[96%] mx-auto flex gap-4">
                    <div class="lg:w-[88%] md:w-[80%] sm:w-[88%] xs:w-full mx-auto shadow-2xl p-4 rounded-xl h-fit self-center dark:bg-gray-800/40">
                        <h1 class="lg:text-3xl md:text-2xl sm:text-xl xs:text-xl font-serif font-extrabold mb-2 dark:text-white">
                            Profile
                        </h1>
                        <h2 class="text-grey text-sm mb-4 dark:text-gray-400">Edit Profile</h2>
        
                        <!-- Profile and Cover Image -->
                        <div class="w-full rounded-sm relative h-32 bg-gradient-to-r from-indigo-600 to-blue-700 bg-cover bg-center bg-no-repeat items-center">
                            <!-- Profile Image -->
                            <div class="mx-auto flex justify-center w-[141px] h-[141px] bg-blue-300/20 rounded-full bg-cover bg-center bg-no-repeat relative" id="profile-image-container">
                                <!-- Profile Image Preview -->
                                <img id="profile-preview" src="{{ asset('storage/' . old('image_path', auth()->user()->image_path)) }}" alt="Profile Image" class="rounded-full w-full h-full object-cover">
                            
                                <!-- Input for Image Upload -->
                                <div class="bg-white/90 rounded-full w-6 h-6 text-center ml-28 mt-4 absolute top-0 right-0">
                                    <input type="file" name="profile" id="upload_profile" hidden onchange="previewImage(event)">
                                    <label for="upload_profile">
                                        <svg class="w-6 h-5 text-blue-700" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z"></path>
                                        </svg>
                                    </label>
                                </div>
                            </div>
                        </div>
        
                        <!-- Name Fields -->
                        <div class="flex lg:flex-row md:flex-col sm:flex-col xs:flex-col gap-2 justify-center w-full">
                            <div class="w-full  mb-4 mt-6">
                                <label for="name" class="mb-2 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800" placeholder="Name">
                            </div>
                            <div class="w-full  mb-4 lg:mt-6">
                                <label for="username" class=" dark:text-gray-300">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username', auth()->user()->username) }}" class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800" placeholder="Username">
                            </div>
                        </div>
        
                        <!-- Sex and Date of Birth -->
                        <div class="flex lg:flex-row md:flex-col sm:flex-col xs:flex-col gap-2 justify-center w-full">
                            
                            <div class="w-full  mb-4 lg:mt-6">
                                <label for="address" class=" dark:text-gray-300">address</label>
                                <input type="text" name="address" id="address" value="{{ old('address', auth()->user()->address) }}" class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800" placeholder="Address">
                            </div>
                            <div class="w-full  mb-4 lg:mt-6">
                                <label for="status" class=" dark:text-gray-300">Bio</label>
                                <input type="text" name="status" id="status" value="{{ old('status', auth()->user()->status) }}" class="mt-2 p-4 w-full border-2 rounded-lg dark:text-gray-200 dark:border-gray-600 dark:bg-gray-800" placeholder="Bio">
                            </div>
                        </div>
        
                        <!-- Submit Button -->
                        <div class="w-full rounded-lg bg-blue-500 mt-4 text-white text-lg font-semibold">
                            <button type="submit" class="w-full p-4">Submit</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        
</div>


<script>
function toggleModal() {
    const modal = document.getElementById('editModal');
    modal.classList.toggle('hidden');
}
function previewImage(event) {
        const reader = new FileReader();
        const file = event.target.files[0];

        reader.onload = function(e) {
            const preview = document.getElementById('profile-preview');
            preview.src = e.target.result; // Set the preview image source to the selected file
        };

        if (file) {
            reader.readAsDataURL(file); // Read the selected file as a Data URL
        }
    }
</script>

                </div>
                

            </div>
        </div>
    </div>
    
    <div class="flex flex-wrap w-full mb-4 p-4 max-w-screen-xl mx-auto">
        <div class="w-full mb-6 lg:mb-0">
            <h1 class="sm:text-4xl text-5xl font-medium title-font mb-2 text-gray-900">Your Albums</h1>
            <div class="h-1 w-60 bg-blue-700 rounded"></div>
        </div>
        <div>

        </div>
    </div>
    <div class="px-20 py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset('storage/images/download.jpg') }}" alt="Download Image" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Meme</h5>
                    </a>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">8 image</p>
                    <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        see more
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </a>
                </div>
            </div>
    
            
        </div>
    </div>
    

   
</body>

</html>
