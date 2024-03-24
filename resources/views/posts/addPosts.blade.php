@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">

    <div class="border max-w-screen-md bg-white mt-6 rounded-2xl p-4">
        <div class="flex items-center justify-between">
            <form action="{{route('addPosts')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="titre" placeholder="titre" required>
                <input type="text" name="description" placeholder="description" required>
                <input type="file" name="photo" required>
                <input type="hidden" name="user_id" value="{{$user_id}}" required>
                <button type="submit">add</button>
            </form>
        </div>
    </div>
</main>
@endsection