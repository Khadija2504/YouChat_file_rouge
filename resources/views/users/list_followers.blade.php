@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">
    <div>follwors list</div>
    @foreach($followers as $follower)
    <div class="border max-w-screen-md w-full bg-white mt-6 rounded-2xl p-4 mb-5">
        {{$follower->users->user_name}}
        @if($follower->status == 'invalid')
        <form action="{{route('acceptation', $follower->id)}}" method="POST">
            @csrf
            <input type="hidden" name="status" value="valid" required>
            <button type="submit">accept</button>
        </form>
        @endif
    </div>
    @endforeach
</main>
@endsection