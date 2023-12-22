<!doctype html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | SMKT Ad-Dimyati</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/app.css">
    

    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-50 dark:bg-gray-800">
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12 flex items-center justify-center">
                <div class="mt-12 flex flex-col items-center">
                    <h1 class="text-xl xl:text-1xl font-bold text-center mb-4">
                        Sistem PPDB Online
                        <br>
                        <span class="block">SMK Terpadu <span class="text-emerald-800">Ad-Dimyati</span></span>
                    </h1>
                    <img src="/image/logo.png" class="h-24 mx-auto" alt="logo">
                    <div class="w-full flex-1 mt-8 items-center">
                        <div class="mx-auto max-w-xs">
                            <form class="mt-8 space-y-6" method="POST">
                                {{ csrf_field() }}
                                <input name="email" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white" type="email" placeholder="Email" value="{{ old('email') }}" />
                                <input name="password" class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border border-gray-200 placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5" type="password" placeholder="Password" />
                                <button type="submit" class="mt-5 tracking-wide font-semibold bg-lime-700 text-gray-100 w-full py-4 rounded-lg hover:bg-lime-800 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 -ml-2" fill="currentColor" viewBox="0 0 512 512">
                                        <path d="M352 96l64 0c17.7 0 32 14.3 32 32l0 256c0 17.7-14.3 32-32 32l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l64 0c53 0 96-43 96-96l0-256c0-53-43-96-96-96l-64 0c-17.7 0-32 14.3-32 32s14.3 32 32 32zm-9.4 182.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L242.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/>
                                    </svg>
                                    <span class="ml-3">
                                        Login
                                    </span>
                                </button>
                            </form>
                            <p class="mt-6 text-xs text-gray-600 text-center">
                                Anda hanya dapat login dengan akun yang telah terdaftar
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-lime-100 text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                    style="background-image: url('/image/illustrasi/ilustrasi-green.webp');">
                </div>
            </div>
        </div>
    </div>
</body>

</html>