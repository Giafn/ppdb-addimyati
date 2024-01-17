@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')

<div class="flex h-screen justify-center items-center">
    <div class="text-center">
        <img src="/image/illustrasi/warning.svg" class="w-3/5 mx-auto lg:w-60" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">Maaf,</h2>
        <h1 class="font-bold text-2xl text-emerald-800 text-center">Pendaftaran Gagal!</h1>
        <p class="text-sm text-gray-600 text-center">Mohon maaf, pendaftaran anda tidak dapat diproses.</p>
        <p class="text-sm text-gray-600 text-center">Silahkan coba lagi atau hubungi admin.</p>
        <a href=/ppdb class="inline-block mt-4 px-4 py-2 bg-lime-800 text-white rounded-md hover:bg-lime-700">Kembali</a>
    </div>
  </div>
@endsection