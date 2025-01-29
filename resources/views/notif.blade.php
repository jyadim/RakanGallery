<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notifications</title>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100 p-5">
    <div class="max-w-lg mx-auto bg-white shadow-lg p-6 rounded-lg">
        <h2 class="text-xl font-semibold mb-4">Notifications</h2>
    

            <template x-if="notifications.length === 0">
                <p class="text-center text-gray-500">No new notifications</p>
            </template>
    
            <template x-for="notification in notifications" :key="notification.id">
                <div class="border-b py-3 mb-3">
                    <p x-text="notification.message" class="text-sm text-gray-700"></p>
                    <span x-text="new Date(notification.created_at).toLocaleString()" class="text-xs text-gray-500 block mt-1"></span>
                    <button 
                        @click="notification.is_read = true"
                        x-show="!notification.is_read"
                        class="mt-2 bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                        Mark as Read
                    </button>
                </div>
            </template>
        </div>
    </div>
</body>
</html>
