<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Kemahasiswaan Polban</title>

    <!-- Fonts and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Main Styling -->
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                fontFamily: {
                    sans: ["Roboto", "sans-serif"],
                    body: ["Roboto", "sans-serif"],
                    mono: ["ui-monospace", "monospace"],
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    @vite(['resources/css/app.css','resources/js/app.js'])

    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .animated-gradient {
            background: linear-gradient(-45deg, #ee7752, #ee7752, #23a6d5, #ee7752);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .float-effect {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    
    <body class="overflow-hidden">
        <main class="min-h-screen overflow-y-auto">
            <main class="flex items-center justify-center h-screen bg-gray-100">
        <section class="relative flex flex-col lg:flex-row w-full max-w-4xl h-auto lg:h-[30rem] rounded-3xl overflow-hidden shadow-lg">
            <!-- First Column (App Name + Background Image + Overlay) -->
            <div class="animated-gradient fixed inset-0 opacity-50"></div>
            <div class="relative lg:w-1/2 w-full h-64 lg:h-full bg-cover bg-center flex items-start justify-center" style="background-image: url('{{ asset('img/curved-images/curved14.jpg') }}');">
                <div class="absolute inset-0 bg-black opacity-30"></div>
                <div class="relative z-10 p-8">
                    <h1 class="text-3xl font-bold text-white">
                        Sistem Informasi Kemahasiswaan Polban
                    </h1>
                </div>
            </div>        

            <!-- Second Column (Login, Forgot Password, and Reset Password Forms) -->
            <div class="w-full lg:w-1/2 flex flex-col p-10 bg-white relative">
                <!-- Login Form -->
                <div id="loginForm" class="absolute inset-0 transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white">
                    <div class="title mb-6">
                        <h1 class="text-2xl font-bold">Login</h1>
                    </div>
                    <form method="POST" action="{{ route('login.mahasiswa.submit') }}">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="email" class="block pb-3 text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="example@polban.ac.id">
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="password" class="block pb-3 text-sm font-medium text-gray-700">Password</label>
                                <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700 focus:border-fuchsia-300 focus:outline-none transition-shadow" placeholder="********">
                                @error('password')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                                <span class="pt-2 block">Forgot your password? <a href="#" id="forgotPasswordLink" class="text-blue-500"><strong>Click here</strong></a></span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-block w-full px-6 py-3 font-bold text-white uppercase transition-all bg-orange-500 hover:bg-orange-700 rounded-lg shadow-md hover:scale-105 hover:shadow-lg focus:ring-2 focus:ring-orange-400 focus:outline-none">
                                Login
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Forgot Password Form -->
                <div id="forgotPasswordForm" class="absolute inset-0 transform translate-x-full transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white">
                    <div class="title mb-6">
                        <h1 class="text-2xl font-bold">Forgot Password</h1>
                    </div>
                    <form id="forgotPasswordFormSubmit">
                        @csrf
                        <div class="space-y-5"> 
                            <div>
                                <label for="reset-email" class="block pb-3 text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="reset-email" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2 text-gray-700" placeholder="example@polban.ac.id" required>
                            </div>
                            <div>
                                <label for="auth_code" class="block pb-3 text-sm font-medium text-gray-700">Kode Autentikasi</label>
                                <input type="text" name="auth_code" id="auth_code" class="border border-gray-300 rounded-lg w-full px-4 py-2" placeholder="123456" required>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-block w-full px-6 py-3 font-bold text-white uppercase bg-orange-500 hover:bg-orange-700 rounded-lg">
                                Verify Code
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Reset Password Form -->
                <div id="resetPasswordForm" class="absolute inset-0 transform translate-x-full transition-transform duration-700 ease-in-out flex flex-col justify-between p-10 bg-white hidden">
                    <div class="title mb-6">
                        <h1 class="text-2xl font-bold">Reset Password</h1>
                    </div>
                    <form id="resetPasswordFormSubmit">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label for="password" class="block pb-3 text-sm font-medium text-gray-700">Password Baru</label>
                                <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block pb-3 text-sm font-medium text-gray-700">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="focus:shadow-soft-primary-outline text-sm block w-full rounded-lg border border-gray-300 px-3 py-2" required>
                            </div>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="inline-block w-full px-6 py-3 font-bold text-white uppercase bg-orange-500 hover:bg-orange-700 rounded-lg">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Success Message -->
                <div id="resetSuccess" class="absolute inset-0 hidden flex flex-col justify-center items-center p-10 text-center">
                    <h1 class="text-2xl font-bold mb-4">Password Changed Successfully</h1>
                    <p class="text-lg text-gray-700 mb-8">Your password has been successfully updated!</p>
                    <a href="#" id="backToLoginAfterSuccess" class="text-blue-500"><strong>Back to Login</strong></a>
                </div>
            </div>
        </section>
    </main>

    <script>
        const forgotPasswordLink = document.getElementById('forgotPasswordLink');
        const backToLogin = document.getElementById('backToLogin');
        const loginForm = document.getElementById('loginForm');
        const forgotPasswordForm = document.getElementById('forgotPasswordForm');
        const resetPasswordForm = document.getElementById('resetPasswordForm');
        const resetSuccess = document.getElementById('resetSuccess');
        const backToLoginAfterSuccess = document.getElementById('backToLoginAfterSuccess');

        // Transition to Forgot Password Form
        forgotPasswordLink.addEventListener('click', function (event) {
            event.preventDefault();
            forgotPasswordForm.classList.remove('hidden');
            setTimeout(() => {
                loginForm.classList.add('translate-x-full');
                forgotPasswordForm.classList.remove('translate-x-full');
            }, 50);
        });

        // Handle Forgot Password Form Submission
        document.getElementById('forgotPasswordFormSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            const email = document.getElementById('reset-email').value;
            const authCode = document.getElementById('auth_code').value;

            fetch('{{ route('password.forgot') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email, auth_code: authCode })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Verified!') {
                    forgotPasswordForm.classList.add('hidden');
                    resetPasswordForm.classList.remove('hidden');
                    resetPasswordForm.classList.remove('translate-x-full');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        // Handle Reset Password Form Submission
        document.getElementById('resetPasswordFormSubmit').addEventListener('submit', function(event) {
            event.preventDefault();
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            fetch('{{ route('password.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ password, password_confirmation: passwordConfirmation })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.message === 'Password updated successfully!') {
                    resetPasswordForm.classList.add('hidden');
                    resetSuccess.classList.remove('hidden');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An unexpected error occurred. Please try again.');
            });
        });

        // Back to Login from Success
        backToLoginAfterSuccess.addEventListener('click', function (event) {
            event.preventDefault();
            resetSuccess.classList.add('hidden');
            loginForm.classList.remove('translate-x-full');
        });
    </script>

        </main>
    
        <!-- JavaScript Plugins -->
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>
        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
        <script src="https://buttons.github.io/buttons.js" async defer></script>
        <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>
    
</body>
</html>
