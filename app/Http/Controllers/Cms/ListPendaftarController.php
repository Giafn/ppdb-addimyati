<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ListPendaftarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:listPendaftar,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable'
        ]);

        $search = $request->search;

        // $listData  = NominalPendaftaran::select('gelombang', 'nama', 'nominal', 'id', 'keterangan')
        //     ->when(!empty($search), function ($query) use ($search) {
        //         $query->where('nama', 'like', '%' . $search . '%');
        //     })
        //     ->orderBy('gelombang', 'asc')
        //     ->paginate(20);

        // $listData->appends($request->input());

        // $totalData = $listData->total();
        // $firstData = ($listData->currentPage() - 1) * $listData->perPage();
        // $lastData  = ($firstData + $listData->perPage()) > $totalData ? $totalData : ($firstData + $listData->perPage());

        // $paginationData = [
        //     'first' => $firstData,
        //     'last'  => $lastData,
        //     'total' => $totalData,
        //     'prev_page_url' => $listData->previousPageUrl(),
        //     'next_page_url' => $listData->nextPageUrl(),
        // ];

        // return view('cms.master.nominal-administrasi', compact('listData', 'paginationData'));
    }
}
