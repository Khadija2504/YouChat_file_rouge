
$(document).ready(function(){
var storiesContainer = $('#storiesContainer');
$.ajax({
  url: "http://127.0.0.1:8000/stories/displayAvatarStories",
  type: "GET",
  success: function(data){
    console.log(data);
    storiesContainer.empty();
    data.stories.forEach(storyDisplay);
    var pElement = $('<p></p>');

    pElement.text(data.storiesCount);
    $('#unreadStoriesCount').empty();
    $('#unreadStoriesCount').append(pElement);
  },
  error: function (error) {
      console.log('Error fetching stories:', error);
  }
});

let displayedUserIds = new Set();

function storyDisplay(item) {
  if (displayedUserIds.has(item.users.id)) {
    return;
  }
  displayedUserIds.add(item.users.id);

  var firstFourWords = item.comment ? item.comment.substring(0, 4) : '';

  var storyHTML = `
  <a href="${item.userId}">
    <div class="text-center">
      <div class="rounded-full p-0.5 bg-gradient-to-r from-yellow-400 via-pink-500 to-red-500">
        <div class="h-14 w-14 rounded-full bg-white wrapper overflow-hidden border-2 border-black" style="background-image: url('${item.users.avatar}')">
          <img class="w-full h-full object-contain" src="${item.users.avatar_url}" alt="avatar">
        </div>
      </div>
      <div class="text-black text-xs pb-2 pt-1" id="unreadStoriesCount"></div>
    </div>
  </a>
  `;

  if (typeof storiesContainer === 'object' && storiesContainer.append) {
    storiesContainer.append(storyHTML);
  } else {
    document.querySelector(storiesContainer).innerHTML += storyHTML;
  }
}

});
$(document).ready(function(){
  $(document).on('click', '#postId_button', function(){
    var postId = $(this).data('post-id');
    var save_icon = document.getElementById('save_icon' + postId);
    var saved_icon = document.getElementById('saved_icon' + postId);
    console.log(postId);
    $.ajax({
        url: `http://127.0.0.1:8000/favorite/${postId}`,
        type: "GET",
        success: function(data) {
          if(data.success == true){
            console.log(data);
            save_icon.style.display = "none";
            saved_icon.style.display = "block";
          } else {
            console.log(data);
            save_icon.style.display = "block";
            saved_icon.style.display = "none";
          }
        }
    });
  });
});

$(document).ready(function(){
  $('#searchInput').on('keyup', function(event){
      event.preventDefault();
      searchValue = $(this).val();
      var searchResultPosts = $('#search-result-posts');
      var searchResultUsers = $('#search-result-users');
      var searchResultReels = $('#search-result-reels');
      var searchResultVideos = $('#search-result-videos');
      var old_data = document.getElementById('old_data');
      if(searchValue.trim() === '') {
      searchResult.empty();
      old_data.style.display = 'block';
  } else {

      var formData = new FormData($('#searchForm')[0]);
      formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

      $.ajax({
          url: "http://127.0.0.1:8000/search",
          method: "POST",
          data: formData,
          contentType: false,
          processData: false,
          success: function(data){
              console.log(data);
              old_data.style.display = 'none';
              searchResultPosts.empty();
              data.post.forEach(function(item) {
                  var result = `
                      <div class="max-w-3xl w-full mx-auto z-10">
                          <div class="flex flex-col">
                              <div class="bg-white border border-white shadow-lg rounded-3xl p-4 m-4">
                                  <div class="flex-none sm:flex">
                                      <div class=" relative h-32 w-32">
                                          <img src="${item.users.avatar_url}" class=" w-32 h-32 object-cover rounded-2xl">
                                      </div>
                                      <div class="flex-auto sm:ml-5 justify-evenly">
                                          <div class="flex items-center justify-between sm:mt-2">
                                              <div class="flex items-center">
                                                  <div class="flex flex-col">
                                                      <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">${item.users.name}</div>
                                                      <div class="flex-auto text-gray-500 my-1">
                                                          <span class="mr-3 ">${item.description}</span>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="flex pt-2 text-sm text-gray-500">
                                              <div class="flex-1 inline-flex items-center">
                                                  <a href="${item.post_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the post </a>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  `;
                  searchResultPosts.append(result);
              });
              searchResultUsers.empty();
              data.users.forEach(function(item) {
                var user = `
                <div class="max-w-3xl w-full mx-auto z-10">
                    <div class="flex flex-col">
                        <div class="bg-white border border-white shadow-lg rounded-3xl p-4 m-4">
                            <div class="flex-none sm:flex">
                                <div class=" relative h-32 w-32">
                                    <img src="${item.avatar_url}" class=" w-32 h-32 object-cover rounded-2xl">
                                </div>
                                <div class="flex-auto sm:ml-5 justify-evenly">
                                    <div class="flex items-center justify-between sm:mt-2">
                                        <div class="flex items-center">
                                            <div class="flex flex-col">
                                                <div class="w-full flex-none text-lg text-gray-800 font-bold leading-none">${item.name}</div>
                                                <div class="flex-auto text-gray-500 my-1">
                                                    <span class="mr-3 ">${item.about}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex pt-2 text-sm text-gray-500">
                                        <div class="flex-1 inline-flex items-center">
                                            <a href="${item.user_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the profile </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div> `;
              searchResultUsers.append(user);
              });
              searchResultVideos.empty();
              data.videos.forEach(function(item){
                var video = `
                  <div class="max-w-3xl w-full mx-auto z-10">
                    <div class="flex flex-col">
                      <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex-none sm:flex">
                          <div class=" relative h-32 w-32">
                            <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                              <source src="${item.video_path}" type="video/${item.video_type}">
                            </video>
                          </div>
                          <div class="flex-auto sm:ml-5 justify-evenly">
                            <div class="flex items-center justify-between sm:mt-2">
                              <div class="flex items-center">
                                <div class="flex flex-col">
                                  <div class="flex-auto text-gray-500 my-1">
                                    <span class="mr-3 ">${item.titre}</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="flex pt-2 text-sm text-gray-500">
                              <div class="flex-1 inline-flex items-center">
                                <a href="${item.video_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the video </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                `;
              searchResultVideos.append(video);
              });

              searchResultReels.empty();
              data.reels.forEach(function(item){
                var reel = `
                  <div class="max-w-3xl w-full mx-auto z-10">
                    <div class="flex flex-col">
                      <div class="bg-white border border-white shadow-lg  rounded-3xl p-4 m-4">
                        <div class="flex-none sm:flex">
                          <div class=" relative h-32 w-32">
                            <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                              <source src="${item.reel_path}" type="video/${item.reel_type}">
                            </video>
                          </div>
                          <div class="flex-auto sm:ml-5 justify-evenly">
                            <div class="flex items-center justify-between sm:mt-2">
                              <div class="flex items-center">
                                <div class="flex flex-col">
                                  <div class="flex-auto text-gray-500 my-1">
                                    <span class="mr-3 ">${item.description}</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="flex pt-2 text-sm text-gray-500">
                              <div class="flex-1 inline-flex items-center">
                                <a href="${item.reel_url}" class="font-medium text-blue-600 hover:text-blue-500"> Display the reel </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                `;
              searchResultReels.append(reel);
              });
          },
      });
    }
  });
});

$(document).ready(function () {
const noNotifications = $('#no_notifications');
const unreadNotifications = $('#unread_notifications');

function fetchNotifications() {
    $.ajax({
        url: "http://127.0.0.1:8000/notifications/unread",
        method: "GET",
        success: function (data) {
            console.log(data);
            if(data.notifications > 0){
              noNotifications.css('display', 'none');
              unreadNotifications.css('display', 'block');
            } else{
              noNotifications.css('display', 'block');
              unreadNotifications.css('display', 'none');
            }
        },
        error: function (error) {
            console.log('Error fetching unread notifications:', error);
        }
    });
}
fetchNotifications();
setInterval(fetchNotifications, 10000);
});

$(document).ready(function () {
const noMessages = $('#no_messages');
const unreadMessages = $('#unread_messages');

function fetchMessages() {
    $.ajax({
        url: "http://127.0.0.1:8000/conversations/unreadMessages",
        method: "GET",
        success: function (data) {
            console.log(data);
            if(data.messages > 0){
              noMessages.css('display', 'none');
              unreadMessages.css('display', 'block');
            } else{
              noMessages.css('display', 'block');
              unreadMessages.css('display', 'none');
            }
        },
        error: function (error) {
            console.log('Error fetching unread messages:', error);
        }
    });
}
fetchMessages();
setInterval(fetchMessages, 10000);
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