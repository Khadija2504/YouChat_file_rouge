@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-wrap items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">
        <h1 class="text-3xl font-bold mb-4">Videos</h1>
    @foreach($videos as $video)

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white w-full h-full rounded-lg overflow-hidden shadow-md">
            <video class="w-full" controls>
                <source src="{{asset('' . $video->video)}}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <div class="p-4">
                <h2 class="text-lg font-semibold mb-2">Video Title</h2>
                <p class="text-sm text-gray-600">{{$video->video}}</p>
                <div>
                    <form action="{{route('voteVideo', $video->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="happy" required>
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                sentiment_very_satisfied
                            </span>
                        </button>
                    </form>
                    <div class="text-sm">{{ $video->videoVotes()->where('vote', 'happy')->count() }}</div>
                    <form action="{{route('voteVideo', $video->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="sad" required>
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                sentiment_sad
                            </span>
                        </button>
                    </form>
                    <div class="text-sm">{{ $video->videoVotes()->where('vote', 'sad')->count() }}</div>
                    <form action="{{route('voteVideo', $video->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="heart" required>
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                favorite
                            </span>
                        </button>
                    </form>
                    <div class="text-sm">{{ $video->videoVotes()->where('vote', 'heart')->count() }}</div>
                    <form action="{{route('voteVideo', $video->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="vote" value="celebration" required>
                        <button type="submit">
                            <span class="material-symbols-outlined">
                                celebration
                            </span>
                        </button>
                    </form>
                    <div class="text-sm">{{ $video->videoVotes()->where('vote', 'celebration')->count() }}</div>
                </div>
                @if($video->user_id == Auth::user()->id)
                    <a href="{{route('deleteVideo', $video->id)}}">delete</a>
                @endif
            </div>
        </div>
    </div>
  @endforeach
</main>
@endsection