@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')

@if(session('page'))
@endif
<div class="lg:w-1/2 lg:mx-auto pt-5 px-4">
    <div class="w-full my-10">
        <div class="text-center">
            <h1 class="text-xl font-bold text-emerald-800 text-center">Alur Pendaftaran <br> SMK Ad-Dimyati</h1>
            <p class="text-sm font-semibold text-emerald-800 text-center">2021/2022</p>
        </div>
    </div>
    <div class="container mx-auto">
        <div
          class="flex flex-col md:grid grid-cols-9 mx-auto p-2 text-blue-50">
          @php $i = 1; @endphp
          @foreach ($dataAlur as $item)
            @if ($i % 2 == 1)
              <div class="flex flex-row-reverse md:contents">
                <div
                  class="bg-lime-700 col-start-1 col-end-5 p-4 rounded-xl my-4 ml-auto shadow-md"
                >
                  <h3 class="font-semibold text-md mb-1">{{ $item->nama_tahap }}</h3>
                  <p class="leading-tight text-justify text-sm">
                    {{ $item->deskripsi }}
                  </p>
                </div>
                <div class="col-start-5 col-end-6 md:mx-auto relative mr-10">
                  <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-lime-800 pointer-events-none"></div>
                  </div>
                  <div
                    class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-lime-700 shadow"
                  ></div>
                </div>
              </div>
            @else
              <div class="flex md:contents">
                <div class="col-start-5 col-end-6 mr-10 md:mx-auto relative">
                  <div class="h-full w-6 flex items-center justify-center">
                    <div class="h-full w-1 bg-lime-800 pointer-events-none"></div>
                  </div>
                  <div
                    class="w-6 h-6 absolute top-1/2 -mt-3 rounded-full bg-lime-700 shadow"
                  ></div>
                </div>
                <div
                  class="bg-lime-700 col-start-6 col-end-10 p-4 rounded-xl my-4 mr-auto shadow-md"
                >
                  <h3 class="font-semibold text-md mb-1">{{ $item->nama_tahap }}</h3>
                  <p class="leading-tight text-justify text-sm">
                    {{ $item->deskripsi }}
                  </p>
                </div>
              </div>
            @endif
            @php $i++; @endphp
          @endforeach
        </div>
    </div>
    <div class="w-full my-10">
        <div class="text-center">
            <a href="/ppdb/pendaftaran" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Daftar Sekarang</a>
        </div>
    </div>
    <div class="w-full mb-10 mt-28">
        <div class="text-center">
            <h1 class="text-xl font-bold text-emerald-800 text-center">FAQ</h1>
            <p class="text-sm font-semibold text-emerald-800 text-center">Frequently Asked Questions</p>
        </div>
    </div>
    <div class="container mx-auto px-6">
        <div class="flex items-center justify-center w-full flex-col mb-10">
          @foreach ($faq as $p)
            <button class="w-full border-b border-gray-300 pb-6 text-left group focus:outline-none">
                <div class="text-md font-semibold text-emerald-800">Q: {{ $p->pertanyaan }}</div>
                <div class="mt-3 text-sm hidden text-gray-700 group-focus:flex">
                    <p>{{ $p->jawaban }}</p>
                </div>
            </button>
          @endforeach
        </div>
    </div>
</div>
{{-- footer --}}
<div class="w-full py-4 px-8">
    <div class="flex items-center justify-center">
        <img src="/image/logo.png" class="h-10" alt="logo">
        <h1 class="text-xs font-bold text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h1>
    </div>
</div>
@endsection