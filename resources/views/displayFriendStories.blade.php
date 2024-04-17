@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">

    <div class="relative overflow-hidden w-96 h-60 displayFriendStories slideshow" id="slideshow">
        
    </div>
    

    <script>

    $(document).ready(function(){
      var displayFriendStories = $('.displayFriendStories');
      $.ajax({
        url: "http://127.0.0.1:8000/stories/displayFriendStories/{{$id}}",
        type: "GET",
        success: function(data){
          console.log(data);
          displayFriendStories.empty();
          data.stories.forEach(storyDisplay);
        },
        error: function (error) {
            console.log('Error fetching stories:', error);
        }
      });

      function storyDisplay(item) {
        let data_Story_url = item.dataStory_url;
        let extension = data_Story_url.split('.').pop().toLowerCase();
        let isVideo = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv'].includes(extension);
        if (isVideo) {
            var storyHTML = `
                <video class="slide absolute inset-0 w-full h-full object-cover">
                    <source src="${item.dataStory_url}"></source>
                </video>
                <div>${item.comment}</div>
            `;
        } else {
            var storyHTML = `
                <img src="${item.dataStory_url}" id="slide" class="slide absolute inset-0 w-full h-full object-cover">
                <div>${item.comment}</div>
            `;
        }
        displayFriendStories.append(storyHTML);
        }      

    });

    let currentSlide = 0;
    const slides = document.querySelectorAll('#slide');

    function showSlide(index) {
        slides.forEach(slide => slide.style.display = 'none');
        slides[index].style.display = 'block';
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    showSlide(currentSlide);
    setInterval(nextSlide, 7000);


    </script>

</main>
@endsection