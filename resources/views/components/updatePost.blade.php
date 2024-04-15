<div x-show="open" class="fixed z-10 flex justify-center inset-0 overflow-y-auto" x-cloak style="background-color: #6970ff50;">
    
    <div class="bg-white px-6 pt-6 pb-2 rounded-xl shadow-lg duration-500" style="width: 50%; height: fit-content">
        <div class="flex flex-wrap items-center">
            <button @click="open = false" style="margin-right: 10px;">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
            <h3 class="mb-3 text-xl font-bold text-indigo-600">Edit {{$post->titre}}'s post</h3>
        </div>
        <form action="{{route('updatePost', $post->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="relative">
            <div class="mt-5 flex gap-2	 justify-center border-b pb-4 flex-wrap	">
                @foreach($post->photos as $photo)
                    <img src="{{asset('' . $photo->images->photo)}}" class="bg-red-500 rounded-2xl w-1/3 object-cover h-96 flex-auto" alt="photo">
                @endforeach
            </div>
            <div class="absolute top-0 bg-yellow-300 text-gray-800 font-semibold py-1 px-3 rounded-br-lg rounded-tl-lg flex-auto">
                <span class="material-symbols-outlined">
                    delete
                </span>
            </div>
            </div>
            
            <label for="uploadFile1"
                    class="bg-gray-800 hover:bg-gray-700 text-white text-sm px-4 py-2.5 outline-none rounded w-max cursor-pointer mx-auto block font-[sans-serif]">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 mr-2 fill-white inline" viewBox="0 0 32 32">
                    <path
                        d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z"
                        data-original="#000000" />
                    <path
                        d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z"
                        data-original="#000000" />
                </svg>
                Add more photos
                <input type="file" name="photo[]" multiple id="uploadFile1" accept=".png, .jpg, .jpeg, .svg" class="hidden" />
            </label>
            <input type="hidden" name="user_id" value="{{$post->user_id}}" required>
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