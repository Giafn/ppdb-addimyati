@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')
@php
    $dibuka = true;
    $tanggal_buka = false;
@endphp
@if ($dibuka)
<div class="px-9 py-5">
    <div>
        <img src="/image/logo.png" class="h-12 mx-auto" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h2>
    </div>
    <div class="w-full fixed bottom-0 left-0 right-0 shadow-md pb-10 px-4">
        <img src="/image/illustrasi/ppdb_sudah_dibuka.png" class="w-4/5 mx-auto" alt="logo" style="margin-bottom: 4vh;">
        <div class="judul mx-8">
            <h2 class="font-semibold text-sm text-emerald-800 text-center">Alhamdulillah,</h2>
            <h2 class="font-semibold text-sm text-emerald-800 text-center">Pendaftaran siswa sudah di buka
                Yuk <span class="text-base">Daftar Online</span> Sekarang !</h2>
        </div>
        <a href="/ppdb/pendaftaran" class="block w-4/5 mx-auto mt-4 bg-lime-700 text-white text-center py-2 rounded-full text-sm font-semibold">Daftar Sekarang</a>
        <a href="" class="block w-4/5 mx-auto mt-4 text-emerald-800 text-center text-sm font-semibold">Informasi pendaftaran</a>
    </div>
</div>
@else
<div class="px-9 py-5">
    <div>
        <img src="/image/logo.png" class="h-12 mx-auto" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h2>
    </div>
    <div class="w-full fixed bottom-0 left-0 right-0 shadow-md pb-14 px-4">
        <img src="/image/illustrasi/ppdb_belum_dibuka.png" class="w-4/5 mx-auto" alt="logo" style="margin-bottom: 4vh;">
        <div class="judul mx-8 mb-7">
            <h2 class="font-semibold text-sm text-emerald-800 text-center">Mohon Maaf,</h2>
            <h2 class="font-semibold text-sm text-emerald-800 text-center">Pendaftaran siswa belum di buka !</h2>
            @if ($tanggal_buka)
            <h2 class="font-semibold text-sm text-emerald-800 text-center">Pendaftaran siswa akan di buka pada tanggal <span class="text-base">{{ $tanggal_buka }}</span></h2>
            @endif
        </div>
        <div class="mx-6">
            <p class="text-sm text-emerald-800 text-center">
                dapatkan notifikasi penerimaan  siswa melalui email
            </p>
            <form action="" method="POST" class="mt-4">
                @csrf
                <div class="flex">
                    <input type="email" name="email" id="email" class="w-full border border-emerald-800 rounded-lg mr-2 px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-800 focus:border-transparent" placeholder="Masukkan email anda">
                    <button type="submit" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection