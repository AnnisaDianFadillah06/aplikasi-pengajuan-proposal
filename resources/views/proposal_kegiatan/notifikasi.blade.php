<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Download</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <!-- Button untuk menampilkan notifikasi -->
    <button onclick="showNotification()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Download File
    </button>

    <!-- Notifikasi Download -->
    <div id="notification" class="hidden fixed bottom-4 right-4 max-w-sm w-full bg-white border border-gray-300 shadow-lg rounded-lg overflow-hidden">
        <div class="flex items-start p-4">
            <div class="flex-shrink-0 bg-blue-500 text-white rounded-full p-2">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </div>
            <div class="ml-3 w-0 flex-1">
                <p class="text-sm font-medium text-gray-900">File Sedang Didownload</p>
                <p class="text-sm text-gray-500">File Anda sedang didownload, harap tunggu...</p>
            </div>
            <button onclick="hideNotification()" class="text-gray-400 hover:text-gray-500">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        function showNotification() {
            // Menampilkan notifikasi dan menghilangkannya otomatis setelah 5 detik
            const notification = document.getElementById("notification");
            notification.classList.remove("hidden");
            setTimeout(hideNotification, 5000);
        }

        function hideNotification() {
            // Menyembunyikan notifikasi
            const notification = document.getElementById("notification");
            notification.classList.add("hidden");
        }
    </script>

</body>
</html>
