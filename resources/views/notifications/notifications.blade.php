@extends('layouts.app')
@section('main')
<main class=" w[50%] bg-gray-50 flex flex-wrap items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">
    @foreach ($notifications as $notification)
        @if(isset($notification->id))

            <div class="max-w-3xl w-full mx-auto z-10">
                <div class="flex flex-col">
                    <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex-none sm:flex">
                            <div class=" relative h-32 w-32">
                                <img src="{{asset('' . $notification->sender->avatar)}}" class=" w-32 h-32 object-cover rounded-2xl">
                            </div>
                            <div class="flex-auto sm:ml-5 justify-evenly">
                                <div class="flex items-center justify-between sm:mt-2">
                                    <div class="flex items-center">
                                        <div class="flex flex-col">
                                            <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">{{$notification->sender->name}}</div>
                                            <div class="flex-auto text-gray-500 my-1">
                                                <span class="mr-3 ">{{$notification->message}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button id="deleteNotificationBtn" data-notification-id="{{$notification->id}}">
                                    <span class="material-symbols-outlined">
                                        delete
                                    </span>
                                </button>

                                <div class="flex pt-2  text-sm text-gray-500">
                                    <div class="flex-1 inline-flex items-center">
                                        
                                        @if($notification->type == 'post')
                                            <a href="{{ route('readPost', $notification->data_id) }}" class="font-medium text-blue-600 hover:text-blue-500"> Display the post </a>
                                        @elseif($notification->type == 'follower')
                                        <a href="{{ route('listFollowers', $notification->data_id) }}" class="font-medium text-blue-600 hover:text-blue-500"> Display the followers list </a>
                                        @else
                                            <a href="{{ route('readVideo', $notification->data_id) }}" class="font-medium text-blue-600 hover:text-blue-500"> Display the vodeo </a>
                                        @endif
                                    </div>
                                    
                                    @if($notification->sender_id !== Auth::user()->id)
                                    @php
                                    if($isFollowed !== null){
                                        $isFollowed = $isFollowed->where('friend_id', $notification->sender_id)->first();
                                    }
                                    @endphp
                                      @if($isFollowed)
                                          <form action="{{ route('unfollow', $notification->sender_id) }}" method="GET">
                                            @csrf
                                            <button type="submit">
                                              <div class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                                <div class="mr-1">
                                                  <svg width="22px" height="22px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="6" r="4" fill="#1C274C"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18 15.75C16.7574 15.75 15.75 16.7574 15.75 18C15.75 18.3473 15.8287 18.6763 15.9693 18.97L18.9701 15.9693C18.6763 15.8287 18.3474 15.75 18 15.75ZM20.0307 17.0299L17.0299 20.0307C17.3236 20.1713 17.6526 20.25 18 20.25C19.2426 20.25 20.25 19.2426 20.25 18C20.25 17.6526 20.1713 17.3237 20.0307 17.0299ZM14.25 18C14.25 15.9289 15.9289 14.25 18 14.25C20.0711 14.25 21.75 15.9289 21.75 18C21.75 20.0711 20.0711 21.75 18 21.75C15.9289 21.75 14.25 20.0711 14.25 18Z" fill="#1C274C"/>
                                                    <path opacity="0.5" d="M17.2157 14.3321C15.5211 14.6927 14.25 16.1979 14.25 18C14.25 18.9823 14.6277 19.8764 15.2457 20.5449C14.2756 20.8356 13.1714 21 12 21C8.13401 21 5 19.2091 5 17C5 14.7909 8.13401 13 12 13C14.0722 13 15.934 13.5145 17.2157 14.3321Z" fill="#1C274C"/>
                                                  </svg>
                                                </div>
                                                unfollow
                                              </div>
                                            </button>
                                          </form>
                                      @else
                                        <button id="follower_user" data-follow-user="{{ $notification->sender_id }}">
                                            <div class="text-xs text-blue-600 hover:bg-opacity-60 font-semibold flex items-center justify-center px-3 py-2 bg-blue-300 bg-opacity-50 rounded-lg">
                                                <div class="mr-1">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                                                </div>
                                                follow
                                            </div>
                                        </button>
                                      @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div>No notifications for this moment.</div>
        @endif
    @endforeach
    <div id="NotificationsContainer"></div>
    @if($notifications->count() > 8)
    <div class="text-center">
        <button id="showMoreBtn" class="bg-blue-500 text-white font-bold py-2 px-4 rounded mt-4">Show More</button>
    </div>
    @endif
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var offset = 8;
    var limit = 8;

    function loadMoreNotifications() {
        $.ajax({
            url: '{{ route("displayMoreNotifications") }}',
            type: 'GET',
            data: { offset: offset, limit: limit },
            success: function(response) {
                console.log(response.Notifications);
                $('#NotificationsContainer').append(response.html);
                offset += limit;
                if (response.html.trim() == '') {
                    $('#showMoreBtn').hide();
                }
            },

            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    $(document).ready(function() {
        $('#showMoreBtn').on('click', function() {
            loadMoreNotifications();
        });
    });

    $(document).ready(function(){
        $('#deleteNotificationBtn').on('click', function() {
            var notification_id = $(this).data('notification-id');
            console.log(notification_id);
            $.ajax({
                url: `http://127.0.0.1:8000/notifications/delete/${notification_id}`,
                type: 'GET',
                success: function(response) {
                    console.log(response);
                },
            });
        });
    });

    $(document).ready(function(){
        $(document).on('click', '#follower_user', function(){
          var follow_id = $(this).data('follow-user');
        $.ajax({
            url: `http://127.0.0.1:8000/follow/${follow_id}`,
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

    $(document).ready(function(){
        $("#friend_id").on("click", function(){
            var friend_id = $(this).data("friend-id");
            $.ajax({
                url: `createConversation/${friend_id}`,
                method: "GET",
                success: function(data){
                  console.log(data);
                }
            });
        });
    });

</script>
@endsection