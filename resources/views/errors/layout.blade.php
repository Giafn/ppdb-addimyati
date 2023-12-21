<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Error | SMKT Ad-Dimyati</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/image/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="/css/app.css">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @yield('style')
</head>

<body class="bg-white h-screen">
    <div class="flex overflow-hidden bg-white h-full dark:bg-gray-900">
        <div id="main-content" class="relative w-full h-full overflow-y-auto">
            <main class="h-full">
                @yield('content')
            </main>
        </div>
    </div>
    <script src="/js/app.js"></script>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @stack('script')
</body>

</html>