<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>KennGallery</title>
</head>
<body class="bg-gray-100">
    <x-navbar></x-navbar>

    <div class="max-w-lg mx-auto mt-10">
        <h2 class="text-xl font-bold mb-4 flex justify-between items-center">
            Notification
            <form action="{{ route('notifications.clear') }}" method="POST" onsubmit="return confirm('U sure want to clear all notifications?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline">Clear All</button>
            </form>
        </h2>

        <div class="space-y-4">
            @forelse($notifications as $notification)
                @php $data = json_decode($notification->data); @endphp
                <div class="bg-white p-4 shadow-md rounded-lg flex items-center space-x-4">
                    <div class="p-2 rounded-full {{ $notification->type == 'like' ? 'bg-blue-500' : 'bg-green-500' }} text-white">
                        @if($notification->type == 'like')
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 9l-2-2m0 0L10 9m2-2v6m-6 6a6 6 0 100-12 6 6 0 000 12z"/>
                            </svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.77 9.77 0 01-4-.83l-4.71 2.35A1 1 0 012 20.53V12a9 9 0 0118 0z"/>
                            </svg>
                        @endif
                    </div>
                    <p class="text-gray-700">
                        {{ $data->message }}
                    </p>
                    <div class="flex-1">

                        <div class="text-xs text-gray-500 flex justify-end">
                            <i class="fa fa-clock"></i>
                            @if ($notification->created_at->diffInDays(now()) > 2)
                                {{ $notification->created_at->format('d M Y') }}
                            @else
                                {{ $notification->created_at->diffForHumans() }}
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-6">
                    No Notification Available at The Moment
                </div>
            @endforelse
        </div>

    </div>
</body>
</html>
