@extends('cms.layouts.dashboard-admin')
@section('title', 'Pembayaran | ')
@section('content')
    <div id="toast-container" class="fixed top-5 right-5 z-100"></div>
    <div
        class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="mb-4">
                <nav class="flex mb-5" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                        <li class="inline-flex items-center">
                            <a href="#"
                                class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <a href="#"
                                    class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">List
                                    Pendaftar</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">#</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">List Pendaftar</h1>
            </div>
            <form action="#" method="GET">
                <div class="sm-flex mb-2">
                </div>
                <div class="sm:flex flex-wrap">
                    <div class="w-full flex mb-2">
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
                                            {{ $tahun_ajaran }}</option>
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
                                            {{ $gelombang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <input type="text" name="search" id="search"
                                value="{{ app('request')->input('search') }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cari berdasarkan nama, nisn, dan email">
                        </div>
                    </div>
                    <div
                        class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                        <label for="status_pembayaran" class="sr-only">Status Pembayaran</label>
                        <div class="relative mt-1 lg:w-64 xl:w-96">
                            <select name="status_pembayaran" id="status_pembayaran"
                                class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="" selected>Pilih Status Pembayaran</option>
                                @foreach ($fillSelectFilter['status_pembayaran'] as $key => $status_pembayaran)
                                    @if ($key == request()->input('status_pembayaran') && request()->input('status_pembayaran') != null)
                                        <option value="{{ $key }}" selected>{{ $status_pembayaran['text'] }}
                                        </option>
                                    @else
                                        <option value="{{ $key }}">{{ $status_pembayaran['text'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full flex px-2">
                            <button type="submit"
                                class="me-2 inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Cari
                            </button>
                            <a href="/cms/pembayaran"
                                class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 sm:w-auto dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                Reset
                            </a>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    </div>
    <div class="flex flex-col">
        <div class="overflow-x-auto">
            <div class="inline-block min-w-full align-middle">
                <div class="overflow-hidden shadow">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600"  id="dataBayar">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox"
                                            class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Kode Pendaftaran
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Nama Siswa
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Status Pembayaran
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Sisa Pembayaran
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Tanggal Daftar
                                </th>
                                <th scope="col"
                                    class="p-4 text-sm font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @if (count($listData) > 0)
                                @foreach ($listData as $data)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="w-4 p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox"
                                                    class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $data->daftar_kode }}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">{{ $data->nama_siswa }}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <span class="text-sm text-gray-900 dark:text-white">
                                                {{ $listStatusPembayaran[$data->status_pembayaran]['text'] }}
                                            </span>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">
                                                {{ $data->sisa ? 'Rp. ' . number_format($data->sisa, 0, ',', '.') : '-' }}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 dark:text-white">
                                                {{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                                        </td>
                                        <td class="p-4 space-x-2 whitespace-nowrap flex">
                                            <div>
                                                <button type="button" onclick="bayar({{ $data->id }})"
                                                    class="btn btn-primary btn-sm inline-flex items-center">
                                                    Cek
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="">
                                    <td class="p-4 text-center text-gray-900 whitespace-nowrap dark:text-white"
                                        colspan="9">Data tidak ditemukan</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div
        class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
        <div class="flex items-center mb-4 sm:mb-0">
            <a href="{{ $paginationData['prev_page_url'] ?? '#' }}"
                class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <a href="{{ $paginationData['next_page_url'] ?? '#' }}"
                class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span
                    class="font-semibold text-gray-900 dark:text-white">{{ $paginationData['first'] + 1 }}-{{ $paginationData['last'] }}</span>
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginationData['total'] }}</span></span>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ $paginationData['prev_page_url'] ?? '#' }}"
                class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-5 h-5 mr-1 -ml-1"" fill=" currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
                Previous
            </a>
            <a href="{{ $paginationData['next_page_url'] ?? '#' }}"
                class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Next
                <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>

    <div id="bayarModal" tabindex="-1" aria-hidden="true" class="modal">
        <div class="modal-dialog max-w-6xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        Lakukan Pembayaran
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-mana-modal-toggle="bayarModal">
                        @includeif('components.icons.close')
                    </button>
                </div>
                <div class="modal-body">
                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-2">
                            <input type="hidden" id="infoId" name="id">
                            <input type="hidden" id="sisaBayar">
                            <div class="mb-4">
                                <table class="w-full">
                                    <tr>
                                        <td>Nama Siswa</td>
                                        <td>:</td>
                                        <td id="infoNamaSiswa"></td>
                                    </tr>
                                    <tr>
                                        <td>Status Pembayaran</td>
                                        <td>:</td>
                                        <td id="infoStatusPembayaran"></td>
                                    </tr>
                                </table>
                            </div>
                            <div id="haveId">
                                <div class="mb-4">
                                    <label for="totalBayarText"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Yang
                                        Harus Dibayarkan <span class="text-red-500">*</span></label>

                                    <p id="totalBayarText">
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sisa
                                        tunggakan</label>
                                    <p id="sisaTunggakanText">
                                    </p>
                                </div>
                                <div class="mb-4" id="nominalBayarContainer">
                                    <label for="nominalBayar"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nominal
                                        Pembayaran<span class="text-red-500">*</span></label>
                                    <input type="text" name="nominal_bayar" id="nominalBayar"
                                        class="currencyInput shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="Masukan Nominal Bayar Sekarang" required>
                                    <div class="mt-2">
                                        <label for="keterangan"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Masukan Keterangan"></textarea>
                                    </div>
                                    <button type="button" id="bayarBtn"
                                        class="mt-2 btn btn-primary btn-sm inline-flex items-center">
                                        Bayar
                                    </button>
                                </div>
                            </div>

                            <div id="notHaveId">
                                <label for="totalBayar"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harap Masukan
                                    Total Yang Harus di bayarkan terlebih dahulu<span class="text-red-500">*</span></label>
                                <input type="text" name="total" id="totalBayar"
                                    class="currencyInput shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Masukan Total yang harus di bayarkan" required>
                                <button type="button" id="storeTotalBayarBtn"
                                    class="mt-2 btn btn-primary btn-sm inline-flex items-center">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        <div class="col-span-2 max-h-96 overflow-y-auto">
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Riwayat
                                    Pembayaran</label>
                                <div class="overflow-x-auto">
                                    <div class="inline-block min-w-full align-middle">
                                        <div class="overflow-hidden shadow">
                                            <table
                                                class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                                <thead class="bg-gray-100 dark:bg-gray-700">
                                                    <tr>
                                                        <th scope="col"
                                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                            Tanggal Bayar
                                                        </th>
                                                        <th scope="col"
                                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                            Nominal Bayar
                                                        </th>
                                                        <th scope="col"
                                                            class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                            keterangan
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody
                                                    class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
                                                    id="historyBayar">
                                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        <td colspan="3" class="p-4 whitespace-nowrap text-center">
                                                            <div class="text-xs text-gray-900 dark:text-white">Belum ada
                                                                riwayat pembayaran</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer flex justify-end">
                    <button type="button" class="btn btn-secondary btn-sm inline-flex items-center"
                        data-mana-modal-toggle="bayarModal">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function bayar(id) {
            loading(true);

            axios({
                    method: 'get',
                    url: '/cms/pembayaran/' + id
                })
                .then(function(response) {
                    let data = response.data
                    if (data.status == "OK") {
                        drawDetail(data);
                        toggleModal('bayarModal');
                        loading(false)
                    }
                });
        }

        function formatRupiah(angka) {
            angka = parseFloat(angka);
            angka = angka.toLocaleString('id-ID', {
                minimumFractionDigits: 0
            });
            angka = angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            angka = 'Rp. ' + angka;

            return angka;
        }

        $('.currencyInput').on('keyup', function() {
            let value = $(this).val();
            value = value.replace(/\./g, '');
            value = value.replace(/\,/g, '');
            value = value.replace(/\Rp /g, '');
            value = value.replace(/\Rp/g, '');
            value = value.replace(/Rp /g, '');
            value = value.replace(/Rp/g, '');
            value = value.replace(/ /g, '');
            value = value.replace(/[^0-9]/g, '');
            value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            $(this).val(value);
        });

        // bayar
        $('#bayarBtn').on('click', function() {
            if  ($('#keterangan').val() == '') {
                alert('keterangan tidak boleh kosong');
                return false;
            }
            if (!confirm('Yakin bayar, aksi ini tidak dapat di batalkan')) {
                return false;
            }
            let id = $('#infoId').val();
            let nominal_bayar = $('#nominalBayar').val();
            let keterangan = $('#keterangan').val();
            if (!nominal_bayar) {
                alert('nominal tidak boleh kosong');
                return false;
            }
            nominal_bayar = nominal_bayar.split('.').join("");
            maximalBayar = $('#sisaBayar').val();
            if (nominal_bayar > maximalBayar) {
                alert('nominal bayar tidak boleh lebih dari sisa tunggakan');
                return false;
            }
            axios({
                    method: 'post',
                    url: '/cms/pembayaran/' + id,
                    data: {
                        nominal_bayar: nominal_bayar,
                        keterangan: keterangan
                    }
                })
                .then(function(response) {
                    let data = response.data;
                    if (data.status == "OK") {
                        alert('berhasil bayar');
                        drawDetail(data, true);
                        loading(false);
                    }
                });
        });

        // store total bayar
        $('#storeTotalBayarBtn').on('click', function() {
            if (!confirm('Yakin simpan total bayar, total bayar tidak dapat di ubah kembali, harap mengisi dengan benar')) {
                return false;
            }
            let id = $('#infoId').val();
            let total_bayar = $('#totalBayar').val();
            if (!total_bayar) {
                alert('total bayar tidak boleh kosong');
                return false;
            }
            total_bayar = total_bayar.split('.').join("");
            if (total_bayar < 0) {
                alert('total bayar tidak boleh kurang dari 0');
                return false;
            }
            if (total_bayar < 100000) {
                alert('total bayar tidak boleh kurang dari 100.000');
                return false;
            }
            axios({
                    method: 'post',
                    url: '/cms/pembayaran/' + id + '/total',
                    data: {
                        total_bayar: total_bayar
                    }
                })
                .then(function(response) {
                    let data = response.data;
                    if (data.status == "OK") {
                        drawDetail(data, true);
                        loading(false);
                    }
                });
        });

        function drawDetail(data, reload = false) {
            data = data.results;
            $('#infoId').val(data.id);
            $('#infoNamaSiswa').html(data.nama);
            $('#infoStatusPembayaran').html(data.status_pembayaran);
            $('#sisaTunggakanText').text(data.sisa_pembayaran ? formatRupiah(data.sisa_pembayaran, '') :
                '-');
            $('#sisaBayar').val(data.sisa_pembayaran);
            $('#nominalBayar').val('');
            $('#keterangan').val('');
            $('#totalBayarText').text(data.total_pembayaran ? formatRupiah(data.total_pembayaran, '') :
                '-');
            $('#historyBayar').html('');
            if (!data.total_pembayaran) {
                $('#haveId').addClass('hidden');
                $('#notHaveId').removeClass('hidden');
            } else {
                if (data.status_kode == 2) {
                    $('#haveId').removeClass('hidden');
                    $('#notHaveId').addClass('hidden');
                    $('#nominalBayarContainer').addClass('hidden');
                } else {
                    $('#haveId').removeClass('hidden');
                    $('#notHaveId').addClass('hidden');
                }
            }
            if (data.history_pembayaran.length > 0) {
                data.history_pembayaran.forEach(function(item) {
                    $('#historyBayar').append(`
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-900 dark:text-white">
                                                ${item.tgl_bayar}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-900 dark:text-white">
                                                ${formatRupiah(item.jumlah)}
                                            </div>
                                        </td>
                                        <td class="p-4 whitespace-nowrap">
                                            <div class="text-xs text-gray-900 dark:text-white">
                                                ${item.keterangan}
                                            </div>
                                        </td>
                                    </tr>
                                `);
                });
            } else {
                $('#historyBayar').append(`
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td colspan="3" class="p-4 whitespace-nowrap text-center">
                                        <div class="text-xs text-gray-900 dark:text-white">Belum ada riwayat pembayaran</div>
                                    </td>
                                </tr>
                            `);
            }
            if (reload) {
                $( "#dataBayar" ).load(window.location.href + " #dataBayar" );
            }
        }
    </script>
@endsection
