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
            <button class="w-full border-b-2 border-gray-300 pb-6 text-left group focus:outline-none">
                <div class="text-md font-semibold text-emerald-800">Q: What is the airspeed velocity of an unladen swallow?</div>
                <div class="mt-3 text-sm hidden text-gray-700 group-focus:flex">
                    <p>Although a definitive answer would of course require further measurements, published species-wide averages of wing length and body mass, initial Strouhal estimates based on those averages and cross-species comparisons, the Lund wind tunnel study of birds flying at a range of speeds, and revised Strouhal numbers based on that study all lead me to estimate that the average cruising airspeed velocity of an unladen European Swallow is roughly 11 meters per second, or 24 miles an hour.</p>
                </div>
            </button>
            <button class="w-full border-b-2 border-gray-300 pb-6 text-left group mt-6 focus:outline-none">
                <div class="text-md font-semibold text-emerald-800">Q: What is the tragedy of Darth Plagueis the Wise?</div>
                <div class="mt-3 text-sm hidden text-gray-700 group-focus:flex">
                    <p>Darth Plagueis was a Dark Lord of the Sith, so powerful and so wise he could use the Force to influence the midichlorians to create life… He had such a knowledge of the dark side, he could even keep the ones he cared about from dying. He became so powerful… the only thing he was afraid of was losing his power, which eventually, of course, he did.</p>
                </div>
            </button>
            <button class="w-full border-b-2 border-gray-300 pb-6 text-left group mt-6 focus:outline-none">
                <div class="text-md font-semibold text-emerald-800">Q: Why did the Fellowship of the Ring not fly to Mordor with the Eagles?</div>
                <div class="mt-3 text-sm hidden text-gray-700 group-focus:flex">
                    <p>Basically if they had attempted to fly in earlier, they would've been seen by the eye and then utterly demolished by the still strong forces within Mordor as Sauron was still very powerful and his armies were definitely a force to be reckoned with. That being said it is conceivable that a mission that bold could've been completed if the elves had also gotten involved, but they didn't care too much for the whole ordeal.</p>
                </div>
            </button>
        {{-- <a class="fixed flex items-center justify-center h-8 pr-2 pl-1 bg-blue-600 rounded-full bottom-0 right-0 mr-4 mb-4 shadow-lg text-blue-100 hover:bg-blue-600" href="https://twitter.com/lofiui" target="_top">
            <div class="flex items-center justify-center h-6 w-6 bg-blue-500 rounded-full">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24" class="r-jwli3a r-4qtqp9 r-yyyyoo r-16y2uox r-1q142lx r-8kz0gk r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1srniue"><g><path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"></path></g></svg>
            </div>
            <span class="text-sm ml-1 leading-none">@lofiui</span>
        </a> --}}
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