@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')

<div class="flex h-screen justify-center items-center">
    <div class="text-center">
        <img src="/image/illustrasi/email.svg" class="w-3/5 mx-auto lg:w-60" alt="logo">
        <h2 class="font-semibold text-sm text-emerald-800 text-center">Alhamdulillah,</h2>
        <h1 class="font-bold text-2xl text-emerald-800 text-center">Pendaftaran Berhasil!</h1>
        <p class="text-sm text-gray-600 text-center">Terima kasih telah mendaftar di PPDB Ad-Dimyati.</p>
        <p class="text-sm text-gray-600 text-center">Silahkan cek email anda untuk melihat informasi lebih lanjut.</p>
        <a href="/" class="inline-block mt-4 px-4 py-2 bg-lime-800 text-white rounded-md hover:bg-lime-700">Kembali ke Beranda</a>
    </div>
  </div>
@endsection