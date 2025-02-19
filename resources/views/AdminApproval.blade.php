<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x/dist/cdn.min.js"></script>
    <title>KennGallery | Admin</title>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="relative overflow-x-auto px-24">
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

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="bg-white dark:bg-gray-800" x-data="{ showRejectForm: false }">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->username }}
                        </th>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <!-- Approve Button -->
                            <form action="{{ route('admin.approve-user', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    Approve
                                </button>
                            </form>

                            <!-- Reject Button -->
                            <button @click="showRejectForm = true" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Reject
                            </button>

                            <!-- Reject Form (Tampil hanya jika tombol Reject diklik) -->
                            <div x-show="showRejectForm" class="mt-2 p-4 bg-gray-100 rounded-lg">
                                <form action="{{ route('admin.reject-user', $user->id) }}" method="POST">
                                    @csrf
                                    <label for="reason" class="block text-sm font-medium text-gray-700">Reason:</label>
                                    <input type="text" name="reason" required
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md"
                                        placeholder="Input Reason">
                                    
                                    <div class="flex justify-end mt-2">
                                        <button type="button" @click="showRejectForm = false"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                            Cancel
                                        </button>
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
