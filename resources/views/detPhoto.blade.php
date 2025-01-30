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


    <div class="container mx-auto mt-6">
        <div class="bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-wrap -mx-4">
                    <!-- Product Images -->

                    <div class="w-full md:w-1/2 px-4 mb-8">
                        <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Product"
                            class="w-full h-auto rounded-lg shadow-md mb-4" id="mainImage">

                    </div>

                    <!-- Product Details -->
                    <div class="w-full md:w-1/2 px-4">
                        <h2 class="text-3xl font-bold mb-2">{{ $photo->photo_name }}</h2>
                        <p class="text-gray-700 mb-6">{{ $photo->photo_desc }}</p>

                        <div class="flex items-center space-x-4  mb-6">
                            <!-- Profile Picture -->
                            <img src="{{ $photo->user->image_path ? asset('storage/' . old('image_path', $photo->user->image_path)) : asset('storage/profiles/Shoyo Hinata.jpg') }}"
                                alt="User Avatar" class="w-10 h-10 rounded-full object-cover">

                            <!-- User Info -->
                            <div class="flex-1">
                                <div class="text-sm font-semibold text-gray-800">
                                    {{ $photo->user->username }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    <i class="fa fa-clock"></i> {{ $photo->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>


                        <form method="post" action="{{ route('store.comments') }}"
                            class="bg-white p-6 rounded-lg shadow-md">
                            @csrf
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Add a Comment</h2>
                            <div class="mb-4">
                                <textarea
                                    class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 resize-none"
                                    name="comments" rows="4" placeholder="Write your comment here..."></textarea>
                            </div>

                            <input type="hidden" name="photo_id" value="{{ $photo->id }}">

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                                    <i class="fa fa-comment mr-2"></i> Add Comment
                                </button>
                            </div>
                        </form>
                        <div class="space-y-6 py-5">
                            @foreach($comments as $comment)
                                <div class="flex items-start space-x-4 bg-gray-50 rounded-lg p-4 shadow-sm @if($comment->parent_id) ml-10 @endif">
                                    <!-- User Avatar -->
                                    <div class="flex-shrink-0">
                                        <img src="{{ $comment->user->image_path ? asset('storage/' . old('image_path', $comment->User->image_path)) : asset('storage/profiles/Shoyo Hinata.jpg') }}"
                                             alt="User Avatar"
                                             class="w-12 h-12 rounded-full object-cover">
                                    </div>

                                    <!-- Comment Content -->
                                    <div class="flex-1">
                                        <div class="text-sm font-semibold text-gray-800">
                                            {{ $comment->user->username }}
                                            @if ($comment->parent_id)
                                                <span class="text-gray-500 text-xs"> Replying to: {{ $comment->parent->user->username }}</span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-gray-500 mb-2">
                                            <i class="fa fa-clock"></i> {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                        <p class="text-sm text-gray-700 whitespace-pre-wrap">{!! nl2br(e($comment->comments)) !!}</p>

                                        <!-- Reply Form -->
                                        <form method="post" action="{{ route('store.comments') }}" class="mt-4">
                                            @csrf
                                            <div class="flex items-start space-x-2">
                                                <textarea
                                                    name="comments"
                                                    class="w-full rounded-lg border border-gray-300 focus:ring focus:ring-blue-300 focus:outline-none px-3 py-2 text-sm"
                                                    placeholder="Write Your Reply..."></textarea>
                                                <input type="hidden" name="photo_id" value="{{ $photo->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <button type="submit" class="px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600">
                                                    <i class="fa fa-reply"></i> Reply
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Display Replies -->
                                        @if ($comment->replies->count())
                                            <div class="mt-4 ml-10 border-l-2 border-gray-200 pl-4 space-y-4">
                                                @foreach ($comment->replies as $reply)
                                                    <div class="flex items-start space-x-4 bg-gray-100 rounded-lg p-3 shadow-sm">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ $reply->User->image_path ? asset('storage/' . old('image_path', $reply->User->image_path)) : asset('storage/profiles/Shoyo Hinata.jpg') }}" alt="User Avatar" class="w-12 h-12 rounded-full object-cover">                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="text-sm font-semibold text-gray-800">
                                                                {{ $reply->user->username }}
                                                            </div>
                                                            <div class="text-xs text-gray-500 mb-2">
                                                                <i class="fa fa-clock"></i> {{ $reply->created_at->diffForHumans() }}
                                                            </div>
                                                            <p class="text-sm text-gray-700 whitespace-pre-wrap">{!! nl2br(e($reply->comments)) !!}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>

            <script>
                function changeImage(src) {
                    document.getElementById('mainImage').src = src;
                }
            </script>
        </div>
    </div>

</body>

</html>
