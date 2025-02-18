@extends('layouts.app')
@section('main')

<div class="flex h-screen antialiased text-gray-800">
    <div class="flex flex-col md:flex-row h-[90%] w-full overflow-x-hidden overflow-y-hidden">
      <div class="flex flex-row overflow-x-auto md:hidden block " id="phoneConversationsContainer">
      </div>
      <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0 md:block hidden">
        <div class="flex flex-row items-center justify-center h-12 w-full">
          <div
            class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10"
          >
            <svg
              class="w-6 h-6"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
              ></path>
            </svg>
          </div>
          <div class="ml-2 font-bold text-2xl">QuickChat</div>
        </div>
        <div
          class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-6 px-4 rounded-lg"
        >
        
        </div>
        <div class="flex flex-col mt-8">
          <div class="flex flex-row items-center justify-between text-xs">
            <span class="font-bold">Active Conversations</span>
          </div>
          <div class="flex flex-col space-y-1 mt-4 -mx-2 h-[100%] overflow-x-auto" id="conversationContainer">
            
          </div>

        </div>
      </div>
      <div class="flex flex-col flex-auto h-full p-6">
        <div
          class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4"
        >
          <div class="flex flex-col h-full overflow-x-auto mb-4" id="chatBox">
            <div class="lg:hidden xl:hidden">
              
            </div>
            <div id="headChatContainer" class="relative flex items-center space-x-4 mb-8"></div>
            <div class="flex flex-col h-full">
              <div class="grid grid-cols-12 gap-y-2" id="messagesContainer">
                
              </div>
            </div>
          </div>
          <form id="chatMessage_form">
            @csrf
          <div
            class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4"
          >
            
            <div class="flex-grow ml-1">
              <div class="relative w-full">
                <input
                  type="text" name="message"
                  class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"
                required/>
                <input type="hidden" name="chat_id" id="conversationId" required>
                <input type="hidden" name="from_id" value="{{Auth::user()->id}}" required>
                <input type="hidden" name="to_id" value="{{Auth::user()->id}}" id="user_id" required>
                <div
                  class="absolute flex items-center justify-center h-full w-12 right-0 top-0 text-gray-400 hover:text-gray-600"
                >
                </div>
              </div>
            </div>
            <div class="ml-4">
              <button type="submit"
                class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-2 py-1 flex-shrink-0"
              >
                <span class="md:block hidden">Send</span>
                <span class="ml-2">
                  <svg
                    class="w-4 h-4 transform rotate-45 -mt-px"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"
                    ></path>
                  </svg>
                </span>
              </button>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

  <script>
  var scrollDown = function(){
        let chatBox = document.getElementById('chatBox');
        chatBox.scrollTop = chatBox.scrollHeight;
	}
    var loggedInUserId = {{ Auth::user()->id }};
    
    $(document).ready(function(){
    $('#chatMessage_form').submit(function(event){
        event.preventDefault();
        var formData = new FormData(this);

        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        $.ajax({
            url: "http://127.0.0.1:8000/chatRoom/createMessage",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                console.log(data);
                if(data.seccess == true){
                    $("#chatMessage_form")[0].reset();
                    const messagesContainer = $('#messagesContainer');
                    const conversation_id = data.message.chat_id;
                    function getMessages(){
                        $.ajax({
                            url: `http://127.0.0.1:8000/chatRoom/displayMessages/${conversation_id}`,
                            type: "GET",
                            success: function(data) {
                                console.log(data);
                                messagesContainer.empty();
                                data.messages.forEach(displayAllMessages);
                                scrollDown();
                            },
                            error: function(error) {
                                console.log('Error fetching messages:', error);
                            }
                        });
                    }

                   function displayAllMessages(item) {
                        var avatarUrl = item.from_user.avatar;
                        var isFromLoggedInUser = item.from_user.id === loggedInUserId;
                        avatarUrl = 'http://127.0.0.1:8000/' + avatarUrl;
                        var messages = isFromLoggedInUser ? `
                        <div class="col-start-6 col-end-13 rounded-lg">
                            <div class="flex items-center justify-start flex-row-reverse">
                                <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                                <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                                    <div>${item.message}</div>
                                </div>
                            </div>
                        </div>
                    ` : `
                        <div class="col-start-1 col-end-8 rounded-lg">
                            <div class="flex flex-row items-center">
                                <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                                <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                    <div>${item.message}</div>
                                </div>
                            </div>
                        </div>
                    `;
                        messagesContainer.append(messages);
                    } 
                    getMessages();
                    } else {
                    printErrorMsg(data);
                }
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
    });
});

function printErrorMsg(data) {
    $(".error").text(data.error);
}

$(document).ready(function () {
    const conversationContainer = $('#conversationContainer');
    const phoneConversationsContainer = $('#phoneConversationsContainer');

    function fetchConversation() {
        $.ajax({
            url: "http://127.0.0.1:8000/chatRoom/conversations",
            method: "GET",
            success: function (data) {
                console.log(data);
                conversationContainer.empty();
                phoneConversationsContainer.empty();
                data.conversations.forEach(function (conversation) {
                    conversationDisplay(conversation, data.unreadMessages[conversation.id]);
                });
            },
            error: function (error) {
                console.log('Error fetching conversations:', error);
            }
        });
    }

    function conversationDisplay(item, unreadMessages) {
        let avatarUrl, conversationName;

        if (item.friend_id == {{ Auth::user()->id }}) {
            avatarUrl = item.users.avatar;
            conversationName = item.users.name;
            userStatus = item.users.status;
        } else {
            avatarUrl = item.friends.avatar;
            conversationName = item.friends.name;
            userStatus = item.friends.status;
        }

        avatarUrl = 'http://127.0.0.1:8000/' + avatarUrl;

                if(userStatus  == 'active'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-1 top-4">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#21b100"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'inactive'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-1 top-4">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#ffe601"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'disabled') {
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-1 top-4">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#dd0303"></circle>
                                </svg>
                              </span>` ;
                } else{
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-1 top-4">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#909090"></circle>
                                </svg>
                              </span>`;
                }
        const unreadMessagesIndicator = unreadMessages > 0 ? `<span class="flex items-center justify-center bg-gray-300 h-4 w-4 ml-28 rounded-full">${unreadMessages}</span>` : '';
        const unreadMessagesPhone = unreadMessages >  0 ? `<span class="absolute left-2 top-3"> ${unreadMessages}</span>` : '';

        const conversation = `
            <button
                class="conversation-button relative flex flex-row items-center hover:bg-gray-100 rounded-xl p-2"
                data-conversation-id="${item.id}"
            >
              <div class="relative flex items-center space-x-4">
                <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                ${satatusConversationsContainer}
              </div>
                <div class="flex flex-row items-center justify-between text-xs">
                    <div class="ml-2 text-sm font-semibold">${conversationName}</div>
                    ${unreadMessagesIndicator}
                </div>
            </button>
        `;

        const phoneConversations = `
            <button
                class="conversation-button relative flex flex-col items-center hover:bg-gray-100 rounded-xl p-2"
                data-conversation-id="${item.id}"
            >
              <div class="relative flex items-center space-x-4">
                <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                ${satatusConversationsContainer} ${unreadMessagesPhone}
              </div>
                <div class="flex flex-row items-center justify-between text-xs">
                    <div class="ml-2 text-sm font-semibold">${conversationName}</div>
                </div>
            </button>
        `;
        phoneConversationsContainer.append(phoneConversations);
        conversationContainer.append(conversation);
    }

    fetchConversation();
    // setInterval(fetchConversation, 10000);
});

$(document).ready(function() {
    var messagesContainer = $("#messagesContainer");
    var headChatContainer = $("#headChatContainer");
    var currentInterval = null;
    var loggedInUserId = {{ Auth::user()->id }};

    $(document).on('click', '.conversation-button', function() {
        var conversationId = $(this).data('conversation-id');
        $("#conversationId").val(conversationId);

        if (currentInterval) {
            clearInterval(currentInterval);
        }
        scrollDown();

        fetchMessages(conversationId);

        currentInterval = setInterval(function() {
            fetchMessages(conversationId);
        }, 1000);
    });

    function fetchMessages(conversationId) {
        $.ajax({
            url: `http://127.0.0.1:8000/chatRoom/displayMessages/${conversationId}`,
            type: "GET",
            success: function(data) {
                console.log(data);
                messagesContainer.empty();
                headChatContainer.empty();
                data.messages.forEach(displayMessages);
                if (data.conversation.friend_id == {{ Auth::user()->id }}) {
                    avatarUrl = data.conversation.users.avatar;
                    conversationStatus = data.conversation.users.status;
                    userStatus = data.conversation.users.status;
                    conversationName = data.conversation.users.name;
                } else {
                    avatarUrl = data.conversation.friends.avatar;
                    conversationStatus = data.conversation.friends.status;
                    userStatus = data.conversation.friends.status;
                    conversationName = data.conversation.friends.name;
                }

                if(userStatus  == 'active'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#21b100"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'inactive'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#ffe601"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'disabled') {
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#dd0303"></circle>
                                </svg>
                              </span>` ;
                } else{
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#909090"></circle>
                                </svg>
                              </span>`;
                }

                avatarUrl = 'http://127.0.0.1:8000/' + avatarUrl;
                var headContainer = `
                  <div class="relativeX">
                    ${satatusConversationsContainer}
                    <img src="${avatarUrl}" alt="" class="w-8 sm:w-12 h-8 sm:h-12 rounded-full">
                    </div>
                    <div class="flex flex-col leading-tight">
                    <div class="text-2xl mt-1 flex items-center">
                      <span class="text-gray-700 mr-3" style="font-size: 25px">${conversationName}</span>
                    </div>
                    <span class="text-lg text-gray-600" style="font-size: 15px">${conversationStatus}</span>
                  </div>
                `;
                headChatContainer.append(headContainer);
            },
            error: function(error) {
                console.log('Error fetching messages:', error);
            }
        });
    }

    function fetchMessagesByConversationId(conversationId) {
        $.ajax({
            url: `http://127.0.0.1:8000/chatRoom/displayMessages/${conversationId}`,
            type: "GET",
            success: function(data) {
                console.log(data);
                messagesContainer.empty();
                headChatContainer.empty();
                data.messages.forEach(displayMessages);
                if (data.conversation.friend_id == {{ Auth::user()->id }}) {
                    avatarUrl = data.conversation.users.avatar;
                    conversationStatus = data.conversation.users.status;
                    userStatus = data.conversation.users.status;
                    conversationName = data.conversation.users.name;
                } else {
                    avatarUrl = data.conversation.friends.avatar;
                    conversationStatus = data.conversation.friends.status;
                    userStatus = data.conversation.friends.status;
                    conversationName = data.conversation.friends.name;
                }

                if(userStatus  == 'active'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#21b100"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'inactive'){
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#ffe601"></circle>
                                </svg>
                              </span>`;
                } else if(userStatus == 'disabled') {
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#dd0303"></circle>
                                </svg>
                              </span>` ;
                } else{
                  satatusConversationsContainer = `<span class="absolute text-green-500 left-8 top-8">
                                <svg width="20" height="20">
                                    <circle cx="8" cy="8" r="8" fill="#909090"></circle>
                                </svg>
                              </span>`;
                }

                avatarUrl = 'http://127.0.0.1:8000/' + avatarUrl;
                var headContainer = `
                  <div class="relative">
                      ${satatusConversationsContainer}
                  <img src="${avatarUrl}" alt="" class="w-8 sm:w-12 h-8 sm:h-12 rounded-full">
                  </div>
                  <div class="flex flex-col leading-tight">
                      <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-3" style="font-size: 25px">${conversationName}</span>
                      </div>
                      <span class="text-lg text-gray-600" style="font-size: 15px">${conversationStatus}</span>
                  </div>
                `;
                headChatContainer.append(headContainer);
            },
            error: function(error) {
                console.log('Error fetching messages:', error);
            }
        });
    }

    function displayMessages(item) {
        var avatarUrl = item.from_user.avatar;
        avatarUrl = 'http://127.0.0.1:8000/' + avatarUrl;
        var isFromLoggedInUser = item.from_user.id === loggedInUserId;
        const deleteMessage_button = item.from_user.id === {{Auth::user()->id}} ? `<button class="delete-icon" id="deleteMessage_button" data-message-id="${item.id}">
                        <span class="material-symbols-outlined">
                        delete_forever
                        </span>
                    </button>` : '';

        var messageHTML = isFromLoggedInUser ? `
            <div class="col-start-6 col-end-13 rounded-lg message-container">
                <div class="flex items-center justify-start flex-row-reverse">
                    <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                    <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                        <div>${item.message}</div>
                    </div>
                    <button class="delete-icon" id="deleteMessage_button" data-message-id="${item.id}">
                        <span class="material-symbols-outlined">
                        delete_forever
                        </span>
                    </button>
                </div>
            </div>
        ` : `
            <div class="col-start-1 col-end-8 rounded-lg message-container">
                <div class="flex flex-row items-center">
                    <img src="${avatarUrl}" class="object-cover bg-yellow-500 rounded-full w-8 h-8">
                    <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                        <div>${item.message}</div>
                    </div>
                    ${deleteMessage_button}
                </div>
            </div>
            
        `;

        messagesContainer.append(messageHTML);
    }

    $.ajax({
        url: "http://127.0.0.1:8000/chatRoom/conversations",
        method: "GET",
        success: function (data) {
            if(data.conversations.length > 0) {
                var firstConversationId = data.conversations[0].id;
                fetchMessagesByConversationId(firstConversationId);
            }
        },
        error: function (error) {
            console.log('Error fetching conversations:', error);
        }
    });

    $(document).on('click', '#deleteMessage_button', function(){
        var messageId = $(this).data('message-id');
        console.log(messageId);
        $.ajax({
            url: `http://127.0.0.1:8000/chatRoom/DeleteMessage/${messageId}`,
            type: "GET",
            success: function(data) {
                console.log(data);
                // fetchMessages(conversationId);
            }
        });
    });
});

  </script>

@endsection