<?php

namespace App\Http\Controllers\Cms\Master;

use App\Http\Controllers\Controller;
use App\Models\AlurPendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InfoPPDBController extends Controller
{
    public function __construct()
    {
        $this->middleware(['cms.access:alurPendaftaran,hak-akses']);
    }

    public function index(Request $request)
    {
        $request->validate([
            'serach' => 'nullable',
        ]);

        $listData  = AlurPendaftaran::orderBy('id', 'asc')
            ->paginate(30);

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


        return view('cms.master.alur-daftar', compact('listData', 'paginationData'));
    }

    public function detail(Request $request, $id)
    {
        $data = AlurPendaftaran::find($id);

        if (!$data) {
            return response()->json([
                'message' => "Data not found"
            ], 404);
        }

        return response()->json([
            'status' => "OK",
            'results'   => $data
        ]);
    }

    public function storeOrUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tahap' => 'required|string',
            'deskripsi'  => 'required|string',
            "id"         => "nullable|exists:alur_pendaftaran,id"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => $validator->errors()->first()
            ], 422);
        }
        
        try {
            if ($request->id) {
                $data = AlurPendaftaran::find($request->id);
                $data->update($request->all());
            } else {
                $data = AlurPendaftaran::create($request->all());
            }
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

    public function delete(Request $request, $id)
    {
        $data = AlurPendaftaran::find($id);

        if (!$data) {
            return response()->json([
                'message' => "Data not found"
            ], 404);
        }

        try {
            $data->delete();
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
}
