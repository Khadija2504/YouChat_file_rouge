<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('css/landing.css')}}" />
    <title>YouChat</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo">YouChat<span>.</span></div>
      @auth
      <ul class="nav__links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#">Destinations</a></li>
        <li class="link"><a href="#">Pricing</a></li>
        <a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>

        <li class="link"><a href="#">Reviews</a></li>
      </ul>
      @else
      <ul class="nav__links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#">logout</a></li>
        <li class="link"><a href="#">register</a></li>
        <li class="link"><a href="#">Reviews</a></li>
      </ul>
      @endauth
      <button class="btn">Login</button>
    </nav>
    <header>
      <div class="section__container header__container">
        <div class="header__image">
          <img src="https://i.pinimg.com/564x/c7/04/5b/c7045be4bcbb0297f99054ede078370d.jpg" alt="header" />
          <img src="https://i.pinimg.com/564x/e2/1c/6c/e21c6cf04d76dc29076b8416db22abde.jpg" alt="header" />
        </div>
        <div class="header__content">
          <div>
            <p class="sub__header">YouChat</p>
            <h1>The Happy 😊<br />connection for sharing</h1>
            <p class="section__subtitle">
              Experience the joy of staying connected. Join our vibrant community and share your world with friends
            </p>
            @auth
            @if(Auth::user()->role == 'user')
            <div class="action__btns">
              <a href="{{route('home')}}">
                <button class="btn">Go home</button>
              </a>
            </div>
              @else
              <div class="action__btns">
                <a href="{{route('dashboard')}}">
                  <button class="btn">Go home</button>
                </a>
              </div>
              @endif
            @else
            <div class="action__btns">
              <a href="{{route('register')}}">
                <button class="btn">Try it!</button>
              </a>
            </div>
            @endauth
          </div>
        </div>
      </div>
    </header>

    <section class="section__container destination__container">
      <div class="section__header">
        <div>
          <h2 class="section__title">For Engaging Posts & More ✨</h2>
          <p class="section__subtitle">
            Dive into captivating content, exciting videos, immersive reels, thrilling events, and lively chats. Only on YouChat.
          </p>
        </div>
      </div>
      <div class="destination__grid">
        <div class="destination__card">
          <img src="https://i.pinimg.com/564x/46/c6/e4/46c6e4c345e97ebb3b46a69f9760f1a8.jpg" alt="destination" />
          <div class="destination__details">
            <p class="destination__title">Posts</p>
            <p class="destination__subtitle">Tell your connections about your ideas</p>
          </div>
        </div>
        <div class="destination__card">
          <img src="https://i.pinimg.com/564x/9f/a9/61/9fa9613d0873ae4060af2a04233cec7c.jpg" alt="destination" />
          <div class="destination__details">
            <p class="destination__title">Reels</p>
            <p class="destination__subtitle">Share short videos with your friends</p>
          </div>
        </div>
        <div class="destination__card">
          <img src="https://i.pinimg.com/564x/70/19/ca/7019ca21c52ba39228fda3e71daa69bb.jpg" alt="destination" />
          <div class="destination__details">
            <p class="destination__title">Videos</p>
            <p class="destination__subtitle">Share a special moments with the peaple you know</p>
          </div>
        </div>
        <div class="destination__card">
          <img src="https://i.pinimg.com/564x/da/fb/98/dafb989ff4af09e4719a7767e20d7aad.jpg" alt="destination" />
          <div class="destination__details">
            <p class="destination__title">Events</p>
            <p class="destination__subtitle">Let your followers congrate you about your birthday</p>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3>Pathway<span>.</span></h3>
          <p>
            Explore your suitable and dream places around the world. Here you
            can find your right destination.
          </p>
        </div>
        <div class="footer__col">
          <h4>Support</h4>
          <p>FAQs</p>
          <p>Terms & Conditions</p>
          <p>Privacy Policy</p>
          <p>Contact Us</p>
        </div>
        <div class="footer__col">
          <h4>Address</h4>
          <p>
            <span>Address:</span> 280 Wilson Street, Cima, California, 92323,
            United States
          </p>
          <p><span>Email:</span> info@pathway.com</p>
          <p><span>Phone:</span> +91 9876543210</p>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2023 Web Design Mastery. All rights reserved.
      </div>
    </footer>
  </body>
</html>
