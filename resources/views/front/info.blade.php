@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')
@php
    $dibuka = false;
    $tanggal_buka = "10 maret 2024";
@endphp
@if ($dibuka)
<div class="px-9 py-5 w-full lg:h-screen">
    <div class="lg:hidden">
        <img src="/image/logo.png" class="h-12 mx-auto" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h2>
    </div>
    <div class="w-full fixed bottom-0 left-0 lg:static right-0 pb-10 px-4 lg:grid lg:grid-cols-2 lg:place-items-center lg:h-full">
        <div class="w-full lg:col-span-1">
            <img src="/image/illustrasi/ppdb_sudah_dibuka.svg" class="w-4/5 mx-auto lg:w-1/2" alt="logo" style="margin-bottom: 4vh;">
        </div>
        <div class="w-full lg:col-span-1">
            <div class="col-span-2 hidden lg:block mb-10">
                <img src="/image/logo.png" class="h-10 mx-auto inline" alt="logo">
                <span class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</span>
            </div>
            <div class="judul mx-8 lg:mb-6 lg:mx-0">
                <h2 class="font-semibold text-sm text-emerald-800 text-center lg:text-left lg:text-lg lg:text-2xl">Alhamdulillah,</h2>
                <h2 class="font-semibold text-sm text-emerald-800 text-center lg:text-left lg:text-lg lg:text-xl">Pendaftaran siswa sudah di buka
                    Yuk <span class="text-base lg:text-2xl px-1 bg-emerald-800 text-white">Daftar Online</span> Sekarang !</h2>
            </div>
            <a href="/ppdb/pendaftaran" class="block w-4/5 mx-auto mt-4 bg-lime-700 text-white text-center py-2 rounded-full text-sm font-semibold lg:inline lg:px-4 lg:me-4 lg:text-md">Daftar Sekarang</a>
            <a href="" class="block w-4/5 mx-auto mt-4 text-emerald-800 text-center text-sm font-semibold lg:inline lg:text-md">Informasi pendaftaran</a>
        </div>
    </div>
</div>
@else
<div class="px-9 py-5 w-full lg:h-screen">
    <div class="lg:hidden">
        <img src="/image/logo.png" class="h-12 mx-auto" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h2>
    </div>
    <div class="w-full fixed bottom-0 left-0 lg:static right-0 pb-10 px-4 lg:grid lg:grid-cols-2 lg:place-items-center lg:h-full">
        <div class="w-full lg:col-span-1">
            <img src="/image/illustrasi/ppdb_belum_dibuka.svg" class="w-4/5 mx-auto lg:w-1/2" alt="logo" style="margin-bottom: 4vh;">
        </div>
        <div class="w-full lg:col-span-1">
            <div class="col-span-2 hidden lg:block mb-10">
                <img src="/image/logo.png" class="h-10 mx-auto inline" alt="logo">
                <span class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</span>
            </div>
            <div class="judul mx-8 lg:mb-6 lg:mx-0">
                <h2 class="font-semibold text-sm text-emerald-800 text-center lg:text-left lg:text-lg lg:text-2xl">Mohon Maaf,</h2>
                <h2 class="font-semibold text-sm text-emerald-800 text-center lg:text-left lg:text-lg lg:text-xl">Pendaftaran siswa belum di buka !</h2>
                @if ($tanggal_buka)
                    <h2 class="font-semibold text-sm text-emerald-800 text-center lg:text-base lg:text-left">Pendaftaran siswa akan di buka pada tanggal <span class="text-base lg:text-lg underline decoration-2 underline-offset-4">{{ $tanggal_buka }}</span></h2>
                @endif
            </div>
            <div class="mx-6 lg:mx-0">
                <p class="text-sm text-emerald-800 text-center lg:text-left">
                    dapatkan notifikasi penerimaan  siswa melalui email
                </p>
                <form action="" method="POST" class="mt-4">
                    @csrf
                    <div class="flex">
                        <input type="email" name="email" id="email" class="w-full border border-emerald-800 rounded-lg mr-2 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800 focus:border-transparent lg:w-96" placeholder="Masukkan email anda">
                        <button type="submit" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection