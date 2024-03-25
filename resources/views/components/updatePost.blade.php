<div x-show="open" class="fixed z-10 flex justify-center inset-0 overflow-y-auto" x-cloak style="background-color: #6970ff50;">
    
    <div class="bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg duration-500" style="width: 50%;">
        <div class="flex flex-wrap items-center">
            <button @click="open = false" style="margin-right: 10px;">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
            <h3 class="mb-3 text-xl font-bold text-indigo-600">Edit {{$post->titre}}'s post</h3>
        </div>
        <form action="{{route('updatePost', $post->id)}}" method="POST">
            @csrf
            <div class="relative">
            <div class="mt-5 flex gap-2 justify-center border-b pb-4 flex-wrap	">
                @foreach($post->photos as $photo)
                    <img src="{{asset('' . $photo->images->photo)}}" class="bg-red-500 rounded-2xl w-1/3 object-cover h-90 flex-auto" alt="photo">
                @endforeach
            </div>
            @foreach($post->photos as $photo)
            <div class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg flex-auto">
                <span class="material-symbols-outlined">
                    delete
                </span>
            </div>
            @endforeach
            input:
            </div>
            <span class="material-symbols-outlined">
                edit
            </span>
            <input type="hidden" name="user_id" value="{{$post->user_id}}" required>
            <input class="mt-4 text-gray-800 text-2xl font-bold cursor-pointer"type="text" name="titre" value="{{$post->titre}}" placeholder="titre" required>
            <div class="my-4">
            <div class="flex space-x-1">
                <span class="material-symbols-outlined">
                    edit
                </span>
                <textarea name="description" id="description" value="{{$post->description}}" cols="100" rows="5">{{$post->description}}</textarea>
            </div>
            <button class="mt-4 text-xl w-full text-white bg-indigo-600 py-2 rounded-xl shadow-lg" type="submit">Update Post's data</button>
            </div>
        </form>    
    </div>
    
</div>