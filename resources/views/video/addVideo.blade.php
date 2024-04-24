@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">


    <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
      <div class="text-center">
        <h2 class="mt-5 text-3xl font-bold text-gray-900">
          Video Upload!
        </h2>
        <p class="mt-2 text-sm text-gray-400">Shire the short videos with your followers</p>
      </div>
      <form action="{{route('addVideo')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
        <div class="grid grid-cols-1 space-y-2">
            <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
            <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" name="titre" type="text" placeholder="title" required>
        </div>
        <div class="grid grid-cols-1 space-y-2">
          <label class="text-sm font-bold text-gray-500 tracking-wide">Description</label>
          <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" name="description" type="text" placeholder="Description">
      </div>
        <div class="grid grid-cols-1 space-y-2">
           <label class="text-sm font-bold text-gray-500 tracking-wide">Video</label>
            <div class="flex items-center justify-center w-full">
              <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                  <div class="h-full w-full text-center flex flex-col items-center justify-center items-center  ">
                      <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                      <img class="has-mask h-36 object-center" src="https://img.freepik.com/free-vector/image-upload-concept-landing-page_52683-27130.jpg?size=338&ext=jpg" alt="freepik image">
                      </div>
                      <p class="pointer-none text-gray-500 "><span class="text-sm">Drag and drop</span> files here <br /> or <a href="" id="" class="text-blue-600 hover:underline">select a file</a> from your computer</p>
                  </div>
                  <input type="file" name="video" class="hidden">
              </label>
            </div>
        </div>
          <p class="text-sm text-gray-300">
              <span>File type: video</span>
          </p>
        <div>
            <button onclick="
              Swal.fire('The video has added successfully!');
              " type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                        font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
            Upload
        </button>
        </div>
      </form>
  </div>
  
  <style>
    .has-mask {
      position: absolute;
      clip: rect(10px, 150px, 130px, 10px);
    }
  </style>
</main>
@endsection