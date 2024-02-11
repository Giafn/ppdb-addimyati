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
            <div class="w-full mb-10 hidden" id="container-result">
              <h3 class="text-lg mb-4 font-bold text-emerald-800 text-center p-2 max-w-sm mx-auto">
                Hasil Pencarian
              </h3>
              <div id="hasilCari">
                
              </div>
            </div>
        </div>
    </div>
    <div class="py-4 px-8">
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
                let loading = `
                    <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center justify-center">
                      <div role="status">
                          <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                          </svg>
                          <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                `;
                $('#container-result').removeClass('hidden');
                $('#hasilCari').html(loading);
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
                      let statusBadge = [
                          `<span class="bg-red-500 text-white px-1 rounded text-xs">Belum Membayar</span>`,
                          `<span class="bg-slate-500 text-white px-1 rounded text-xs">Belum Lunas</span>`,
                          `<span class="bg-emerald-500 text-white px-1 rounded text-xs">Lunas</span>`
                      ]
                      if (data.data.nama_lengkap) {
                          html += `
                            <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md">
                              <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                  <img class="h-12 w-12 rounded-full shadow" src="/image/people.jpg" alt="">
                                </div>
                                <div>
                                  <div class="text-base font-medium text-black">${data.data.nama_lengkap} (${data.data.jurusan})</div>
                                  <p class="text-gray-500 text-sm"${data.data.kode}</p>
                                </div>
                              </div>
                              <hr class="mx-4 my-3">
                              <div class="text-left p-3">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Status : <span class="bg-slate-500 text-white px-1 rounded text-xs">Telah Mendaftar</span></div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${data.data.nama_lengkap}</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${data.data.jenis_kelamin == 'l' ? "Laki Laki" : "Perempuan"}</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Tempat, Tanggal Lahir</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${ data.data.tempat_lahir + ", " + data.data.tanggal_lahir_formated }</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Agama</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${data.data.agama}</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Asal Sekolah</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${data.data.asal_sekolah}</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Pilihan Jurusan</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${data.data.jurusan}</div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">Status Pembayaran</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">${statusBadge[data.data.status_pembayaran]}</div>
                              </div>
                            </div>
                          `;
                      } else {
                        html += `
                        <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md text-center">
                          Data tidak ditemukan <br>
                          <span class="text-xs text-gray-500">
                            *bila anda sudah daftar dan data anda tidak di temukan harap hubungi admin 
                          </span>
                        </div>
                        `;
                      }
                      $('#container-result').removeClass('hidden');
                      $('#hasilCari').html(html);
                    },
                    error: function(err) {
                      const html = `
                        <div class="p-2 max-w-sm mx-auto bg-white rounded-xl shadow-md text-center">
                          Data tidak ditemukan <br>
                          <span class="text-xs text-gray-500">
                            *bila anda sudah daftar dan data anda tidak di temukan harap hubungi admin
                          </span>
                        </div>
                        `;
                      $('#container-result').removeClass('hidden');
                      $('#hasilCari').html(html);
                    }
                });
            });
        });
    </script>
@endpush
