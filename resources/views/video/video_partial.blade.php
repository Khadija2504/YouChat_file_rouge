@foreach($videos as $video)
<div class="container mx-auto px-4 py-8">
    <div class="bg-white w-full h-full rounded-lg overflow-hidden shadow-md">
        <video class="w-full" controls>
            <source src="{{ asset($video->video) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="p-4">
            <h 2 class="text-lg font-semibold mb-2">Video Title</h2>
            <p class="text-sm text-gray-600">{{ $video->video }}</p>
            <div class="flex flex-row justify-between items-center">
            </div>
            @if($video->user_id == Auth::user()->id)
                <a href="{{ route('deleteVideo', $video->id) }}">
                    <span class="material-symbols-outlined">delete</span>
                </a>
            @endif
        </div>
    </div>
                
</div>
@endforeach
