@extends('layouts.app')
@section('main')
<main class="h-full w[50%] bg-gray-50 flex flex-column items-center justify-center overflow-x-hidden transition-transform duration-300 ease-in-out">

    <div class="relative overflow-hidden w-[80%] h-[85%] displayFriendStories" id="slideshow">
    </div>
    
    <script>
    $(document).ready(function(){
        var displayFriendStories = $('#slideshow');
        $.ajax({
            url: "http://127.0.0.1:8000/stories/displayFriendStories/{{$id}}",
            type: "GET",
            success: function(data){
                console.log(data);
                displayFriendStories.empty();
                data.stories.forEach(storyDisplay);
                initializeSlideshow();
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
                    <div class="story-slide">
                        <video class="slide absolute inset-0 w-full h-full object-cover" autoplay loop muted>
                            <source src="${item.dataStory_url}" type="video/${extension}">
                        </video>
                        <div class="comment absolute bottom-0 left-0 w-full text-white text-center bg-black bg-opacity-50 p-2">${item.comment}</div>
                    </div>
                `;
            } else {
                var storyHTML = `
                    <div class="story-slide">
                        <img src="${item.dataStory_url}" class="slide absolute inset-0 w-full h-full object-cover">
                        <div class="comment absolute bottom-0 left-0 w-full text-white text-center bg-black bg-opacity-50 p-2">${item.comment}</div>
                    </div>
                `;
            }

            displayFriendStories.append(storyHTML);
        }
    });
    
    let intervalId = null;
    function initializeSlideshow() {
        let slides = $('.slide');
        let currentSlide = 0;
    
        function showSlide(index) {
            slides.hide();
            $(slides[index]).show();
        }
    
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
    
        clearInterval(intervalId);
        showSlide(currentSlide); 
        intervalId = setInterval(nextSlide, 4000);
    }
    </script>
    

</main>
@endsection