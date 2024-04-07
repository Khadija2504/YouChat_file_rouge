<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        <a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg viewBox="0 0 651 192" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-16 w-auto text-gray-700 sm:h-20">
                        <g clip-path="url(#clip0)" fill="#EF3B2D">
                            <path d="M248.032 44.676h-16.466v100.23h47.394v-14.748h-30.928V44.676zM337.091 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.431 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162-.001 2.863-.479 5.584-1.432 8.161zM463.954 87.202c-2.101-3.341-5.083-5.965-8.949-7.875-3.865-1.909-7.756-2.864-11.669-2.864-5.062 0-9.69.931-13.89 2.792-4.201 1.861-7.804 4.417-10.811 7.661-3.007 3.246-5.347 6.993-7.016 11.239-1.672 4.249-2.506 8.713-2.506 13.389 0 4.774.834 9.26 2.506 13.459 1.669 4.202 4.009 7.925 7.016 11.169 3.007 3.246 6.609 5.799 10.811 7.66 4.199 1.861 8.828 2.792 13.89 2.792 3.913 0 7.804-.955 11.669-2.863 3.866-1.908 6.849-4.533 8.949-7.875v9.021h15.607V78.182h-15.607v9.02zm-1.432 32.503c-.955 2.578-2.291 4.821-4.009 6.73-1.719 1.91-3.795 3.437-6.229 4.582-2.435 1.146-5.133 1.718-8.091 1.718-2.96 0-5.633-.572-8.019-1.718-2.387-1.146-4.438-2.672-6.156-4.582-1.719-1.909-3.032-4.152-3.938-6.73-.909-2.577-1.36-5.298-1.36-8.161 0-2.864.451-5.585 1.36-8.162.905-2.577 2.219-4.819 3.938-6.729 1.718-1.908 3.77-3.437 6.156-4.582 2.386-1.146 5.059-1.718 8.019-1.718 2.958 0 5.656.572 8.091 1.718 2.434 1.146 4.51 2.674 6.229 4.582 1.718 1.91 3.054 4.152 4.009 6.729.953 2.577 1.432 5.298 1.432 8.162 0 2.863-.479 5.584-1.432 8.161zM650.772 44.676h-15.606v100.23h15.606V44.676zM365.013 144.906h15.607V93.538h26.776V78.182h-42.383v66.724zM542.133 78.182l-19.616 51.096-19.616-51.096h-15.808l25.617 66.724h19.614l25.617-66.724h-15.808zM591.98 76.466c-19.112 0-34.239 15.706-34.239 35.079 0 21.416 14.641 35.079 36.239 35.079 12.088 0 19.806-4.622 29.234-14.688l-10.544-8.158c-.006.008-7.958 10.449-19.832 10.449-13.802 0-19.612-11.127-19.612-16.884h51.777c2.72-22.043-11.772-40.877-33.023-40.877zm-18.713 29.28c.12-1.284 1.917-16.884 18.589-16.884 16.671 0 18.697 15.598 18.813 16.884h-37.402zM184.068 43.892c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002-35.648-20.524a2.971 2.971 0 00-2.964 0l-35.647 20.522-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v38.979l-29.706 17.103V24.493a3 3 0 00-.103-.776c-.024-.088-.073-.165-.104-.25-.058-.157-.108-.316-.191-.46-.056-.097-.137-.176-.203-.265-.087-.117-.161-.242-.265-.345-.085-.086-.194-.148-.29-.223-.109-.085-.206-.182-.327-.252l-.002-.001-.002-.002L40.098 1.396a2.971 2.971 0 00-2.964 0L1.487 21.919l-.002.002-.002.001c-.121.07-.219.167-.327.252-.096.075-.205.138-.29.223-.103.103-.178.228-.265.345-.066.089-.147.169-.203.265-.083.144-.133.304-.191.46-.031.085-.08.162-.104.25-.067.249-.103.51-.103.776v122.09c0 1.063.568 2.044 1.489 2.575l71.293 41.045c.156.089.324.143.49.202.078.028.15.074.23.095a2.98 2.98 0 001.524 0c.069-.018.132-.059.2-.083.176-.061.354-.119.519-.214l71.293-41.045a2.971 2.971 0 001.489-2.575v-38.979l34.158-19.666a2.971 2.971 0 001.489-2.575V44.666a3.075 3.075 0 00-.106-.774zM74.255 143.167l-29.648-16.779 31.136-17.926.001-.001 34.164-19.669 29.674 17.084-21.772 12.428-43.555 24.863zm68.329-76.259v33.841l-12.475-7.182-17.231-9.92V49.806l12.475 7.182 17.231 9.92zm2.97-39.335l29.693 17.095-29.693 17.095-29.693-17.095 29.693-17.095zM54.06 114.089l-12.475 7.182V46.733l17.231-9.92 12.475-7.182v74.537l-17.231 9.921zM38.614 7.398l29.693 17.095-29.693 17.095L8.921 24.493 38.614 7.398zM5.938 29.632l12.475 7.182 17.231 9.92v79.676l.001.005-.001.006c0 .114.032.221.045.333.017.146.021.294.059.434l.002.007c.032.117.094.222.14.334.051.124.088.255.156.371a.036.036 0 00.004.009c.061.105.149.191.222.288.081.105.149.22.244.314l.008.01c.084.083.19.142.284.215.106.083.202.178.32.247l.013.005.011.008 34.139 19.321v34.175L5.939 144.867V29.632h-.001zm136.646 115.235l-65.352 37.625V148.31l48.399-27.628 16.953-9.677v33.862zm35.646-61.22l-29.706 17.102V66.908l17.231-9.92 12.475-7.182v33.841z"/>
                        </g>
                    </svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel.com/docs" class="underline text-gray-900 dark:text-white">Documentation</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel has wonderful, thorough documentation covering every aspect of the framework. Whether you are new to the framework or have previous experience with Laravel, we recommend reading all of the documentation from beginning to end.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" /></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laracasts.com" class="underline text-gray-900 dark:text-white">Laracasts</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laracasts offers thousands of video tutorials on Laravel, PHP, and JavaScript development. Check them out, see for yourself, and massively level up your development skills in the process.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" /></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold"><a href="https://laravel-news.com/" class="underline text-gray-900 dark:text-white">Laravel News</a></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-500"><path stroke-linecap="round" stroke-linejoin="round" d="M6.115 5.19l.319 1.913A6 6 0 008.11 10.36L9.75 12l-.387.775c-.217.433-.132.956.21 1.298l1.348 1.348c.21.21.329.497.329.795v1.089c0 .426.24.815.622 1.006l.153.076c.433.217.956.132 1.298-.21l.723-.723a8.7 8.7 0 002.288-4.042 1.087 1.087 0 00-.358-1.099l-1.33-1.108c-.251-.21-.582-.299-.905-.245l-1.17.195a1.125 1.125 0 01-.98-.314l-.295-.295a1.125 1.125 0 010-1.591l.13-.132a1.125 1.125 0 011.3-.21l.603.302a.809.809 0 001.086-1.086L14.25 7.5l1.256-.837a4.5 4.5 0 001.528-1.732l.146-.292M6.115 5.19A9 9 0 1017.18 4.64M6.115 5.19A8.965 8.965 0 0112 3c1.929 0 3.716.607 5.18 1.64" /></svg>
                                <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white">Vibrant Ecosystem</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                                    Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="underline">Forge</a>, <a href="https://vapor.laravel.com" class="underline">Vapor</a>, <a href="https://nova.laravel.com" class="underline">Nova</a>, and <a href="https://envoyer.io" class="underline">Envoyer</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="underline">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="underline">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="underline">Echo</a>, <a href="https://laravel.com/docs/horizon" class="underline">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="underline">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="underline">Telescope</a>, and more.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>







<html lang="fr-FR" data-website-id="1" data-main-object="website.page(4,)" data-country="MA" data-logged="false"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="Odoo">
    <meta name="description" content="Découvrez Numeriatech, le leader en Excellence Opérationnelle, Usine Intelligente et Intelligence d'Affaires. Maximisez votre productivité avec nos solutions innovantes.">
    <meta name="keywords" content="exellence opérationnelle,industrie intelligente,Stratégie Industrielle,Performance Opérationnelle,IIOT,Odoo,ERP,Intégration">
        
    <meta property="og:type" content="website">
    <meta property="og:title" content="NumeriaTech Consulting">
    <meta property="og:site_name" content="NumeriaTech Consulting">
    <meta property="og:url" content="https://www.numeria-tech.com/">
    <meta property="og:image" content="https://www.numeria-tech.com/web/image/1251-2d752445/image%2520%25281%2529.webp">
    <meta property="og:description" content="Découvrez Numeriatech, le leader en Excellence Opérationnelle, Usine Intelligente et Intelligence d'Affaires. Maximisez votre productivité avec nos solutions innovantes.">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="NumeriaTech Consulting">
    <meta name="twitter:image" content="https://www.numeria-tech.com/web/image/1251-2d752445/image%2520%25281%2529.webp">
    <meta name="twitter:description" content="Découvrez Numeriatech, le leader en Excellence Opérationnelle, Usine Intelligente et Intelligence d'Affaires. Maximisez votre productivité avec nos solutions innovantes.">
    
    <link rel="canonical" href="https://www.numeria-tech.com/">
    
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <title>NumeriaTech Consulting</title>
    <link type="image/x-icon" rel="shortcut icon" href="/web/image/website/1/favicon?unique=d5cfad0">
    <link rel="preload" href="/web/static/src/libs/fontawesome/fonts/fontawesome-webfont.woff2?v=4.7.0" as="font" crossorigin="">
    <link type="text/css" rel="stylesheet" href="../../css/homePageStyle.css">
    <script id="web.layout.odooscript" type="text/javascript">
        var odoo = {
            csrf_token: "d1ab5484cc9603982da0c7dae418926fdd2e590do1743976469",
            debug: "",
        };
    </script>
    <script type="text/javascript">
        odoo.__session_info__ = {"is_admin": false, "is_system": false, "is_website_user": true, "user_id": false, "is_frontend": true, "profile_session": null, "profile_collectors": null, "profile_params": null, "show_effect": true, "currencies": {"108": {"symbol": "DH", "position": "after", "digits": [69, 2]}}, "bundle_params": {"lang": "en_US", "website_id": 1}, "translationURL": "/website/translations", "cache_hashes": {"translations": "79df83e331d4a34da5e50f7b47e2613971ed6a37"}, "geoip_country_code": "MA", "geoip_phone_code": 212, "lang_url_code": "fr"};
        if (!/(^|;\s)tz=/.test(document.cookie)) {
            const userTZ = Intl.DateTimeFormat().resolvedOptions().timeZone;
            document.cookie = `tz=${userTZ}; path=/`;
        }
    </script>
    <script type="text/javascript" defer="defer" src="/web/assets/1/2d392d6/web.assets_frontend_minimal.min.js" onerror="__odooAssetError=1"></script>
    <script type="text/javascript" defer="defer" onerror="__odooAssetError=1" src="/web/assets/1/af8c53a/web.assets_frontend_lazy.min.js"></script>
    
    
<style id="conditional_visibility"></style></head>
<body class="">

    <div id="wrapwrap" class="homepage o_footer_effect_enable">
            <header id="top" data-anchor="true" data-name="Header" class="o_header_standard o_top_fixed_element" style="">
                
<nav data-name="Navbar" aria-label="Main" class="navbar navbar-expand-lg navbar-light o_colored_level o_cc o_header_force_no_radius d-none d-lg-block p-0 shadow-sm ">
    

        <div id="o_main_nav">
            <div class="o_header_hide_on_scroll">
                <div aria-label="Haut" class="o_header_sales_two_top py-1">
                    <ul class="navbar-nav container d-grid h-100 px-3 o_grid_header_3_cols">
                        
                        <li class="o_header_sales_two_lang_selector_placeholder"></li>
        
    <li class="d-flex align-items-center">
            <div data-name="Text" class="s_text_block d-flex align-items-center mx-auto">
                <small><br></small>
            </div>
    </li>
                              
                        <li class="o_header_sales_two_social_links_placeholder"></li>
                    </ul>
                </div>
                <div aria-label="Moyen" class="container d-flex justify-content-between align-items-center py-1">
                    
<a data-name="Navbar Logo" href="/" class="navbar-brand logo me-4">
        
        <span role="img" aria-label="Logo of NumeriaTech Consulting" title="NumeriaTech Consulting"><img src="/web/image/website/1/logo/NumeriaTech%20Consulting?unique=d5cfad0" class="img img-fluid" width="95" height="40" alt="NumeriaTech Consulting" loading="lazy" style=""></span>
    </a>

                    <ul class="navbar-nav align-items-center gap-1">
                        
    <li class="">
<form method="get" class="o_searchbar_form s_searchbar_input" action="/website/search" data-snippet="s_searchbar_input">
        <div role="search" class="input-group ">
    <input type="search" name="search" class="search-query form-control oe_search_box border-0 bg-light rounded-start-pill ps-3 text-bg-light" placeholder="Rechercher…" data-search-type="all" data-limit="5" data-display-image="true" data-display-description="true" data-display-extra-link="true" data-display-detail="true" data-order-by="name asc" autocomplete="off">
    <button type="submit" aria-label="Rechercher" title="Rechercher" class="btn oe_search_button rounded-end-pill p-3 bg-o-color-3 lh-1">
        <i class="oi oi-search"></i>
    </button>
</div>

        <input name="order" type="hidden" class="o_search_order_by" value="name asc">
        

    </form>
    </li>
                        
        <li class=" o_no_autohide_item">
            <a href="/web/login" class="btn btn-outline-secondary">Se connecter</a>
        </li>
                        
    
    
                    </ul>
                </div>
            </div>
            <div aria-label="Bas" class="border-top o_border_contrast">
                <div class="container d-flex justify-content-between">
                    
<ul id="top_menu" role="menu" class="nav navbar-nav me-4 py-1">
    

                        
<li role="presentation" class="nav-item">
    <a role="menuitem" href="/" class="nav-link active">
        <span>Page d'accueil</span>
    </a>
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  " data-bs-display="static">
        <span>Exellence opérationnelle</span>
    </a>
    <div data-name="Mega Menu" class="dropdown-menu o_mega_menu o_no_parent_editor o_mega_menu_container_size">

<section class="s_mega_menu_odoo_menu pt16 o_colored_level o_cc o_cc1" style="background-image: none;">
    <div class="o_container_small">
        <div class="row">
            
            
            
            <div class="col-md-6 col-lg pt16 o_colored_level col-lg-5 pb40">
                <h4 class="text-uppercase h5 fw-bold mt-0"><font class="text-o-color-1">stratégie et exellence opérationnelle</font><font style="color: rgb(30, 111, 102);">&ZeroWidthSpace;</font><br></h4>
                <div class="s_hr text-start pt4 pb16 text-o-color-5" data-name="Séparateur">
                    <hr class="w-100 mx-auto" style="border-top: 2px solid rgb(64, 159, 111);">
                </div>
                <nav class="nav flex-column">
                    <a href="/strategie-industrielle" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><strong><font class="text-black">Stratégie industrielle</font></strong><br></a>
                    <a href="/performance-operationnelle" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><font class="text-black"><strong>Performance opérationnelle</strong></font><br></a>
                    <a href="/lean-manufacturing" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><strong><font class="text-black">Lean manufacturing</font></strong><br></a>
                    
                </nav>
            </div>
        </div>
    </div>
    
</section></div>
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  " data-bs-display="static">
        <span>Industrie intelligente</span>
    </a>
    <div data-name="Mega Menu" class="dropdown-menu o_mega_menu o_no_parent_editor o_mega_menu_container_size o_editable">

<section class="s_mega_menu_odoo_menu pt16 o_colored_level o_cc o_cc1" style="background-image: none;">
    <div class="container">
        <div class="row o_grid_mode" data-row-count="5">    
            
        <div class="o_colored_level o_grid_item g-col-lg-4 g-height-5 col-lg-4" style="z-index: 1; grid-area: 1 / 5 / 6 / 9;">
                <h4 class="text-uppercase h5 fw-bold mt-0"><font class="text-o-color-1">usine intelligente</font><br></h4>
                <div class="s_hr text-start pt4 pb16 text-o-color-5" data-name="Séparateur">
                    <hr class="w-100 mx-auto" style="border-top: 2px solid rgb(64, 159, 111);">
                </div>
                <nav class="nav flex-column">
                    <a href="/transformation-digitale" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><font class="text-black"><strong>Transformation digitale</strong></font><br></a>
                    <a href="/connectivite-industrielle" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><font class="text-black"><strong>Connectivité&nbsp;</strong></font><font color="#000000"><b>industrielle</b></font><br></a><a href="/surveillance-equipements" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title="" aria-describedby="popover196545"><font class="text-black"><b>Surveillance d'équipements&nbsp;(IIoT)</b></font></a>
                    
                </nav>
            </div></div>
    </div>
    
</section></div>
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  " data-bs-display="static">
        <span>Intelligence d'affaires</span>
    </a>
    <div data-name="Mega Menu" class="dropdown-menu o_mega_menu o_no_parent_editor o_mega_menu_container_size">

<section class="s_mega_menu_odoo_menu pt16 o_colored_level o_cc o_cc1" style="background-image: none;">
    <div class="container">
        <div class="row o_grid_mode" data-row-count="4">
 
        <div class="o_colored_level o_grid_item g-col-lg-4 g-height-4 col-lg-4" style="z-index: 1; grid-area: 1 / 7 / 5 / 11;">
                <h4 class="text-uppercase h5 fw-bold mt-0"><font class="text-o-color-1">INtelligence d'affaires</font><br></h4>
                <div class="s_hr text-start pt4 pb16 text-o-color-5" data-name="Séparateur">
                    <hr class="w-100 mx-auto" style="border-top: 2px solid rgb(64, 159, 111);">
                </div>
                <nav class="nav flex-column">
                    <a href="/strategie-bi" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><strong><font class="text-black">Stratégie pour l'intelligence d'affaires</font></strong><br></a><a href="/performance-analytique" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><font class="text-black"><strong>Performance analytique</strong></font></a><a href="/valorisation-de-donnees" class="nav-link px-0" data-name="Menu Item" data-bs-original-title="" title=""><strong><font class="text-black">Valorisation de données</font></strong></a>
                    
                </nav>
            </div></div>
    </div>
    
</section></div>
</li>

                    
<li role="presentation" class="nav-item">
    <a role="menuitem" href="/career" class="nav-link">
        <span>Carrière</span>
    </a>
</li></ul>
                    
                    <ul class="navbar-nav">
    <div class="oe_structure oe_structure_solo ">
        
    <section class="s_text_block o_colored_level pb0 oe_unremovable oe_unmovable" data-snippet="s_text_block" data-name="Text" style="background-image: none;">
            <div class="container h-100">
                <a href="/contactus" class="btn btn-primary btn_cta oe_unremovable btn_ca w-100 w-100 w-100 w-100 d-flex align-items-center h-100 rounded-0" data-bs-original-title="" title=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contactez-nous</font></font></font></font></font></font></font></font></font></font></a>
            </div>
        </section></div>
                    </ul>
                </div>
            </div>
        </div>
    
</nav>
<nav data-name="Navbar" aria-label="Mobile" class="navbar  navbar-light o_colored_level o_cc o_header_mobile d-block d-lg-none shadow-sm o_header_force_no_radius">
    

    <div id="o_main_nav" class="container flex-wrap justify-content-between">
        
<a data-name="Navbar Logo" href="/" class="navbar-brand logo ">
        
        <span role="img" aria-label="Logo of NumeriaTech Consulting" title="NumeriaTech Consulting"><img src="/web/image/website/1/logo/NumeriaTech%20Consulting?unique=d5cfad0" class="img img-fluid" width="95" height="40" alt="NumeriaTech Consulting" loading="lazy" style=""></span>
    </a>

        <ul class="o_header_mobile_buttons_wrap navbar-nav flex-row align-items-center gap-2 mb-0">
            <li>
                <button class="nav-link btn me-auto p-2 o_not_editable" type="button" data-bs-toggle="offcanvas" data-bs-target="#top_menu_collapse_mobile" aria-controls="top_menu_collapse_mobile" aria-expanded="false" aria-label="Basculer la navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </li>
        </ul>
        <div id="top_menu_collapse_mobile" class="offcanvas offcanvas-end o_navbar_mobile">
            <div class="offcanvas-header justify-content-end o_not_editable">
                <button type="button" class="nav-link btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between h-100 w-100">
                <ul class="navbar-nav">
                    
    <li class="">
<form method="get" class="o_searchbar_form s_searchbar_input" action="/website/search" data-snippet="s_searchbar_input">
        <div role="search" class="input-group mb-3">
    <input type="search" name="search" class="search-query form-control oe_search_box border-0 bg-light rounded-start-pill text-bg-light ps-3" placeholder="Rechercher…" data-search-type="all" data-limit="0" data-display-image="true" data-display-description="true" data-display-extra-link="true" data-display-detail="true" data-order-by="name asc">
    <button type="submit" aria-label="Rechercher" title="Rechercher" class="btn oe_search_button rounded-end-pill bg-o-color-3 pe-3">
        <i class="oi oi-search"></i>
    </button>
</div>

        <input name="order" type="hidden" class="o_search_order_by" value="name asc">
        

    </form>
    </li>
                    
<ul id="top_menu" role="menu" class="nav navbar-nav  ">
    

                        
<li role="presentation" class="nav-item">
    <a role="menuitem" href="/" class="nav-link active">
        <span>Page d'accueil</span>
    </a>
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  d-flex justify-content-between align-items-center" data-bs-display="static">
        <span>Exellence opérationnelle</span>
    </a>
    
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  d-flex justify-content-between align-items-center" data-bs-display="static">
        <span>Industrie intelligente</span>
    </a>
    
</li>
<li class="nav-item dropdown position-static">
    <a data-bs-toggle="dropdown" href="#" class="nav-link dropdown-toggle o_mega_menu_toggle  d-flex justify-content-between align-items-center" data-bs-display="static">
        <span>Intelligence d'affaires</span>
    </a>
    
</li>
<li role="presentation" class="nav-item">
    <a role="menuitem" href="/career" class="nav-link ">
        <span>Carrière</span>
    </a>
</li>
                    
</ul>
                    
    <li class="">
            <div data-name="Text" class="s_text_block mt-2 border-top pt-2 o_border_contrast">
                <small><br></small>
            </div>
    </li>
                    
                </ul>
                <ul class="navbar-nav gap-2 mt-3 w-100">
                    
        <li class=" o_no_autohide_item">
            <a href="/web/login" class="btn btn-outline-secondary w-100">Se connecter</a>
        </li>
          
    <div class="oe_structure oe_structure_solo ">
        
    <section class="s_text_block o_colored_level pb0 oe_unremovable oe_unmovable" data-snippet="s_text_block" data-name="Text" style="background-image: none;">
            <div class="container">
                <a href="/contactus" class="btn btn-primary btn_cta oe_unremovable btn_ca w-100 w-100 w-100 w-100 w-100" data-bs-original-title="" title=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Contactez-nous</font></font></font></font></font></font></font></font></font></font></a>
            </div>
        </section></div>
                </ul>
            </div>
        </div>
    </div>

</nav>

    </header>
            <main style="">
                
    <div id="wrap" class="oe_structure oe_empty"><section class="s_carousel_wrapper" data-vxml="001" data-snippet="s_carousel" data-name="Carrousel">
    <div class="s_carousel s_carousel_default carousel slide" data-bs-interval="10000" id="myCarousel1697632170727" style="background-image: none;">
        
        <ol class="carousel-indicators o_we_no_overlay">
            <li data-bs-slide-to="0" data-bs-target="#myCarousel1697632170727"></li>
            <li data-bs-slide-to="1" data-bs-target="#myCarousel1697632170727"></li>
            <li data-bs-slide-to="2" data-bs-target="#myCarousel1697632170727" class="active" aria-current="true"></li>
        <li data-bs-target="#myCarousel1697632170727" data-bs-slide-to="3"></li> </ol>
        
        <div class="carousel-inner">
            
            <div class="carousel-item pt152 pb152 o_colored_level oe_img_bg o_bg_img_center" style="background-image: url(&quot;/web/image/website.s_carousel_default_image_1&quot;); min-height: 621.8px;" data-name="Slide">
                <div class="container oe_unremovable">
                    <div class="row">
                        <div class="carousel-content col-lg-6 o_colored_level">
                             <h2><font style="font-size: 62px;" class="o_default_snippet_text">Titre de la diapositive</font></h2>
                            <p class="lead o_default_snippet_text">Utilisez ce snippet pour présenter votre contenu dans un format semblable à un diaporama. N'écrivez pas à propos de produits ou services ici, écrivez plutôt à propos des solutions.</p>
                            <p>
                                <a href="/contactus" class="btn btn-primary mb-2 o_default_snippet_text">Contactez-nous</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div><div class="carousel-item pt152 pb152 o_colored_level oe_img_bg o_bg_img_center" style="background-image: url(&quot;/web/image/website.s_carousel_default_image_1&quot;); min-height: 621.8px;" data-name="Slide">
                <div class="container oe_unremovable">
                    <div class="row">
                        <div class="carousel-content col-lg-6 o_colored_level">
                             <h2><font style="font-size: 62px;" class="o_default_snippet_text">Titre de la diapositive</font></h2>
                            <p class="lead o_default_snippet_text">Utilisez ce snippet pour présenter votre contenu dans un format semblable à un diaporama. N'écrivez pas à propos de produits ou services ici, écrivez plutôt à propos des solutions.</p>
                            <p>
                                <a href="/contactus" class="btn btn-primary mb-2 o_default_snippet_text">Contactez-nous</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item pt96 pb96 o_colored_level oe_img_bg o_bg_img_center" style="background-image: url(&quot;/web/image/website.s_carousel_default_image_2&quot;); min-height: 621.8px;" data-name="Slide">
                <div class="container oe_unremovable">
                    <div class="row">
                        <div class="carousel-content col-lg-8 offset-lg-2 bg-black-50 text-center pt48 pb40 o_colored_level">
                            <h2 style="font-size: 62px;" class="o_default_snippet_text">Un slogan intelligent</h2>
                            <div class="s_hr pt8 pb24" data-snippet="s_hr" data-name="Separator">
                                <hr class="w-25 mx-auto" style="border-top-width: 1px; border-top-style: solid;">
                            </div>
                            <p class="lead o_default_snippet_text">Le storytelling est un outil puissant. <br> Ca engage les utilisateurs. </p>
                            <p><a href="/" class="btn btn-primary mb-2 o_default_snippet_text">Commencez votre aventure</a></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item pt128 pb128 o_colored_level oe_img_bg o_bg_img_center" style="background-image: url(&quot;/web/image/website.s_carousel_default_image_3&quot;); min-height: 621.8px;" data-name="Slide">
                <div class="container oe_unremovable">
                    <div class="row">
                        <div class="carousel-content col-lg-6 offset-lg-6 o_colored_level">
                            <h2><font style="font-size: 62px; background-color: rgb(255, 255, 255);" class="o_default_snippet_text">Editer ce titre</font></h2>
                            <h4><font style="background-color: rgb(255, 255, 255);" class="o_default_snippet_text">Une bonne écriture est simple, mais pas simpliste.</font></h4>
                            <p><br></p>
                            <p class="o_default_snippet_text">Un bon texte commence par la compréhension de comment votre produit ou service aide votre client. Des mots simples sont souvent plus efficaces que des grands mots et un langage pompeux. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <a class="carousel-control-prev o_not_editable o_we_no_overlay" data-bs-slide="prev" role="img" aria-label="Précédent" title="Précédent" href="#myCarousel1697632170727">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden o_default_snippet_text">Précédent</span>
        </a>
        <a class="carousel-control-next o_not_editable o_we_no_overlay" data-bs-slide="next" role="img" aria-label="Suivant" title="Suivant" href="#myCarousel1697632170727">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden o_default_snippet_text">Suivant</span>
        </a>
    </div>
</section><section class="s_carousel_wrapper o_half_screen_height" data-vxml="001" data-snippet="s_carousel" data-name="Carrousel">
    <div class="s_carousel s_carousel_default carousel slide" data-bs-interval="5000" id="myCarousel1697632197830" style="background-image: none;">
        
        <ol class="carousel-indicators o_we_no_overlay">
            <li data-bs-slide-to="0" data-bs-target="#myCarousel1697632197830" class=""></li>
            <li data-bs-slide-to="1" data-bs-target="#myCarousel1697632197830" class=""></li>
            <li data-bs-slide-to="2" data-bs-target="#myCarousel1697632197830" class="active" aria-current="true"></li>
        </ol>
        
        <div class="carousel-inner"><div class="carousel-item o_colored_level pt0 pb96 oe_img_bg o_bg_img_center" style="background-image: url(&quot;/web/image/4210-04f9dfb6/9fd145a0-1329-4797-9f79-57d81553d144.webp&quot;); position: relative; min-height: 520px;" data-name="Slide" data-oe-shape-data="{&quot;shape&quot;:&quot;web_editor/Floats/04&quot;,&quot;colors&quot;:{&quot;c1&quot;:&quot;#278f84&quot;,&quot;c2&quot;:&quot;#3F4152&quot;,&quot;c4&quot;:&quot;#FFFFFF&quot;,&quot;c5&quot;:&quot;#3F4152&quot;},&quot;flip&quot;:[],&quot;showOnMobile&quot;:false,&quot;animated&quot;:&quot;true&quot;}" data-mimetype-before-conversion="image/jpeg" data-mimetype="image/webp" data-original-id="4209" data-original-src="/web/image/4209-8df94741/9fd145a0-1329-4797-9f79-57d81553d144.jpeg" data-resize-width="1024"><div class="o_we_shape o_web_editor_Floats_04 o_we_animated" style="background-image: url(&quot;/web_editor/shape/web_editor%2FFloats%2F04.svg?c1=%23278f84&amp;c2=%233F4152&amp;c4=%23FFFFFF&amp;c5=%233F4152&quot;);"></div>
                <div class="oe_unremovable container">
                    <div class="row o_grid_mode" data-row-count="8">
                        
                    <div class="carousel-content bg-black-50 text-center o_colored_level o_grid_item g-height-5 g-col-lg-8 col-lg-8" style="z-index: 1; grid-area: 4 / 3 / 9 / 11;">
                            <h1 style="font-size: 62px;"><font style="background-color: rgba(0, 0, 0, 0);" class="text-200"><span style="font-size: 48px;">Usine intelligente</span></font></h1><p class="lead"><br></p><p class="lead"><strong><span style="font-size: 20px;"><strong></strong><span style="font-size: 20px;"><strong><span style="font-size: 20px;">Avec notre approche de l'usine intelligente, votre usine devient connectée, optimisée et prête pour l'avenir.</span></strong></span></span></strong><br></p></div></div>
                </div>
            </div><div class="carousel-item o_colored_level pt0 pb120 oe_img_bg o_bg_img_center" style="background-image: url(&quot;/unsplash/qWwpHwip31M/1176/strategie.jpg?unique=cf1a2c24&quot;); position: relative; min-height: 520px;" data-name="Slide" data-oe-shape-data="{&quot;shape&quot;:&quot;web_editor/Floats/04&quot;,&quot;colors&quot;:{&quot;c1&quot;:&quot;#278f84&quot;,&quot;c2&quot;:&quot;#3F4152&quot;,&quot;c4&quot;:&quot;#FFFFFF&quot;,&quot;c5&quot;:&quot;#3F4152&quot;},&quot;flip&quot;:[],&quot;showOnMobile&quot;:false,&quot;animated&quot;:&quot;true&quot;}" data-mimetype-before-conversion="image/jpeg" data-mimetype="image/webp" data-original-id="1175" data-original-src="/unsplash/qWwpHwip31M/strategie.jpg?unique=2ed3b46d" data-resize-width="1920"><div class="o_we_shape o_web_editor_Floats_04 o_we_animated" style="background-image: url(&quot;/web_editor/shape/web_editor%2FFloats%2F04.svg?c1=%23278f84&amp;c2=%233F4152&amp;c4=%23FFFFFF&amp;c5=%233F4152&quot;); left: -0.0999999px; right: -0.0999999px;"></div>
                <div class="oe_unremovable container-fluid">
                    <div class="row o_grid_mode" data-row-count="8">
                        
                    <div class="o_grid_item o_colored_level bg-black-50 g-height-5 g-col-lg-7 col-lg-7" style="z-index: 2; grid-area: 4 / 4 / 9 / 11;"><h1 style="text-align: center;"><font color="#f9f9f9"><span style="font-size: 48px;">Excellence</span></font><span style="font-size: 48px;"><font class="text-o-color-3">&nbsp;opérationnelle</font></span></h1><p style="text-align: center;"><br></p><p style="text-align: center;">
<strong><span style="font-size: 20px;">Notre engagement envers l'excellence opérationnelle propulse votre entreprise vers de nouveaux sommets, vous préparant pour l'avenir de la manière la plus efficace et performante qui soi</span></strong><span style="font-size: 20px;">t.</span>

<br></p></div></div>
                </div>
            </div><div class="carousel-item o_colored_level bg-black-25 pt0 pb104 oe_img_bg o_bg_img_center active" style="background-image: url(&quot;/unsplash/hpjSkU2UYSU/business%20.jpg?unique=37d41b7f&quot;); position: relative; min-height: 520px;" data-name="Slide" data-oe-shape-data="{&quot;shape&quot;:&quot;web_editor/Floats/04&quot;,&quot;colors&quot;:{&quot;c1&quot;:&quot;#278f84&quot;,&quot;c2&quot;:&quot;#3F4152&quot;,&quot;c4&quot;:&quot;#FFFFFF&quot;,&quot;c5&quot;:&quot;#3F4152&quot;},&quot;flip&quot;:[],&quot;showOnMobile&quot;:false,&quot;animated&quot;:&quot;true&quot;}" data-mimetype-before-conversion="image/jpeg"><div class="o_we_bg_filter bg-black-25"></div><div class="o_we_shape o_web_editor_Floats_04 o_we_animated" style="background-image: url(&quot;/web_editor/shape/web_editor%2FFloats%2F04.svg?c1=%23278f84&amp;c2=%233F4152&amp;c4=%23FFFFFF&amp;c5=%233F4152&quot;);"></div>
                <div class="oe_unremovable o_container_small">
                    <div class="row o_grid_mode" data-row-count="8">
                        
                    <div class="carousel-content o_colored_level bg-black-25 o_grid_item g-height-5 g-col-lg-12 col-lg-12" style="z-index: 1; grid-area: 4 / 1 / 9 / 13;">
                            <h1 style="text-align: center;"><font style="font-size: 62px; background-color: rgba(0, 0, 0, 0);" class="text-200"><span style="font-size: 48px;">Intelligence d'affaires</span></font></h1><p style="text-align: center;"><font style="background-color: rgba(0, 0, 0, 0);" class="text-200"><span style="font-size: 18px;">&nbsp;</span></font></p><p style="text-align: center;"><font style="background-color: rgba(0, 0, 0, 0);" class="text-200"><span style="font-size: 20px;"><strong>Nos services d'intelligence d'affaires optimisent votre prise de décision et stimulent la croissance de votre entreprise</strong></span></font><br></p><p><font class="text-200">&ZeroWidthSpace;</font></p><div class="s_donation" data-name="Bouton de don" data-donation-email="info@yourcompany.example.com" data-custom-amount="freeAmount" data-prefilled-options="true" data-descriptions="true" data-donation-amounts="[&quot;10&quot;, &quot;25&quot;, &quot;50&quot;, &quot;100&quot;]" data-minimum-amount="5" data-maximum-amount="100" data-slider-step="5" data-default-amount="25" data-snippet="s_donation_button">
    <form class="s_donation_form" action="/donation/pay" method="post" enctype="multipart/form-data">
        <span id="s_donation_description_inputs"><input type="hidden" class="o_translatable_input_hidden d-block mb-1 w-100" name="donation_descriptions" value="Une année d'éveil culturel."><input type="hidden" class="o_translatable_input_hidden d-block mb-1 w-100" name="donation_descriptions" value="Prendre soin d'un bébé pendant 1 mois."><input type="hidden" class="o_translatable_input_hidden d-block mb-1 w-100" name="donation_descriptions" value="Un an à l'école primaire."></span></form>
</div>
                        </div></div>
                </div>
            </div></div>
        
        <a class="carousel-control-prev o_not_editable o_we_no_overlay" data-bs-slide="prev" role="img" aria-label="Précédent" title="Précédent" href="#myCarousel1697632197830">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden o_default_snippet_text">Précédent</span>
        </a>
        <a class="carousel-control-next o_not_editable o_we_no_overlay" data-bs-slide="next" role="img" aria-label="Suivant" title="Suivant" href="#myCarousel1697632197830">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden o_default_snippet_text">Suivant</span>
        </a>
    </div>
</section><section class="s_text_image o_colored_level o_cc o_cc2 pt0 pb0" data-snippet="s_image_text" data-name="Image - Texte" style="background-image: none;">
    <div class="container-fluid">
        <div class="row o_grid_mode" data-row-count="9">    
        <div class="o_colored_level o_grid_item g-height-2 g-col-lg-2 col-lg-2" style="z-index: 4; grid-area: 8 / 10 / 10 / 12;">
                <p style="text-align: right;">
                    <a class="mb-2 btn btn-primary btn-lg" href="https://www.odoosynergie.com/" data-bs-original-title="" title="" aria-describedby="popover917208">Savoir plus</a>
                </p>
            </div><div class="o_colored_level o_grid_item o_grid_item_image g-col-lg-5 g-height-7 col-lg-5" style="z-index: 1; grid-area: 2 / 1 / 9 / 6;"><img src="/web/image/4204-e62814eb/Odoo.svg" alt="" class="img img-fluid w-75 o_we_custom_image me-auto float-start" data-shape="web_editor/geometric/geo_square_4" data-shape-colors=";;;;" data-mimetype="image/svg+xml" data-original-id="4203" data-original-src="/web/image/4203-b635f852/Odoo.png" data-mimetype-before-conversion="image/png" data-original-mimetype="image/webp" data-resize-width="962" data-file-name="Odoo.svg" loading="lazy" style=""></div><div class="o_colored_level o_grid_item g-col-lg-5 g-height-7 col-lg-5" style="z-index: 2; grid-area: 2 / 7 / 9 / 12;">
                <h2 style="text-align: center;"><font style="color: rgb(159, 64, 112);">Intégration d'Odoo</font></h2><h2 style="text-align: center;"><font class="text-o-color-2"><strong><span style="font-size: 22px;">Une application</span></strong><span style="font-size: 22px;"> pour</span><strong><span style="font-size: 22px;"> vos besoin</span></strong></font><span style="font-size: 22px;">&nbsp;</span><br></h2><p>
Optimisez Odoo avec nos solutions d'intégration sur mesure pour les PME. De la personnalisation à la migration de données, garantissez la réussite de votre intégration grâce à notre expertise.</p></div><div class="o_grid_item o_colored_level g-height-3 g-col-lg-3 col-lg-3" style="z-index: 3; grid-area: 6 / 8 / 9 / 11;"><h6><font style="color: rgb(159, 64, 112);"><strong><span class="fa fa-gear" data-bs-original-title="" title="" aria-describedby="tooltip613034"></span>&nbsp; &nbsp;&nbsp;Paramétrage Odoo</strong></font></h6><h6><font style="color: rgb(159, 64, 112);"><strong><span class="fa fa-copy"></span>&nbsp; &nbsp;Migration des données</strong></font></h6><h6><font style="color: rgb(159, 64, 112);"><strong><span class="fa fa-code" data-bs-original-title="" title="" aria-describedby="tooltip153427"></span>&nbsp; &nbsp; Personnalisation d'Odoo</strong></font></h6><h6><font style="color: rgb(159, 64, 112);"><strong><span class="fa fa-check" data-bs-original-title="" title="" aria-describedby="tooltip563199"></span>&nbsp; &nbsp; Validation du système</strong></font><font style="color: rgb(115, 24, 66);">&ZeroWidthSpace;</font></h6><p><br></p></div></div>
    </div>
</section>
        
        <section class="s_text_image o_colored_level pt16 o_cc o_cc5 pb32" data-snippet="s_text_image" data-name="Texte - Image" style="background-color: rgb(63, 65, 82); background-image: none;">
    <div class="container">
        <div class="row o_grid_mode" data-row-count="7">
      
        <div class="o_grid_item o_colored_level g-height-6 g-col-lg-6 col-lg-6" style="z-index: 4; grid-area: 2 / 1 / 8 / 7;"><h2><font class="text-o-color-3">Business Intelligence</font><br></h2><h3 style="text-align: left;"><span style="font-size: 22px;">Nos Solutions BI Axées sur les Données!</span><font class="text-800">&nbsp;</font><br></h3><p style="text-align: left;">Chez NumeriaTech Consulting, nous nous spécialisons&nbsp;dans l'analyse de données pour :</p><ul><li style="text-align: left;">Personnaliser les Solutions BI</li><li style="text-align: left;">Réduire les Coûts et Optimiser les Processus</li><li style="text-align: left;">Surveiller les KPI en Temps Réel</li><li style="text-align: left;">Améliorer l'Assurance Qualité et la Chaîne d'Approvisionnement</li></ul></div><div class="o_grid_item o_grid_item_image o_colored_level g-col-lg-5 g-height-7 col-lg-5" style="z-index: 5; grid-area: 1 / 8 / 8 / 13;"><img src="/unsplash/8mikJ83LmSQ/4200/data.jpg?unique=3b7420ee" class="img img-fluid mx-auto o_we_custom_image" data-mimetype="image/svg+xml" data-original-id="1070" data-original-src="/unsplash/8mikJ83LmSQ/data.jpg?unique=c8602187" data-mimetype-before-conversion="image/jpeg" data-resize-width="1920" alt="NumeriaTech Consulting Business intelligence" title="usiness intelligence" loading="lazy" data-shape="web_editor/geometric_round/geo_round_square" data-file-name="data.svg" data-shape-colors=";;;;" data-original-mimetype="image/jpeg" style=""></div></div>
    </div>
</section><section class="s_text_image o_colored_level pt0 pb32" data-oe-shape-data="{&quot;shape&quot;:&quot;web_editor/Bold/01&quot;,&quot;flip&quot;:[],&quot;showOnMobile&quot;:false}" data-snippet="s_image_text" data-name="Image - Texte" style="background-image: none;">
    <div class="o_we_shape o_web_editor_Bold_01" style="left: -0.0999999px; right: -0.0999999px;"></div>
    <div class="container">
        <div class="row o_grid_mode" data-row-count="7">

        <div class="o_grid_item o_grid_item_image o_colored_level g-height-7 g-col-lg-3 col-lg-3" style="z-index: 2; grid-area: 1 / 1 / 8 / 4;"><img src="/web/image/4089-cf21eaa9/IIOt.svg" alt="" class="img img-fluid mx-auto o_we_custom_image" data-shape="web_editor/geometric_round/geo_round_square" data-shape-colors=";;;;" data-mimetype="image/svg+xml" data-original-id="4087" data-original-src="/web/image/4087-52aa92f4/IIOt.webp" data-mimetype-before-conversion="image/webp" data-original-mimetype="image/webp" data-resize-width="690" data-file-name="IIOt.svg" loading="lazy" style=""></div><div class="o_colored_level o_grid_item g-col-lg-5 g-height-4 col-lg-5" style="z-index: 1; grid-area: 3 / 7 / 7 / 12;">
                <h2>Usine intelligente (IIoT)<br></h2><p style="text-align: justify;">L'<a></a><a href="/surveillance-equipements" data-bs-original-title="" title="">Usine Intelligente</a>, au cœur de l'IIoT, représente notre engagement&nbsp;envers la transformation digitale de votre entreprise. Grâce à une connectivité industrielle avancée et une surveillance en temps réel de&nbsp;vos équipements, nous transformons vos opérations pour les rendre&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;plus&nbsp;intelligentes, efficaces et réactives.

</p></div></div>
    </div>
</section>
  
    </div>

    <div id="o_shared_blocks" class="oe_unremovable"></div>
            </main>
            <footer id="bottom" data-anchor="true" data-name="Footer" class="o_footer o_colored_level o_cc  o_footer_slideout">
                <div id="footer" class="oe_structure oe_structure_solo">
        <section class="s_text_block pt48 pb16" data-snippet="s_text_block" data-name="Text" style="background-image: none;">
            <div class="container">
                <div class="row o_grid_mode" data-row-count="5">
   
                <div class="o_colored_level o_grid_item g-col-lg-3 g-height-5 col-lg-3" style="z-index: 3; grid-area: 1 / 1 / 6 / 4;">
                        <section class="s_map pt56 pb168" data-map-type="m" data-map-zoom="12" data-snippet="s_map" data-map-address="Kénitra Maroc" data-name="Carte">
    <div class="map_container o_not_editable">
        <div class="css_non_editable_mode_hidden">
            <div class="missing_option_warning alert alert-info rounded-0 fade show d-none d-print-none o_default_snippet_text"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                Une adresse doit être spécifiée pour qu'une carte soit intégrée
            </font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></div>
        </div>
        
        <iframe class="s_map_embedded o_not_editable" width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=K%C3%A9nitra%20Maroc&amp;t=m&amp;z=12&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe><div class="s_map_color_filter"></div>
    </div>
</section><h5><br></h5><p><br></p><ul class="list-unstyled"><li class="py-1"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">&ZeroWidthSpace;</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></li>
                        </ul>
                    </div><div class="o_colored_level o_grid_item g-col-lg-3 g-height-5 col-lg-3" style="z-index: 4; grid-area: 1 / 7 / 6 / 10;">
                        <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Entrer en contact</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></h5>
                        <ul class="list-unstyled">
                            <li class="py-1"><i class="fa fa-1x fa-fw fa-envelope me-2"></i><a href="mailto:info@numeria-tech.com" data-bs-original-title="" title=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">info@numeria-tech.com</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></a></li>
                            <li class="py-1"><i class="fa fa-1x fa-fw fa-phone me-2" data-bs-original-title="" title="" aria-describedby="tooltip487505"></i><span class="o_force_ltr"></span><a href="tel://+2125 30239632">+2125 30239632</a><span class="o_force_ltr">&nbsp;</span><br></li><li class="py-1"><i aria-describedby="tooltip181332" title="" data-bs-original-title="" class="fa fa-1x fa-fw fa-linkedin-square me-2"></i><font class="text-o-color-1"></font><a href="https://www.linkedin.com/company/numeriatech-consulting/?viewAsMember=true"><font class="text-o-color-1">&nbsp;</font><font style="color: rgb(57, 201, 186);"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Linkedin&nbsp;</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></a><font style="color: rgb(57, 201, 186);"></font></li>
                        </ul>
                    </div><div class="o_colored_level o_grid_item g-height-5 g-col-lg-3 col-lg-3" style="z-index: 5; grid-area: 1 / 4 / 6 / 7;">
                        <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">NumeriaTech Consulting&nbsp;</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font><br><font class="text-200"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Kenitra ,Maroc</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></h5></div><div class="o_colored_level o_grid_item g-height-5 g-col-lg-3 col-lg-3" style="z-index: 1; grid-area: 1 / 10 / 6 / 13;">
                        <h5><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Explorateur</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></h5>
                        <ul class="list-unstyled">
                            <li class="list-item py-1"><a href="/"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Page d'accueil</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></a></li><li class="list-item py-1"></li>
                            <li class="list-item py-1">
                                <a href="/privacy" data-bs-original-title="" title=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Politique de confidentialité&nbsp;</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></a></li><li class="list-item py-1">
                                <a href="/about-us" data-bs-original-title="" title=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">À propos de nous</font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></font></a>
                            <br></li>
                        </ul>
                    </div></div>
            </div>
        </section>
    </div>
<div id="o_footer_scrolltop_wrapper" class="container h-0 d-flex align-items-center justify-content-center o_editable">
        <a id="o_footer_scrolltop" role="button" href="#top" title="" class="btn btn-primary rounded-circle d-flex align-items-center justify-content-center" data-bs-original-title="Faire défiler vers le haut">
            <span class="oi fa-1x oi-chevron-up" contenteditable="false">&ZeroWidthSpace;</span>
        </a>
    </div>
                <div class="o_footer_copyright o_colored_level o_cc" data-name="Copyright">
                    <div class="container py-3">
                        <div class="row">
                            <div class="col-sm text-center text-sm-start text-muted">
                                <span class="o_footer_copyright_name me-2">Copyright © NumeriaTech Consulting</span>
</div>
                            <div class="col-sm text-center text-sm-end o_not_editable">
    <div class="o_brand_promotion">

</div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        <div style="width: 1px; height: 1px; margin-top: -1px;"></div></div>
        <script src="../../js/pageHomeScript.js"></script>    
    
<div class="o-main-components-container"><div class="o-overlay-container"></div><div></div><div class="o_notification_manager o_upload_progress_toast"></div><div class="o_notification_manager"></div></div></body></html>