@php
    $activeClass = 'block py-2 px-3 md:p-0 text-white bg-lime-700 rounded md:bg-transparent md:text-lime-700 md:dark:text-lime-500 font-bold';
    $inactiveClass = 'block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700';
@endphp
<nav class="bg-white border-gray-200 fixed w-full z-20 top-0 start-0 md:py-2 shadow">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/image/logo.png" class="h-8 mr-1" alt="Logo" />
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">SMKT Ad-Dimyati</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <a href="/ppdb/pendaftaran"
                class="hover:cursor-pointer text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-4 py-2 text-center hidden md:block">Daftar Sekarang</a>
            <button data-collapse-toggle="navbar-cta" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-cta" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
            <ul
                class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white">
                <li>
                    <a href="/"
                        class="{{ request()->url() == url('/ppdb') ? $activeClass : $inactiveClass }}">
                        Beranda</a>
                </li>
                <li>
                    <a href="/ppdb/flow-daftar"
                        class="{{ request()->url() == url('/ppdb/flow-daftar') ? $activeClass : $inactiveClass }}">
                        Informasi</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700">Cek data</a>
                </li>
                <li>
                    <a href="#"
                        class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-lime-700 ">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
