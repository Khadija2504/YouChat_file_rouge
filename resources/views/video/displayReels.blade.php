@extends('layouts.app')

@section('main')
<main class="reel-container h-screen w-full bg-gray-50 overflow-y-scroll">
    <h1 class="text-3xl font-bold text-center py-8">Reels</h1>
    <div class="reels-wrap">
        @foreach($reels as $reelPlay)
            <div class="reel bg-white h-screen w-full flex items-center justify-center shadow-md">
                <div class="rounded-lg overflow-hidden">
                    <button id="redirect_button">
                    </button>
                    <div class="mt-5 flex gap-2	 justify-center border-b pb-4 flex-wrap">
                    <video class="reel-video w-full h-full object-cover" autoplay muted loop>
                        <source src="{{ asset($reelPlay->reel) }}" type="video/mp4" class="object-cover">
                        Your browser does not support the video tag.
                    </video>
                    </div>
                    <div class="bottom-0 left-0 right-0 bg-white bg-opacity-75 p-4">
                        <h2 class="text-lg font-semibold">Reel's Description</h2>
                        <p class="text-sm text-gray-600">{{ $reelPlay->description }}</p>
                        <div class="flex items-center gap-3">
                            <button id="reelId_button"  data-reel-id="{{$reelPlay->id}}">
                                @if ($reelPlay->votesReel->where('user_id', Auth::user()->id)->where('reel_id', $reelPlay->id)->isEmpty())
                                <svg width="22px" id="save_icon{{$reelPlay->id}}" height="22px" style="display: block;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5.50063L11.4596 6.02073C11.463 6.02421 11.4664 6.02765 11.4698 6.03106L12 5.50063ZM8.96173 18.9109L8.49742 19.4999L8.96173 18.9109ZM15.0383 18.9109L14.574 18.3219L15.0383 18.9109ZM7.00061 16.4209C6.68078 16.1577 6.20813 16.2036 5.94491 16.5234C5.68169 16.8432 5.72758 17.3159 6.04741 17.5791L7.00061 16.4209ZM2.34199 13.4115C2.54074 13.7749 2.99647 13.9084 3.35988 13.7096C3.7233 13.5108 3.85677 13.0551 3.65801 12.6917L2.34199 13.4115ZM13.4698 8.03034C13.7627 8.32318 14.2376 8.32309 14.5304 8.03014C14.8233 7.7372 14.8232 7.26232 14.5302 6.96948L13.4698 8.03034ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55955 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219ZM9.42605 18.3219C8.63014 17.6945 7.82129 17.0963 7.00061 16.4209L6.04741 17.5791C6.87768 18.2624 7.75472 18.9144 8.49742 19.4999L9.42605 18.3219ZM3.65801 12.6917C3.0968 11.6656 2.75 10.5033 2.75 9.1371H1.25C1.25 10.7746 1.66995 12.1827 2.34199 13.4115L3.65801 12.6917ZM11.4698 6.03106L13.4698 8.03034L14.5302 6.96948L12.5302 4.97021L11.4698 6.03106Z" fill="#1C274C"/>
                                </svg>
        
                                <svg width="22px" id="saved_icon{{$reelPlay->id}}" style="display: none;" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.10627 18.2468C5.29819 16.0833 2 13.5422 2 9.1371C2 4.27416 7.50016 0.825464 12 5.50063L14 7.49928C14.2929 7.79212 14.7678 7.79203 15.0607 7.49908C15.3535 7.20614 15.3534 6.73127 15.0605 6.43843L13.1285 4.50712C17.3685 1.40309 22 4.67465 22 9.1371C22 13.5422 18.7018 16.0833 15.8937 18.2468C15.6019 18.4717 15.3153 18.6925 15.0383 18.9109C14 19.7294 13 20.5 12 20.5C11 20.5 10 19.7294 8.96173 18.9109C8.68471 18.6925 8.39814 18.4717 8.10627 18.2468Z" fill="#1C274C"/>
                                </svg>
                                @else
                                <svg width="22px" id="saved_icon{{$reelPlay->id}}" style="display: block;" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.10627 18.2468C5.29819 16.0833 2 13.5422 2 9.1371C2 4.27416 7.50016 0.825464 12 5.50063L14 7.49928C14.2929 7.79212 14.7678 7.79203 15.0607 7.49908C15.3535 7.20614 15.3534 6.73127 15.0605 6.43843L13.1285 4.50712C17.3685 1.40309 22 4.67465 22 9.1371C22 13.5422 18.7018 16.0833 15.8937 18.2468C15.6019 18.4717 15.3153 18.6925 15.0383 18.9109C14 19.7294 13 20.5 12 20.5C11 20.5 10 19.7294 8.96173 18.9109C8.68471 18.6925 8.39814 18.4717 8.10627 18.2468Z" fill="#1C274C"/>
                                </svg>
          
                                <svg width="22px" id="save_icon{{$reelPlay->id}}" height="22px" style="display: none;" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5.50063L11.4596 6.02073C11.463 6.02421 11.4664 6.02765 11.4698 6.03106L12 5.50063ZM8.96173 18.9109L8.49742 19.4999L8.96173 18.9109ZM15.0383 18.9109L14.574 18.3219L15.0383 18.9109ZM7.00061 16.4209C6.68078 16.1577 6.20813 16.2036 5.94491 16.5234C5.68169 16.8432 5.72758 17.3159 6.04741 17.5791L7.00061 16.4209ZM2.34199 13.4115C2.54074 13.7749 2.99647 13.9084 3.35988 13.7096C3.7233 13.5108 3.85677 13.0551 3.65801 12.6917L2.34199 13.4115ZM13.4698 8.03034C13.7627 8.32318 14.2376 8.32309 14.5304 8.03014C14.8233 7.7372 14.8232 7.26232 14.5302 6.96948L13.4698 8.03034ZM2.75 9.1371C2.75 6.98623 3.96537 5.18252 5.62436 4.42419C7.23607 3.68748 9.40166 3.88258 11.4596 6.02073L12.5404 4.98053C10.0985 2.44352 7.26409 2.02539 5.00076 3.05996C2.78471 4.07292 1.25 6.42503 1.25 9.1371H2.75ZM8.49742 19.4999C9.00965 19.9037 9.55955 20.3343 10.1168 20.6599C10.6739 20.9854 11.3096 21.25 12 21.25V19.75C11.6904 19.75 11.3261 19.6293 10.8736 19.3648C10.4213 19.1005 9.95208 18.7366 9.42605 18.3219L8.49742 19.4999ZM15.5026 19.4999C16.9292 18.3752 18.7528 17.0866 20.1833 15.4758C21.6395 13.8361 22.75 11.8026 22.75 9.1371H21.25C21.25 11.3345 20.3508 13.0282 19.0617 14.4798C17.7469 15.9603 16.0896 17.1271 14.574 18.3219L15.5026 19.4999ZM22.75 9.1371C22.75 6.42503 21.2153 4.07292 18.9992 3.05996C16.7359 2.02539 13.9015 2.44352 11.4596 4.98053L12.5404 6.02073C14.5983 3.88258 16.7639 3.68748 18.3756 4.42419C20.0346 5.18252 21.25 6.98623 21.25 9.1371H22.75ZM14.574 18.3219C14.0479 18.7366 13.5787 19.1005 13.1264 19.3648C12.6739 19.6293 12.3096 19.75 12 19.75V21.25C12.6904 21.25 13.3261 20.9854 13.8832 20.6599C14.4405 20.3343 14.9903 19.9037 15.5026 19.4999L14.574 18.3219ZM9.42605 18.3219C8.63014 17.6945 7.82129 17.0963 7.00061 16.4209L6.04741 17.5791C6.87768 18.2624 7.75472 18.9144 8.49742 19.4999L9.42605 18.3219ZM3.65801 12.6917C3.0968 11.6656 2.75 10.5033 2.75 9.1371H1.25C1.25 10.7746 1.66995 12.1827 2.34199 13.4115L3.65801 12.6917ZM11.4698 6.03106L13.4698 8.03034L14.5302 6.96948L12.5302 4.97021L11.4698 6.03106Z" fill="#1C274C"/>
                                </svg>
                                @endif
                            </button>
                            <div class="text-sm" id="realVotesCount" style="display: block">{{$reelPlay->votesReel->where('reel_id', $reelPlay->id)->count()}}</div>
                            <div class="text-sm" id="NewVotesCount">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</main>
<script>
    $(document).ready(function(){
        $(document).on('click', '#reelId_button', function(){
          var reelId = $(this).data('reel-id');
           var votesCounts = document.getElementById('realVotesCount').textContent
           votesCount = parseInt(votesCounts, 10);
          var save_icon = document.getElementById('save_icon' + reelId);
          var saved_icon = document.getElementById('saved_icon' + reelId);
          var realVotesCount = document.getElementById('realVotesCount');
          $.ajax({
              url: `http://127.0.0.1:8000/reels/vote/${reelId}`,
              type: "GET",
                success: function(data) {
                    if(data.success == true){
                        console.log(data);
                        save_icon.style.display = "none";
                        saved_icon.style.display = "block";
                        realVotesCount.style.display = "none";
                        var pElement = $('<p></p>');

                        pElement.text(data.reelCount);
                        $('#NewVotesCount').empty();
                        $('#NewVotesCount').append(pElement);
                    } else {
                        console.log(data);
                        save_icon.style.display = "block";
                        saved_icon.style.display = "none";
                        realVotesCount.style.display = "none";
                        var pElement = $('<p></p>');

                        pElement.text(data.reelCount);
                        $('#NewVotesCount').empty();

                        $('#NewVotesCount').append(pElement);

                    }
                }
            });
        });
    });

    $(document).ready(function(){
        $(document).on('click', '#redirect_button', function(){
        $.ajax({
            url: "http://127.0.0.1:8000/stories/redirectBack",
            type: "GET",
            success: function(data){
                console.log(data);
            },
            error: function (error) {
                console.log('Error fetching stories:', error);
            }
        });
    });
    });


    </script>
    
@endsection
