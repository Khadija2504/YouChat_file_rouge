<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css">
        {{-- <link rel="stylesheet" href="../css/style.css"> --}}
        {{-- <link rel="stylesheet" href="{{asset('css/dashboard.css')}}"> --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <style>
          .deleteCommentButton{
            display: none;
          }
          .commentContainer:hover .deleteCommentButton{
             display: block;
          }
          .delete-icon{
            display: none;
          }
          .message-container:hover .delete-icon{
            display: block;
          }
          .toggle {
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            cursor: pointer;
          }
          .navigation.active {
            width: 80px;
          }
          .main.active {
            width: calc(100% - 80px);
            left: 80px;
          }
        </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>


<body class="font-poppins antialiased">
    <div
      id="view"
      class="h-full w-screen flex flex-row container"
      x-data="{ sidenav: false }"
    >
    <button
      @click="sidenav = !sidenav"
      class="p-2 border-2 bg-white rounded-md border-gray-200 shadow-lg text-gray-500 focus:bg-orange-500 focus:outline-none focus:text-white absolute top-0 left-0 sm:hidden"
    >
      <svg
        class="w-5 h-5 fill-current"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
          clip-rule="evenodd"
        ></path>
      </svg>
    </button>
      <div
        id="sidebar"
        class="bg-white h-screen md:block shadow-xl px-3 md:w-90 lg:w-90 overflow-x-hidden transition-transform duration-300 ease-in-out"
        :class="{ 'hidden': !sidenav, 'block': sidenav }"  style="width: 50rem"
        {{-- x-show="sidenav" --}}
      >
        <div class="space-y-6 md:space-y-10 mt-10">
          <h1 class="font-bold text-4xl text-center md:hidden">
            D<span class="text-orange-500">.</span>
          </h1>
          <h1 class="hidden md:block font-bold text-sm md:text-xl text-center">
            YouChat<span class="text-orange-500">.</span>
          </h1>
          <div id="profile" class="space-y-3">
            <a href="{{route('EditProfile')}}" class="relative">
              <img
                src="{{asset('' . Auth::user()->avatar)}}"
                alt="Avatar user"
                class="object-cover bg-yellow-500 rounded-full w-12 h-12 mx-auto"
              />
              @if(Auth::user()->status == 'active')
                <svg width="32px" height="32px" class="material-symbols-outlined absolute top-0 right-[35%] bg-white rounded-full p-1 cursor-pointer" style="font-size: 4rem;color: #333;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M16 3H14.3575C13.5255 3 12.765 3.47005 12.3929 4.21417V4.21417C12.231 4.53795 11.769 4.53795 11.6071 4.21417V4.21417C11.235 3.47005 10.4745 3 9.64251 3H8" stroke="#000000" stroke-width="2"/>
                  <path d="M19 12V6C19 4.34315 17.6569 3 16 3H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H10" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
                  <circle cx="16" cy="18" r="3" stroke="#000000" stroke-width="2"/>
               </svg>
              @elseif(Auth::user()->status == 'inactive')
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon" width="32px" class="material-symbols-outlined absolute top-0 right-[35%] bg-white rounded-full p-1 cursor-pointer" style="font-size: 4rem;color: #333;"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"></path>
              </svg>
              @elseif(Auth::user()->status == 'disabled')
              <svg width="32px" height="32px" class="material-symbols-outlined absolute top-0 right-[35%] bg-white rounded-full p-1 cursor-pointer" style="font-size: 4rem;color: #333;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M1 4C1 2.34315 2.34315 1 4 1H20C21.6569 1 23 2.34315 23 4V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V4C21 3.44772 20.5523 3 20 3H4ZM6 11H18V13H6V11Z" fill="#000000"/>
            </svg>
              @else
              <svg fill="#000000" width="32px" class="material-symbols-outlined absolute top-0 right-[35%] bg-white rounded-full p-1 cursor-pointer" style="font-size: 4rem;color: #333;" height="32px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M20.722,24.964c0.096,0.096,0.057,0.264-0.073,0.306c-7.7,2.466-16.032-1.503-18.594-8.942  c-0.072-0.21-0.072-0.444,0-0.655c0.743-2.157,1.99-4.047,3.588-5.573c0.061-0.058,0.158-0.056,0.217,0.003l4.302,4.302  c0.03,0.03,0.041,0.072,0.031,0.113c-1.116,4.345,2.948,8.395,7.276,7.294c0.049-0.013,0.095-0.004,0.131,0.032  C17.958,22.201,20.045,24.287,20.722,24.964z" id="XMLID_323_"/><path d="M24.68,23.266c2.406-1.692,4.281-4.079,5.266-6.941c0.072-0.21,0.072-0.44,0-0.65  C27.954,9.888,22.35,6,16,6c-2.479,0-4.841,0.597-6.921,1.665L3.707,2.293c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414  l26,26c0.391,0.391,1.023,0.391,1.414,0c0.391-0.391,0.391-1.023,0-1.414L24.68,23.266z M16,10c3.309,0,6,2.691,6,6  c0,1.294-0.416,2.49-1.115,3.471l-8.356-8.356C13.51,10.416,14.706,10,16,10z" id="XMLID_325_"/>
              </svg>
              @endif
            </a>
            <a href="{{route('EditProfile')}}">
            <div>
              <h2
                class="font-medium text-xs md:text-sm text-center text-orange-500"
              >
                {{Auth::user()->name}}
              </h2>
              <p class="text-xs text-gray-500 text-center">{{Auth::user()->user_name}}</p>
            </div>
          </a>
          </div>
          
          <div id="menu" class="flex flex-col space-y-2">
            <a
              href="{{route('home')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out"
            >
              <svg
                class="w-6 h-6 fill-current inline-block"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                ></path>
              </svg>
              <span class="">Home</span>
            </a>
            <a
              href="{{route('savedPosts')}}"
              class="text-sm font-medium text-gray-700 flex justify-start py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
              <span class="material-symbols-outlined">
                bookmarks
                </span>
              <span class="ml-1">Favorites</span>
            </a>
            <a
              href="{{route('displayReels')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
            <svg width="22px" height="22px" class="w-6 h-6 inline-block"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22H15C20 22 22 20 22 15Z" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M2.52002 7.11011H21.48" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8.52002 2.11011V6.97011" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15.48 2.11011V6.52011" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9.75 14.4501V13.2501C9.75 11.7101 10.84 11.0801 12.17 11.8501L13.21 12.4501L14.25 13.0501C15.58 13.8201 15.58 15.0801 14.25 15.8501L13.21 16.4501L12.17 17.0501C10.84 17.8201 9.75 17.1901 9.75 15.6501V14.4501V14.4501Z" stroke="#292D32" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="">Reels</span>
            </a>
            <a
              href="{{route('chatRoom')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
              <svg
                class="w-6 h-6 fill-current inline-block"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z"
                ></path>
                <path
                  d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"
                ></path>
              </svg>
              <span class="">Chat</span>
            </a>
            <a
              href="{{route('displayEvents')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
              <svg
                class="w-6 h-6 fill-current inline-block"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                  clip-rule="evenodd"
                ></path>
              </svg>
              <span class="">Events</span>
            </a>
            <a
              href="{{route('displayVideos')}}"
              class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
            >
            <svg width="22px"  class="w-6 h-6 fill-current inline-block" height="22px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="m11 14 7-4-7-4z"/><path d="M4 8H2v12c0 1.103.897 2 2 2h12v-2H4V8z"/><path d="M20 2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zm-9 12V6l7 4-7 4z"/></svg>
              <span class="">videos</span>
            </a>
            <div class=" relative inline-block text-left dropdown">
              <span class="rounded-md shadow-sm">
              <button class="inline-flex w-full text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out" 
                type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                <svg
                class="w-6 h-6 fill-current inline-block"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"
                ></path>
              </svg>
              <span class="ml-3">My Connections</span>
                  <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              </button
              ></span>
              <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
              <div class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                    <a
                      href="{{route('listFollowers')}}"
                      class="flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105"
                    >Followers</a>
                    <a
                      href="{{route('listFollowings')}}"
                      class="flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105"
                    >Followings</a>
              </div>
              </div>
          </div>
            <style>
              .dropdown:focus-within .dropdown-menu {
                opacity:1;
                transform: translate(0) scale(1);
                visibility: visible;
              }
            </style>
          </div>
        </div>
      </div>
      <main class="main bg-white h-screen md:block shadow-xl px-3 overflow-x-hidden transition-transform duration-300 ease-in-out" id="main" style="width: 300vh">
        <nav class=" bg-white w-full flex relative justify-between items-center mx-auto px-8 h-20">
          {{-- <div class="inline-flex">
              <a class="_o6689fn" href="/"
                  ><div class="hidden md:block">
                      <svg width="102" height="32" fill="currentcolor" style="display: block">
                          <path d="M29.24 22.68c-.16-.39-.31-.8-.47-1.15l-.74-1.67-.03-.03c-2.2-4.8-4.55-9.68-7.04-14.48l-.1-.2c-.25-.47-.5-.99-.76-1.47-.32-.57-.63-1.18-1.14-1.76a5.3 5.3 0 00-8.2 0c-.47.58-.82 1.19-1.14 1.76-.25.52-.5 1.03-.76 1.5l-.1.2c-2.45 4.8-4.84 9.68-7.04 14.48l-.06.06c-.22.52-.48 1.06-.73 1.64-.16.35-.32.73-.48 1.15a6.8 6.8 0 007.2 9.23 8.38 8.38 0 003.18-1.1c1.3-.73 2.55-1.79 3.95-3.32 1.4 1.53 2.68 2.59 3.95 3.33A8.38 8.38 0 0022.75 32a6.79 6.79 0 006.75-5.83 5.94 5.94 0 00-.26-3.5zm-14.36 1.66c-1.72-2.2-2.84-4.22-3.22-5.95a5.2 5.2 0 01-.1-1.96c.07-.51.26-.96.52-1.34.6-.87 1.65-1.41 2.8-1.41a3.3 3.3 0 012.8 1.4c.26.4.45.84.51 1.35.1.58.06 1.25-.1 1.96-.38 1.7-1.5 3.74-3.21 5.95zm12.74 1.48a4.76 4.76 0 01-2.9 3.75c-.76.32-1.6.41-2.42.32-.8-.1-1.6-.36-2.42-.84a15.64 15.64 0 01-3.63-3.1c2.1-2.6 3.37-4.97 3.85-7.08.23-1 .26-1.9.16-2.73a5.53 5.53 0 00-.86-2.2 5.36 5.36 0 00-4.49-2.28c-1.85 0-3.5.86-4.5 2.27a5.18 5.18 0 00-.85 2.21c-.13.84-.1 1.77.16 2.73.48 2.11 1.78 4.51 3.85 7.1a14.33 14.33 0 01-3.63 3.12c-.83.48-1.62.73-2.42.83a4.76 4.76 0 01-5.32-4.07c-.1-.8-.03-1.6.29-2.5.1-.32.25-.64.41-1.02.22-.52.48-1.06.73-1.6l.04-.07c2.16-4.77 4.52-9.64 6.97-14.41l.1-.2c.25-.48.5-.99.76-1.47.26-.51.54-1 .9-1.4a3.32 3.32 0 015.09 0c.35.4.64.89.9 1.4.25.48.5 1 .76 1.47l.1.2c2.44 4.77 4.8 9.64 7 14.41l.03.03c.26.52.48 1.1.73 1.6.16.39.32.7.42 1.03.19.9.29 1.7.19 2.5zM41.54 24.12a5.02 5.02 0 01-3.95-1.83 6.55 6.55 0 01-1.6-4.48 6.96 6.96 0 011.66-4.58 5.3 5.3 0 014.08-1.86 4.3 4.3 0 013.7 1.92l.1-1.57h2.92V23.8h-2.93l-.1-1.76a4.52 4.52 0 01-3.88 2.08zm.76-2.88c.58 0 1.09-.16 1.57-.45.44-.32.8-.74 1.08-1.25.25-.51.38-1.12.38-1.8a3.42 3.42 0 00-1.47-3.04 2.95 2.95 0 00-3.12 0c-.44.32-.8.74-1.08 1.25a4.01 4.01 0 00-.38 1.8 3.42 3.42 0 001.47 3.04c.47.29.98.45 1.55.45zM53.45 8.46c0 .35-.06.67-.22.93-.16.25-.38.48-.67.64-.29.16-.6.22-.92.22-.32 0-.64-.06-.93-.22a1.84 1.84 0 01-.67-.64 1.82 1.82 0 01-.22-.93c0-.36.07-.68.22-.93.16-.3.39-.48.67-.64.29-.16.6-.23.93-.23a1.84 1.84 0 011.6.86 2 2 0 01.21.94zm-3.4 15.3V11.7h3.18v12.08h-3.19zm11.68-8.9v.04c-.15-.07-.35-.1-.5-.13-.2-.04-.36-.04-.55-.04-.89 0-1.56.26-2 .8-.48.55-.7 1.32-.7 2.31v5.93h-3.19V11.69h2.93l.1 1.83c.32-.64.7-1.12 1.24-1.48a3.1 3.1 0 011.81-.5c.23 0 .45.02.64.06.1.03.16.03.22.06v3.2zm1.28 8.9V6.74h3.18v6.5c.45-.58.96-1.03 1.6-1.38a5.02 5.02 0 016.08 1.31 6.55 6.55 0 011.6 4.49 6.96 6.96 0 01-1.66 4.58 5.3 5.3 0 01-4.08 1.86 4.3 4.3 0 01-3.7-1.92l-.1 1.57-2.92.03zm6.15-2.52c.57 0 1.08-.16 1.56-.45.44-.32.8-.74 1.08-1.25.26-.51.38-1.12.38-1.8 0-.67-.12-1.28-.38-1.79a3.75 3.75 0 00-1.08-1.25 2.95 2.95 0 00-3.12 0c-.45.32-.8.74-1.09 1.25a4.01 4.01 0 00-.38 1.8 3.42 3.42 0 001.47 3.04c.47.29.98.45 1.56.45zm7.51 2.53V11.69h2.93l.1 1.57a3.96 3.96 0 013.54-1.89 4.1 4.1 0 013.82 2.44c.35.76.54 1.7.54 2.75v7.24h-3.19v-6.82c0-.84-.19-1.5-.57-1.99-.38-.48-.9-.74-1.56-.74-.48 0-.9.1-1.27.32-.35.23-.64.52-.86.93a2.7 2.7 0 00-.32 1.35v6.92h-3.16zm12.52 0V6.73h3.19v6.5a4.67 4.67 0 013.73-1.89 5.02 5.02 0 013.95 1.83 6.57 6.57 0 011.59 4.48 6.95 6.95 0 01-1.66 4.58 5.3 5.3 0 01-4.08 1.86 4.3 4.3 0 01-3.7-1.92l-.09 1.57-2.93.03zm6.18-2.53c.58 0 1.09-.16 1.56-.45.45-.32.8-.74 1.09-1.25.25-.51.38-1.12.38-1.8a3.42 3.42 0 00-1.47-3.04 2.95 2.95 0 00-3.12 0c-.44.32-.8.74-1.08 1.25a3.63 3.63 0 00-.38 1.8 3.42 3.42 0 001.47 3.04c.47.29.95.45 1.55.45z" ></path>
                      </svg>
                  </div>
                  <div class="block md:hidden">
                      <svg width="30" height="32" fill="currentcolor" style="display: block">
                          <path d="M29.24 22.68c-.16-.39-.31-.8-.47-1.15l-.74-1.67-.03-.03c-2.2-4.8-4.55-9.68-7.04-14.48l-.1-.2c-.25-.47-.5-.99-.76-1.47-.32-.57-.63-1.18-1.14-1.76a5.3 5.3 0 00-8.2 0c-.47.58-.82 1.19-1.14 1.76-.25.52-.5 1.03-.76 1.5l-.1.2c-2.45 4.8-4.84 9.68-7.04 14.48l-.06.06c-.22.52-.48 1.06-.73 1.64-.16.35-.32.73-.48 1.15a6.8 6.8 0 007.2 9.23 8.38 8.38 0 003.18-1.1c1.3-.73 2.55-1.79 3.95-3.32 1.4 1.53 2.68 2.59 3.95 3.33A8.38 8.38 0 0022.75 32a6.79 6.79 0 006.75-5.83 5.94 5.94 0 00-.26-3.5zm-14.36 1.66c-1.72-2.2-2.84-4.22-3.22-5.95a5.2 5.2 0 01-.1-1.96c.07-.51.26-.96.52-1.34.6-.87 1.65-1.41 2.8-1.41a3.3 3.3 0 012.8 1.4c.26.4.45.84.51 1.35.1.58.06 1.25-.1 1.96-.38 1.7-1.5 3.74-3.21 5.95zm12.74 1.48a4.76 4.76 0 01-2.9 3.75c-.76.32-1.6.41-2.42.32-.8-.1-1.6-.36-2.42-.84a15.64 15.64 0 01-3.63-3.1c2.1-2.6 3.37-4.97 3.85-7.08.23-1 .26-1.9.16-2.73a5.53 5.53 0 00-.86-2.2 5.36 5.36 0 00-4.49-2.28c-1.85 0-3.5.86-4.5 2.27a5.18 5.18 0 00-.85 2.21c-.13.84-.1 1.77.16 2.73.48 2.11 1.78 4.51 3.85 7.1a14.33 14.33 0 01-3.63 3.12c-.83.48-1.62.73-2.42.83a4.76 4.76 0 01-5.32-4.07c-.1-.8-.03-1.6.29-2.5.1-.32.25-.64.41-1.02.22-.52.48-1.06.73-1.6l.04-.07c2.16-4.77 4.52-9.64 6.97-14.41l.1-.2c.25-.48.5-.99.76-1.47.26-.51.54-1 .9-1.4a3.32 3.32 0 015.09 0c.35.4.64.89.9 1.4.25.48.5 1 .76 1.47l.1.2c2.44 4.77 4.8 9.64 7 14.41l.03.03c.26.52.48 1.1.73 1.6.16.39.32.7.42 1.03.19.9.29 1.7.19 2.5z"></path>
                      </svg>
                  </div>
              </a>
          </div> --}}
    
          <button @click="sidenav = !sidenav" class="p-2 border-2 bg-white rounded-md border-gray-200 shadow-lg text-gray-500 focus:bg-orange-500 focus:outline-none focus:text-white absolute top-0 left-0 sm:hidden">
            <svg class="w-5 h-5 fill-current" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
            </svg>
        </button>
          <form id="searchForm">
            <div x-data="{ search: '' }"
              class="flex border-2 border-gray-200 rounded-md focus-within:ring-2 ring-teal-500"
            >
              <input
              name="search"
              x-model="search"
              id="searchInput"
                type="search"
                class="w-full rounded-tl-md rounded-bl-md px-2 py-3 text-sm text-gray-600 focus:outline-none"
                placeholder="Search" required
              />
              <div
                class="rounded-tr-md rounded-br-md px-2 py-3 hidden md:block"
              >
                <svg
                  class="w-4 h-4 fill-current"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </div>
            </div>
          </form>
    
          <div class="flex-initial">
            <div class="flex justify-end items-center relative">
            
              <div class="flex mr-4 items-center">
    
                <div class="block relative m-5" id="notification">
                  <a href="{{route('chatRoom')}}">
                    <svg width="28px" height="28px" id="no_messages" style="display: block" viewBox="0 0 24 24" id="_24x24_On_Light_Messages" data-name="24x24/On Light/Messages" xmlns="http://www.w3.org/2000/svg">
                      <rect id="view-box" width="24" height="24" fill="none"/>
                      <path id="Shape" d="M6.485,18.519a9.891,9.891,0,0,1-4.876.981c-.285,0-.584-.006-.887-.018a.739.739,0,0,1-.65-.432.738.738,0,0,1,.085-.775,11.192,11.192,0,0,0,2.072-3.787A9.751,9.751,0,1,1,10.751,19.5,9.661,9.661,0,0,1,6.485,18.519ZM6.808,17a8.247,8.247,0,1,0-3.139-3.015.75.75,0,0,1,.092.535A10.189,10.189,0,0,1,2.2,17.99a7.2,7.2,0,0,0,3.816-.947.745.745,0,0,1,.431-.136A.756.756,0,0,1,6.808,17Zm-.057-4.5a.75.75,0,0,1,0-1.5h7a.75.75,0,0,1,0,1.5Zm0-4a.75.75,0,0,1,0-1.5h5a.75.75,0,1,1,0,1.5Z" transform="translate(1.249 2.25)" fill="#141124"/>
                    </svg>
    
                    <svg width="28px" id="unread_messages" style="display: none" height="28px" viewBox="0 0 24 24" id="_24x24_On_Light_Messages-Alert" data-name="24x24/On Light/Messages-Alert" xmlns="http://www.w3.org/2000/svg">
                      <rect id="view-box" width="24" height="24" fill="none"/>
                      <path id="Shape" d="M10.751,19.5a9.66,9.66,0,0,1-4.266-.981,9.889,9.889,0,0,1-4.876.981c-.279,0-.578-.006-.887-.018a.74.74,0,0,1-.65-.432.738.738,0,0,1,.085-.775,11.191,11.191,0,0,0,2.072-3.787A9.754,9.754,0,0,1,12.682.192a5.478,5.478,0,0,0-.676,1.4A8.252,8.252,0,0,0,3.668,13.983a.75.75,0,0,1,.092.535A10.189,10.189,0,0,1,2.2,17.99a7.2,7.2,0,0,0,3.816-.947.746.746,0,0,1,.431-.136A.755.755,0,0,1,6.808,17a8.254,8.254,0,0,0,12.1-8.5,5.477,5.477,0,0,0,1.4-.676A9.755,9.755,0,0,1,10.751,19.5Zm3-7h-7a.75.75,0,0,1,0-1.5h7a.75.75,0,0,1,0,1.5Zm-2-4h-5a.75.75,0,1,1,0-1.5h5a.75.75,0,0,1,0,1.5Zm6.612-1.931h0a8.34,8.34,0,0,0-4.43-4.43,3.527,3.527,0,0,1,.781-1.3,9.773,9.773,0,0,1,4.946,4.946,3.527,3.527,0,0,1-1.3.781Z" transform="translate(1.249 2.25)" fill="#141124"/>
                      <path id="Shape-2" data-name="Shape" d="M3.5,7A3.5,3.5,0,1,1,7,3.5,3.5,3.5,0,0,1,3.5,7Z" transform="translate(15 2)" fill="#ff6359"/>
                    </svg>
                  </a>
                </div>
                
                <div class="block relative m-5" id="notification">
                  <a
                    href="{{route('notifications')}}"
                  >
                  <svg fill="#000000" width="28px" id="no_notifications" style="display: block" height="28px" viewBox="0 0 24 24" id="notification-bell" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color"><path id="secondary" d="M15,17H9a1,1,0,0,0-1,1,4,4,0,0,0,8,0A1,1,0,0,0,15,17Z" style="fill: rgb(97 97 97);"></path><path id="primary" d="M20.09,13.67,19,12.59V9A7,7,0,0,0,5,9v3.59L3.91,13.67A3.13,3.13,0,0,0,6.12,19H17.88a3.13,3.13,0,0,0,2.21-5.33Z" style="fill: rgb(0, 0, 0);"></path></svg>
                  <svg fill="#000000" width="28px" style="display: none" id="unread_notifications"  height="28px" viewBox="0 0 24 24" id="notification-circle" data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color"><path id="secondary" d="M15,17H9a1,1,0,0,0-1,1,4,4,0,0,0,8,0A1,1,0,0,0,15,17Z" style="fill: rgb(97 97 97);"></path><path id="primary" d="M20.09,13.67,19,12.59V9A7,7,0,0,0,5,9v3.59L3.91,13.67A3.13,3.13,0,0,0,6.12,19H17.88a3.13,3.13,0,0,0,2.21-5.33Z" style="fill: rgb(0, 0, 0);"></path><circle id="secondary-2" data-name="secondary" cx="17" cy="6" r="4" style="fill: rgb(249 115 22);"></circle></svg>
                  </a>
                </div>
              
                <div class="block relative m-5" id="notification">
                  <a href="{{ url('/logout') }}">
                    <span class="material-symbols-outlined" style="font-size: 28px">
                      logout
                    </span>
                    </a>
                </div>
              </div>
            </div>
          </div>
      </nav>
      <div id="search-result-posts"></div>
      <div id="search-result-users"></div>
      <div id="search-result-reels"></div>
      <div id="search-result-videos" class="flex flex-row overflow-x-auto"></div>
      <main id="container">
        @yield('main')
      </main>
      </main>
      <div
          id="sidebar"
          class="bg-white h-screen md:block shadow-xl px-3 md:w-90 lg:w-90 overflow-x-hidden transition-transform duration-300 ease-in-out rightSidebar" :class="{ 'hidden': !sidenav, 'block': sidenav }" style="width: 50rem;"
          @click.away="sidenav = false"
        >
        <div class="space-y-6 md:space-y-10 mt-10">
          <h1 class="font-bold text-4xl text-center md:hidden">
            D<span class="text-teal-600">.</span>
          </h1>
          <h1 class="hidden md:block font-bold text-sm md:text-xl text-center">
            YouChat<span class="text-teal-600">.</span>
          </h1>
          <div id="profile" class="space-y-3">
            @yield('rightSidebar')
          </div>
        <div id="menu" class="flex flex-col space-y-2">
          <a
            href="{{route('welcome')}}"
            class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:text-base rounded-md transition duration-150 ease-in-out"
          >
            <svg
              class="w-6 h-6 fill-current inline-block"
              fill="currentColor"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
              ></path>
            </svg>
            <span class="">welcome</span>
          </a>
          <a
            href="{{route('addFormReel')}}"
            class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
          >
          <svg width="22px" height="22px" class="w-6 h-6 inline-block" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M14.7295 5.86V2.5C14.7295 2.22 14.5095 2 14.2295 2H9.76953C9.48953 2 9.26953 2.22 9.26953 2.5V5.86C9.26953 6.14 9.48953 6.36 9.76953 6.36H14.2295C14.5095 6.36 14.7295 6.14 14.7295 5.86Z" fill="#292D32"/>
            <path d="M7.24851 2.0207C4.68851 2.1807 2.93851 3.5007 2.28851 5.7007C2.18851 6.0307 2.42851 6.3607 2.76851 6.3607H7.26851C7.54851 6.3607 7.76851 6.1407 7.76851 5.8607V2.5207C7.76851 2.2407 7.52851 2.0007 7.24851 2.0207Z" fill="#292D32"/>
            <path d="M16.7505 2.00898C19.3105 2.16898 21.0605 3.48898 21.7105 5.68898C21.8105 6.01898 21.5705 6.34898 21.2305 6.34898H16.7305C16.4505 6.34898 16.2305 6.12898 16.2305 5.84898V2.50898C16.2305 2.22898 16.4705 1.98898 16.7505 2.00898Z" fill="#292D32"/>
            <path d="M22 15.7C22 15.69 21.99 15.68 21.98 15.67C21.94 15.61 21.89 15.55 21.84 15.5C21.83 15.49 21.82 15.47 21.81 15.46C21 14.56 19.81 14 18.5 14C17.24 14 16.09 14.52 15.27 15.36C14.48 16.17 14 17.28 14 18.5C14 19.34 14.24 20.14 14.65 20.82C14.87 21.19 15.15 21.53 15.47 21.81C15.49 21.82 15.5 21.83 15.51 21.84C15.56 21.89 15.61 21.93 15.67 21.98C15.67 21.98 15.67 21.98 15.68 21.98C15.69 21.99 15.7 22 15.71 22C16.46 22.63 17.43 23 18.5 23C20.14 23 21.57 22.12 22.35 20.82C22.58 20.43 22.76 20 22.87 19.55C22.96 19.21 23 18.86 23 18.5C23 17.44 22.63 16.46 22 15.7ZM20.18 19.23H19.25V20.2C19.25 20.61 18.91 20.95 18.5 20.95C18.09 20.95 17.75 20.61 17.75 20.2V19.23H16.82C16.41 19.23 16.07 18.89 16.07 18.48C16.07 18.07 16.41 17.73 16.82 17.73H17.75V16.84C17.75 16.43 18.09 16.09 18.5 16.09C18.91 16.09 19.25 16.43 19.25 16.84V17.73H20.18C20.59 17.73 20.93 18.07 20.93 18.48C20.93 18.89 20.6 19.23 20.18 19.23Z" fill="#292D32"/>
            <path d="M22 8.35937V12.7394C22 13.1094 21.61 13.3494 21.28 13.1794C20.44 12.7394 19.48 12.4994 18.5 12.4994C16.89 12.4994 15.32 13.1594 14.2 14.3094C13.1 15.4294 12.5 16.9194 12.5 18.4994C12.5 19.3094 12.82 20.3494 13.22 21.2194C13.38 21.5694 13.14 21.9994 12.75 21.9994H7.81C4.6 21.9994 2 19.3994 2 16.1894V8.35937C2 8.07937 2.22 7.85938 2.5 7.85938H21.5C21.78 7.85938 22 8.07937 22 8.35937Z" fill="#292D32"/>
          </svg>
            <span class="">Add reel</span>
          </a>
          <a
            href="{{route('createFormEvent')}}"
            class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
          >
          <svg class="w-6 h-6 fill-current inline-block" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
          viewBox="0 0 24 24" xml:space="preserve">
          <style type="text/css">
            .st0{fill:none;}
          </style>
          <path d="M5,2v2H4C2.9,4,2,4.9,2,6v11c0,1.1,0.9,2,2,2h6.8c1.8-1.8,0,0,2-2H4V8h12v5.9c1.6-1.6,0.2-0.2,2-2V6c0-1.1-0.9-2-2-2h-1V2
            h-2v2H7V2H5z M10,9.2l-0.8,2L7,11.4l1.6,1.4l-0.5,2.1l1.8-1.1l1.8,1.1l-0.5-2.1l1.6-1.4l-2.2-0.2L10,9.2z M20.5,12
            c-0.1,0-0.3,0.1-0.4,0.2L19.3,13l2,2l0.8-0.8c0.2-0.2,0.2-0.6,0-0.7l-1.3-1.3C20.8,12,20.6,12,20.5,12z M18.8,13.5L12.3,20v2h2
            l6.5-6.5L18.8,13.5"/>
          <rect class="st0" width="24" height="24"/>
          </svg>
            <span class="">Create an event</span>
          </a>
          <a
            href="{{route('addVideoForm')}}"
            class="text-sm font-medium text-gray-700 py-2 px-2 hover:bg-orange-500 hover:text-white hover:scale-105 rounded-md transition duration-150 ease-in-out"
          >
          <svg fill="#000000" width="22px"  class="w-6 h-6 fill-current inline-block" height="22px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
            <path d="M960 293.333v160H186.667C171.939 453.333 160 465.272 160 480v1253.33c0 14.73 11.939 26.67 26.667 26.67H1440c14.73 0 26.67-11.94 26.67-26.67V960h160v773.33c0 103.1-83.58 186.67-186.67 186.67H186.667C83.573 1920 0 1836.43 0 1733.33V480c0-103.093 83.573-186.667 186.667-186.667H960ZM586.667 800 1120 1120l-533.333 320V800ZM1626.67 0v293.333H1920v160h-293.33v293.334h-160V453.333h-293.34v-160h293.34V0h160Z" fill-rule="evenodd"/>
          </svg>
            <span class="">Add videos</span>
          </a>
        </div>
        </div>
      </div>
    </div>

  <script src="{{asset('js/dashboard.js')}}"></script>
  <script>
    if(window.location.pathname == '/chatRoom'){
      $(".rightSidebar").hide();
      $("#main").css("width", "410vh");
      $("#main").css("overflow-y", "hidden");
    }

    $(document).ready(function(){
        $('#searchInput').on('keyup', function(event){
            event.preventDefault();
            searchValue = $(this).val();
            var searchResultPosts = $('#search-result-posts');
            var searchResultUsers = $('#search-result-users');
            var searchResultReels = $('#search-result-reels');
            var searchResultVideos = $('#search-result-videos');
            var container = document.getElementById('container');
            if(searchValue.trim() === '') {
              searchResultPosts.empty();
              searchResultUsers.empty();
              searchResultReels.empty();
              searchResultVideos.empty();
              container.style.display = 'block';
        } else {

            var formData = new FormData($('#searchForm')[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: "http://127.0.0.1:8000/search",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    container.style.display = 'none';
                    searchResultPosts.empty();
                    data.post.forEach(function(item) {
                        var result = `
                            <div class="max-w-3xl w-full mx-auto z-10">
                                <div class="flex flex-col">
                                    <div class="bg-white border border-white shadow-lg rounded-3xl p-4 m-4">
                                        <div class="flex-none sm:flex">
                                            <div class=" relative h-32 w-32">
                                                <img src="${item.users.avatar_url}" class=" w-32 h-32 object-cover rounded-2xl">
                                            </div>
                                            <div class="flex-auto sm:ml-5 justify-evenly">
                                                <div class="flex items-center justify-between sm:mt-2">
                                                    <div class="flex items-center">
                                                        <div class="flex flex-col">
                                                            <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">${item.users.name}</div>
                                                            <div class="flex-auto text-gray-500 my-1">
                                                                <span class="mr-3 ">${item.description}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex pt-2 text-sm text-gray-500">
                                                    <div class="flex-1 inline-flex items-center">
                                                        <a href="${item.post_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the post </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                        `;
                        searchResultPosts.append(result);
                    });
                    searchResultUsers.empty();
                    data.users.forEach(function(item) {
                      var user = `
                      <div class="max-w-3xl w-full mx-auto z-10">
                          <div class="flex flex-col">
                              <div class="bg-white border border-white shadow-lg rounded-3xl p-4 m-4">
                                  <div class="flex-none sm:flex">
                                      <div class=" relative h-32 w-32">
                                          <img src="${item.avatar_url}" class=" w-32 h-32 object-cover rounded-2xl">
                                      </div>
                                      <div class="flex-auto sm:ml-5 justify-evenly">
                                          <div class="flex items-center justify-between sm:mt-2">
                                              <div class="flex items-center">
                                                  <div class="flex flex-col">
                                                      <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">${item.name}</div>
                                                      <div class="flex-auto text-gray-500 my-1">
                                                          <span class="mr-3 ">${item.followers_count} follower</span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="flex pt-2 text-sm text-gray-500">
                                              <div class="flex-1 inline-flex items-center">
                                                  <a href="${item.user_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the profile </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div> `;
                    searchResultUsers.append(user);
                    });
                    searchResultVideos.empty();
                    data.videos.forEach(function(item){
                      var video = `
                        <div class="max-w-3xl w-full mx-auto z-10">
                          <div class="flex flex-col">
                            <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                              <div class="flex-none sm:flex">
                                <div class=" relative h-32 w-32">
                                  <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                                    <source src="${item.video_path}" type="video/${item.video_type}">
                                  </video>
                                </div>
                                <div class="flex-auto sm:ml-5 justify-evenly">
                                  <div class="flex items-center justify-between sm:mt-2">
                                    <div class="flex items-center">
                                      <div class="flex flex-col">
                                        <div class="flex-auto text-gray-500 my-1">
                                          <span class="mr-3 ">${item.titre}</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="flex pt-2 text-sm text-gray-500">
                                    <div class="flex-1 inline-flex items-center">
                                      <a href="${item.video_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the video </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      `;
                    searchResultVideos.append(video);
                    });

                    searchResultReels.empty();
                    data.reels.forEach(function(item){
                      var reel = `
                        <div class="max-w-3xl w-full mx-auto z-10">
                          <div class="flex flex-col">
                            <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                              <div class="flex-none sm:flex">
                                <div class=" relative h-32 w-32">
                                  <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                                    <source src="${item.reel_path}" type="video/${item.reel_type}">
                                  </video>
                                </div>
                                <div class="flex-auto sm:ml-5 justify-evenly">
                                  <div class="flex items-center justify-between sm:mt-2">
                                    <div class="flex items-center">
                                      <div class="flex flex-col">
                                        <div class="flex-auto text-gray-500 my-1">
                                          <span class="mr-3 ">${item.description}</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="flex pt-2 text-sm text-gray-500">
                                    <div class="flex-1 inline-flex items-center">
                                      <a href="${item.reel_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the reel </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      `;
                    searchResultReels.append(reel);
                    });
                },
            });
          }
        });
    });
  </script>