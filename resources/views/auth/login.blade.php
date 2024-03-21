<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Panda Login Form</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap'>
  <link rel="stylesheet" href="../../css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <form method="post" action="{{route('storeLogin')}}">
    @csrf
    <label for="email">Email</label>
    <input name="email" type="email" id="email" placeholder="email" required>
    <label for="password">Password</label>
    <input name="password" type="password" id="password" placeholder="Password" required>
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
        <a href="{{route('request')}}"
           class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
            password?</a>
    </div>
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
<!-- partial -->
  <script  src="../../js/script.js"></script>
</body>
</html>
