<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard | Korsat X Parmaga</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
    {{-- <link rel="stylesheet" href="../css/style.css"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <div
        id="sidebar"
        class="h-screen md:block shadow-xl px-3 md:w-90 lg:w-90 overflow-x-hidden transition-transform duration-300 ease-in-out" style="width: 50rem; background-color:rgb(228, 228, 228)"
        x-show="sidenav"
        {{-- @click.away="sidenav = false" --}}
      >
        <div class="space-y-6 md:space-y-10 mt-10">
          <h1 class="font-bold text-4xl text-center md:hidden">
            D<span class="text-teal-600">.</span>
          </h1>
          <h1 class="hidden md:block font-bold text-sm md:text-xl text-center">
            YouChat<span class="text-teal-600">.</span>
          </h1>
          <a href="{{route('EditProfile')}}" id="profile" class="space-y-3">
            <img
              src="{{asset('' . Auth::user()->avatar)}}"
              alt="Avatar user"
              class="object-cover bg-yellow-500 rounded-full w-12 h-12 mx-auto"
            />
          <div>
              <a href="{{route('EditProfile')}}"
                class="font-medium text-xs md:text-sm text-center text-teal-500"
              >
                {{Auth::user()->name}}
              </a>
              <p class="text-xs text-gray-500 text-center">{{Auth::user()->email}}</p>
            </div>
          </a>
          
          <div id="menu" class="flex flex-col space-y-2">
            <a
              href="{{route('dashboard')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out"
            >
              <svg
                class="w-9 h-9 fill-current inline-block"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                ></path>
              </svg>
              <span class="ml-8">Dashboard</span>
            </a>
            <a
              href="{{route('welcome')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
            <svg width="40px" height="40px" class="w-9 h-9 fill-current inline-block" viewBox="0 0 24 24" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

              <style type="text/css">
                .st0{opacity:0.2;fill:none;stroke:#000000;stroke-width:5.000000e-02;stroke-miterlimit:10;}
              </style>
              
              <g id="grid_system"/>
              
              <g id="_icons">
              
              <path d="M7,21h10c2.2,0,4-1.8,4-4v-6.5c0-1.3-0.6-2.4-1.6-3.2l-5-3.8C13,2.5,11,2.5,9.6,3.6l-5,3.7C3.6,8.1,3,9.2,3,10.5V17   C3,19.2,4.8,21,7,21z M5,10.5c0-0.6,0.3-1.2,0.8-1.6l5-3.8c0.4-0.3,0.8-0.4,1.2-0.4s0.8,0.1,1.2,0.4l5,3.8c0.5,0.4,0.8,1,0.8,1.6   V17c0,1.1-0.9,2-2,2H7c-1.1,0-2-0.9-2-2V10.5z"/>
              
              </g>
              
              </svg>
              <span class="ml-8">Home</span>
            </a>
            <a
              href="{{route('usersList')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
            <svg
            class="w-9 h-9 fill-current inline-block"
            fill="currentColor"
            viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
            ></path>
          </svg>
              <span class="ml-8">Users list</span>
            </a>
          </div>
        </div>
      </div>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
            </div>
            @yield('main')
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="{{asset('js/dashboard.js')}}"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>