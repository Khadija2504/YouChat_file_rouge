<div class="bg-gray-100 fixed z-10 flex justify-center items-center inset-0 overflow-y-auto" x-show="open" x-cloak style="background-color: #6970ff50;">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md" style="width: 50%; height: fit-content">
    <div class="flex flex-wrap items-center">
        <button @click="open = false" style="margin-right: 10px;">
            <span class="material-symbols-outlined">
                close
            </span>
        </button>
    </div>
    <div class="max-w-2xl mx-auto">

        <div class="p-4 max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col justify-center items-center mb-4">
            <h3 class="text-xl font-bold leading-none text-gray-900 mb-5 dark:text-white">Your conversations</h3>
            <form id="searchFormUsers">
                <div x-data="{ search: '' }"
                  class="flex border-2 border-gray-200 rounded-md focus-within:ring-2 ring-teal-500"
                >
                  <input
                  name="search"
                  x-model="search"
                  id="searchInputUsers"
                    type="search"
                    class="w-full rounded-tl-md rounded-bl-md px-2 py-3 text-sm text-gray-600 focus:outline-none"
                    placeholder="Search" required
                  />
                  <div
                    class="rounded-tr-md rounded-br-md px-2 py-3 hidden md:block"
                  >
                    <svg
                      class="w-4 h-4 fill-current"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </div>
                </div>
              </form>
       </div>
       <div id="searchResultUsers"></div>
       <ul role="list" id="search-result_users" class="divide-y divide-gray-200 dark:divide-gray-700">
       </ul>
            <ul role="list" id="old_list" style="display: block" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($conversations as $conversation)
                <li class="py-3 sm:py-4">
                    <div class="flex items-center space-x-4">
                        <input type="hidden" id="post_id" value="{{$post->id}}" >
                        <div class="flex-shrink-0">
                            @if($conversation->users->id == Auth::user()->id)
                            <img class="w-8 h-8 rounded-full" src="{{asset('' . $conversation->friends->avatar)}}" alt="Neil image">
                            @else
                            <img class="w-8 h-8 rounded-full" src="{{asset('' . $conversation->users->avatar)}}" alt="Neil image">
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                @if($conversation->users->id == Auth::user()->id)
                                {{ $conversation->friends->name }}
                                @else
                                {{ $conversation->users->name }}
                                @endif
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                @if($conversation->users->id == Auth::user()->id)
                                {{ $conversation->friends->email }}
                                @else
                                {{ $conversation->users->email }}
                                @endif
                            </p>
                        </div>
                        <button id="share_button_{{$post->id}}" style="display: block" data-post-id="{{$post->id}}" data-conversation_id="{{$conversation->id}}">
                            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.61109 12.4L10.8183 18.5355C11.0462 19.6939 12.6026 19.9244 13.1565 18.8818L19.0211 7.84263C19.248 7.41555 19.2006 6.94354 18.9737 6.58417M9.61109 12.4L5.22642 8.15534C4.41653 7.37131 4.97155 6 6.09877 6H17.9135C18.3758 6 18.7568 6.24061 18.9737 6.58417M9.61109 12.4L18.9737 6.58417M19.0555 6.53333L18.9737 6.58417" stroke="#0089ee" stroke-width="2"/>
                            </svg>
                        </button>
                        <svg id="shared_button_{{$post->id}}" style="display: none" width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.61109 12.4L10.8183 18.5355C11.0462 19.6939 12.6026 19.9244 13.1565 18.8818L19.0211 7.84263C19.248 7.41555 19.2006 6.94354 18.9737 6.58417M9.61109 12.4L5.22642 8.15534C4.41653 7.37131 4.97155 6 6.09877 6H17.9135C18.3758 6 18.7568 6.24061 18.9737 6.58417M9.61109 12.4L18.9737 6.58417M19.0555 6.53333L18.9737 6.58417" stroke="#000000" stroke-width="2"/>
                        </svg>
                    </div>
                </li>
                @endforeach
            </ul>
       </div>
    </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
  $(document).ready(function(){
    $('#searchInputUsers').on('input', function(event){
        event.preventDefault();
        var searchValue = $(this).val().trim();
        console.log(searchValue);
        var searchResultUsers = $('#search-result_users');
        var post_id = document.getElementById('post_id');
        var postId = post_id.val;
        var old_list = document.getElementById('old_list');
        console.log(searchResultUsers);

        if(searchValue === '') {
            searchResultUsers.empty();
            old_list.style.display = 'block';
        } else {
            var formData = new FormData($('#searchFormUsers')[0]);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                url: "{{ route('searchConversations') }}",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    console.log(data);
                    old_list.style.display = 'none';
                    searchResultUsers.empty();
                    data.conversations.forEach(function(chat) {
                        var conversationId = chat.chat_room_id;
                        var user = chat.user;
                        var result = `
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="${user.avatar_url}" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        ${user.name}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        ${user.email}
                                    </p>
                                </div>
                                <button id="share_button_profile" style="display: block" data-profile-id="${postId}" data-conversation_id="${conversationId}">
                                    <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.61109 12.4L10.8183 18.5355C11.0462 19.6939 12.6026 19.9244 13.1565 18.8818L19.0211 7.84263C19.248 7.41555 19.2006 6.94354 18.9737 6.58417M9.61109 12.4L5.22642 8.15534C4.41653 7.37131 4.97155 6 6.09877 6H17.9135C18.3758 6 18.7568 6.24061 18.9737 6.58417M9.61109 12.4L18.9737 6.58417M19.0555 6.53333L18.9737 6.58417" stroke="#0089ee" stroke-width="2"/>
                                    </svg>
                                </button>
                                <svg id="shared_button_profile" style="display: none" width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.61109 12.4L10.8183 18.5355C11.0462 19.6939 12.6026 19.9244 13.1565 18.8818L19.0211 7.84263C19.248 7.41555 19.2006 6.94354 18.9737 6.58417M9.61109 12.4L5.22642 8.15534C4.41653 7.37131 4.97155 6 6.09877 6H17.9135C18.3758 6 18.7568 6.24061 18.9737 6.58417M9.61109 12.4L18.9737 6.58417M19.0555 6.53333L18.9737 6.58417" stroke="#000000" stroke-width="2"/>
                                </svg>
                            </div>
                        </li>
                        `;
                        searchResultUsers.append(result);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
});


    $(document).ready(function(){
        var post_id = {{$post->id}};
        $(document).on('click', '#share_button_' + post_id, function(){
          var postId = $(this).data('post-id');
          var conversationId = $(this).data('conversation_id');
          var share_button = document.getElementById('share_button_'+ post_id);
          var shared_button = document.getElementById('shared_button_'+ post_id);
          $.ajax({
              url: `http://127.0.0.1:8000/share/post/${postId}/${conversationId}`,
              type: "GET",
                success: function(data) {
                    console.log(data);
                    if(data.success == true) {
                        share_button.style.display = "none";
                        shared_button.style.display = "block";
                    }
                }
            });
        });
    });
    
</script>