@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">

    <div class="border max-w-screen-md bg-white mt-6 rounded-2xl p-4">
        <div class="flex items-center justify-between">
            <form action="{{route('addVideo')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="titre" placeholder="Add a video title" required>
                <input type="text" name="description" placeholder="Add the description for your video if you want">
                <input type="file" name="video" required>
                <button>
                  <span class="material-symbols-outlined">
                    add
                  </span>
                </button>
              </form>
        </div>
    </div>
</main>
@endsection