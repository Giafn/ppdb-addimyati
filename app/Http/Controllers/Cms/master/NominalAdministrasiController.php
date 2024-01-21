<?php

namespace App\Http\Controllers\Cms\Master;

use App\Http\Controllers\Controller;
use App\Models\NominalPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NominalAdministrasiController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:nominalAdministrasi,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable'
        ]);

        $search = $request->search;

        $listData  = NominalPendaftaran::select('gelombang', 'nama', 'nominal', 'id', 'keterangan')
            ->when(!empty($search), function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            })
            ->orderBy('gelombang', 'asc')
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

        return view('cms.master.nominal-administrasi', compact('listData', 'paginationData'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string',
            'nominal'   => 'required',
            'keterangan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $request->merge([
            'nominal' => str_replace(['.', 'Rp'], '', $request->nominal)
        ]);

        try {
            $nominalAdministrasi = new NominalPendaftaran();
            $nominalAdministrasi->gelombang = '1';
            $nominalAdministrasi->nama = $request->nama;
            $nominalAdministrasi->nominal = $request->nominal;
            $nominalAdministrasi->keterangan = $request->keterangan;
            $nominalAdministrasi->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Data gagal disimpan",
                "debug" => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function detail($id)
    {
        $nominalAdministrasi = NominalPendaftaran::find($id);
        if (!$nominalAdministrasi) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }
        $nominalAdministrasi->nominal = number_format($nominalAdministrasi->nominal, 0, ',', '.');

        return response()->json([
            'status' => "OK",
            'results' => $nominalAdministrasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama'      => 'required|string',
            'nominal'   => 'required',
            'keterangan' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }

        $request->merge([
            'nominal' => str_replace(['.', 'Rp'], '', $request->nominal)
        ]);

        try {
            $nominalAdministrasi = NominalPendaftaran::find($id);
            $nominalAdministrasi->gelombang = '1';
            $nominalAdministrasi->nama = $request->nama;
            $nominalAdministrasi->nominal = $request->nominal;
            $nominalAdministrasi->keterangan = $request->keterangan;
            $nominalAdministrasi->save();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Data gagal disimpan",
                "debug" => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public function delete($id)
    {
        $nominalAdministrasi = NominalPendaftaran::find($id);
        if (!$nominalAdministrasi) {
            return response()->json([
                'message' => "Data tidak ditemukan"
            ], 404);
        }

        try {
            $nominalAdministrasi->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'message' => "Data gagal dihapus",
                "debug" => $th->getMessage()
            ], 500);
        }

        return response()->json([
            'status' => "OK"
        ]);
    }

    public static function hitungNominal($gelombang, $voucherKode = null)
    {
        $nominalAdministrasi = NominalPendaftaran::where('gelombang', $gelombang)
            ->get();

        if ($voucherKode) {
        }

        $sumNominal = 0;
        foreach ($nominalAdministrasi as $key => $value) {
            $sumNominal += $value->nominal;
        }

        return $sumNominal;
    }
}
