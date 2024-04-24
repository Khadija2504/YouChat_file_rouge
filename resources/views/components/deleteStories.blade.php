<div class="bg-gray-100 fixed z-10 flex justify-center items-center inset-0 overflow-y-auto" x-show="open" x-cloak style="background-color: #6970ff50;">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md" style="width: 50%; height: fit-content">
    <div class="flex flex-wrap items-center">
        <button @click="open = false" style="margin-right: 10px;">
            <span class="material-symbols-outlined">
                close
            </span>
        </button>
        <h3 class="mb-3 text-xl font-bold text-indigo-600">Your available stories</h3>
    </div>
    @foreach($myStories as $myStory)
    <div class="max-w-3xl w-full mx-auto z-10">
        <div class="flex flex-col">
            <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                <div class="flex-none sm:flex">
                    <div class=" relative h-32 w-32">
                        @if(in_array(strtolower(pathinfo($myStory->data_Story, PATHINFO_EXTENSION)), $videoExtensions))
                            <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                                <source src="{{ asset($myStory->data_Story) }}" type="video/{{ strtolower(pathinfo($myStory->data_Story, PATHINFO_EXTENSION)) }}">
                            </video>
                        @else
                            <img src="{{ asset($myStory->data_Story) }}" class=" w-32 h-32 object-cover rounded-2xl">
                        @endif
                    </div>
                    <div class="flex-auto sm:ml-5 justify-evenly">
                        <div class="flex items-center justify-between sm:mt-2">
                            <div class="flex items-center">
                                <div class="flex flex-col">
                                    <div class="flex-auto text-gray-500 my-1">
                                        <span class="mr-3 ">{{$myStory->comment}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('deleteStory', $myStory->id)}}" method="GET">
                            @csrf
                            <button type="submit" class="flex-no-shrink bg-orange-400 hover:bg-green-500 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
</div>