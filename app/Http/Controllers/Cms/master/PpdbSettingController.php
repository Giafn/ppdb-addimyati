<?php

namespace App\Http\Controllers\Cms\master;

use App\Http\Controllers\Controller;
use App\Models\Ppdb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PpdbSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:ppdb,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable'
        ]);

        $search = $request->search;

        $listData  = PpDB::select('start_date', 'end_date', 'tahun_ajaran', 'gelombang', 'id')
            ->addSelect(DB::raw("IF(now() between start_date and end_date, 'open', 'close') as status_waktu"))
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('tahun_ajaran', 'like', '%' . $search . '%');
            })
            ->orderBy('start_date', 'desc')
            ->orderBy('tahun_ajaran', 'desc')
            ->paginate(20);

        $listData->appends($request->input());

        $totalData = $listData->total();
        $firstData = ($listData->currentPage() - 1) * $listData->perPage();
        $lastData  = ($firstData + $listData->perPage()) > $totalData ? $totalData : ($firstData + $listData->perPage());

        $paginationData = [
            'first' => $firstData,
            'last'  => $lastData,
            'total' => $totalData,
            'prev_page_url' => $listData->previousPageUrl(),
            'next_page_url' => $listData->nextPageUrl(),
        ];

        return view('cms.master.ppdb-setting', compact('listData', 'paginationData'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahunAjaran'       => 'required|string',
            'gelombang'      => 'required|numeric',
            'start_date'   => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        // validasi format tahun ajaran = 2020/2021
        if (!preg_match('/^[0-9]{4}\/[0-9]{4}$/', $request->tahunAjaran)) {
            return response()->json([
                'message' => "Format tahun ajaran tidak sesuai gunakan format YYYY/YYYY"
            ], 422);
        }

        $ppdb = Ppdb::where('tahun_ajaran', $request->tahunAjaran)->where('gelombang', $request->gelombang)->first();
        if ($ppdb) {
            return response()->json([
                'message' => "PPDB dengan tahun ajaran " . $request->tahunAjaran . " dan gelombang " . $request->gelombang . " sudah ada"
            ], 422);
        }

        $ppdbEndDateLast = Ppdb::select('end_date')->orderBy('end_date', 'desc')->first();
        if ($ppdbEndDateLast && $request->start_date < $ppdbEndDateLast->end_date) {
            return response()->json([
                'message' => "Format tanggal tidak sesuai, pastikan tanggal dibuka tidak kurang dari tanggal tutup ppdb sebelumnya"
            ], 422);
        }

        $tahunAjaran = $request->tahunAjaran;
        $gelombang = $request->gelombang;
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));
        if ($startDate < date('Y-m-d') || $endDate < $startDate) {
            return response()->json([
                'message' => "Format tanggal tidak sesuai, pastikan tanggal dibuka tidak kurang dari sekarang dan tanggal tutup tidak kurang dari tanggal dibuka"
            ], 422);
        }

        try {
            $ppdb = new Ppdb();
            $ppdb->tahun_ajaran = $tahunAjaran;
            $ppdb->gelombang = $gelombang;
            $ppdb->start_date = $startDate;
            $ppdb->end_date = $endDate;
            $ppdb->status = 0;
            $ppdb->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Database Error",
                'debug'   => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function detail($id)
    {
        $data = Ppdb::find($id);

        if (!$data) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => "OK",
            'results'   => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tahunAjaran'       => 'required|string',
            'gelombang'      => 'required|numeric',
            'start_date'   => 'required',
            'end_date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        // validasi format tahun ajaran = 2020/2021
        if (!preg_match('/^[0-9]{4}\/[0-9]{4}$/', $request->tahunAjaran)) {
            return response()->json([
                'message' => "Format tahun ajaran tidak sesuai gunakan format YYYY/YYYY"
            ], 422);
        }

        $ppdb = Ppdb::where('tahun_ajaran', $request->tahunAjaran)->where('gelombang', $request->gelombang)->where('id', '!=', $id)->first();
        if ($ppdb) {
            return response()->json([
                'message' => "PPDB dengan tahun ajaran " . $request->tahunAjaran . " dan gelombang " . $request->gelombang . " sudah ada"
            ], 422);
        }

        $ppdbEndDateLast = Ppdb::select('end_date')->where('id', '!=', $id)->orderBy('end_date', 'desc')->first();
        if ($ppdbEndDateLast && $request->start_date < $ppdbEndDateLast->end_date) {
            return response()->json([
                'message' => "Format tanggal tidak sesuai, pastikan tanggal dibuka tidak kurang dari tanggal tutup ppdb sebelumnya"
            ], 422);
        }

        if ($request->start_date < date('Y-m-d') || $request->end_date < $request->start_date) {
            return response()->json([
                'message' => "Format tanggal tidak sesuai, pastikan tanggal dibuka tidak kurang dari sekarang dan tanggal tutup tidak kurang dari tanggal dibuka"
            ], 422);
        }

        $tahunAjaran = $request->tahunAjaran;
        $gelombang = $request->gelombang;
        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));

        try {
            $ppdb = Ppdb::find($id);
            $ppdb->tahun_ajaran = $tahunAjaran;
            $ppdb->gelombang = $gelombang;
            $ppdb->start_date = $startDate;
            $ppdb->end_date = $endDate;
            $ppdb->save();
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Database Error",
                'debug'   => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function delete($id)
    {
        $ppdb = Ppdb::find($id);

        // cek ppdb aktif
        if ($ppdb->start_date <= date('Y-m-d') && $ppdb->end_date >= date('Y-m-d')) {
            return response()->json([
                'message' => "PPDB aktif tidak dapat dihapus"
            ], 422);
        }

        if (!$ppdb) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        try {
            $ppdb->delete();
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Database Error",
                'debug'   => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public static function getPPDBInfo()
    {
        $ppdbOpen = Ppdb::select('start_date', 'end_date', 'tahun_ajaran', 'gelombang', 'id')
            ->addSelect(DB::raw("IF(now() between start_date and end_date, 'open', 'close') as status_waktu"))
            ->whereRaw('now() between start_date and end_date')
            ->first();
        $ppdbNext = Ppdb::select('start_date', 'end_date', 'tahun_ajaran', 'gelombang')
            ->addSelect(DB::raw("IF(now() between start_date and end_date, 'open', 'close') as status_waktu"))
            ->whereRaw('start_date > now()')
            ->orderBy('start_date', 'asc')
            ->first();
        $ppdbNext = $ppdbNext ? $ppdbNext->start_date : null;

        return [
            'ppdbOpen' => $ppdbOpen,
            'ppdbNext' => $ppdbNext
        ];
    }
}
