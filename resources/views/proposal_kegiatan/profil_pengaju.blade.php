@extends('welcome')
@section('konten')

<body class="bg-gray-100 font-sans antialiased">
    <!-- Container Utama -->
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-gradient-to-r from-orange-700 to-orange-300 p-6 text-white rounded-lg">
            <div class="flex justify-between items-center">
                <!-- Info Profil -->
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 bg-white rounded-full">
                        <!-- Gambar profil placeholder -->
                        <img src="profile_image_url" alt="Profile Image" class="rounded-full w-full h-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-2xl font-semibold">ANGELITA TAPITTA</h1>
                        <p class="text-sm">231511000</p>
                    </div>
                </div>

                <!-- Navigation Right -->
                <div class="space-x-4">
                    <a href="#" class="text-white">Edit Profile</a>
                    <a href="#" class="text-white">Settings</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-1 container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-bold mb-4">User Details</h2>
                    <ul class="space-y-4">
                        <li>
                            <p class="font-semibold">Email Address</p>
                            <p class="text-sm text-gray-600">angelita@polban.ac.id</p>
                        </li>
                        <li>
                            <p class="font-semibold">Country</p>
                            <p class="text-sm text-gray-600">Indonesia</p>
                        </li>
                        <li>
                            <p class="font-semibold">City/town</p>
                            <p class="text-sm text-gray-600">Bandung</p>
                        </li>
                    </ul>
                </div>

                <!-- Platform Settings -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-bold mb-4">User Details</h2>
                    <div class="flex justify-between items-center mb-4">
                        <label class="text-sm">Email me when someone follows me</label>
                        <input type="checkbox" class="toggle-checkbox">
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="text-sm">Email me when someone answers my post</label>
                        <input type="checkbox" class="toggle-checkbox">
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <label class="text-sm">Email me when someone mentions me</label>
                        <input type="checkbox" class="toggle-checkbox">
                    </div>
                </div>
                
                <!-- Profile Information -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-lg font-bold mb-4">Profile Information</h2>
                    <p class="text-sm mb-4">
                        Hi, I’m Alec Thompson. Decisions: If you can’t decide, the answer is no...
                    </p>
                    <p class="text-sm"><strong>Full Name:</strong> Alec M. Thompson</p>
                    <p class="text-sm"><strong>Mobile:</strong> (44) 123 1234 123</p>
                </div>

            </div>
        </main>
    </div>
</body>

@endsection
