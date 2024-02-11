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
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 576 512">
                                    <path d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zM272 192H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16s7.2-16 16-16zM256 304c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H272c-8.8 0-16-7.2-16-16zM164 152v13.9c7.5 1.2 14.6 2.9 21.1 4.7c10.7 2.8 17 13.8 14.2 24.5s-13.8 17-24.5 14.2c-11-2.9-21.6-5-31.2-5.2c-7.9-.1-16 1.8-21.5 5c-4.8 2.8-6.2 5.6-6.2 9.3c0 1.8 .1 3.5 5.3 6.7c6.3 3.8 15.5 6.7 28.3 10.5l.7 .2c11.2 3.4 25.6 7.7 37.1 15c12.9 8.1 24.3 21.3 24.6 41.6c.3 20.9-10.5 36.1-24.8 45c-7.2 4.5-15.2 7.3-23.2 9V360c0 11-9 20-20 20s-20-9-20-20V345.4c-10.3-2.2-20-5.5-28.2-8.4l0 0 0 0c-2.1-.7-4.1-1.4-6.1-2.1c-10.5-3.5-16.1-14.8-12.6-25.3s14.8-16.1 25.3-12.6c2.5 .8 4.9 1.7 7.2 2.4c13.6 4.6 24 8.1 35.1 8.5c8.6 .3 16.5-1.6 21.4-4.7c4.1-2.5 6-5.5 5.9-10.5c0-2.9-.8-5-5.9-8.2c-6.3-4-15.4-6.9-28-10.7l-1.7-.5c-10.9-3.3-24.6-7.4-35.6-14c-12.7-7.7-24.6-20.5-24.7-40.7c-.1-21.1 11.8-35.7 25.8-43.9c6.9-4.1 14.5-6.8 22.2-8.5V152c0-11 9-20 20-20s20 9 20 20z"/>
                                </svg>
                                Pembayaran
                            </a>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">List Pembayaran</h1>
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
                                    <option value="">Semua Gelombang</option>
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
                                placeholder="Cari berdasarkan nama. dan nisn">
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
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                @if (ManaCms::checkAccess('laporan', 'hak-akses'))
                <button type="button"  data-modal-target="modal-export" data-modal-toggle="modal-export" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 sm:w-auto dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM216 232V334.1l31-31c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-72 72c-9.4 9.4-24.6 9.4-33.9 0l-72-72c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l31 31V232c0-13.3 10.7-24 24-24s24 10.7 24 24z"/></svg>
                    Export Data
                </button>
                @endif
            </div>
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
                                                    Lakukan Pembayaran
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
                                <table class="w-full dark:text-white">
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

                                    <div class="flex gap-2 items-center">
                                        <p id="totalBayarText" class="dark:text-white">
                                        </p>
                                        <a id="editTotalBayarBtn" class="cursor-pointer text-blue-500 hover:text-blue-700">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sisa
                                        tunggakan</label>
                                    <p id="sisaTunggakanText" class="dark:text-white">
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
                                <form id="setTotalBayar">
                                    <div class="mb-4">
                                        <label for="jenisPembayaran"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                            Pembayaran<span class="text-red-500">*</span></label>
                                        <select name="jenis_pembayaran" id="jenisPembayaran"
                                            class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="">Pilih Jenis Pembayaran</option>
                                            <option value="0">Normal (Rp. {{ number_format($hargaNormal, 0, ',', '.') }})</option>
                                            @foreach ($listKeringanan as $keringanan)
                                                <option value="{{ $keringanan->id }}">
                                                    {{ $keringanan->nama }} (Rp. {{ number_format($keringanan->total, 0, ',', '.') }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" id="storeTotalBayarBtn"
                                        class="mt-2 btn btn-primary btn-sm inline-flex items-center">
                                        Simpan
                                    </button>
                                    {{-- batal --}}
                                    <a id="batalTotalBayarBtn"
                                        class="mt-2 btn btn-secondary btn-sm inline-flex items-center cursor-pointer hidden">
                                        Batal
                                    </a>
                                </form>
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
                            <div id="cardDataPembayaran" class="inline-flex items-center justify-between w-full p-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-500 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-900 hover:bg-gray-100 dark:text-white dark:bg-gray-600 dark:hover:bg-gray-500">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Data pembayaran</div>
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
            let id = $('#infoId').val();
            let nominal_bayar = $('#nominalBayar').val();
            let keterangan = $('#keterangan').val();
            if (!nominal_bayar) {
                if ($('#errorNominal').length) {
                    $('#errorNominal').remove();
                }
                let errorElement = `<p class="text-red-500 text-xs mt-1" id="errorNominal">Nominal bayar tidak boleh kosong</p>`;
                $('#nominalBayar').addClass('border-red border-2');
                $('#nominalBayar').after(errorElement);

                return false;
            }

            nominal_bayar = nominal_bayar.split('.').join("");
            maximalBayar = $('#sisaBayar').val();

            console.log(nominal_bayar, maximalBayar);
            if (parseInt(nominal_bayar) > parseInt(maximalBayar)) {
                if ($('#errorNominal').length) {
                    $('#errorNominal').remove();
                }
                let errorElement = `<p class="text-red-500 text-xs mt-1" id="errorNominal">Nominal bayar tidak boleh melebihi sisa pembayaran</p>`;
                $('#nominalBayar').addClass('border-red border-2');
                $('#nominalBayar').after(errorElement);
                return false;
            }

            $('#nominalBayar').removeClass('border-red border-2');
            $('#errorNominal').remove();

            if  ($('#keterangan').val() == '') {
                if ($('#errorKeterangan').length) {
                    $('#errorKeterangan').remove();
                }
                let errorElement = `<p class="text-red-500 text-xs mt-1" id="errorKeterangan">Keterangan tidak boleh kosong</p>`;
                $('#keterangan').addClass('border-red border-2');
                $('#keterangan').after(errorElement);

                return false;
            }

            $('#keterangan').removeClass('border-red border-2');
            $('#errorKeterangan').remove();

            if (!confirm('Yakin bayar, aksi ini tidak dapat di batalkan')) {
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
                    } else {
                        alert(data.message);
                        loading(false);
                    }
                });
        });

        // store total bayar
        $('#setTotalBayar').on('submit', function(e) {
            e.preventDefault();
            if (!confirm('Yakin simpan, aksi ini tidak dapat di batalkan')) {
                return false;
            }
            let id = $('#infoId').val();
            let jenis_pembayaran = $('#jenisPembayaran').val();
            if (!jenis_pembayaran) {
                alert('jenis pembayaran tidak boleh kosong');
                return false;
            }

            axios({
                    method: 'post',
                    url: '/cms/pembayaran/' + id + '/total',
                    data: {
                        jenis_pembayaran: jenis_pembayaran
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

        // edit total bayar
        $('#editTotalBayarBtn').on('click', function() {
            $('#haveId').addClass('hidden');
            $('#notHaveId').removeClass('hidden');
        });

        function drawDetail(data, reload = false) {
            data = data.results;

            console.log(data);
            $('#jenisPembayaran').val('');
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
                $('#batalTotalBayarBtn').addClass('hidden');
            } else {
                if (data.status_kode == 2) {
                    $('#haveId').removeClass('hidden');
                    $('#notHaveId').addClass('hidden');
                    $('#nominalBayarContainer').addClass('hidden');
                    $('#bayarBtn').addClass('hidden');
                    $('#editTotalBayarBtn').addClass('hidden');
                } else {
                    $('#haveId').removeClass('hidden');
                    $('#notHaveId').addClass('hidden');

                    $('#jenisPembayaran').val(data.keringanan ? data.keringanan : 0);
                    $('#batalTotalBayarBtn').removeClass('hidden');
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

        $('#batalTotalBayarBtn').on('click', function() {
            $('#haveId').removeClass('hidden');
            $('#notHaveId').addClass('hidden');
        });
    </script>
    @if (ManaCms::checkAccess('laporan', 'hak-akses'))
    <script>
        $('#cardDataPembayaran').click(function() {
            exportExcel('pembayaran');
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
