@extends('layouts.app')
@section('main')
<div class="flex items-center justify-center">
    <div class="flex flex-wrap justify-center items-center">
        @foreach($events as $index => $event)
        <div class="relative bg-white py-6 px-6 rounded-3xl w-64 my-4 shadow-xl m-10 mt-10">
                <img src="{{asset('' . $event->image)}}" alt="event_image" class="object-cover bg-yellow-500 rounded-full w-16 h-16 mx-auto absolute bottom-[270px] left-4">
            <div class="mt-8">
                
                <p class="text-xl font-semibold my-2">{{$event->title}}</p>
                <div x-data="{ openSettings{{$index}}: false }">
                    <button @click="openSettings{{$index}} = !openSettings{{$index}}" class="border border-gray-400 p-2 rounded text-gray-300 hover:text-gray-300 bg-gray-100 bg-opacity-10 hover:bg-opacity-20" title="Settings">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                <div x-show="openSettings{{$index}}" @click.away="openSettings{{$index}} = false" class="bg-white absolute right-0 top-10 w-40 py-2 mt-1 border border-gray-200 shadow-2xl">
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
                        <div x-data="{ open : false }">
                        <a href="#" @click="open = true" class="">
                        <button type="submit" class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                            <span class="material-symbols-outlined h-3 w-3 text-gray-400 flex justify-center items-center">
                              edit
                            </span>
                            <span class="text-sm text-gray-70f0">
                              Edit event
                            </span>
                        </button>
                        </a>
                        @include('components.updateEvent')
                      </div>
                    </div>
                    <div class="py-2">
                        <form method="GET" action="{{route('deleteEvent', $event->id)}}">
                          @csrf
                        <button type="submit" class="w-full flex items-center py-1.5 px-6 space-x-2 hover:bg-gray-200">
                          <span class="material-symbols-outlined  h-3 w-3 text-gray-400 flex justify-center items-center">
                            delete
                          </span>
                            <span class="text-sm text-gray-700">Delete</span>
                          </button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
                <div class="flex space-x-2 text-gray-400 text-sm">
                    
                     <div id="description_{{ $event->id }}" class="whitespace-pre-wrap mt-7" style="display: block;">{{ Illuminate\Support\Str::limit($event->description, 20) }}</div>
                     <div id="fullDescription_{{ $event->id }}" class="whitespace-pre-wrap mt-7" style="display: none;">{{ $event->description }}</div>
                     <button onclick="toggleDescription({{ $event->id }})">Show More</button>
                </div>
                <div class="flex space-x-2 text-gray-400 text-sm my-3">
                    <!-- svg  -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                     <p>{{$event->date}}</p>
                </div>
                <div class="border-t-2"></div>

                    <div class="pt-2 flex flex-wrap justify-between">
                        <div class="flex flex-col flex-col items-center">
                            <form action="{{route('voteEvent', $event->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="happy" required>
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        sentiment_very_satisfied
                                    </span>
                                </button>
                            </form>
                            <div class="text-sm">{{ $event->voteEvent()->where('vote', 'happy')->count() }}</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <form action="{{route('voteEvent', $event->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="sad" required>
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        sentiment_sad
                                    </span>
                                </button>
                            </form>
                            <div class="text-sm">{{ $event->voteEvent()->where('vote', 'sad')->count() }}</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <form action="{{route('voteEvent', $event->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="heart" required>
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        favorite
                                    </span>
                                </button>
                            </form>
                            <div class="text-sm">{{ $event->voteEvent()->where('vote', 'heart')->count() }}</div>
                        </div>
                        <div class="flex flex-col items-center">
                            <form action="{{route('voteEvent', $event->id)}}" method="POST">
                                @csrf
                                <input type="hidden" name="vote" value="celebration" required>
                                <button type="submit">
                                    <span class="material-symbols-outlined">
                                        celebration
                                    </span>
                                </button>
                            </form>
                            <div class="text-sm">{{ $event->voteEvent()->where('vote', 'celebration')->count() }}</div>
                        </div>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

<script>

@foreach($events as $index => $event)
      const dropdownButton{{$index}} = document.getElementById('dropdown-button-{{$index}}');
      const dropdownMenu{{$index}} = document.getElementById('dropdown-menu-{{$index}}');
      const searchInput{{$index}} = document.getElementById('search-input-{{$index}}');
      let isOpen{{$index}} = true;
      
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

    function toggleDescription(eventId) {
          var fullDescriptionElement = document.getElementById("fullDescription_" + eventId);
          var descriptionElement = document.getElementById("description_" + eventId);
          
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