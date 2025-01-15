<!--
=========================================================
* Soft UI Dashboard Tailwind - v1.0.5
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-tailwind
* Copyright 2023 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Tambahkan CDN PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>
    <script>
        // Inisialisasi worker PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';
    </script>
    <!-- Apple Touch Icon -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}" />

    <!--untuk tanda seru di histori pengajuan-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/LOGOPOLBAN4K.png') }}" />

    
    <title>@yield('title', 'Pengajuan Proposal Kegiatan')</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
   <!-- Main Styling -->
    <link href="{{ asset('css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />    
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css" >

    {{-- tailwind cdn --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery filtering tabel - DHEA-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    {{-- tailwind-flowbite --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    <!-- ApexCharts : chart di dashboard -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.44.0/apexcharts.min.js"></script>
    <!-- Chart.js : chart di dashboard-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
  </head>


  <body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <!-- Breadcrumb -->
    <!-- sidenav  -->
  @if(!isset($hideSidebar) || !$hideSidebar)
  {{-- <button id="sidebarToggle" class="fixed top-4 left-4 z-50 p-2 rounded-lg bg-white shadow-lg xl:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button> --}}

<!-- Backdrop -->
<div id="sidebarBackdrop" class="fixed inset-0 bg-gray-800/50 z-40 xl:hidden hidden" aria-hidden="true"></div>

  <aside class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 ease-in-out bg-white border-r border-gray-200 shadow-lg transform xl:translate-x-0 -translate-x-full">
    <!-- Logo & Close Button Section -->
    <div class="relative flex items-center justify-between p-4">
        <a href="dashboard-pengaju" class="flex items-center space-x-3">
            <img src="{{ asset('img/LOGOPOLBAN4K.png') }}" class="h-8 w-auto" alt="POLBAN Logo" />
            <span class="text-sm font-semibold text-gray-800">Pengajuan Kegiatan Polban</span>
        </a>
        {{-- <button class="p-2 rounded-lg xl:hidden hover:bg-gray-100" sidenav-close>
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button> --}}
    </div>

    <!-- Divider -->
    {{-- <div class="h-px my-3 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div> --}}

    <!-- Navigation Links -->
    <nav class="px-3 py-4 space-y-1.5">
        <!-- Dashboard -->
        <a href="{{ route('proposal_kegiatan.dashboard-pengaju') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200 
                  {{ Route::currentRouteName() == 'proposal_kegiatan.dashboard-pengaju' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-home {{ Route::currentRouteName() == 'proposal_kegiatan.dashboard-pengaju' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Dashboard</span>
        </a>

        <!-- Pengajuan Kegiatan -->
        <a href="{{ route('pengajuan-proposal') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200
                  {{ Route::currentRouteName() == 'pengajuan-proposal' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-file-upload {{ Route::currentRouteName() == 'pengajuan-proposal' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Pengajuan Kegiatan</span>
        </a>

        <!-- Pengajuan LPJ -->
        <a href="{{ route('pengajuan-lpj') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200
                  {{ Route::currentRouteName() == 'pengajuan-lpj' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-file-upload {{ Route::currentRouteName() == 'pengajuan-lpj' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Pengajuan LPJ</span>
        </a>

        <!-- Histori Pengajuan -->
        <a href="{{ route('histori.pengajuan') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200
                  {{ Route::currentRouteName() == 'histori.pengajuan' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-history {{ Route::currentRouteName() == 'histori.pengajuan' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Histori Pengajuan</span>
        </a>

        <!-- Event List -->
        <a href="{{ route('event-list.index') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200
                  {{ Route::currentRouteName() == 'event-list.index' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-calendar {{ Route::currentRouteName() == 'event-list.index' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Event List</span>
        </a>

        <!-- Profile -->
        {{-- <a href="{{ route('profile.index') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg group transition-all duration-200
                  {{ Route::currentRouteName() == 'profile.index' ? 
                     'bg-blue-50 text-blue-600' : 
                     'text-gray-700 hover:bg-orange-400' }}">
            <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-lg bg-white shadow-sm group-hover:shadow">
                <i class="fas fa-user {{ Route::currentRouteName() == 'profile.index' ? 'text-blue-600' : 'text-gray-500' }}"></i>
            </div>
            <span>Profil</span>
        </a> --}}
    </nav>
</aside>
    @endif

    <!-- end sidenav -->

    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
    @if(session('alert'))
    <div id="alert-border-{{ session('alert')['type'] }}" class="flex items-center p-4 mb-4 text-{{ session('alert')['type'] === 'danger' ? 'red' : (session('alert')['type'] === 'success' ? 'green' : 'blue') }}-800 border-t-4 border-{{ session('alert')['type'] === 'danger' ? 'red' : (session('alert')['type'] === 'success' ? 'green' : 'blue') }}-300 bg-{{ session('alert')['type'] === 'danger' ? 'red' : (session('alert')['type'] === 'success' ? 'green' : 'blue') }}-50 dark:text-{{ session('alert')['type'] }}-400 dark:bg-gray-800 dark:border-{{ session('alert')['type'] }}-800" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <div class="ms-3 text-sm font-medium">
            {{ session('alert')['message'] }}
        </div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-{{ session('alert')['type'] }}-50 text-{{ session('alert')['type'] }}-500 rounded-lg focus:ring-2 focus:ring-{{ session('alert')['type'] }}-400 p-1.5 hover:bg-{{ session('alert')['type'] }}-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-{{ session('alert')['type'] }}-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-border-{{ session('alert')['type'] }}" aria-label="Close">
            <span class="sr-only">Dismiss</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
        </button>
    </div>
@endif

<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
          <!-- Hamburger Menu Button -->
          <div class="flex items-center xl:hidden">
              <button type="button" 
                      class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                      id="mobile-menu-button"
                      aria-expanded="false">
                  <span class="sr-only">Open menu</span>
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>
              </button>
          </div>

          <!-- Logo for mobile -->
        <a href="dashboard-pengaju" class="flex items-center space-x-3">
          <div class="flex items-center xl:hidden">
              <img src="{{ asset('img/LOGOPOLBAN4K.png') }}" class="h-8 w-auto" alt="POLBAN Logo" />
          </div>
        </a>

          <!-- Right side - Actions -->
          <div class="flex items-center space-x-4">
              <div class="hidden xl:flex items-center space-x-4">
                  <!-- Notifications -->
                  {{-- <button type="button" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                      <span class="sr-only">View notifications</span>
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                      </svg>
                      <span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                  </button>

                  <!-- Settings -->
                  <button type="button" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full">
                      <span class="sr-only">Settings</span>
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      </svg>
                  </button> --}}
              </div>
          </div>
      </div>

      <!-- Mobile menu, show/hide based on menu state -->
      <div class="hidden xl:hidden" id="mobile-menu">
          <div class="pt-2 pb-3 space-y-1">
              <!-- Dashboard -->
              <a href="{{ route('proposal_kegiatan.dashboard-pengaju') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-home mr-3"></i>
                  Dashboard
              </a>

              <!-- Pengajuan Kegiatan -->
              <a href="{{ route('pengajuan-proposal') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-file-upload mr-3"></i>
                  Pengajuan Kegiatan
              </a>

              <!-- Pengajuan LPJ -->
              <a href="{{ route('pengajuan-lpj') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-file-upload mr-3"></i>
                  Pengajuan LPJ
              </a>

              <!-- Histori Pengajuan -->
              <a href="{{ route('histori.pengajuan') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-history mr-3"></i>
                  Histori Pengajuan
              </a>

              <!-- Event List -->
              <a href="{{ route('event-list.index') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-calendar mr-3"></i>
                  Event List
              </a>

              <!-- Profile -->
              <a href="{{ route('profile.index') }}" 
                 class="block px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                  <i class="fas fa-user mr-3"></i>
                  Profil
              </a>

              <!-- Mobile-only buttons -->
              <div class="px-4 py-2 space-y-2 xl:hidden">
                  <!-- Notifications -->
                  <button type="button" class="flex items-center w-full px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                      <i class="fas fa-bell mr-3"></i>
                      Notifications
                  </button>

                  <!-- Settings -->
                  <button type="button" class="flex items-center w-full px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                      <i class="fas fa-cog mr-3"></i>
                      Settings
                  </button>

                  <!-- Sign Out -->
                  <form action="{{ route('logout.mahasiswa') }}" method="POST" class="block">
                      @csrf
                      <button type="submit" class="flex items-center w-full px-4 py-2 text-base font-medium text-gray-700 hover:bg-gray-50 hover:text-blue-600">
                          <i class="fas fa-sign-out-alt mr-3"></i>
                          Sign Out
                      </button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</nav>

     <!-- Navbar -->
     <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
              <!-- Hamburger Menu Button -->
              {{-- <div class="flex items-center xl:hidden">
                  <button type="button" 
                          class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          id="hamburger-button">
                      <span class="sr-only">Open sidebar</span>
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                      </svg>
                  </button>
              </div> --}}
            <!-- Left side - Breadcrumb -->
            <div class="flex items-center">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('proposal_kegiatan.dashboard-pengaju') }}" class="inline-flex items-center text-gray-700 hover:text-blue-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                                </svg>
                                <span class="text-sm font-medium">Pages</span>
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-blue-600">
                                    @if(Route::currentRouteName() == 'proposal_kegiatan.dashboard-pengaju')
                                        Dashboard
                                    @elseif(Route::currentRouteName() == 'manajemen-review')
                                        Manajemen Review
                                    @elseif(Route::currentRouteName() == 'histori.pengajuan')
                                        Histori Pengajuan
                                    @elseif(Route::currentRouteName() == 'pengajuan-proposal')
                                        Pengajuan Kegiatan
                                    @elseif(Route::currentRouteName() == 'pedoman.index')
                                        Pedoman Kemahasiswaan
                                    @elseif(Route::currentRouteName() == 'jenis-kegiatan.index')
                                        Jenis Kegiatan
                                    @elseif(Route::currentRouteName() == 'bidang-kegiatan.index')
                                        Bidang Kegiatan
                                    @elseif(Route::currentRouteName() == 'event-list.index')
                                        Event List
                                    @elseif(Route::currentRouteName() == 'tambah-pengajuan-proposal')
                                        Form Kegiatan
                                    @elseif(Route::currentRouteName() == 'spj.index')
                                        Informasi SPJ
                                    @elseif(Route::currentRouteName() == 'spj.formIndex')
                                        Upload SPJ
                                    @elseif(Route::currentRouteName() == 'proposal.detail')
                                        Detail Proposal
                                    @else
                                        Undefined Page
                                    @endif
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Right side - Actions -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative">
                    <button type="button" class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <span class="sr-only">View notifications</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-0 right-0 block w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
                    </button>
                    
                    <!-- Notifications Dropdown -->
                    <div class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 divide-y divide-gray-100">
                        <div class="p-2 space-y-1">
                            <!-- Notification Items -->
                            <a href="#" class="flex items-center px-4 py-3 hover:bg-gray-50 rounded-lg group transition duration-150 ease-in-out">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="{{ asset('img/team-2.jpg') }}" alt="">
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">New message from Laur</p>
                                    <p class="text-xs text-gray-500">13 minutes ago</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Settings -->
                <button type="button" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="sr-only">Settings</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </button>

                <!-- Sign Out -->
                <!-- Profile Dropdown -->
<div class="relative">
    <!-- Profile Button -->
    <button type="button" 
            class="flex items-center gap-2 rounded-full focus:ring-4 focus:ring-blue-100" 
            id="profileDropdownButton" 
            data-dropdown-toggle="profileDropdown">
        <!-- Profile Image - Ganti src dengan foto profil mahasiswa -->
        <img class="w-10 h-10 rounded-full border-2 border-gray-200" 
             src="{{ auth()->user()->photo_url ?? 'https://flowbite.com/docs/images/people/profile-picture-5.jpg' }}" 
             alt="user photo">
        <!-- Optional: Tambahkan nama user -->
        <span class="hidden md:block text-sm font-medium text-gray-900">
            {{  session('username')  }}
        </span>
        <!-- Dropdown Arrow -->
        {{-- <svg class="w-4 h-4 text-gray-600" 
             fill="currentColor" 
             viewBox="0 0 20 20">
            <path fill-rule="evenodd" 
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" 
                  clip-rule="evenodd"/>
        </svg> --}}
    </button>

    <!-- Dropdown Menu -->
    <div class="hidden absolute right-0 z-10 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5" 
         id="profileDropdown">
        <div class="py-1">
            <!-- Profile Link -->
            <a href="{{ route('profile.index') }}" 
               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors">
                <i class="fas fa-user w-5 h-5 mr-2 text-gray-500"></i>
                Profil
            </a>
            
            <!-- Logout Form -->
            <form action="{{ route('logout.mahasiswa') }}" method="POST">
                @csrf
                <button type="submit" 
                        class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5 mr-2" 
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" 
                              stroke-linejoin="round" 
                              stroke-width="2" 
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</nav>
<!-- end Navbar -->

      <!-- cards -->
      <div class="w-full px-6 py-6 mx-auto">
                    @yield('konten')

        <footer class="pt-4">
          <!-- <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
              <div class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
                <div class="text-sm leading-normal text-center text-slate-500 lg:text-left">
                  ©
                  <script>
                    document.write(new Date().getFullYear() + ",");
                  </script>
                  made with <i class="fa fa-heart"></i> by
                  <a href="https://www.creative-tim.com" class="font-semibold text-slate-700" target="_blank">Creative Tim</a>
                  for a better web.
                </div>
              </div>
              <div class="w-full max-w-full px-3 mt-0 shrink-0 lg:w-1/2 lg:flex-none">
                <ul class="flex flex-wrap justify-center pl-0 mb-0 list-none lg:justify-end">
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500" target="_blank">Creative Tim</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/presentation" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500" target="_blank">About Us</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://creative-tim.com/blog" class="block px-4 pt-0 pb-1 text-sm font-normal transition-colors ease-soft-in-out text-slate-500" target="_blank">Blog</a>
                  </li>
                  <li class="nav-item">
                    <a href="https://www.creative-tim.com/license" class="block px-4 pt-0 pb-1 pr-0 text-sm font-normal transition-colors ease-soft-in-out text-slate-500" target="_blank">License</a>
                  </li>
                </ul>
              </div>
            </div>
          </div> -->
        </footer>
      </div>
      <!-- end cards -->
    </main>
    <div fixed-plugin>
      <a fixed-plugin-button class="bottom-7.5 right-7.5 text-xl z-990 shadow-soft-lg rounded-circle fixed cursor-pointer bg-white px-4 py-2 text-slate-700">
        <i class="py-2 pointer-events-none fa fa-cog"> </i>
      </a>
      <!-- -right-90 in loc de 0-->
      <div fixed-plugin-card class="z-sticky shadow-soft-3xl w-90 ease-soft -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white bg-clip-border px-2.5 duration-200">
        <div class="px-6 pt-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
          <div class="float-left">
            <h5 class="mt-4 mb-0">Soft UI Configurator</h5>
            <p>See our dashboard options.</p>
          </div>
          <div class="float-right mt-6">
            <button fixed-plugin-close-button class="inline-block p-0 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 active:opacity-85 text-slate-700">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
        <div class="flex-auto p-6 pt-0 sm:pt-4">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0">Sidebar Colors</h6>
          </div>
          <a href="javascript:void(0)">
            <div class="my-2 text-left" sidenav-colors>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-purple-700 to-pink-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" active-color data-color-from="purple-700" data-color-to="pink-500" onclick="sidebarColor(this)"></span>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-gray-900 to-slate-800 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color-from="gray-900" data-color-to="slate-800" onclick="sidebarColor(this)"></span>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-blue-600 to-cyan-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color-from="blue-600" data-color-to="cyan-400" onclick="sidebarColor(this)"></span>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-green-600 to-lime-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color-from="green-600" data-color-to="lime-400" onclick="sidebarColor(this)"></span>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-500 to-yellow-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color-from="red-500" data-color-to="yellow-400" onclick="sidebarColor(this)"></span>
              <span class="text-xs rounded-circle h-5.75 mr-1.25 w-5.75 ease-soft-in-out bg-gradient-to-tl from-red-600 to-rose-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color-from="red-600" data-color-to="rose-400" onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-4">
            <h6 class="mb-0">Sidenav Type</h6>
            <p class="text-sm leading-normal">Choose between 2 different sidenav types.</p>
          </div>
          <div class="flex">
            <button transparent-style-btn class="inline-block w-full px-4 py-3 mb-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border border-transparent border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 bg-fuchsia-500 hover:border-fuchsia-500" data-class="bg-transparent" active-style>Transparent</button>
            <button white-style-btn class="inline-block w-full px-4 py-3 mb-2 ml-2 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500" data-class="bg-white">White</button>
          </div>
          <p class="block mt-2 text-sm leading-normal xl:hidden">You can change the sidenav type just on desktop view.</p>
          <!-- Navbar Fixed -->
          <div class="mt-4">
            <h6 class="mb-0">Navbar Fixed</h6>
          </div>
          <div class="min-h-6 mb-0.5 block pl-0">
            <input navbarFixed class="rounded-10 duration-250 ease-soft-in-out after:rounded-circle after:shadow-soft-2xl after:duration-250 checked:after:translate-x-5.25 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-slate-800/95 checked:bg-slate-800/95 checked:bg-none checked:bg-right" type="checkbox" />
          </div>
          <hr class="h-px bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent sm:my-6" />
          <a class="inline-block w-full px-6 py-3 mb-4 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer leading-pro ease-soft-in hover:shadow-soft-xs hover:scale-102 active:opacity-85 tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800" href="https://www.creative-tim.com/product/soft-ui-dashboard-tailwind" target="_blank">Free Download</a>
          <a class="inline-block w-full px-6 py-3 mb-4 text-xs font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none" href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/soft-ui-dashboard/" target="_blank">View documentation</a>
          <div class="w-full text-center">
            <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard-tailwind" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
            <h6 class="mt-4">Thank you for sharing!</h6>
            <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20Tailwind%20made%20by%20%40CreativeTim&hashtags=webdesign,dashboard,tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-tailwind" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-twitter"></i> Tweet </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard-tailwind" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:shadow-soft-xs hover:scale-102 active:opacity-85 leading-pro ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-facebook-square"></i> Share </a>
          </div>
        </div>
      </div>
    </div>
  </body>
    <!-- plugin for charts -->
    <script src="{{ asset('js/plugins/chartjs.min.js') }}" async></script>

    <!-- plugin for scrollbar -->
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}" async></script>

    <!-- main script file -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="{{ asset('js/soft-ui-dashboard-tailwind.js') }}" async></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    
  <!-- github button -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>

  {{-- Hamburger Menu --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            // Toggle the menu visibility
            const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');

            // Change hamburger icon to close icon and vice versa
            const svg = mobileMenuButton.querySelector('svg');
            if (!isExpanded) {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                `;
            } else {
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                `;
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenuButton.setAttribute('aria-expanded', 'false');
                mobileMenu.classList.add('hidden');
                const svg = mobileMenuButton.querySelector('svg');
                svg.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                `;
            }
        });
    });

  
  </script>


</html>