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
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="#" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">List Pendaftar</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
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
                            <option value="">Pilih Gelombang</option>
                            @foreach($fillSelectFilter['list_gelombang'] as $gelombang)
                            <option value="{{ $gelombang }}" {{ $gelombang == request()->input('gelombang') ? 'selected' : '' }}>{{ $gelombang }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                <label for="search" class="sr-only">Search</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <input type="text" name="search" id="search" value="{{ app('request')->input('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cari berdasarkan nama, nisn, dan email">
                </div>
            </div>
            <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700 me-2">
                <label for="status_pembayaran" class="sr-only">Status Pembayaran</label>
                <div class="relative mt-1 lg:w-64 xl:w-96">
                    <select name="status_pembayaran" id="status_pembayaran" class="block w-full py-2.5 px-5 pr-10 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="" selected>Pilih Status Pembayaran</option>
                        @foreach($fillSelectFilter['status_pembayaran'] as $key => $status_pembayaran)
                            @if($key == request()->input('status_pembayaran') && request()->input('status_pembayaran') != null)
                                <option value="{{ $key }}" selected>{{ $status_pembayaran['text'] }}</option>
                            @else
                                <option value="{{ $key }}">{{ $status_pembayaran['text'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="w-full flex px-2">
                    <button type="submit" class="me-2 inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Cari
                    </button>
                    <a href="/cms/list-pendaftar" class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 sm:w-auto dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Reset
                    </a>
                </div>
            </div>
            </form>
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-mana-modal-toggle="tambahModal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Manual Daftar
                </button>
            </div>
        </div>
    </div>
</div>
<div class="flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-all" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Kode Pendaftaran
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Nisn
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Nama Siswa
                            </th>
                            <!-- <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Status data
                            </th> -->
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Status Pembayaran
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Tanggal Daftar
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @if(count($listData) > 0)
                        @foreach($listData as $data)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $data->daftar_kode }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $data->nisn }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $data->nama_siswa }}</div>
                            </td>
                            <!-- <td class="p-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ $listStatusData[$data->status_pendaftaran]['text'] }}
                                </span>
                            </td> -->
                            <td class="p-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900 dark:text-white">
                                    {{ $listStatusPembayaran[$data->status_pembayaran]['text'] }}
                                </span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ date('d-m-Y', strtotime($data->created_at)) }}</div>
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <div>
                                    <button type="button" onclick="show({{ $data->id }})" class="btn btn-primary btn-sm inline-flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="w-4 h-4" fill="currentColor">
                                            <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                        </svg>
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $data->id }})" class="btn btn-danger btn-sm inline-flex items-center">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr class="">
                            <td class="p-4 text-center text-gray-900 whitespace-nowrap dark:text-white" colspan="9">Data tidak ditemukan</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="sticky bottom-0 right-0 items-center w-full p-4 bg-white border-t border-gray-200 sm:flex sm:justify-between dark:bg-gray-800 dark:border-gray-700">
    <div class="flex items-center mb-4 sm:mb-0">
        <a href="{{ $paginationData['prev_page_url'] ?? '#' }}" class="inline-flex justify-center p-1 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <a href="{{ $paginationData['next_page_url'] ?? '#' }}" class="inline-flex justify-center p-1 mr-2 text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $paginationData['first']+1 }}-{{ $paginationData['last'] }}</span> of <span class="font-semibold text-gray-900 dark:text-white">{{ $paginationData['total'] }}</span></span>
    </div>
    <div class="flex items-center space-x-3">
        <a href="{{ $paginationData['prev_page_url'] ?? '#' }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-5 h-5 mr-1 -ml-1"" fill=" currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            Previous
        </a>
        <a href="{{ $paginationData['next_page_url'] ?? '#' }}" class="inline-flex items-center justify-center flex-1 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Next
            <svg class="w-5 h-5 ml-1 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
            </svg>
        </a>
    </div>
</div>

<div id="tambahModal" tabindex="-1" aria-hidden="true" class="modal">
    <div class="modal-dialog modal-2xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    Manual Daftar
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-mana-modal-toggle="tambahModal">
                    @includeif('components.icons.close')
                </button>
            </div>
            <div class="modal-body">
                <form id="formAdd">
                    <div class="">
                        {{ csrf_field() }}
                        <div class="mb-4">
                            <label for=kodePendaftaran" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pendaftaran <span class="text-red-500">*</span></label>
                            <input id="kodePendaftaran" type="text" class="shadow-sm bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Kode Pendaftaran" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="NISN" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NISN <span class="text-red-500">*</span></label>
                            <input type="number" name="nisn" id="NISN" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NISN" required>
                        </div>
                        <div class="mb-4">
                            <label for="namaSiswa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Siswa <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="namaSiswa" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nama Siswa" required>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button" onclick="add()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div id="showModal" class="modal">
    <div class="modal-dialog modal-3xl">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">
                    Detail Data Pendaftar
                </h3>
                <button type="button" id="closeShowModalBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-mana-modal-toggle="showModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <div class="grid grid-cols-1 px-4 pt-6 xl:grid-cols-3 xl:gap-4">
                    <div class="col-span-full xl:col-auto">
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                                <img class="mb-4 rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0" src="https://flowbite-admin-dashboard.vercel.app/images/users/bonnie-green-2x.png" alt="Jese picture">
                                <div>
                                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Foto Pendaftar</h3>
                                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                                        JPG, GIF or PNG. maksimal 200kb
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <label for="file-upload" class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            <span>Upload file</span>
                                        </label>
                                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                        <button type="button" class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <div class="flow-root">
                                <h3 class="text-xl font-semibold dark:text-white">Info Pendaftaran</h3>
                                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg  class="w-5 h-5  dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">Fonticons, Inc. --><path fill="currentColor" d="M181.3 32.4c17.4 2.9 29.2 19.4 26.3 36.8L197.8 128h95.1l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3s29.2 19.4 26.3 36.8L357.8 128H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H347.1L325.8 320H384c17.7 0 32 14.3 32 32s-14.3 32-32 32H315.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8l9.8-58.7H155.1l-11.5 69.3c-2.9 17.4-19.4 29.2-36.8 26.3s-29.2-19.4-26.3-36.8L90.2 384H32c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l21.3-128H64c-17.7 0-32-14.3-32-32s14.3-32 32-32h68.9l11.5-69.3c2.9-17.4 19.4-29.2 36.8-26.3zM187.1 192L165.8 320h95.1l21.3-128H187.1z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Kode Pendaftaran
                                                </span>
                                                <span id="infoKodePPDB" class="block text-sm font-normal truncate text-primary-700 dark:text-white">
                                                    -
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 dark:text-white" xmlns="http://www.w3.org/2000/svg"viewBox="0 0 576 512"><path fill="currentColor" d="M64 64C28.7 64 0 92.7 0 128V384c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128c0-35.3-28.7-64-64-64H64zm48 160H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zM96 336c0-8.8 7.2-16 16-16H464c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16zM376 160h80c13.3 0 24 10.7 24 24v48c0 13.3-10.7 24-24 24H376c-13.3 0-24-10.7-24-24V184c0-13.3 10.7-24 24-24z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Status Pembayaran
                                                </span>
                                                <span id="infoStatusPembayaran" class="block text-sm font-normal truncate text-primary-700 dark:text-white">
                                                    Lunas
                                                </span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5 dark:text-white" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="wa" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Whatsapp / No. HP
                                                </span>
                                                <a href="" id="infoNoTlp" class="block text-sm font-normal truncate text-primary-700 hover:underline dark:text-white">
                                                    081234567890
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <svg class="w-5 h-5  dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"/></svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <span class="block text-base font-semibold text-gray-900 truncate dark:text-white">
                                                    Url untuk edit data
                                                </span>
                                                <a href="#" id="infoUrlEdit" class="block text-sm font-normal truncate text-primary-700 hover:underline dark:text-white">
                                                    https://example.com
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <input type="hidden" id="infoId">
                        <input type="hidden" id="infoAkademikId">
                        <input type="hidden" id="infoSiswaId">
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Pribadi</h3>
                            <form id="formPribadi">
                                <div class="grid grid-cols-6 gap-4">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaNamaLengkap" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="siswaNamaLengkap" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Nama Lengkap" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaNamaPanggilan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Panggilan</label>
                                        <input type="text" name="nama_panggilan" id="siswaNamaPanggilan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Panggilan" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaNik" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIK</label>
                                        <input type="number" name="nik" id="siswaNik" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="320xxxxxxxxxxxxx" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaJk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                                        <select name="jk" id="siswaJk" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="l">Laki-laki</option>
                                            <option value="p">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaNoTlp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor telepon/Whatsapp</label>
                                        <input type="text" name="notlpwa" id="siswaNoTlp" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="089723xxxxxxx" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaTanggalLahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                                        <input type="date" name="taggal_lahir" id="siswaTanggalLahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="15/08/1990" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaTempatLahir" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" id="siswaTempatLahir" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaAgama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama</label>
                                        <input type="text" name="agama" id="siswaAgama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaAnakKe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Anak Ke</label>
                                        <input type="number" name="anak_ke" id="siswaAnakKe" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="anak Ke" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaJmlSaudara" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Saudara Kandung</label>
                                        <input type="number" name="jumlah_saudara" id="siswaJmlSaudara" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="jumlah saudara" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaJmlSaudaraTiri" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Saudara Tiri</label>
                                        <input type="number" name="jumlah_saudara_tiri" id="siswaJmlSaudaraTiri" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="jumlah saudara tiri">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaJmlSaudaraSekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Saudara yang sudah sekolah</label>
                                        <input type="number" name="jumlah_saudara_sekolah" id="siswaJmlSaudaraSekolah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="jumlah saudara yang sudah sekolah">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="siswaJmlSaudaraNoSekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Saudara yang belum sekolah</label>
                                        <input type="number" name="jumlah_saudara_belum_sekolah" id="siswaJmlSaudaraNoSekolah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="jumlah saudara yang belum sekolah">
                                    </div>
                                    <label class="block text-sm font-bold text-gray-900 dark:text-white col-span-6">
                                        <hr class="mb-3">
                                        <span class="text-gray-700 dark:text-gray-400">Alamat Lengkap</span>
                                    </label>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatProvinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                        <input type="text" name="provinsi" id="alamatProvinsi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatKabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                                        <input type="text" name="kabupaten" id="alamatKabupaten" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatKecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                        <input type="text" name="kecamatan" id="alamatKecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatDesa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                                        <input type="text" name="desa" id="alamatDesa" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatJalan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jalan</label>
                                        <input type="text" name="jalan" id="alamatJalan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatGang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gang / Komplek</label>
                                        <input type="text" name="gang" id="alamatGang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <label for="alamatRt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RT</label>
                                        <input type="number" name="rt" id="alamatRt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <label for="alamatRw" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RW</label>
                                        <input type="number" name="rw" id="alamatRw" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatNoRumah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Rumah</label>
                                        <input type="text" name="nomor_rumah" id="alamatNoRumah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="alamatKodePos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                                        <input type="number" name="kode_pos" id="alamatKodePos" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <hr class="col-span-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="pilihanJurusan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilihan Jurusan</label>
                                        <select name="pilihan_jurusan" id="pilihanJurusan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="pilihanJurusan2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilihan Jurusan kedua</label>
                                        <select name="pilihan_jurusan2" id="pilihanJurusan2" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            @foreach ($jurusan as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="ukuranSeragam" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ukuran Seragam</label>
                                        <select name="ukuran_seragam" id="ukuranSeragam" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            <option value="s">S</option>
                                            <option value="m">M</option>
                                            <option value="l">L</option>
                                            <option value="xl">XL</option>
                                            <option value="xxl">XXL</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="tinggiBadan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tinggi Badan</label>
                                        <input type="number" name="tinggi_badan" id="tinggiBadan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="tinggi badan">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="beratBadan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat Badan</label>
                                        <input type="number" name="berat_badan" id="beratBadan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="berat badan">
                                    </div>
                                    {{-- golongan darah --}}
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="golonganDarah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Golongan Darah</label>
                                        <select name="golongan_darah" id="golonganDarah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 w-full block py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                                            <option value="">Pilih</option>
                                            <option value="a-">A-</option>
                                            <option value="b-">B-</option>
                                            <option value="ab-">AB-</option>
                                            <option value="o">O</option>
                                            <option value="a+">A+</option>
                                            <option value="b+">B+</option>
                                            <option value="ab+">AB+</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="penyakitKronis" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Penyakit Kronis</label>
                                        <input type="text" name="penyakit_kronis" id="penyakitKronis" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="prestasi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Prestasi</label>
                                        <input type="text" name="prestasi" id="prestasi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="keahlian" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keahlian</label>
                                        <input type="text" name="keahlian" id="keahlian" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <a onclick="updatePribadi()" class="hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="submit">
                                            Simpan Data Pribadi
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Akademik</h3>
                            <form id="formAkademik">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nisn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NISN</label>
                                        <input type="number" name="nisn" id="nisn" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="NISN" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="asalSekolah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Asal Sekolah</label>
                                        <input type="text" name="asal_sekolah" id="asalSekolah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Asal Sekolah" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="nomorSeriSttb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Seri STTB</label>
                                        <input type="text" name="nomor_seri_sttb" id="nomorSeriSttb" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nomor Seri STTB" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="tahunSttb" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun STTB</label>
                                        <input type="number" name="tahun_sttb" id="tahunSttb" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tahun STTB" required>
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <a class="hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="updateAkademik()">
                                            Simpan Data Akademik
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Orang Tua</h3>
                            <form id="formOrtu">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="namaAyah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ayah</label>
                                        <input type="text" name="nama_ayah" id="namaAyah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="pekerjaanAyah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan Ayah</label>
                                        <input type="text" name="pekerjaan_ayah" id="pekerjaanAyah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="pendidikanAyah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan Ayah</label>
                                        <select name="pendidikan_ayah" id="pendidikanAyah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="sd">SD</option>
                                            <option value="smp">SMP</option>
                                            <option value="sma">SMA</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="namaIbu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Ibu</label>
                                        <input type="text" name="nama_ibu" id="namaIbu" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="pekerjaanIbu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan Ibu</label>
                                        <input type="text" name="pekerjaan_ibu" id="pekerjaanIbu" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="pendidikanIbu" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan Ibu</label>
                                        <select name="pendidikan_ibu" id="pendidikanIbu" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="sd">SD</option>
                                            <option value="smp">SMP</option>
                                            <option value="sma">SMA</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <a class="hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="updateOrangTua()">
                                            Simpan Data Orang Tua
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
                            <h3 class="mb-4 text-xl font-semibold dark:text-white">Informasi Wali</h3>
                            <form id="formWali">
                                <div class="grid grid-cols-6 gap-4">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="namaWali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Wali</label>
                                        <input type="text" name="nama_wali" id="namaWali" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="pekerjaanWali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan Wali</label>
                                        <input type="text" name="pekerjaan_wali" id="pekerjaanWali" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="pendidikanWali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pendidikan Wali</label>
                                        <select name="pendidikan_wali" id="pendidikanWali" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 px-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="sd">SD</option>
                                            <option value="smp">SMP</option>
                                            <option value="sma">SMA</option>
                                            <option value="s1">S1</option>
                                            <option value="s2">S2</option>
                                            <option value="s3">S3</option>
                                        </select>
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="tanggunganWali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggungan Wali</label>
                                        <input type="number" name="tanggungan_wali" id="tanggunganWali" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="tanggungan wali">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="agamaWali" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agama Wali</label>
                                        <input type="text" name="agama_wali" id="agamaWali" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    <label class="block text-sm font-bold text-gray-900 dark:text-white col-span-6">
                                        <hr class="mb-3">
                                        <span class="text-gray-700 dark:text-gray-400">Alamat Wali</span>
                                    </label>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatWaliProvinsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi</label>
                                        <input type="text" name="provinsi_wali" id="alamatWaliProvinsi" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatWaliKabupaten" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kabupaten</label>
                                        <input type="text" name="kabupaten_wali" id="alamatWaliKabupaten" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatWaliKecamatan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                        <input type="text" name="kecamatan_wali" id="alamatWaliKecamatan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="alamatWaliDesa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                                        <input type="text" name="desa_wali" id="alamatWaliDesa" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatWaliJalan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jalan</label>
                                        <input type="text" name="jalan_wali" id="alamatWaliJalan" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatWaliGang" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gang / Komplek</label>
                                        <input type="text" name="gang_wali" id="alamatWaliGang" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <label for="alamatWaliRt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RT</label>
                                        <input type="number" name="rt_wali" id="alamatWaliRt" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-1">
                                        <label for="alamatWaliRw" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RW</label>
                                        <input type="number" name="rw_wali" id="alamatWaliRw" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-2">
                                        <label for="alamatWaliNoRumah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Rumah</label>
                                        <input type="text" name="nomor_rumah_wali" id="alamatWaliNoRumah" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <label for="alamatWaliKodePos" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                                        <input type="number" name="kode_pos_wali" id="alamatWaliKodePos" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full block p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="col-span-6 sm:col-full">
                                        <a class="hover:cursor-pointer text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" onclick="updateWali()">
                                            Save Data Wali
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="deleteModal">
    <div class="modal-dialog modal-popup">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeDeleteModal()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Apakah Anda yakin ingin menghapus item ini?</h3>
                <button type="button" id="buttonDelete" data-id="" onclick="deleteAction()" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                    Ya, Hapus
                </button>
                <a href="#" class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700" onclick="closeDeleteModal()">
                    Batalkan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#NISN").keyup(function() {
        console.log($(this).val());
        var nisn = $(this).val();
        var kodePendaftaran = "PPDB-" + nisn;
        $("#kodePendaftaran").val(kodePendaftaran);
    });

    // if press esc key close modal
    $(document).keyup(function(e) {
        if (e.key === "Escape") {
            $("#closeShowModalBtn").click();
        }
    });

    function add() {
        var form = document.forms["formAdd"];

        var formData = new FormData(form);
        var formDataObj = new Object;
        formData.forEach((value, key) => (formDataObj[key] = value));

        loading(true)
        axios({
                method: 'post',
                url: '/cms/list-pendaftar',
                data: formDataObj
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    location.reload();
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    let message = error.response.data.message;
                    let errors = error.response.data.errors;
                    let alertMessage = message;

                    for (var key in errors) {
                        alertMessage = alertMessage + "\n- " + errors[key]
                    }

                    alert(alertMessage)
                } else {
                    alert("Unknown Error")
                }
            });
    }

    function show(id) {
        resetForm();
        loading(true);

        axios({
                method: 'get',
                url: '/cms/list-pendaftar/' + id
            })
            .then(function(response) {
                let data = response.data;
                if (data.status == "OK") {
                    filldataShow(data.results);
                    toggleModal('showModal');
                    loading(false)
                }
            });
    }

    function resetForm() {
        // set value '' for all input
        $("#formPribadi input").val('');
        $("#formPribadi select").val('');
        $("#formPribadi textarea").val('');
        $("#formAkademik input").val('');
        $("#formAkademik select").val('');
        $("#formAkademik textarea").val('');
        $("#formOrtu input").val('');
        $("#formOrtu select").val('');
        $("#formOrtu textarea").val('');
        $("#formWali input").val('');
        $("#formWali select").val('');
        $("#formWali textarea").val('');
    }

    function filldataShow(data) {
        $(".validation-error").remove();
        $("#infoKodePPDB").html(data.pendaftaran.kode);
        $("#infoStatusPembayaran").html(data.pendaftaran.status_pembayaran == 2 ? "Lunas" : (data.pendaftaran.status_pembayaran == 1 ? "Belum Lunas" : "Belum Bayar"));
        $("#infoNoTlp").html(data.calonSiswa.telepon);
        var noTlp = data.calonSiswa.telepon;
        if (noTlp.charAt(0) != 0) {
            noTlp = "62" + noTlp;
        } else if (noTlp.charAt(0) != 62) {
            noTlp = "62" + noTlp.substr(1);
        }
        $("#infoNoTlp").attr("href", "https://wa.me/"+noTlp).attr("target", "_blank");

        // id
        $("#infoId").val(data.pendaftaran.id);
        $("#infoAkademikId").val(data.akademik.id);
        $("#infoSiswaId").val(data.calonSiswa.id);

        // informasi Pribadi
        $("#siswaNamaLengkap").val(data.calonSiswa.nama_lengkap);
        $("#siswaNamaPanggilan").val(data.calonSiswa.nama_panggilan);
        $("#siswaNik").val(data.calonSiswa.nik);
        $('#siswaJk').val(data.calonSiswa.jenis_kelamin);
        $("#siswaNoTlp").val(data.calonSiswa.telepon);
        $("#siswaTanggalLahir").val(data.calonSiswa.tanggal_lahir);
        $("#siswaTempatLahir").val(data.calonSiswa.tempat_lahir);
        $("#siswaAgama").val(data.calonSiswa.agama);
        $("#siswaAnakKe").val(data.calonSiswa.anak_ke);
        $("#siswaJmlSaudara").val(data.calonSiswa.jml_saudara_kandung);
        $("#siswaJmlSaudaraTiri").val(data.calonSiswa.jml_saudara_tiri);
        $("#siswaJmlSaudaraSekolah").val(data.calonSiswa.jml_saudara_sekolah);
        $("#siswaJmlSaudaraNoSekolah").val(data.calonSiswa.jml_saudara_no_sekolah);

        $("#alamatProvinsi").val(data.alamat.provinsi);
        $("#alamatKabupaten").val(data.alamat.kota);
        $("#alamatKecamatan").val(data.alamat.kecamatan);
        $("#alamatDesa").val(data.alamat.desa);
        $("#alamatJalan").val(data.alamat.jalan);
        $("#alamatGang").val(data.alamat.gang);
        $("#alamatRt").val(data.alamat.rt);
        $("#alamatRw").val(data.alamat.rw);
        $("#alamatNoRumah").val(data.alamat.no_rumah);
        $("#alamatKodePos").val(data.alamat.kode_pos);

        $("#pilihanJurusan").val(data.pendaftaran.jurusan_id1);
        $("#pilihanJurusan2").val(data.pendaftaran.jurusan_id2);

        $("#ukuranSeragam").val(data.calonSiswa.ukuran_seragam);
        $("#tinggiBadan").val(data.calonSiswa.tinggi_badan);
        $("#beratBadan").val(data.calonSiswa.berat_badan);
        $("#golonganDarah").val(data.calonSiswa.golongan_darah);
        $("#penyakitKronis").val(data.calonSiswa.penyakit_kronis);
        $("#prestasi").val(data.calonSiswa.prestasi);
        $("#keahlian").val(data.calonSiswa.keahlian);

        // informasi Akademik
        $("#nisn").val(data.akademik.nisn);
        $("#asalSekolah").val(data.akademik.asal_sekolah);
        $("#nomorSeriSttb").val(data.akademik.nomor_seri_sttb);
        $("#tahunSttb").val(data.akademik.tahun_sttb);

        // informasi Orang Tua
        $("#namaAyah").val(data.orangTuaWali.ayah.nama_lengkap);
        $("#pekerjaanAyah").val(data.orangTuaWali.ayah.pekerjaan);
        $("#pendidikanAyah").val(data.orangTuaWali.ayah.pendidikan_terakhir);

        $("#namaIbu").val(data.orangTuaWali.ibu.nama_lengkap);
        $("#pekerjaanIbu").val(data.orangTuaWali.ibu.pekerjaan);
        $("#pendidikanIbu").val(data.orangTuaWali.ibu.pendidikan_terakhir);

        // informasi Wali
        if (data.orangTuaWali.wali != null) {
            $("#namaWali").val(data.orangTuaWali.wali.nama_lengkap);
            $("#pekerjaanWali").val(data.orangTuaWali.wali.pekerjaan);
            $("#pendidikanWali").val(data.orangTuaWali.wali.pendidikan_terakhir);
            $("#tanggunganWali").val(data.orangTuaWali.wali.tanggungan);
            $("#agamaWali").val(data.orangTuaWali.wali.agama);
            
            $("#alamatWaliProvinsi").val(data.orangTuaWali.wali.provinsi);
            $("#alamatWaliKabupaten").val(data.orangTuaWali.wali.kota);
            $("#alamatWaliKecamatan").val(data.orangTuaWali.wali.kecamatan);
            $("#alamatWaliDesa").val(data.orangTuaWali.wali.desa);
            $("#alamatWaliJalan").val(data.orangTuaWali.wali.jalan);
            $("#alamatWaliGang").val(data.orangTuaWali.wali.gang);
            $("#alamatWaliRt").val(data.orangTuaWali.wali.rt);
            $("#alamatWaliRw").val(data.orangTuaWali.wali.rw);
            $("#alamatWaliNoRumah").val(data.orangTuaWali.wali.no_rumah);
            $("#alamatWaliKodePos").val(data.orangTuaWali.wali.kode_pos);
        }
    }

    function deleteModal(id) {
        document.getElementById("buttonDelete").setAttribute('data-id', id);

        toggleModal("deleteModal");

        return false;
    }

    function deleteAction() {
        var id = document.getElementById("buttonDelete").getAttribute('data-id');

        loading(true)
        axios({
                method: 'delete',
                url: '/cms/list-pendaftar/' + id,
                data: {
                    _token: "{{ csrf_token() }}"
                }
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    location.reload();
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    let message = error.response.data.message;
                    let errors = error.response.data.errors;
                    let alertMessage = message;

                    for (var key in errors) {
                        alertMessage = alertMessage + "\n- " + errors[key]
                    }

                    alert(alertMessage)
                } else {
                    alert("Unknown Error")
                }
            });
    }

    function closeDeleteModal() {
        // remove show
        $("#deleteModal").removeClass("show");
        $("#deleteModal").addClass("hidden");
        // remove class modal-backdrop
        $("body").removeClass("modal-open");
        $("body").find(".modal-backdrop").remove();
        // remove overflow hidden class
        $("body").removeClass("overflow-hidden");
    }

    function updatePribadi() {
        var form = document.forms["formPribadi"];

        var formData = new FormData(form);
        // id 
        var id = $("#infoId").val();
        var formDataObj = new Object;
        formData.forEach((value, key) => (formDataObj[key] = value));

        loading(true)
        axios({
                method: 'PATCH',
                url: '/cms/list-pendaftar/update/profile/' + id,
                data: formDataObj
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    gtoast.showToast('Berhasil update data', 'success', 5000);
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    gtoast.showToast('Gagal update data', 'error', 5000);
                    $("#formPribadi").find(".validation-error").remove();
                    let errors = error.response.data.errors;

                    var elementForm ="";
                    for (var key in errors) {
                        elementForm = $("#formPribadi").find("[name='" + key + "']");
                        if (!elementForm.parent().find(".validation-error").length) {
                            elementForm.after('<span class="validation-error text-red-500 text-sm mt-1">'+errors[key]+'</span>');
                        } else {
                            elementForm.parent().find(".validation-error").html(errors[key]);
                        }
                    }
                } else {
                    alert("Unknown Error")
                }
            });
        loading(false)
    }

    function updateAkademik() {
        var form = document.forms["formAkademik"];

        var formData = new FormData(form);
        // id 
        var id = $("#infoAkademikId").val();
        var formDataObj = new Object;
        formData.forEach((value, key) => (formDataObj[key] = value));
        console.log(formDataObj);

        loading(true)
        axios({
                method: 'PATCH',
                url: '/cms/list-pendaftar/update/akademik/' + id,
                data: formDataObj
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    $("#formAkademik").find(".validation-error").remove();
                    gtoast.showToast('Berhasil update data', 'success', 5000);
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    gtoast.showToast('Gagal update data', 'error', 5000);
                    let errors = error.response.data.errors;

                    var elementForm ="";
                    for (var key in errors) {
                        elementForm = $("#formAkademik").find("[name='" + key + "']");
                        if (!elementForm.parent().find(".validation-error").length) {
                            elementForm.after('<span class="validation-error text-red-500 text-sm mt-1">'+errors[key]+'</span>');
                        } else {
                            elementForm.parent().find(".validation-error").html(errors[key]);
                        }
                    }
                } else {
                    alert("Unknown Error")
                }
            });
        loading(false)
    }

    function updateOrangTua() {
        var form = document.forms["formOrtu"];

        var formData = new FormData(form);
        // id 
        var id = $("#infoSiswaId").val();
        var formDataObj = new Object;
        formData.forEach((value, key) => (formDataObj[key] = value));
        console.log(formDataObj);

        loading(true)
        axios({
                method: 'PATCH',
                url: '/cms/list-pendaftar/update/ortu/' + id,
                data: formDataObj
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    $("#formOrtu").find(".validation-error").remove();
                    gtoast.showToast('Berhasil update data', 'success', 5000);
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    gtoast.showToast('Gagal update data', 'error', 5000);
                    let errors = error.response.data.errors;

                    var elementForm ="";
                    for (var key in errors) {
                        elementForm = $("#formOrtu").find("[name='" + key + "']");
                        if (!elementForm.parent().find(".validation-error").length) {
                            elementForm.after('<span class="validation-error text-red-500 text-sm mt-1">'+errors[key]+'</span>');
                        } else {
                            elementForm.parent().find(".validation-error").html(errors[key]);
                        }
                    }
                } else {
                    alert("Unknown Error")
                }
            });
        loading(false)
    }

    function updateWali() {
        var form = document.forms["formWali"];

        var formData = new FormData(form);
        // id 
        var id = $("#infoSiswaId").val();
        var formDataObj = new Object;
        formData.forEach((value, key) => (formDataObj[key] = value));
        console.log(formDataObj);

        loading(true)
        axios({
                method: 'PATCH',
                url: '/cms/list-pendaftar/update/wali/' + id,
                data: formDataObj
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    $("#formWali").find(".validation-error").remove();
                    gtoast.showToast('Berhasil update data', 'success', 5000);
                }
            })
            .catch(function(error) {
                loading(false)
                if (error.response) {
                    gtoast.showToast('Gagal update data', 'error', 5000);
                    let errors = error.response.data.errors;
                    
                    var elementForm ="";
                    for (var key in errors) {
                        elementForm = $("#formWali").find("[name='" + key + "']");
                        if (!elementForm.parent().find(".validation-error").length) {
                            elementForm.after('<span class="validation-error text-red-500 text-sm mt-1">'+errors[key]+'</span>');
                        } else {
                            elementForm.parent().find(".validation-error").html(errors[key]);
                        }
                    }
                } else {
                    alert("Unknown Error")
                }
            });
        loading(false)
    }
</script>
@endsection