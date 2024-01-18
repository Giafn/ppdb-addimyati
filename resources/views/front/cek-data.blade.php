@extends('front.layouts.app')
@section('title', 'Cek Data | ')
@section('content')

    @if (session('page'))
    @endif
    <div class="lg:w-1/2 lg:mx-auto pt-5 px-4 md:mt-10 mt-5">
        <div class="w-full my-10">
            <div class="text-center">
                <h1 class="text-xl font-bold text-emerald-800 text-center">Cek Data Pendaftaran <br> SMK Ad-Dimyati</h1>
            </div>
        </div>
        <div class="container mx-auto px-6">
            <div class="w-full mb-5">
                <form class="max-w-sm mx-auto" id="formCek">
                    <div class="mb-5">
                        <label for="nik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                        <input type="number" id="nik" name="nik"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                            placeholder="320xxxxxxxxxxx" required>
                    </div>
                    <div class="mb-5">
                      <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nisn</label>
                      <input type="number" id="nisn" name="nisn"
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                          placeholder="121xxxxxx" required>
                    </div>
                    <div class="mb-5">
                        <label for="tanggal_lahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                            placeholder="Nama Lengkap" required>
                    </div>
                    <button type="submit"
                        class="text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">Cari</button>
                </form>
            </div>
            <div class="w-full mb-10">
              <h3 class="text-lg mb-4 font-bold text-emerald-800 text-center p-2 max-w-sm mx-auto">
                Hasil Pencarian
              </h3>
              <div id="hasilCari">
                <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md text-center">
                  Data tidak ditemukan
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="fixed bottom-0 left-0 right-0 py-4 px-8">
        <div class="flex items-center justify-center">
            <img src="/image/logo.png" class="h-10" alt="logo">
            <h1 class="text-xs font-bold text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h1>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('#formCek').submit(function(e) {
                e.preventDefault();
                var nik = $('#nik').val();
                var nisn = $('#nisn').val();
                var tanggal_lahir = $('#tanggal_lahir').val();
                $.ajax({
                    url: '/ppdb/cek-data',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nik: nik,
                        nisn: nisn,
                        tanggal_lahir: tanggal_lahir
                    },
                    success: function(data) {
                      console.log(data.data.length);
                      let html = '';
                      if (data.data.id_hash) {
                          html += `
                            <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4" onclick="showDetail('${data.data.id_hash}')">
                              <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full shadow" src="https://t3.ftcdn.net/jpg/01/65/63/94/360_F_165639425_kRh61s497pV7IOPAjwjme1btB8ICkV0L.jpg" alt="">
                              </div>
                              <div>
                                <div class="text-base font-medium text-black">${data.data.nama_lengkap} (${data.data.jurusan})</div>
                                <p class="text-gray-500 text-sm">${data.data.kode}</p>
                              </div>
                            </div>
                          `;
                      } else {
                        html += `
                        <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md text-center">
                          Data tidak ditemukan
                        </div>
                        `;
                      }
                      $('#hasilCari').html(html);
                    }
                });
            });
        });
    </script>
@endpush
