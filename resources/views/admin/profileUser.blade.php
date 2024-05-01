@extends('layouts.admin')
@section('main')
<style>
    /* Style for the pages */
    .page {
        display: none; /* Hide pages by default */
    }
    .active {
        display: block; /* Show active page */
    }
</style>
    <div class="h-full p-8">
        <div class="bg-white rounded-lg shadow-xl pb-8">
            
            <div class="w-full h-[250px]">
                <img src="https://vojislavd.com/ta-template-demo/assets/img/profile-background.jpg" class="w-full h-full rounded-tl-lg rounded-tr-lg">
            </div>
            <div class="flex flex-col items-center -mt-20">
                <img src="{{asset('' . $users->avatar)}}" class="w-40 border-4 border-white rounded-full">
                <div class="flex items-center space-x-2 mt-2">
                    <p class="text-2xl">{{$users->name}}</p>
                    <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
                </div>
                <p class="text-gray-700">{{$users->email}}</p>
                
                <div id="description_{{ $users->id }}" class="whitespace-pre-wrap mt-7" style="display: block;">{{ Illuminate\Support\Str::limit($users->about, 20) }}</div>
                <div id="fullDescription_{{ $users->id }}" class="whitespace-pre-wrap mt-7" style="display: none;">{{ $users->about }}</div>
                <button onclick="toggleDescription({{ $users->id }})" id="showMore_{{ $users->id }}" style="display: block">
                    <span class="material-symbols-outlined">
                    visibility
                    </span>
                </button>
            </div>
            <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 mt-2">
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-xl pb-8">
            <div class="grid grid-cols-4">
                <button onclick="showReelsPage()" class="mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="border-b-2 border-gray-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                </button>
                <button onclick="showuserssPage()" class="mx-auto">
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
        <div class="bg-white rounded-lg shadow-xl pb-8" id="reelsPage">

            <div id="userssPage" class="grid w-full sm:grid-cols-2 xl:grid-cols-4 gap-6">
                @foreach($users->reels as $reel)
                    <div class="relative w-full h-60 bg-cover bg-center bg-no-repeat"  id="reelsPage" style="background-image: url('https://sf-tk-sg.ibytedtos.com/obj/tiktok-web-sg/tt-sg-article-cover-351970d5103b996fbe9ddc67f6d668cc.gif');">
                        <div class="absolute bottom-1 left-1 flex gap-1 text-white text-xs items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{$reel->description}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-xl pb-8">
            <div class="grid grid-cols-4 gap-0.5 mt-2">
                @foreach($users->posts as $post)
                    <div class="relative flex flex-col shadow-md rounded-xl overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 max-w-sm">
                        
                        <a href="" class="z-20 absolute h-full w-full top-0 left-0 ">&nbsp;</a>
                        
                        <div class="bg-white py-4 px-3">
                          <h3 class="text-xs mb-2 font-medium">{{$post->description}}</h3>
                          <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-400">
                            {{$post->comments->count()}} comments
                          </p>
                          <div class="relative z-40 flex items-center gap-2">
                          </div>
                          </div>
                        </div>
                      </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-xl pb-8">
            <div class="grid grid-cols-4 gap-0.5 mt-2">
                @foreach($users->events as $event)
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
                @foreach($users->videos as $video)
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

    </div>


    <script>
    $(document).ready(function(){
        $(document).on('click', '#follower_users', function(){
            var follow_id = $(this).data('follow-users');
            var followButton = $('#follower_users');
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
        function showuserssPage() {
            document.getElementById('userssPage').classList.add('active');
            document.getElementById('reelsPage').classList.remove('active');
        }

        function showReelsPage() {
            document.getElementById('userssPage').classList.remove('active');
            document.getElementById('reelsPage').classList.add('active');
        }

        function toggleDescription(usersId) {
          var fullDescriptionElement = document.getElementById("fullDescription_" + usersId);
          var descriptionElement = document.getElementById("description_" + usersId);
          var showMore = document.getElementById("showMore_" + usersId);
          var ShowLess = document.getElementById("showLess_" + usersId);
          
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