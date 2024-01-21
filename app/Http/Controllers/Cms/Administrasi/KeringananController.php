<?php

namespace App\Http\Controllers\Cms\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Keringanan;
use App\Models\NominalPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeringananController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:keringanan,hak-akses']);
    }

    public function index()
    {
        $listData  = Keringanan::with('detailKeringanan', 'detailKeringanan.item')
            ->select('nama', 'total', 'id')
            ->orderBy('nama', 'asc')
            ->get();

        $listItem = NominalPendaftaran::select('id', 'nama', 'nominal')->get();

        return view('cms.master.keringanan', compact('listData', 'listItem'));
    }

    public function upsert(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'data' => 'required|array',
        ]);

        $data = $request->data;
        $nama = $request->nama;

        foreach ($data as $key => $item) {
            $nominal = preg_replace('/[^0-9]/', '', $item['nominal']);
            $data[$key]['nominal'] = $nominal;
        }
        
        try {
            DB::beginTransaction();
            if (isset($request->id)) {
                $keringanan = Keringanan::find($request->id);
                $keringanan->nama = $nama;
                $keringanan->total = array_sum(array_column($data, 'nominal'));
                $keringanan->save();
            } else {
                $keringanan = Keringanan::create([
                    'nama' => $nama,
                    'total' => array_sum(array_column($data, 'nominal')),
                ]);
            }
            $keringanan->detailKeringanan()->delete();
            
            foreach ($data as $item) {
                $keringanan->detailKeringanan()->create([
                    'item_id' => $item['id'],
                    'nominal' => $item['nominal'],
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Terjadi kesalahan',
                'error' => $th->getMessage(),
            ], 500);
        }

        return response()->json([
            'status' => 'OK',
            'message' => 'Berhasil menyimpan data',
        ]);
    }

    public function detail($id)
    {
        $data = Keringanan::with('detailKeringanan', 'detailKeringanan.item')->find($id);
        return response()->json(
            [
                'status' => 'OK',
                'results' => $data,
            ]
        );
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $data = Keringanan::find($id);
            $data->detailKeringanan()->delete();
            $data->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
        
        return response()->json([
            'status' => 'OK',
            'message' => 'Berhasil menghapus data',
        ]);
    }
}
