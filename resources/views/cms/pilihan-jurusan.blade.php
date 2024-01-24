@extends('cms.layouts.dashboard-admin')
@section('title', 'List pendaftar | ')
@section('content')
<div id="toast-container" class="fixed top-5 right-5 z-100"></div>
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                <path d="M192 0c-41.8 0-77.4 26.7-90.5 64H64C28.7 64 0 92.7 0 128V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H282.5C269.4 26.7 233.8 0 192 0zm0 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM305 273L177 401c-9.4 9.4-24.6 9.4-33.9 0L79 337c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L271 239c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                            </svg>
                            List Pendaftar Fixs
                        </a>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">List Pendaftar Fixs (Sudah Melakukan Pembayaran ke Sekolah)</h1>
        </div>
        <form action="#" method="GET">
        <div class="sm-flex mb-2">
        </div>
        <div class="sm:flex flex-wrap">
            <div class="w-full flex mb-2">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                    <label for="tahun_ajaran" class="sr-only">Tahun Ajaran</label>
                    <div class="relative mt-1 lg:w-64 xl:w-96">
                        <select name="tahun_ajaran" id="tahun_ajaran" class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach($fillSelectFilter['list_tahun_ajaran'] as $tahun_ajaran)
                            <option value="{{ $tahun_ajaran }}" {{ $tahun_ajaran == request()->input('tahun_ajaran') ? 'selected' : '' }}>{{ $tahun_ajaran }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                    <label for="gelombang" class="sr-only">Gelombang</label>
                    <div class="relative mt-1 lg:w-64 xl:w-96">
                        <select name="gelombang" id="gelombang" class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">Semua Gelombang</option>
                            @foreach($fillSelectFilter['list_gelombang'] as $gelombang)
                            <option value="{{ $gelombang }}" {{ $gelombang == request()->input('gelombang') ? 'selected' : '' }}>{{ $gelombang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="items-center hidden mb-3 sm:flex me-2">
                <label for="search" class="sr-only">Search</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <input type="text" name="search" id="search" value="{{ app('request')->input('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari berdasarkan nama">
                </div>
            </div>
            <div class="items-center hidden mb-3 sm:flex me-2">
                <label for="jurusan_pengganti" class="sr-only">Jurusan Pengganti</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <select name="jurusan_pengganti" id="jurusan_pengganti" class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Pilih Jurusan Pengganti</option>
                        @foreach($jurusan as $jurusan_pengganti)
                        <option value="{{ $jurusan_pengganti->id }}" {{ $jurusan_pengganti->id == request()->input('jurusan_pengganti') ? 'selected' : '' }}>{{ $jurusan_pengganti->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex px-2">
                    <button type="submit" class="me-2 inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cari
                    </button>
                    <a href="/cms/pilihan-program-studi" class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 sm:w-auto dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Reset
                    </a>
                </div>
            </div>
            
            </form>
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                @if (ManaCms::checkAccess('laporan', 'hak-akses'))
                <a href="/cms/export/jurusan?tahun_ajaran={{ request()->input('tahun_ajaran') }}&gelombang={{ request()->input('gelombang') }}" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    Export Data Fix Per Jurusan
                </a>
                <button type="button"  data-modal-target="modal-export" data-modal-toggle="modal-export" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    Export Laporan Pendaftaran
                </button>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col" id="list-pendaftar-jurusan">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
                        @foreach($jurusan as $key => $value)
                        <li class="me-2 pindah-tab" id="tabJurusan-{{ $value->id }}" role="presentation">
                            <button id="buttonTab{{ $value->id }}" class="button-tab inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="jurusan-{{ $value->id }}-tab" data-tabs-target="#jurusan-{{ $value->id }}" type="button" role="tab" aria-controls="jurusan-{{ $value->id }}" aria-selected="false">{{ $value->nama }} ({{ $dataList[$value->id]['jumlah'] }})</button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div id="default-tab-content">
                    @foreach($jurusan as $key => $value)
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800 panel" id="jurusan-{{ $value->id }}" role="tabpanel" aria-labelledby="jurusan-{{ $value->id }}-tab">
                        <div class="flex flex-col mt-4">
                            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                                    <div class="overflow-hidden border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                            <thead class="bg-gray-50 dark:bg-gray-800">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                                        No
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                                        Nama Lengkap
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                                        jurusan pilihan
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                                        jurusan Pengganti
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-400">
                                                        Ubah Jurusan
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                                                @foreach($dataList[$value->id]['data'] as $key => $value1)
                                                <tr>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $key + 1 }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400" id="namaPendaftar{{ $value1->id }}">{{ $value1->nama_lengkap }}</td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $value1->nama_jurusan1 }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                        {{ $value1->nama_jurusan2 }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                        <select name="jurusan" data-id="{{ $value1->id }}" class="pindah-jurusan block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            @foreach($jurusan as $key => $value2)
                                                                @if ($value2->id == $value1->jurusan)
                                                                <option value="{{ $value2->id }}" selected>{{ $value2->nama }}</option>
                                                                @else
                                                                <option value="{{ $value2->id }}">{{ $value2->nama }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if (ManaCms::checkAccess('laporan', 'hak-akses'))
<div id="modal-export" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Export Laporan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-export">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <p class="text-gray-500 dark:text-gray-400 mb-1">pilih laporan yang ingin di export:</p>
                <input type="checkbox" id="withSiswaBelumBayar" required>
                <label for="withSiswaBelumBayar" class="text-gray-500 dark:text-gray-400 text-xs">Sertakan Siswa belum bayar</label>
                <ul class="space-y-4 mb-4 mt-4">
                    <li>
                        <div id="cardDataLengkap" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">                           
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data Lengkap</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                    <hr>
                    <li>
                        <div id="cardDataCalonSiswa" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">                           
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data Calon Siswa</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                    <li>
                        <div id="cardDataPembayaran" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data pembayaran</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                    <li>
                        <div id="cardDataNamaSiswa" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data Nama Siswa</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                    <li>
                        <div id="cardDataAsalSekolah" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data Asal Sekolah</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                    <li>
                        <div id="cardDataUkuranSeragam" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Data Ukuran Seragam</div>
                            </div>
                            @includeif('components.icons.report')
                        </div>
                    </li>
                </ul>
                <small class="text-gray-500 dark:text-gray-400">
                    *jika anda mencentang "Sertakan Siswa belum bayar" maka data siswa yang belum bayar akan ditampilkan di laporan
                </small>
            </div>
        </div>
    </div>
</div>
@endif 

@endsection
@section('script')
<script>
    $(document).ready(function() {
        let idJurusan = localStorage.getItem('idJurusan');
        if (idJurusan) {
            setTimeout(function() {
                openTabs(idJurusan);
            }, 100);
        }
        
        $('.pindah-jurusan').on('change', function() {
            let id = $(this).data('id');
            let pindahJurusan = $(this).val();
            let namaSiswa = $('#namaPendaftar'+id).html();
            let namaJurusanDipilih = $(this).find('option:selected').text();
            if (!confirm('apakah anda yakin mengubah jurusan "'+namaSiswa+'"" menjadi "'+namaJurusanDipilih+'"?')) {
                return false;
            }
            $.ajax({
                url: '/cms/pilihan-program-studi/' + id,
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    jurusan_id: pindahJurusan,
                },
                success: function(data) {
                    if (data.status == 'OK') {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
                
            });
        });
    });
    $('.pindah-tab').on('click', function() {
        let id = $(this).attr('id');
        let idJurusan = id.split('-')[1];
        localStorage.setItem('idJurusan', idJurusan);
    });

    function openTabs(idJurusan) {
        let buttonTab = $('#buttonTab' + idJurusan);
        buttonTab.click();
    }
</script>

@if (ManaCms::checkAccess('laporan', 'hak-akses'))
<script>
    // onclick #cardDataLengkap
    $('#cardDataLengkap').click(function() {
        exportExcel('lengkap');
    });

    $('#cardDataCalonSiswa').click(function() {
        exportExcel('calon-siswa');
    });

    $('#cardDataPembayaran').click(function() {
        exportExcel('pembayaran');
    });

    $('#cardDataNamaSiswa').click(function() {
        exportExcel('nama-siswa');
    });

    $('#cardDataAsalSekolah').click(function() {
        exportExcel('asal-sekolah');
    });

    $('#cardDataUkuranSeragam').click(function() {
        exportExcel('ukuran-seragam');
    });

    function exportExcel(type) {
        var tahun_ajaran = $("#tahun_ajaran").val();
        var gelombang = $("#gelombang").val();
        var is_all = $("#withSiswaBelumBayar").is(":checked") ? 1 : 0;

        window.location.href = "/cms/export/" + type + "?tahun_ajaran=" + tahun_ajaran + "&gelombang=" + gelombang + "&is_all=" + is_all;

    }
</script>
@endif
@endsection