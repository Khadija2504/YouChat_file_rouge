<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Panda Login Form</title>
  <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&amp;display=swap'>
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
  <link rel="stylesheet" href="../../css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
  <form method="post" action="{{route('storeRegister')}}" enctype="multipart/form-data">
    @csrf
    <label for="username">name</label>
    <input name="name" type="text" id="username" placeholder="Username" required>
    <label for="uploadFile1" class="bg-gray-800 hover:bg-gray-700 text-white text-sm px-4 py-2.5 outline-none rounded w-max cursor-pointer mx-auto block font-[sans-serif]">
      Add your avatar
    </label>
      <input type="file" name="avatar" id="uploadFile1" accept=".png, .jpg, .jpeg, .svg" class="" />
    <label for="email">Email</label>
    <input name="email" type="email" id="email" placeholder="email" required>
    <label for="password">Password</label>
    <input name="password" type="password" id="password" placeholder="Password" required>
    <button type="submit">Register</button>
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
