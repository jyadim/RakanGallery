<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>KennGallery</title>
</head>
<body>
    <x-navbar></x-navbar>



<div class="relative overflow-x-auto px-24">
    <h1>Pending Users</h1>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                   Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                   {{$user->username}}
                </th>
                <td class="px-6 py-4">
                    {{$user->name}}
                </td>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    <form action="{{ route('admin.approve-user', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('admin.reject-user', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Reject
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



</body>
</html>
