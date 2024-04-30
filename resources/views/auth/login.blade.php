<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap">
  <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
<div class="container">
  <form class="form" id="loginForm" method="post" action="{{ route('storeLogin') }}">
    @csrf
    <label for="email">Email</label>
    <input name="email" type="email" id="email" placeholder="email" >
    <label for="password">Password</label>
    <input name="password" type="password" id="password" placeholder="Password" >
    <button type="submit">Login</button>
    <div class="flex items-center justify-between">
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input id="remember" name="remember" aria-describedby="remember" type="checkbox"
                       class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
            </div>
            <div class="ml-3 text-sm">
                <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
            </div>
        </div>
        <a href="{{ route('forget.password') }}"
           class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
            password?</a>
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
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    form.addEventListener('submit', function (event) {
      if (!validateEmail(emailInput.value)) {
        event.preventDefault();
        alert('Please enter a valid email address.');
        return false;
      }

      if (!validatePassword(passwordInput.value)) {
        event.preventDefault();
        alert('Please enter a valid password.');
        return false;
      }
    });

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
  });
</script>
</body>
</html>
