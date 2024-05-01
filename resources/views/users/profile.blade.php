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
    <div class="h-full p-8">
        <div class="bg-white rounded-lg shadow-xl pb-8 relative">
            <div x-data="{ openSettings: false }" class="absolute">
                <button @click="openSettings = !openSettings" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                    </svg>
                </button>
                <div x-show="openSettings" @click.away="openSettings = false" class="bg-white absolute left-50 w-40 py-2 mt-1 border border-gray-200 shadow-2xl" style="display: none;">
                    <div class="py-2 border-b">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Settings</p>
                        <button class="w-full flex items-center px-6 py-1.5 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Share Profile</span>
                        </button>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Block User</span>
                        </button>
                        @if($user->id == Auth::user()->id)
                        <a href="{{route('EditProfile')}}">
                            <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-700">Modify your personal infos</span>
                            </button>
                        </a>
                        @endif
                    </div>
                    <div class="py-2">
                        <p class="text-gray-400 text-xs px-6 uppercase mb-1">Feedback</p>
                        <button class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span class="text-sm text-gray-700">Report</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="w-full h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="w-full h-full rounded-tl-lg rounded-tr-lg">
            </div>
            <div class="flex flex-col items-center -mt-20">
                <img src="{{asset('' . $user->avatar)}}" class="w-40 border-4 border-white rounded-full">
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{$user->name}}</p>
                    <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                </div>
                <p class="text-gray-700">{{$user->email}}</p>
                @if($isFollowed)
                 @if(!$isBlocked)
                    <div class="flex flex-row justify-between">
                        <a href="{{route('listFollowings')}}" class="text-sm mr-5 text-gray-500">{{$user->followers->count()}} following</a>
                        <a href="{{route('listFollowers')}}" class="text-sm ml-5 text-gray-500">{{$followers}} followers</a>
                    </div>
                 @else
                    <div class="flex flex-row justify-between">
                        <a class="text-sm mr-5 text-gray-500">0 following</a>
                        <a class="text-sm ml-5 text-gray-500">0 followers</a>
                    </div>
                 @endif
                @else
                    <div class="flex flex-row justify-between">
                        <a href="{{route('listFollowings')}}" class="text-sm mr-5 text-gray-500">{{$user->followers->count()}} following</a>
                        <a href="{{route('listFollowers')}}" class="text-sm ml-5 text-gray-500">{{$followers}} followers</a>
                    </div>
                @endif
                <div id="description_{{ $user->id }}" class="whitespace-pre-wrap mt-7" style="display: block;">{{ Illuminate\Support\Str::limit($user->about, 20) }}</div>
                <div id="fullDescription_{{ $user->id }}" class="whitespace-pre-wrap mt-7" style="display: none;">{{ $user->about }}</div>
                <button onclick="toggleDescription({{ $user->id }})" id="showMore_{{ $user->id }}" style="display: block">
                    <span class="material-symbols-outlined">
                    visibility
                    </span>
                </button>
            </div>
            <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
                <div class="flex items-center space-x-4 mt-2">
                    @if($user->id != Auth::user()->id)
                    @if(!$isFollowed)
                    <button onclick="Swal.fire({
                        icon: 'success',
                        title: 'Followed successfully',
                        showConfirmButton: false,
                        timer: 1500
                      });" id="follower_user" data-follow-user="{{$user->id}}" style="display: block">
                            <div class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                <div class="mr-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                                    </svg>
                                </div>
                                Follow
                            </div>
                    </button>
                    @else
                        @if(!$isBlocked)
                            <a href="{{ route('block', $user->id) }}">
                                <button type="submit">
                                    <div class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                        <div class="mr-1">
                                            <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="12" cy="6" r="4" fill="#1C274C"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M18 15.75C16.7574 15.75 15.75 16.7574 15.75 18C15.75 18.3473 15.8287 18.6763 15.9693 18.97L18.9701 15.9693C18.6763 15.8287 18.3474 15.75 18 15.75ZM20.0307 17.0299L17.0299 20.0307C17.3236 20.1713 17.6526 20.25 18 20.25C19.2426 20.25 20.25 19.2426 20.25 18C20.25 17.6526 20.1713 17.3237 20.0307 17.0299ZM14.25 18C14.25 15.9289 15.9289 14.25 18 14.25C20.0711 14.25 21.75 15.9289 21.75 18C21.75 20.0711 20.0711 21.75 18 21.75C15.9289 21.75 14.25 20.0711 14.25 18Z" fill="#1C274C"/>
                                                <path opacity="0.5" d="M17.2157 14.3321C15.5211 14.6927 14.25 16.1979 14.25 18C14.25 18.9823 14.6277 19.8764 15.2457 20.5449C14.2756 20.8356 13.1714 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C14.0722 13 15.934 13.5145 17.2157 14.3321Z" fill="#1C274C"/>
                                            </svg>
                                        </div>
                                        Block
                                    </div>
                                </button>
                            </a>
                        @else
                        <a href="{{ route('block', $user->id) }}">
                            <button type="submit">
                                <div class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                    <div class="mr-1">
                                        <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="12" cy="6" r="4" fill="#1C274C"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18 15.75C16.7574 15.75 15.75 16.7574 15.75 18C15.75 18.3473 15.8287 18.6763 15.9693 18.97L18.9701 15.9693C18.6763 15.8287 18.3474 15.75 18 15.75ZM20.0307 17.0299L17.0299 20.0307C17.3236 20.1713 17.6526 20.25 18 20.25C19.2426 20.25 20.25 19.2426 20.25 18C20.25 17.6526 20.1713 17.3237 20.0307 17.0299ZM14.25 18C14.25 15.9289 15.9289 14.25 18 14.25C20.0711 14.25 21.75 15.9289 21.75 18C21.75 20.0711 20.0711 21.75 18 21.75C15.9289 21.75 14.25 20.0711 14.25 18Z" fill="#1C274C"/>
                                            <path opacity="0.5" d="M17.2157 14.3321C15.5211 14.6927 14.25 16.1979 14.25 18C14.25 18.9823 14.6277 19.8764 15.2457 20.5449C14.2756 20.8356 13.1714 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C14.0722 13 15.934 13.5145 17.2157 14.3321Z" fill="#1C274C"/>
                                        </svg>
                                    </div>
                                    Unblock
                                </div>
                            </button>
                        </a>
                        @endif
                    @endif
                    <a href="{{route('createconversation', $user->id)}}">
                        <button class="flex items-center bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 rounded text-sm space-x-2 transition duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Message</span>
                        </button>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-xl pb-8">
            <div class="grid grid-cols-4">
                <button onclick="showReelsPage()" class="mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="border-b-2 border-gray-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </button>
                <button onclick="showusersPage()" class="mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </button>
                <button class="mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>
                <button class="mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </button>
            </div>
        </div>
        @if(!$isFollowed)
                <div class="bg-white rounded-lg shadow-xl pb-8" id="reelsPage">
                    <div id="usersPage" class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                        @foreach($user->reels as $reel)
                            <div class="relative w-full h-60 bg-cover bg-center bg-no-repeat"  id="reelsPage" style="background-image: url('https://sf-tk-sg.ibytedtos.com/obj/tiktok-web-sg/tt-sg-article-cover-351970d5103b996fbe9ddc67f6d668cc.gif');">
                                <a href="{{ route('readReel', $reel->id) }}" class="absolute bottom-1 left-1 flex gap-1 text-white text-xs items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{$reel->description}}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-xl pb-8">
                    <div class="grid grid-cols-4 gap-0.5 mt-2">
                        @foreach($user->posts as $post)
                            <div class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                                
                                <a href="" class="z-20 absolute h-full w-full top-0 left-0 ">&nbsp;</a>
                                
                                <div class="bg-white py-4 px-3">
                                <h3 class="text-xs mb-2 font-medium">{{$post->description}}</h3>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-gray-400">
                                    {{$post->comments->count()}} comments
                                </p>
                                <div class="relative z-40 flex items-center gap-2">
                                    <a class="text-orange-600 hover:text-blue-500" href="{{ route('readPost', $post->id) }}">
                                        Read more
                                    </a>
                                </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-xl pb-8">
                    <div class="grid grid-cols-4 gap-0.5 mt-2">
                        @foreach($user->events as $event)
                            <div class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                                                        
                                <div class="bg-white py-4 px-3">
                                <h3>{{$event->title}}</h3>
                                <h2 class="text-xs mb-2 font-medium">{{$event->description}}</h2>
                                <div class="flex justify-between items-center">
                                    <p class="text-xs text-gray-400">
                                    {{$event->voteEvent->count()}} reactions
                                    </p>
                                <div class="relative z-40 flex items-center gap-2">
                                    <div class="text-orange-600 hover:text-blue-500">
                                        {{$event->date}}
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-xl pb-8">
                    <div class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                        @foreach($user->videos as $video)
                            <div class="relative w-full h-60 bg-cover bg-center bg-no-repeat"  id="videosPage" style="background-image: url('https://sf-tk-sg.ibytedtos.com/obj/tiktok-web-sg/tt-sg-article-cover-351970d5103b996fbe9ddc67f6d668cc.gif');">
                                <a href="{{ route('readVideo', $video->id) }}" class="absolute bottom-1 left-1 flex gap-1 text-white text-xs items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>{{$video->description}}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
        @else
            @if(!$isBlocked)
            <div class="bg-white rounded-lg shadow-xl pb-8" id="reelsPage">
                <div id="usersPage" class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                    @foreach($user->reels as $reel)
                        <div class="relative w-full h-60 bg-cover bg-center bg-no-repeat"  id="reelsPage" style="background-image: url('https://sf-tk-sg.ibytedtos.com/obj/tiktok-web-sg/tt-sg-article-cover-351970d5103b996fbe9ddc67f6d668cc.gif');">
                            <a href="{{ route('readReel', $reel->id) }}" class="absolute bottom-1 left-1 flex gap-1 text-white text-xs items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{$reel->description}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-xl pb-8">
                <div class="grid grid-cols-4 gap-0.5 mt-2">
                    @foreach($user->posts as $post)
                        <div class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                            
                            <a href="" class="z-20 absolute h-full w-full top-0 left-0 ">&nbsp;</a>
                            
                            <div class="bg-white py-4 px-3">
                            <h3 class="text-xs mb-2 font-medium">{{$post->description}}</h3>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-400">
                                {{$post->comments->count()}} comments
                            </p>
                            <div class="relative z-40 flex items-center gap-2">
                                <a class="text-orange-600 hover:text-blue-500" href="{{ route('readPost', $post->id) }}">
                                    Read more
                                </a>
                            </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-xl pb-8">
                <div class="grid grid-cols-4 gap-0.5 mt-2">
                    @foreach($user->events as $event)
                        <div class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                                                    
                            <div class="bg-white py-4 px-3">
                            <h3>{{$event->title}}</h3>
                            <h2 class="text-xs mb-2 font-medium">{{$event->description}}</h2>
                            <div class="flex justify-between items-center">
                                <p class="text-xs text-gray-400">
                                {{$event->voteEvent->count()}} reactions
                                </p>
                            <div class="relative z-40 flex items-center gap-2">
                                <div class="text-orange-600 hover:text-blue-500">
                                    {{$event->date}}
                                </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-xl pb-8">
                <div class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                    @foreach($user->videos as $video)
                        <div class="relative w-full h-60 bg-cover bg-center bg-no-repeat"  id="videosPage" style="background-image: url('https://sf-tk-sg.ibytedtos.com/obj/tiktok-web-sg/tt-sg-article-cover-351970d5103b996fbe9ddc67f6d668cc.gif');">
                            <a href="{{ route('readVideo', $video->id) }}" class="absolute bottom-1 left-1 flex gap-1 text-white text-xs items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>{{$video->description}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            @else
                <div>No data</div>
            @endif
        @endif

    </div>
    @endforeach

    <script>
    $(document).ready(function(){
        $(document).on('click', '#follower_user', function(){
            var follow_id = $(this).data('follow-user');
            var followButton = $('#follower_user');
            var blockButton =   $('#Block-Button');
            console.log(follow_id);
            $.ajax({
                url: `http://127.0.0.1:8000/follow/${follow_id}`,
                type: "GET",
                success: function(data){
                    console.log(data);
                    blockButton.css('display', 'block');
                    followButton.css('display', 'none');
                },
                error: function (error) {
                    console.log('Error fetching stories:', error);
                }
            });
        });
    });
    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function showusersPage() {
            document.getElementById('usersPage').classList.add('active');
            document.getElementById('reelsPage').classList.remove('active');
        }

        function showReelsPage() {
            document.getElementById('usersPage').classList.remove('active');
            document.getElementById('reelsPage').classList.add('active');
        }

        function toggleDescription(userId) {
          var fullDescriptionElement = document.getElementById("fullDescription_" + userId);
          var descriptionElement = document.getElementById("description_" + userId);
          var showMore = document.getElementById("showMore_" + userId);
          var ShowLess = document.getElementById("showLess_" + userId);
          
          if (fullDescriptionElement.style.display === "none") {
              fullDescriptionElement.style.display = "block";
              descriptionElement.style.display = "none";
              showMore.style.display = 'none';
              ShowLess.style.display = 'block';
          } else {
              fullDescriptionElement.style.display = "none";
              descriptionElement.style.display = "block";
              showMore.style.display = 'block';
              ShowLess.style.display = 'none';
          }
      }
    </script>

@endsection