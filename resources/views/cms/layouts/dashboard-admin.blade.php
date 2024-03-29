<!doctype html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')SMKT Ad-Dimyati</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- favicon --}}
    <link rel="shortcut icon" href="/image/logo.png" type="image/x-icon">
    {{-- fontawesome --}}
    {{-- css --}}
    <link rel="stylesheet" href="/css/app.css">
</head>

<body class="bg-white dark:bg-gray-800">
    @include('cms.includes.navbar-admin')
    <div class="flex pt-16 overflow-hidden bg-white dark:bg-gray-800">
        <div class="fixed inset-0 z-30 hidden bg-gray-800/50 dark:bg-gray-800/90 md:hidden" id="sidebarBackdrop"></div>
        @include('cms.includes.sidebar-admin')
        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64">
            <main>
                @yield('content')
            </main>
            <p class="my-10 text-sm text-center text-gray-500">
                made with <span class="text-red-500">&hearts;</span> by TeamThree with <a href="https://flowbite.com/" class="hover:underline" target="_blank">Flowbite</a>
            </p>
        </div>
    </div>
    <div id="overflowLoading" class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto md:inset-0 h-modal sm:h-full flex bg-gray-900 bg-opacity-80 dark:bg-opacity-80 hidden">
        <div role="status">
            <svg aria-hidden="true" class="inline w-10 h-10 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }

        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="/js/modal.js"></script>
    <script>
        function loading(show) {
            var element = document.getElementById("overflowLoading");
            if (show) {
                element.classList.remove('hidden');
            } else {
                element.classList.add('hidden');
            }
        }

        // buat fungsi untuk menulis currency
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

            return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : '';
        }
        // on keyup input nominal
        $(".nominalFormat").keyup(function() {
            $(this).val(formatRupiah($(this).val(), "Rp. "));
        });

        var sidebar = document.getElementById('sidebar');
        var sidebarBackdrop = document.getElementById('sidebarBackdrop');
        var sidebarOpenBtn = document.getElementById('toggleSidebarMobileHamburger');

        sidebarOpenBtn.addEventListener('click', function() {
            sidebar.classList.remove('hidden');
            sidebarBackdrop.classList.remove('hidden');
            sidebarOpenBtn.classList.add('hidden');
        });

        sidebarBackdrop.addEventListener('click', function() {
            closeSidebar();
        });

        function closeSidebar() {
            sidebar.classList.add('hidden');
            sidebarBackdrop.classList.add('hidden');
            sidebarOpenBtn.classList.remove('hidden');
        }

    </script>
    <script>
        
    </script>
    @yield('script')
</body>

</html>