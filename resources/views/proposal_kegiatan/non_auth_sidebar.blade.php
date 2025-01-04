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
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" />

    <title>Pengajuan Proposal Kegiatan</title>
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
    <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
<div class="flex items-center h-20 px-8 py-6">
    <!-- Icon close button -->
    <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>

    <!-- Logo section -->
    <a class="flex items-center space-x-3 text-sm whitespace-nowrap text-slate-700" href="javascript:;" target="_blank">
        <!-- Logo image -->
        <img src="{{ asset('img/LOGO POLBAN 4K.png') }}" class="h-12 max-w-full transition-all duration-200 ease-nav-brand" alt="main_logo" />

        <!-- Text next to logo -->
        <span class="font-semibold transition-all duration-200 ease-nav-brand">Pengajuan Kegiatan Polban</span>
    </a>
</div>
      <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

      <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
        <ul class="flex flex-col pl-0 mb-0">
          <!-- <li class="mt-0.5 w-full"> -->
          <!-- <a class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="/dashboard-pengaju"> -->
              
              <!-- <a href="{{ route('proposal_kegiatan.dashboard-pengaju') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'proposal_kegiatan.dashboard-pengaju' ? 'bg-blue-500 text-white' : '' }}">
         <div class="bg-gradient-to-tl white shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
         <i class="fas fa-home text-gray-500"></i>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
      </a>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a href="{{ route('proposal.index') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'manajemen-review' ? 'bg-blue-500 text-white' : '' }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-comments text-gray-500"></i>
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8m-4 4h4M4 6h16M6 18h2m0 0a2 2 0 11-4 0"></path></svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Manajemen Review</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a href="{{ route('histori.pengajuan') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'histori.pengajuan' ? 'bg-blue-500 text-white' : '' }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center fill-current stroke-0 text-center xl:p-2.5">
              <i class="fas fa-history text-gray-500"></i>
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Histori Pengajuan</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a href="{{ route('proposal_kegiatan.dashboard-reviewer') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'dashboard.reviewer' ? 'bg-blue-500 text-white' : '' }}">
              <div class="bg-gradient-to-tl white shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-home text-gray-500"></i>
                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>dashboard</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(0.000000, 148.000000)">
                          <path class="opacity-60" d="M45,0 L0,0 L0,5.625 L45,5.625 L45,0 Z"></path>
                          <path class="opacity-60" d="M45,39.375 L0,39.375 L0,45 L45,45 L45,39.375 Z"></path>
                          <path class="opacity-60" d="M0,22.5 L45,22.5 L45,28.125 L0,28.125 L0,22.5 Z"></path>
                          <path class="opacity-60" d="M0,11.25 L45,11.25 L45,16.875 L0,16.875 L0,11.25 Z"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft min-h-width">Dashboard Reviewer</span>
            </a>
          </li> -->

<!-- <li class="mt-0.5 w-full">
<a href="{{ route('pengajuan-proposal') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'pengajuan-proposal' ? 'bg-blue-500 text-white' : '' }}">
    <div class="bg-gradient-to-tl white shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
    <i class="fas fa-file-upload text-gray-500"></i>
      <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>file-alt</title>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <g transform="translate(1716.000000, 291.000000)">
              <g transform="translate(0.000000, 148.000000)">
                <path class="opacity-60" d="M10,0 L45,0 L45,5.625 L10,5.625 L10,0 Z"></path>
                <path class="opacity-60" d="M10,11.25 L45,11.25 L45,16.875 L10,16.875 L10,11.25 Z"></path>
                <path class="opacity-60" d="M10,22.5 L45,22.5 L45,28.125 L10,28.125 L10,22.5 Z"></path>
                <path class="opacity-60" d="M10,33.75 L45,33.75 L45,39.375 L10,39.375 L10,33.75 Z"></path>
              </g>
            </g>
          </g>
        </g>
      </svg>
    </div>
    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Pengajuan Kegiatan</span>
  </a>
</li> -->

<!-- <li class="mt-0.5 w-full">
<a class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="/histori-pengajuan">
    <div class="bg-gradient-to-tl from-purple-700 to-purple-300 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
      <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <title>history</title>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
            <g transform="translate(1716.000000, 291.000000)">
              <g transform="translate(0.000000, 148.000000)">
                <path class="opacity-60" d="M0,0 L45,0 L45,5.625 L0,5.625 L0,0 Z"></path>
                <path class="opacity-60" d="M0,11.25 L45,11.25 L45,16.875 L0,16.875 L0,11.25 Z"></path>
                <path class="opacity-60" d="M0,22.5 L45,22.5 L45,28.125 L0,28.125 L0,22.5 Z"></path>
                <path class="opacity-60" d="M0,33.75 L45,33.75 L45,39.375 L0,39.375 L0,33.75 Z"></path>
              </g>
            </g>
          </g>
        </g>
      </svg>
    </div>
    <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Histori Pengajuan</span>
  </a>
</li> -->
          <!-- <li class="mt-0.5 w-full">
          <a href="{{ route('pedoman.index') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'pedoman.index' ? 'bg-blue-500 text-white' : '' }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-book text-gray-500"></i>

                <svg width="12px" height="12px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>box-3d-50</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-2319.000000, -291.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(603.000000, 0.000000)">
                          <path class="fill-slate-800" d="M22.7597136,19.3090182 L38.8987031,11.2395234 C39.3926816,10.9925342 39.592906,10.3918611 39.3459167,9.89788265 C39.249157,9.70436312 39.0922432,9.5474453 38.8987261,9.45068056 L20.2741875,0.1378125 L20.2741875,0.1378125 C19.905375,-0.04725 19.469625,-0.04725 19.0995,0.1378125 L3.1011696,8.13815822 C2.60720568,8.38517662 2.40701679,8.98586148 2.6540352,9.4798254 C2.75080129,9.67332903 2.90771305,9.83023153 3.10122239,9.9269862 L21.8652864,19.3090182 C22.1468139,19.4497819 22.4781861,19.4497819 22.7597136,19.3090182 Z"></path>
                          <path class="fill-slate-800 opacity-60" d="M23.625,22.429159 L23.625,39.8805372 C23.625,40.4328219 24.0727153,40.8805372 24.625,40.8805372 C24.7802551,40.8805372 24.9333778,40.8443874 25.0722402,40.7749511 L41.2741875,32.673375 L41.2741875,32.673375 C41.719125,32.4515625 42,31.9974375 42,31.5 L42,14.241659 C42,13.6893742 41.5522847,13.241659 41,13.241659 C40.8447549,13.241659 40.6916418,13.2778041 40.5527864,13.3472318 L24.1777864,21.5347318 C23.8390024,21.7041238 23.625,22.0503869 23.625,22.429159 Z"></path>
                          <path class="fill-slate-800 opacity-60" d="M20.4472136,21.5347318 L1.4472136,12.0347318 C0.953235098,11.7877425 0.352562058,11.9879669 0.105572809,12.4819454 C0.0361450918,12.6208008 6.47121774e-16,12.7739139 0,12.929159 L0,30.1875 L0,30.1875 C0,30.6849375 0.280875,31.1390625 0.7258125,31.3621875 L19.5528096,40.7750766 C20.0467945,41.0220531 20.6474623,40.8218132 20.8944388,40.3278283 C20.963859,40.1889789 21,40.0358742 21,39.8806379 L21,22.429159 C21,22.0503869 20.7859976,21.7041238 20.4472136,21.5347318 Z"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Pedoman Kemahasiswaan</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="/histori-pengajuan-reviewer">
              <div class="bg-gradient-to-tl from-purple-700 to-purple-300 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>history</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(0.000000, 148.000000)">
                          <path class="opacity-60" d="M0,0 L45,0 L45,5.625 L0,5.625 L0,0 Z"></path>
                          <path class="opacity-60" d="M0,11.25 L45,11.25 L45,16.875 L0,16.875 L0,11.25 Z"></path>
                          <path class="opacity-60" d="M0,22.5 L45,22.5 L45,28.125 L0,28.125 L0,22.5 Z"></path>
                          <path class="opacity-60" d="M0,33.75 L45,33.75 L45,39.375 L0,39.375 L0,33.75 Z"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Histori Pengajuan (Reviewer)</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors" href="/organisasi-mahasiswa">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-project-diagram"></i>
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-4H6v4m4 0h6v-4h-4m2-4v-4a2 2 0 112 2h-4a2 2 0 00-2-2"></path>
</svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Organisasi Mahasiswa</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a href="{{ route('jenis-kegiatan.index') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'jenis-kegiatan.index' ? 'bg-blue-500 text-white' : '' }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-clipboard-list text-gray-500"></i>
                <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>settings</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(304.000000, 151.000000)">
                          <polygon class="fill-slate-800 opacity-60" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                          <path class="fill-slate-800 opacity-60" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z"></path>
                          <path class="fill-slate-800" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Jenis Kegiatan</span>
            </a>
          </li> -->

          <!-- <li class="mt-0.5 w-full">
          <a class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'bidang-kegiatan.index' ? 'bg-blue-500 text-white' : '' }}" href="{{ route('bidang-kegiatan.index') }}">
              <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-users text-gray-500"></i>
              <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" d="M5 3h14a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2zM5 3l14 14M5 17l14-14"></path>
</svg>

              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Bidang Kegiatan</span>
            </a>
          </li> -->

          <li class="mt-0.5 w-full">
          <a href="{{ route('event-list.index') }}" 
         class="py-2.7  rounded-lg hover:bg-orange-300 dark:hover:bg-orange-400 group text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors  {{ Route::currentRouteName() == 'event-list.index' ? 'bg-blue-500 text-white' : '' }}">
              <div class="bg-gradient-to-tl white shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
              <i class="fas fa-home text-gray-500"></i>
                <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                  <title>dashboard</title>
                  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                      <g transform="translate(1716.000000, 291.000000)">
                        <g transform="translate(0.000000, 148.000000)">
                          <path class="opacity-60" d="M45,0 L0,0 L0,5.625 L45,5.625 L45,0 Z"></path>
                          <path class="opacity-60" d="M45,39.375 L0,39.375 L0,45 L45,45 L45,39.375 Z"></path>
                          <path class="opacity-60" d="M0,22.5 L45,22.5 L45,28.125 L0,28.125 L0,22.5 Z"></path>
                          <path class="opacity-60" d="M0,11.25 L45,11.25 L45,16.875 L0,16.875 L0,11.25 Z"></path>
                        </g>
                      </g>
                    </g>
                  </g>
                </svg>
              </div>
              <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft min-h-width">Even List</span>
            </a>
          </li>

          
       
    </aside>

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

     <!-- Navbar -->
     <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
        <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
          <nav>
            <!-- breadcrumb -->
            <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
              <span>Pages</span>
                <span class="mx-2">/</span>
                <span class="font-semibold">
                    @if(Route::currentRouteName() == 'proposal_kegiatan.dashboard-pengaju')
                        Dashboard Pengaju
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
                    @else
                        Undefined Page
                    @endif
                </span>
          </nav>

          <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
            <!-- <div class="flex items-center md:ml-auto md:pr-4">

              <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft flex justify-end ml-auto">
                <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all flex justify-end ml-auto">
                  <i class="fas fa-search"></i>
                </span>
                <input type="text" class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow flex" placeholder="Search here..." /> -->
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
</html>