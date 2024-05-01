@extends('layouts.app')
@section('main')
<style>
    .page {
        display: none;
    }
    .active {
        display: block;
    }
</style>
@foreach($users as $user)
    <div class="h-full">
        <div class="">
            <div class="relative flex items-top justify-center min-h-screen bg-white dark:bg-gray-900 sm:items-center sm:pt-0">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                    <div class="mt-8 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-2">
                            <div class="p-6 mr-2 bg-gray-100 dark:bg-gray-800 sm:rounded-lg">
                                <h1 class="text-4xl sm:text-5xl text-gray-800 dark:text-white font-extrabold tracking-tight">
                                    Update your profile
                                </h1>
                                <div class="flex items-center mt-8 text-gray-600 dark:text-gray-400">
                                <form class="p-6 flex flex-col justify-center" action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <label for="avatarInput" class="relative">
                                        <img src="{{ asset($user->avatar) }}" class="w-40 h-40 m-auto rounded-full shadow cursor-pointer" />
                                        <span class="material-symbols-outlined absolute top-0 right-0 bg-white rounded-full p-1 cursor-pointer" style="font-size: 4rem;color: #333;">edit</span>
                                    </label>
                                    <input type="file" id="avatarInput" name="avatar" accept=".png, .jpg, .jpeg" style="display: none;" />
                                    <input type="hidden" name="name" value="{{$user->name}}" required>
                                    <input type="hidden" name="email" value="{{$user->email}}" required>
                                    <input type="hidden" name="about" value="{{$user->about}}" required>
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 mt-2 ml-3">Update photo</button>
                                </form>
                                </div>
                            </div>
        
                            <form class="p-6 flex flex-col justify-center" action="{{route('updateProfile')}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="flex flex-col">
                                    <label for="name" class="">Name</label>
                                    <input name="name" type="text" value="{{$user->name}}" id="username" placeholder="Username" required class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
                                </div>

                                <div class="flex flex-col mt-2">
                                    <label for="text" class="">Country</label>
                                    <input type="text" id="country" value="{{$user->country}}" name="contry" placeholder="Country" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
                                </div>

                                <div class="flex flex-col mt-2">
                                    <label for="text" class="">City</label>
                                    <input type="text" id="city" value="{{$user->city}}" name="city" placeholder="City" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
                                </div>

                                <div class="flex flex-col mt-2">
                                    <label for="text" class="">About</label>
                                    <input type="text" id="about" value="{{$user->about}}" name="about" placeholder="about" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
                                </div>
                                <input type="hidden" name="avatar" value="{{$user->avatar}}" required>

                                <div class="flex flex-col mt-2">
                                    <label for="email" class="">Email</label>
                                    <input type="email" name="email" id="email" value="{{$user->email}}" placeholder="email" class="w-100 mt-2 py-3 px-3 rounded-lg bg-white dark:bg-gray-800 border border-gray-400 dark:border-gray-700 text-gray-800 font-semibold focus:border-indigo-500 focus:outline-none">
                                </div>
        
                                <button type="submit" class="md:w-32 bg-indigo-600 hover:bg-blue-dark text-white font-bold py-3 px-6 rounded-lg mt-3 hover:bg-indigo-500 transition ease-in-out duration-300">
                                    Edit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex flex-row justify-start items-center">
                <svg width="28px" height="28px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none">

                    <g fill="#000000" fill-rule="evenodd" clip-rule="evenodd">
                    
                    <path d="M7.734 4.192C6.572 3.402 5 4.234 5 5.64v4.722c0 1.405 1.572 2.237 2.734 1.447l3.472-2.36a1.75 1.75 0 000-2.895l-3.472-2.36zM6.5 5.64c0-.2.225-.32.39-.206l3.472 2.36a.25.25 0 010 .414l-3.471 2.36a.25.25 0 01-.391-.206V5.639z"/>
                    
                    <path d="M7.25 0A1.75 1.75 0 005.5 1.728a6.715 6.715 0 00-.167.07 1.75 1.75 0 00-2.46.015l-1.06 1.06a1.75 1.75 0 00-.015 2.46 6.712 6.712 0 00-.07.167A1.75 1.75 0 000 7.25v1.5c0 .96.772 1.738 1.728 1.75l.07.167a1.75 1.75 0 00.015 2.46l1.06 1.06a1.75 1.75 0 002.46.015l.167.07A1.75 1.75 0 007.25 16h1.5a1.75 1.75 0 001.75-1.728l.167-.07a1.75 1.75 0 002.46-.015l1.06-1.06a1.75 1.75 0 00.015-2.46l.07-.167A1.75 1.75 0 0016 8.75v-1.5a1.75 1.75 0 00-1.728-1.75 6.185 6.185 0 00-.07-.167 1.75 1.75 0 00-.015-2.46l-1.06-1.06a1.75 1.75 0 00-2.46-.015 6.794 6.794 0 00-.167-.07A1.75 1.75 0 008.75 0h-1.5zM7 1.75a.25.25 0 01.25-.25h1.5a.25.25 0 01.25.25v.51c0 .33.216.62.532.717.326.1.64.23.936.388a.75.75 0 00.884-.131l.36-.36a.25.25 0 01.354 0l1.06 1.06a.25.25 0 010 .354l-.36.36a.75.75 0 00-.131.884c.158.296.289.61.388.936a.75.75 0 00.718.532h.509a.25.25 0 01.25.25v1.5a.25.25 0 01-.25.25h-.51a.75.75 0 00-.717.532c-.1.326-.23.64-.388.936a.75.75 0 00.131.884l.36.36a.25.25 0 010 .354l-1.06 1.06a.25.25 0 01-.354 0l-.36-.36a.75.75 0 00-.884-.131c-.296.158-.61.289-.936.388a.75.75 0 00-.532.718v.509a.25.25 0 01-.25.25h-1.5a.25.25 0 01-.25-.25v-.51a.75.75 0 00-.532-.717c-.326-.1-.64-.23-.936-.388a.75.75 0 00-.884.131l-.36.36a.25.25 0 01-.354 0l-1.06-1.06a.25.25 0 010-.354l.36-.36a.75.75 0 00.131-.884 5.213 5.213 0 01-.388-.936A.75.75 0 002.259 9H1.75a.25.25 0 01-.25-.25v-1.5A.25.25 0 011.75 7h.51a.75.75 0 00.717-.532c.1-.326.23-.64.388-.936a.75.75 0 00-.131-.884l-.36-.36a.25.25 0 010-.354l1.06-1.06a.25.25 0 01.354 0l.36.36a.75.75 0 00.884.131c.296-.158.61-.289.936-.388A.75.75 0 007 2.259V1.75z"/>
                    
                    </g>
                    
                    </svg>
                <p class="ml-5">parameters</p>                    
                </div>
                <div class="flex flex-wor justify-center items-center">
                    <div class="relative inline-block text-left">
                        <button id="dropdown-button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-blue-500">
                            Your status
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M6.293 9.293a1 1 0 011.414 0L10 11.586l2.293-2.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="dropdown-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                            <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">
                                <button data-user-status="active" class="statusBtn flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                    <svg width="18px" height="18px" class="mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 3H14.3575C13.5255 3 12.765 3.47005 12.3929 4.21417V4.21417C12.231 4.53795 11.769 4.53795 11.6071 4.21417V4.21417C11.235 3.47005 10.4745 3 9.64251 3H8" stroke="#000000" stroke-width="2"/>
                                        <path d="M19 12V6C19 4.34315 17.6569 3 16 3H8C6.34315 3 5 4.34315 5 6V18C5 19.6569 6.34315 21 8 21H10" stroke="#000000" stroke-width="2" stroke-linecap="round"/>
                                        <circle cx="16" cy="18" r="3" stroke="#000000" stroke-width="2"/>
                                    </svg> Active
                                </button>
                                <button data-user-status="inactive" class="statusBtn flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="moon" width="18px" class="mr-2"><path d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z"></path>
                                    </svg> Inactive
                                </button>
                                <button data-user-status="invisible" class="statusBtn flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                    <svg fill="#000000" width="18px" class="mr-2" height="18px" viewBox="0 0 32 32" enable-background="new 0 0 32 32" id="Glyph" version="1.1" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M20.722,24.964c0.096,0.096,0.057,0.264-0.073,0.306c-7.7,2.466-16.032-1.503-18.594-8.942  c-0.072-0.21-0.072-0.444,0-0.655c0.743-2.157,1.99-4.047,3.588-5.573c0.061-0.058,0.158-0.056,0.217,0.003l4.302,4.302  c0.03,0.03,0.041,0.072,0.031,0.113c-1.116,4.345,2.948,8.395,7.276,7.294c0.049-0.013,0.095-0.004,0.131,0.032  C17.958,22.201,20.045,24.287,20.722,24.964z" id="XMLID_323_"/><path d="M24.68,23.266c2.406-1.692,4.281-4.079,5.266-6.941c0.072-0.21,0.072-0.44,0-0.65  C27.954,9.888,22.35,6,16,6c-2.479,0-4.841,0.597-6.921,1.665L3.707,2.293c-0.391-0.391-1.023-0.391-1.414,0s-0.391,1.023,0,1.414  l26,26c0.391,0.391,1.023,0.391,1.414,0c0.391-0.391,0.391-1.023,0-1.414L24.68,23.266z M16,10c3.309,0,6,2.691,6,6  c0,1.294-0.416,2.49-1.115,3.471l-8.356-8.356C13.51,10.416,14.706,10,16,10z" id="XMLID_325_"/>
                                    </svg> invisible
                                </button>
                                <button data-user-status="disabled" class="statusBtnflex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                    <svg width="16px" height="16px" class="mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1 4C1 2.34315 2.34315 1 4 1H20C21.6569 1 23 2.34315 23 4V20C23 21.6569 21.6569 23 20 23H4C2.34315 23 1 21.6569 1 20V4ZM4 3C3.44772 3 3 3.44772 3 4V20C3 20.5523 3.44772 21 4 21H20C20.5523 21 21 20.5523 21 20V4C21 3.44772 20.5523 3 20 3H4ZM6 11H18V13H6V11Z" fill="#000000"/>
                                    </svg> disabled
                                </button>
                            </div>
                        </div>
                    </div>
                        <div class="flex items-center justify-center p-12">
                        <div class=" relative inline-block text-left dropdown">
                            <span class="rounded-md shadow-sm"
                            ><button class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800" 
                            type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                                <span>Acceptation: </span> <div id="real-acceptation" style="display: block">{{$user->acceptation}}</div> <div id="new-acceptation"></div>
                                <svg class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button
                            ></span>
                            <div class="opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                            <div class="absolute right-0 w-48 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                                <div class="px-4 py-3">         
                                    <button data-acceptation-change="auto" class="acceptation_btn flex block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                        Auto
                                    </button>
                                    <button data-acceptation-change="manuelle" class="acceptation_btn block rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer">
                                        Manuelle
                                    </button>
                                </div>
                            </div>
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
        <div class="bg-white rounded-lg shadow-xl p-8">
            <div class="flex items-center justify-between">
                <h4 class="text-xl text-gray-900 font-bold">Blocked users ({{$user->followers->where('blocked', '1')->count()}})</h4>
                <a href="#" title="View All">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500 hover:text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 2xl:grid-cols-8 gap-8 mt-8">
                @foreach($user->followers as $blocked)
                <a href="{{route('profile', $blocked->users->id)}}" class="flex flex-col items-center justify-center text-gray-800 hover:text-blue-600" title="View Profile">
                    <img src="{{asset('' . $blocked->users->avatar)}}" class="w-16 rounded-full">
                    <p class="text-center font-bold text-sm mt-1">{{$blocked->users->name}}</p>
                    <p class="text-xs text-gray-500 text-center">{{$blocked->users->user_nams}}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    <script>
        const dropdownButton = document.getElementById('dropdown-button');
        const dropdownMenu = document.getElementById('dropdown-menu');
        let isDropdownOpen = false;

        function toggleDropdown() {
            isDropdownOpen = !isDropdownOpen;
            if (isDropdownOpen) {
                dropdownMenu.classList.remove('hidden');
            } else {
                dropdownMenu.classList.add('hidden');
            }
        }

        dropdownButton.addEventListener('click', toggleDropdown);

        window.addEventListener('click', (event) => {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
                isDropdownOpen = false;
            }
        });

        $(document).ready(function(){
            $('.statusBtn').on('click', function(){
                var userStatus = $(this).data("user-status");
                console.log(userStatus);
                $.ajax({
                    url: `http://127.0.0.1:8000/profile/status/${userStatus}`,
                    method: "GET",
                    success: function(data){
                        console.log(data);
                    }
                });
            });
        });
        $(document).ready(function(){
            $('.acceptation_btn').on('click', function(){
                var acceptationChange = $(this).data("acceptation-change");
                const realAcceptation = document.getElementById('real-acceptation');
                var newAcceptation = document.getElementById('new-acceptation');
                console.log(acceptationChange);
                $.ajax({
                    url: `http://127.0.0.1:8000/acceptationChoose/${acceptationChange}`,
                    method: "GET",
                    success: function(data){
                        console.log(data);
                        realAcceptation.style.display = 'none';
                        newAcceptation.innerHTML = "";
                        newAcceptation.append(acceptationChange);
                    }
                });
            });
        });


    </script>

@endsection
