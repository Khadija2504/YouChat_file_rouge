    <div class="bg-gray-100 fixed z-10 flex justify-center items-center inset-0 overflow-y-auto" x-show="open" x-cloak style="background-color: #6970ff50;">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md" style="width: 50%; height: fit-content">
        <div class="flex flex-wrap items-center">
            <button @click="open = false" style="margin-right: 10px;">
                <span class="material-symbols-outlined">
                    close
                </span>
            </button>
            <h3 class="mb-3 text-xl font-bold text-indigo-600">Create your story</h3>
        </div>
        <form action="{{route('addStory')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
            <div class="mb-6">
                <label for="postContent" class="block text-gray-700 text-sm font-bold mb-2">comment your status</label>
                <textarea id="postContent" name="comment" rows="4" class="w-full border-2 rounded-md px-4 py-2 leading-5 transition duration-150 ease-in-out sm:text-sm
                    sm:leading-5 resize-none focus:outline-none focus:border-blue-500" placeholder="What's on your mind in this moment?" required></textarea>
            </div>
            <div class="mb-6">
                <label for="fileAttachment" class="block text-gray-700 text-sm font-bold mb-2">choose photo/video</label>
                <div class="relative border-2 rounded-md px-4 py-3 bg-white flex items-center justify-between hover:border-blue-500 transition duration-150 ease-in-out">
                    <input type="file" id="fileAttachment" name="data_Story" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="ml-2 text-sm text-gray-600">Choose a file</span>
                    </div>
                    <span class="text-sm text-gray-500">Max file size: 5MB</span>
                </div>
            </div>
            <div class="flex items-center justify-between"> 
                <button type="submit" class="flex justify-center items-center bg-blue-500 hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue text-white py-2 px-4 rounded-md transition duration-300 gap-2"> Post <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" id="send" fill="#fff">
                        <path fill="none" d="M0 0h24v24H0V0z"></path>
                        <path d="M3.4 20.4l17.45-7.48c.81-.35.81-1.49 0-1.84L3.4 3.6c-.66-.29-1.39.2-1.39.91L2 9.12c0 .5.37.93.87.99L17 12 2.87 13.88c-.5.07-.87.5-.87 1l.01 4.61c0 .71.73 1.2 1.39.91z"></path>
                    </svg>
                </button>
                <span class="text-gray-500 text-sm">Max 280 characters</span>
            </div>
        </form>
    </div>
    </div>