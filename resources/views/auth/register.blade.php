<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration Form</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap'>
  <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
<div class="container">
  <form class="form" id="registrationForm" method="post" action="{{ route('storeRegister') }}" enctype="multipart/form-data">
    @csrf
  <div class="right">
    <label for="username">Name</label>
    <input name="name" type="text" id="username" placeholder="Username" >
    <label for="uploadFile1" class="bg-gray-800 hover:bg-gray-700 text-white text-sm px-4 py-2.5 outline-none rounded w-max cursor-pointer mx-auto block font-[sans-serif]">
      Add your avatar
    </label>
    <input type="file" name="avatar" id="uploadFile1" accept=".png, .jpg, .jpeg, .svg" class="" />
    <label for="email">Email</label>
    <input name="email" type="email" id="email" placeholder="Email" >
    <label for="contry">Contry</label>
    <input type="text" id="contry" name="contry" placeholder="Contry">
  </div>
  <div class="left">
    <label for="city">City</label>
    <input type="text" id="city" name="city" placeholder="City">
    <label for="about">Tell us about you</label>
    <textarea name="about" id="about" cols="30" rows="4" ></textarea>
    <label for="password">Password</label>
    <input name="password" type="password" id="password" placeholder="Password" >
    <button type="submit">Register</button>
  </div>
  </form>
  <form class="formGoogle" action="{{route('googleAuthentication')}}">
    @csrf
    <button class="button" type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">continue with google</button>
  </form>
  <div class="ear-l"></div>
  <div class="ear-r"></div>
  <div class="panda-face">
    <div class="blush-l"></div>
    <div class="blush-r"></div>
    <div class="eye-l">
      <div class="eyeball-l"></div>
    </div>
    <div class="eye-r">
      <div class="eyeball-r"></div>
    </div>
    <div class="nose"></div>
    <div class="mouth"></div>
  </div>
  <div class="hand-l"></div>
  <div class="hand-r"></div>
  <div class="paw-l"></div>
  <div class="paw-r"></div>
</div>
<script src="../../js/script.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const usernameInput = document.getElementById('username');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const avatarInput = document.getElementById('uploadFile1');
    const aboutInput = document.getElementById('about');

    form.addEventListener('submit', function (event) {
      if (!validateName(usernameInput.value)) {
        event.preventDefault();
        alert('Please enter a valid username (3-30 characters).');
        return false;
      }

      if (!validateEmail(emailInput.value)) {
        event.preventDefault();
        alert('Please enter a valid email address.');
        return false;
      }

      if (!validatePassword(passwordInput.value)) {
        event.preventDefault();
        alert('Please enter a valid password (minimum 8 characters).');
        return false;
      }

      if (!validateAbout(aboutInput.value)) {
        event.preventDefault();
        alert('Please tell us about yourself (minimum 10 characters).');
        return false;
      }

      // You can add validation for the avatar here if needed
    });

    function validateName(name) {
      // Regular expression for validating name (3-30 characters)
      const nameRegex = /^[a-zA-Z0-9\s]{3,30}$/;
      return nameRegex.test(name);
    }

    function validateEmail(email) {
      // Regular expression for validating email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }

    function validatePassword(password) {
      // Regular expression for validating password (minimum 8 characters)
      const passwordRegex = /^.{8,}$/;
      return passwordRegex.test(password);
    }

    function validateAbout(about) {
      // Regular expression for validating "about" field (minimum 10 characters)
      return about.trim().length >= 10;
    }
  });
</script>
</body>
</html>
