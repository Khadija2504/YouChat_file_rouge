@extends('layouts.app')
@section('main')

<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">
<div class='flex flex-col items-center justify-center w-[90%] min-h-screen'>
    <h1 class="my-10 font-medium text-3xl sm:text-4xl font-black">
        Following list
        <span class="day" style="display: inline-block"></span>
    </h1>
    <div class='user-list w-full mx-auto bg-white rounded-xl shadow-xl flex flex-col py-4'>
        @foreach($followers as $follower)
            <div class="user-row flex flex-col items-center justify-between cursor-pointer  p-4 duration-300 sm:flex-row sm:py-4 sm:px-8 hover:bg-[#f6f8f9]">
                <div class="user flex items-center text-center flex-col sm:flex-row sm:text-left">
                    <div class="avatar-content mb-2.5 sm:mb-0 sm:mr-2.5">
                        <img class="avatar w-20 h-20 rounded-full" src="{{asset('' . $follower->users->avatar)}}"/>
                    </div>
                    <div class="user-body flex flex-col mb-4 sm:mb-0 sm:mr-4">
                        <a href="{{route('profile', $follower->users->id)}}" class="title font-medium no-underline">{{$follower->users->user_name}}</a>
                        <div class="skills flex flex-col">
                            <span class="subtitle text-slate-500">Marketing Liaison</span>
                            <span class="subtitle text-slate-500">Do you want to accept this follower ?</span>
                        </div>
                    </div>
                </div>
                <div class="user-option mx-auto sm:ml-auto sm:mr-0">
                    <button class="btn inline-block select-none no-underline align-middle cursor-pointer whitespace-nowrap px-4 py-1.5 rounded text-base font-medium leading-6 tracking-tight text-white text-center border-0 bg-[#6911e7] hover:bg-[#590acb] duration-300" type="button">Accept</button>
                </div>
            </div>
        @endforeach
        <a class="show-more block w-10/12 mx-auto py-2.5 px-4 text-center no-underline rounded hover:bg-[#f6f8f9] font-medium duration-300" href="#/">Show more members</a>
    </div>
</div>
</main>
@endsection
