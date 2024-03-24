@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-wrap items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">

    @foreach($saved as $save)
    <div class="border max-w-screen-md w-full bg-white mt-6 rounded-2xl p-4 mb-5">
        <div class="flex items-center	justify-between">
            <div class="gap-3.5	flex items-center ">
                <img src="https://images.unsplash.com/photo-1617077644557-64be144aa306?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80" class="object-cover bg-yellow-500 rounded-full w-10 h-10" />
                <div class="flex flex-col">
                    <b class="mb-2 capitalize">{{$save->posts->users->name}}</b>
                    <time datetime="06-08-21" class="text-gray-400 text-xs">{{$save->posts->created_at}}
                    </time>
                </div>
            </div>
            <div class="bg-gray-100	rounded-full h-3.5 flex	items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="34px" fill="#92929D">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z" />
                </svg>
            </div>
        </div>
        <div class="whitespace-pre-wrap mt-7">{{$save->posts->titre}}</div>
        <div id="description_{{ $save->posts->id }}" class="whitespace-pre-wrap mt-7" style="display: block;">{{ Illuminate\Support\Str::limit($save->posts->description, 20) }}</div>
        <div id="fullDescription_{{ $save->posts->id }}" class="whitespace-pre-wrap mt-7" style="display: none;">{{ $save->posts->description }}</div>
        <button onclick="toggleDescription({{ $save->posts->id }})">Show More</button>
        <div class="mt-5 flex gap-2	 justify-center border-b pb-4 flex-wrap	">
            <img src="{{asset('' . $save->posts->photo)}}" class="bg-red-500 rounded-2xl w-1/3 object-cover h-96 flex-auto" alt="photo">
          </div>
            <div class=" h-16 border-b  flex items-center justify-around">
                <div class="flex items-center gap-3">
                    <button id="dropdown-button-{{$loop->index}}">
                    <svg width="20px" height="19px" viewBox="0 0 20 19" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="?-Social-Media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Square_Timeline" transform="translate(-312.000000, -746.000000)">
                                <g id="Post-1" transform="translate(280.000000, 227.000000)">
                                    <g id="Post-Action" transform="translate(0.000000, 495.000000)">
                                        <g transform="translate(30.000000, 21.000000)" id="Comment">
                                            <g>
                                                <g id="ic_comment-Component/icon/ic_comment">
                                                    <g id="Comments">
                                                        <polygon id="Path" points="0 0 24 0 24 25 0 25"></polygon>
                                                        <g id="iconspace_Chat-3_25px"
                                                            transform="translate(2.000000, 3.000000)" fill="#92929D">
                                                            <path
                                                                d="M10.5139395,15.2840977 L6.06545155,18.6848361 C5.05870104,19.4544672 3.61004168,18.735539 3.60795568,17.4701239 L3.60413773,15.1540669 C1.53288019,14.6559967 0,12.7858138 0,10.5640427 L0,4.72005508 C0,2.11409332 2.10603901,0 4.70588235,0 L15.2941176,0 C17.893961,0 20,2.11409332 20,4.72005508 L20,10.5640427 C20,13.1700044 17.893961,15.2840977 15.2941176,15.2840977 L10.5139395,15.2840977 Z M5.60638935,16.5183044 L9.56815664,13.4896497 C9.74255213,13.3563295 9.955971,13.2840977 10.1754888,13.2840977 L15.2941176,13.2840977 C16.7876789,13.2840977 18,12.0671403 18,10.5640427 L18,4.72005508 C18,3.21695746 16.7876789,2 15.2941176,2 L4.70588235,2 C3.21232108,2 2,3.21695746 2,4.72005508 L2,10.5640427 C2,12.0388485 3.1690612,13.2429664 4.6301335,13.28306 C5.17089106,13.297899 5.60180952,13.7400748 5.60270128,14.2810352 L5.60638935,16.5183044 Z"
                                                                id="Path"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                </button>
                    <div class="text-sm	">{{$save->posts->comments->count()}}</div>
                </div>
                <div class="flex items-center	gap-3">
                    <form action="{{route('dislikePost', $save->posts->id)}}" method="GET">
                        @csrf
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                thumb_down
                            </span>
                        </button>
                        <div class="text-sm">{{ $save->posts->postVotes()->where('vote', 'dislike')->count() }}</div>
                    </form>
                </div>
                <div class="flex items-center gap-3">
                    <form action="{{route('likePost', $save->posts->id)}}" method="GET">
                        @csrf
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                thumb_up
                            </span>
                        </button>
                        <div class="text-sm">{{ $save->posts->postVotes()->where('vote', 'like')->count() }}</div>
                    </form>
                </div>
                <div class="flex items-center gap-3">
                    <svg width="22px" height="22px" viewBox="0 0 22 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="?-Social-Media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Square_Timeline" transform="translate(-636.000000, -745.000000)">
                                <g id="Post-1" transform="translate(280.000000, 227.000000)">
                                    <g id="Post-Action" transform="translate(0.000000, 495.000000)">
                                        <g transform="translate(30.000000, 21.000000)" id="Share">
                                            <g transform="translate(325.000000, 1.000000)">
                                                <g id="ic_Share-Component/icon/ic_Share">
                                                    <g id="Share">
                                                        <circle id="Oval" cx="12" cy="12" r="12"></circle>
                                                        <g id="Group-24-Copy"
                                                            transform="translate(12.000000, 12.000000) scale(-1, 1) translate(-12.000000, -12.000000) translate(1.000000, 1.000000)"
                                                            fill="#92929D">
                                                            <path
                                                                d="M4,0 C6.209139,0 8,1.790861 8,4 C8,4.1291298 7.99388117,4.25683047 7.98191762,4.38282788 L15.371607,7.98470389 C16.0745405,7.37145444 16.9938914,7 18,7 C20.209139,7 22,8.790861 22,11 C22,13.209139 20.209139,15 18,15 C16.9572434,15 16.0076801,14.6009919 15.2956607,13.9473263 L7.98384745,17.6380767 C7.99453877,17.7572882 8,17.8780063 8,18 C8,20.209139 6.209139,22 4,22 C1.790861,22 0,20.209139 0,18 C0,15.790861 1.790861,14 4,14 C5.37147453,14 6.58173814,14.690226 7.30236849,15.7422555 L14.2017356,12.2577203 C14.0708451,11.8622268 14,11.4393868 14,11 C14,10.5276126 14.0818865,10.0743509 14.2322392,9.65363512 L7.29274641,6.27172794 C6.57099412,7.31588608 5.36538874,8 4,8 C1.790861,8 0,6.209139 0,4 C0,1.790861 1.790861,0 4,0 Z M4,16 C2.8954305,16 2,16.8954305 2,18 C2,19.1045695 2.8954305,20 4,20 C5.1045695,20 6,19.1045695 6,18 C6,16.8954305 5.1045695,16 4,16 Z M18,9 C16.8954305,9 16,9.8954305 16,11 C16,12.1045695 16.8954305,13 18,13 C19.1045695,13 20,12.1045695 20,11 C20,9.8954305 19.1045695,9 18,9 Z M4,2 C2.8954305,2 2,2.8954305 2,4 C2,5.1045695 2.8954305,6 4,6 C5.1045695,6 6,5.1045695 6,4 C6,2.8954305 5.1045695,2 4,2 Z"
                                                                id="Combined-Shape"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    <div class="text-sm">Share</div>
                </div>
                <div class="flex items-center	gap-3">
                    <form action="{{route('favorite', $save->posts->id)}}" method="GET">
                    @csrf
                    <button type="submit">
                    <svg width="17px" height="22px" viewBox="0 0 17 22" version="1.1" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="?-Social-Media" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Square_Timeline" transform="translate(-787.000000, -745.000000)">
                                <g id="Post-1" transform="translate(280.000000, 227.000000)">
                                    <g id="Post-Action" transform="translate(0.000000, 495.000000)">
                                        <g transform="translate(30.000000, 21.000000)" id="Saved">
                                            <g transform="translate(473.000000, 1.000000)">
                                                <g id="ic_Saved-Component/icon/ic_Saved">
                                                    <g id="Saved">
                                                        <circle id="Oval" cx="12" cy="12" r="12"></circle>
                                                        <g id="Group-13-Copy" transform="translate(5.000000, 2.000000)"
                                                            fill="#92929D">
                                                            <path
                                                                d="M2.85714286,-0.952380952 L12.1428571,-0.952380952 C14.246799,-0.952380952 15.952381,0.753200953 15.952381,2.85714286 L15.952381,18.2119141 C15.952381,19.263885 15.09959,20.116746 14.047619,20.116746 C13.6150601,20.116746 13.1953831,19.9694461 12.8576286,19.6992071 L7.5,15.4125421 L2.14237143,19.6992071 C1.32096217,20.3564207 0.122301512,20.2233138 -0.534912082,19.4019046 C-0.805151112,19.0641501 -0.952380952,18.644473 -0.952380952,18.2119141 L-0.952380952,2.85714286 C-0.952380952,0.753200953 0.753200953,-0.952380952 2.85714286,-0.952380952 Z M2.85714286,0.952380952 C1.80517191,0.952380952 0.952380952,1.80517191 0.952380952,2.85714286 L0.952380952,18.2119141 L6.31000952,13.9252491 C7.00569973,13.3686239 7.99430027,13.3686239 8.68999048,13.9252491 L14.047619,18.2119141 L14.047619,2.85714286 C14.047619,1.80517191 13.1948281,0.952380952 12.1428571,0.952380952 L2.85714286,0.952380952 Z"
                                                                id="Rectangle-92"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    </button>
                    </form>
                    {{-- <div class="text-sm">Saved</div> --}}
                </div>
            </div>
            <div class="flex items-center justify-between mt-4">
                <img src="https://images.unsplash.com/photo-1595152452543-e5fc28ebc2b8?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=750&q=80"  class="bg-yellow-500 rounded-full w-10 h-10 object-cover border">
                <form id="search-input-{{$loop->index}}" action="{{route('addComment', $save->posts->id)}}" method="POST" class="w-full ml-5 flex flex-wrap">
                    @csrf
                    <div class="flex items-center justify-between bg-gray-50 h-11 w-11/12 border rounded-2xl overflow-hidden px-4 ">
                        <input type="text" name="description" class="h-full w-full bg-gray-50 outline-none " placeholder="Write your comment..." required>
                    </div>
                    <button type="submit">Add</button>
                </form>
            </div>
            <div id="dropdown-menu-{{$loop->index}}" class="hidden flex flex-col items-start justify-between">
                <div class="ml-3 mt-5">All Comments</div>
                @foreach ($save->posts->comments as $comment)
                <div class="flex items-center justify-center space-x-2 mt-5">
                    <div x-data="{ open1: false, open2: false }">
                            
                            <div class="flex items-center space-x-2">
                              <div class="group relative flex flex-shrink-0 self-start cursor-pointer">
                                <img 
                                  x-on:mouseover="open1 = true" x-on:mouseleave="open1 = false"
                                 src="https://images.unsplash.com/photo-1507965613665-5fbb4cbb8399?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDQzfHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" class="h-8 w-8 object-fill rounded-full">
                                <div x-cloak x-show.transition.origin.bottom="open1" x-on:mouseover="open1 = true" x-on:mouseleave="open1 = false" class="absolute mt-8 bg-white px-4 py-4 w-72 shadow rounded cursor-default z-10">
                                  <div class="flex space-x-3">
                                    <div class="flex flex-shrink-0">
                                      <img src="https://images.unsplash.com/photo-1507965613665-5fbb4cbb8399?ixid=MXwxMjA3fDB8MHx0b3BpYy1mZWVkfDQzfHRvd0paRnNrcEdnfHxlbnwwfHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="" class="h-16 w-16 object-fill rounded-full">
                                    </div>
                                    <div class="flex flex-col space-y-2">
                                      <div class="font-semibold">
                                        <a href="#" class="hover:underline">
                                          {{$comment->users->name}}
                                        </a>
                                      </div>
                                      <div class="flex justify-start items-center space-x-2">
                                        <div>
                                          <svg class="w-4 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path></svg>
                                        </div>
                                        <div class="w-auto text-sm leading-none">
                                          <small>
                                            1 mutual friends including: <a href="#" class="font-semibold hover:underline">Mulyadi</a>
                                          </small>
                                        </div>
                                      </div>
                                      <div class="flex justify-start items-center space-x-2">
                                        <div>
                                          <svg class="w-4 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                        </div>
                                        <div class="w-auto text-sm leading-none">
                                          <small>
                                            From <a href="#" class="font-semibold">Bandung</a>
                                          </small>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="flex space-x-1 mt-2">
                                    <div class="w-1/2">
                                      <a href="#" class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                        <div class="mr-1">
                                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                                        </div>
                                        Add
                                      </a>
                                    </div>
                                    <div class="w-auto">
                                      <a href="#" class="text-xs text-gray-800 hover:bg-gray-300 font-semibold flex items-center justify-center px-3 py-2 bg-gray-200 rounded-lg">
                                        <div class="mr-1">
                                          <svg viewBox="0 0 28 28" alt="" class="h-4 w-4" height="20" width="20"><path d="M14 2.042c6.76 0 12 4.952 12 11.64S20.76 25.322 14 25.322a13.091 13.091 0 0 1-3.474-.461.956 .956 0 0 0-.641.047L7.5 25.959a.961.961 0 0 1-1.348-.849l-.065-2.134a.957.957 0 0 0-.322-.684A11.389 11.389 0 0 1 2 13.682C2 6.994 7.24 2.042 14 2.042ZM6.794 17.086a.57.57 0 0 0 .827.758l3.786-2.874a.722.722 0 0 1 .868 0l2.8 2.1a1.8 1.8 0 0 0 2.6-.481l3.525-5.592a.57.57 0 0 0-.827-.758l-3.786 2.874a.722.722 0 0 1-.868 0l-2.8-2.1a1.8 1.8 0 0 0-2.6.481Z"></path></svg>
                                        </div>
                                      </a>
                                    </div>
                                    <div class="w-auto">
                                      <a href="#" class="text-xs text-gray-800 hover:bg-gray-300 font-semibold flex items-center justify-center px-3 py-2 bg-gray-200 rounded-lg">
                                        <div class="mr-1">
                                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                                        </div>
                                      </a>
                                    </div>
                                    
                                    <div class="w-auto">
                                      <a href="#" class="text-xs text-gray-800 hover:bg-gray-300 font-semibold flex items-center justify-center px-3 py-2 bg-gray-200 rounded-lg">
                                        <div class="mr-1">
                                          <svg class="w-4 h-4 fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                                        </div>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        
                              <div class="flex items-center justify-center space-x-2">
                                <div class="block">
                                    <div class="flex justify-center items-center space-x-2">
                                      <div class="bg-gray-100 w-auto rounded-xl px-2 pb-2">
                                      <div class="font-medium">
                                          <a href="#" class="hover:underline text-sm">
                                          <small>{{$comment->users->name}}</small>
                                          </a>
                                      </div>
                                      <div class="text-xs">
                                          {{$comment->description}}
                                      </div>
                                      </div>
                                      <div class="self-stretch flex justify-center items-center transform transition-opacity duration-200 opacity-0 hover:opacity-100">
                                          <a href="#" class="">
                                              <div class="text-xs cursor-pointer flex h-6 w-6 transform transition-colors duration-200 hover:bg-gray-100 rounded-full items-center justify-center">
                                              <svg class="w-4 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
                                              </div>
                                          </a>
                                      </div>
                                    </div>
                                  <div class="flex justify-start items-center text-xs w-full">
                                    <div class="font-semibold text-gray-700 px-2 flex items-center justify-center space-x-1">
                                        <div class="flex items-center gap-3">
                                            <form action="{{route('dislikeComment', $comment->id)}}" method="GET">
                                                @csrf
                                                <button type="submit">
                                                    <span class="material-symbols-outlined" style="font-size: 20px">
                                                        thumb_down
                                                    </span>
                                                </button>
                                                <div class="text-sm">{{ $comment->commentVotes()->where('vote', 'dislike')->count() }}</div>
                                            </form>
                                        </div>
                                        <div class="flex items-center gap-3">
                                            <form action="{{route('likeComment', $comment->id)}}" method="GET">
                                                @csrf
                                                <button type="submit">
                                                    <span class="material-symbols-outlined" style="font-size: 20px">
                                                        thumb_up
                                                    </span>
                                                </button>
                                                <div class="text-sm">{{ $comment->commentVotes()->where('vote', 'like')->count() }}</div>
                                            </form>
                                        </div>                               
                                     <small class="self-center">.</small>
                                      <a href="#" class="hover:underline">
                                        <small>{{$comment->created_at}}</small>
                                      </a>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                    </div>
                  </div>
                {{-- <div class="block px-4 py-2 text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer rounded-md">{{$comment->description}}</div> --}}
                {{-- <div>{{$comment->created_at}}</div> --}}
                {{-- <div>{{$comment->users->name}}</div> --}}
                @endforeach
                
            </div>
    </div>
    @endforeach
    </main>
    
    
    <script>
        @foreach($saved as $index => $save->posts)
        const dropdownButton{{$index}} = document.getElementById('dropdown-button-{{$index}}');
        const dropdownMenu{{$index}} = document.getElementById('dropdown-menu-{{$index}}');
        const searchInput{{$index}} = document.getElementById('search-input-{{$index}}');
        let isOpen{{$index}} = false;
        
        function toggleDropdown{{$index}}() {
          isOpen{{$index}} = !isOpen{{$index}};
          dropdownMenu{{$index}}.classList.toggle('hidden', !isOpen{{$index}});
        }
        
        toggleDropdown{{$index}}();
        
        dropdownButton{{$index}}.addEventListener('click', () => {
          toggleDropdown{{$index}}();
        });
        
        searchInput{{$index}}.addEventListener('input', () => {
          const searchTerm{{$index}} = searchInput{{$index}}.value.toLowerCase();
          const items{{$index}} = dropdownMenu{{$index}}.querySelectorAll('a');
        
          items{{$index}}.forEach((item) => {
            const text{{$index}} = item.textContent.toLowerCase();
            if (text{{$index}}.includes(searchTerm{{$index}})) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
        });
        
        function toggleDescription(postId) {
            var fullDescriptionElement = document.getElementById("fullDescription_" + postId);
            var descriptionElement = document.getElementById("description_" + postId);
            
            if (fullDescriptionElement.style.display === "none") {
                fullDescriptionElement.style.display = "block";
                descriptionElement.style.display = "none";
            } else {
                fullDescriptionElement.style.display = "none";
                descriptionElement.style.display = "block";
            }
        }
        @endforeach
    </script>
    
    @endsection
    