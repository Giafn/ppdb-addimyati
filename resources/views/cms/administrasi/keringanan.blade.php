@extends('cms.layouts.dashboard-admin')
@section('title', 'Keringanan | ')
@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 384 512">
                                <path d="M14 2.2C22.5-1.7 32.5-.3 39.6 5.8L80 40.4 120.4 5.8c9-7.7 22.3-7.7 31.2 0L192 40.4 232.4 5.8c9-7.7 22.3-7.7 31.2 0L304 40.4 344.4 5.8c7.1-6.1 17.1-7.5 25.6-3.6s14 12.4 14 21.8V488c0 9.4-5.5 17.9-14 21.8s-18.5 2.5-25.6-3.6L304 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L192 471.6l-40.4 34.6c-9 7.7-22.3 7.7-31.2 0L80 471.6 39.6 506.2c-7.1 6.1-17.1 7.5-25.6 3.6S0 497.4 0 488V24C0 14.6 5.5 6.1 14 2.2zM96 144c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96zM80 352c0 8.8 7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96c-8.8 0-16 7.2-16 16zM96 240c-8.8 0-16 7.2-16 16s7.2 16 16 16H288c8.8 0 16-7.2 16-16s-7.2-16-16-16H96z"/>
                            </svg>
                            Adminnistrasi
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="#" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Keringanan</a>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Pengaturan Keringanan pembayaran</h1>
        </div>
        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <button type="button" data-mana-modal-toggle="tambahModal" class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                    Tambah
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
                                Nama
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Total Bayar
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Detail
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        @forelse($listData as $data)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-1" aria-describedby="checkbox-1" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">{{ $data->nama }}</div>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-white">Rp. {{ number_format($data->total, 0, ',', '.') }}</div>
                            </td>
                            <td class="p-4">
                                <div class="text-sm text-gray-900 dark:text-white">
                                    <ul>
                                        @foreach($data->detailKeringanan as $detail)
                                        <li>{{ $detail->item->nama }} (Rp. {{ number_format($detail->nominal, 0, ',', '.') }})</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td class="p-4 space-x-2 whitespace-nowrap">
                                <div>
                                    <button type="button" onclick="edit({{ $data->id }})" class="btn btn-warning btn-sm inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                                        </svg>
                                        Edit
                                    </button>
                                    <button type="button" onclick="deleteModal({{ $data->id }})" class="btn btn-danger btn-sm inline-flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="mt-2 text-sm text-gray-500 dark:text-gray-400">Data tidak tersedia</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<form id="formAdd">
<div id="tambahModal" tabindex="-1" aria-hidden="true" class="modal">
    <div class="modal-dialog modal-2xl">
        <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">
                        Tambah Keringanan
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-mana-modal-toggle="tambahModal">
                        @includeif('components.icons.close')
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        {{ csrf_field() }}
                        <div class="mb-2">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Keringanan <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nama" required>
                        </div>
                        @foreach($listItem as $item)
                        <div class="mb-2">
                            <label for="item-{{ $item->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama }} <span class="text-red-500">*</span></label>
                            <input type="text" name="item[{{ $item->id }}]" id="item-{{ $item->id }}" class="nominalFormat shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rp. {{ number_format($item->nominal, 0, ',', '.') }}" required>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>


<form id="formEdit">
<div id="editModal" class="modal">
    <div class="modal-dialog modal-2xl">
        <!-- Modal content -->
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <h3 class="modal-title">
                    Edit Keringanan
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" data-mana-modal-toggle="editModal">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                    <div class="">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-2">
                            <label for="editNama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Keringanan <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="editNama" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="nama" required>
                        </div>
                        @foreach($listItem as $item)
                        <div class="mb-2">
                            <label for="editItem-{{ $item->id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $item->nama }} <span class="text-red-500">*</span></label>
                            <input type="text" name="item[{{ $item->id }}]" id="editItem-{{ $item->id }}" class="nominalFormat shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Rp. {{ number_format($item->nominal, 0, ',', '.') }}" required>
                        </div>
                        @endforeach
                    </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Simpan</button>
            </div>
        </div>
    </div>
</div>
</form>

<div class="modal" id="deleteModal">
    <div class="modal-dialog modal-popup">
        <!-- Modal content -->
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white" onclick="closeDeleteModal()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
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
    $('#formAdd').submit(function(e) {
        e.preventDefault();
        let data = {
            "nama" : $('#nama').val(),
            "data" : [
                @foreach($listItem as $item)
                {
                    "id" : {{ $item->id }},
                    "nominal" : $('#item-{{ $item->id }}').val()
                },
                @endforeach
            ]
        }
        loading(true)
        axios({
                method: 'post',
                url: '/cms/administrasi/keringanan',
                data: data
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
    });

    function edit(id) {
        loading(true);

        axios({
                method: 'get',
                url: '/cms/administrasi/keringanan/' + id,
            })
            .then(function(response) {
                if (response.data.status == "OK") {
                    let data = response.data.results;
                    $('#editId').val(data.id);
                    $('#editNama').val(data.nama);
                    let item = data.detail_keringanan;
                    for (var key in item) {
                        $('#editItem-' + item[key].item_id).val(item[key].nominal);
                        $('#editItem-' + item[key].item_id).trigger('keyup');
                    }
                    toggleModal('editModal');

                    loading(false)
                }
            });
    }

    $('#formEdit').submit(function(e) {
        e.preventDefault();

        let data = {
            "id"   : $('#editId').val(),
            "nama" : $('#editNama').val(),
            "data" : [
                @foreach($listItem as $item)
                {
                    "id" : {{ $item->id }},
                    "nominal" : $('#editItem-{{ $item->id }}').val()
                },
                @endforeach
            ]
        }

        loading(true)
        axios({
                method: 'post',
                url: '/cms/administrasi/keringanan',
                data: data
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
    });

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
                url: '/cms/administrasi/keringanan/' + id,
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
</script>
@endsection