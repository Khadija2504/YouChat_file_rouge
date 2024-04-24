@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-wrap items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">
    <h1 class="text-3xl font-bold mb-4">Video</h1>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-full h-full rounded-lg overflow-hidden shadow-md">
            <video class="w-full" controls>
                <source src="{{asset('' . $reels->reel)}}" type="video/mp4">
                Your browser does not support the reel tag.
            </video>
            <div class="p-4">
                <p class="text-sm text-gray-600">{{$reels->description}}</p>
            </div>
        </div>
    </div>
</main>
@endsection