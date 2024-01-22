@extends('cms.layouts.dashboard-admin')
@section('title', 'Dashboard | ')
@section('content')
<div
        class="p-4 block sm:flex items-center justify-between lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard</h1>
            </div>
        </div>
    </div>
<form action="#" method="GET">
    <div class="sm:flex flex-wrap mb-2 mx-4">
        <div class="w-full flex">
            <div
                class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                <label for="tahun_ajaran" class="sr-only">Tahun Ajaran</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <select name="tahun_ajaran" id="tahun_ajaran"
                        class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Tahun Ajaran</option>
                        @foreach ($fillSelectFilter['list_tahun_ajaran'] as $tahun_ajaran)
                            <option value="{{ $tahun_ajaran }}"
                                {{ $tahun_ajaran == request()->input('tahun_ajaran') ? 'selected' : '' }}>
                                Tahun Ajaran {{ $tahun_ajaran }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div
                class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                <label for="gelombang" class="sr-only">Gelombang</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <select name="gelombang" id="gelombang"
                        class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Gelombang</option>
                        @foreach ($fillSelectFilter['list_gelombang'] as $gelombang)
                            <option value="{{ $gelombang }}"
                                {{ $gelombang == request()->input('gelombang') ? 'selected' : '' }}>
                                Gelombang {{ $gelombang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="w-full flex px-2">
                <button type="submit"
                    class="me-2 inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Filter
                </button>
                <a href="/cms/dashboard"
                    class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 sm:w-auto dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Reset
                </a>
            </div>
        </div>
    </div>
</form>
<div class="grid w-full grid-cols-1 gap-4 mt-4 xl:grid-cols-2 2xl:grid-cols-3 px-4 mb-4">
    <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800 relative">
        <div class="w-full">
        <h3 class="text-base font-bold text-gray-600 dark:text-gray-400">Pendaftar Tahun ini</h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white" id="total_pendaftar">0</span>
        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            Calon Siswa
        </p>
        </div>
    </div>
    <div class="items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
        <h3 class="text-base font-bold text-gray-600 dark:text-gray-400">Pendaftar Gelombang <span id="gelombangNow"></span></h3>
        <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl dark:text-white" id="total_pendaftar_gelombang">0</span>
        <p class="flex items-center text-base font-normal text-gray-500 dark:text-gray-400">
            Calon Siswa
        </p>
        </div>
    </div>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <div class="w-full">
          <h3 class="mb-2 text-base font-normal text-gray-500 dark:text-gray-400">Statistik Pembayaran</h3>
          <div class="flex items-center mb-2">
            <div class="w-1/3 text-sm font-medium dark:text-white">Belum Pembayaran</div>
            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="bg-slate-600 text-xs font-medium text-slate-100 text-center p-0.5 leading-none rounded-full" style="width: 0%" id="belum_bayar"> 0%</div>
            </div>
          </div>
          <div class="flex items-center mb-2">
            <div class="w-1/3 text-sm font-medium dark:text-white">Belum Lunas</div>
            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="bg-green-600 text-xs font-medium text-green-100 text-center p-0.5 leading-none rounded-full" style="width: 0%" id="belum_lunas"> 0%</div>
            </div>
          </div>
          <div class="flex items-center mb-2">
            <div class="w-1/3 text-sm font-medium dark:text-white">Lunas</div>
            <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 0%" id="lunas"> 0%</div>
            </div>
          </div>
        </div>
        <div id="traffic-channels-chart" class="w-full"></div>
    </div>
</div>
<div class="grid gap-4 xl:grid-cols-2 2xl:grid-cols-3 px-4 my-2">
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-600 sm:p-6 dark:bg-gray-800">
      <div class="flex items-center justify-between mb-4">
        <div class="flex-shrink-0">
          <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
            Statistik Pendaftar
          </span>
          <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Dalam periode <span class="periode"></span></h3>
        </div>
      </div>
      <canvas id="pendaftarChart"></canvas>
      <div class="flex items-center justify-end pt-3 mt-4 border-t border-gray-200 sm:pt-6 dark:border-gray-600">
        <div class="flex-shrink-0">
          <a href="/cms/list-pendaftar" class="inline-flex items-center p-2 text-xs font-medium uppercase rounded-lg text-primary-700 sm:text-sm dark:text-white hover:bg-gray-100 dark:text-primary-500 dark:hover:bg-gray-700">
            List Pendaftar
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
          </a>
        </div>
      </div>
    </div>
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-600 sm:p-6 dark:bg-gray-800">
        <div class="flex-shrink-0">
            <span class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">
              Program Studi Pilihan
            </span>
            <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Dalam periode <span class="periode"></span></h3>
        </div>
        <canvas id="jurusanChart"></canvas>
      <hr class="w-full mt-5">
    </div>
  </div>
@endsection
@section('script')
    @include('cms.dashbboard-js')
@endsection