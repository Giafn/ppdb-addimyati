<?php

namespace App\Exports\Sheets;

use App\Http\Controllers\Cms\Master\PpdbSettingController;
use App\Models\CalonSiswa;
use App\Models\NominalPendaftaran;
use App\Models\PembayaranHistory;
use App\Models\Pendaftaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SheetDataPembayaran implements FromView, ShouldAutoSize, WithTitle
{
    // constructor untuk menerima data dari controller
    private $data;

    public function __construct($data = ['tahun_ajaran' => null, 'gelombang' => null ])
    {
        $this->data = $data;
    }

    public function view(): View
    {
        $data = $this->data;
        $selectedTahunAjaran = $data['tahun_ajaran'];
        $tahunAjaran = $selectedTahunAjaran ?? PpdbSettingController::getPPDBInfo()['ppdbOpen']->tahun_ajaran;
        $gelombang = $data['gelombang'];

        $dataQ =  Pendaftaran::with(
                'calonSiswa:id,nama_lengkap,jenis_kelamin', 
                'ppdb:id,gelombang,tahun_ajaran',
                'calonSiswa.siswaPembayaran',
                'calonSiswa.siswaPembayaran.pembayaranHistory',
                'calonSiswa.siswaPembayaran.keringanan',
                'calonSiswa.siswaPembayaran.keringanan.detailKeringanan',
                )
            ->join('ppdb', 'pendaftaran.ppdb_id', '=', 'ppdb.id')
            ->where('pendaftaran.status_pembayaran', '!=', 0)
            ->where('ppdb.tahun_ajaran', $tahunAjaran)
            ->when($gelombang, function($query, $gelombang) {
                return $query->where('ppdb.gelombang', $gelombang);
            })
            ->orderBy('ppdb.gelombang', 'asc')
            ->orderBy('pendaftaran.status_pembayaran', 'desc')
            ->get();
        $data = [];
        foreach ($dataQ as $key => $value) {
            $data[$key]['no'] = $key + 1;
            $data[$key]['nama'] = $value->calonSiswa->nama_lengkap;
            $data[$key]['jk'] = strtoupper($value->calonSiswa->jenis_kelamin);
            $data[$key]['gelombang'] = $value->ppdb->gelombang;
            $data[$key]['status_pembayaran'] = $value->status_pembayaran;
            if ($value->calonSiswa->siswaPembayaran) {
                if ($value->calonSiswa->siswaPembayaran->keringanan) {
                    $data[$key]['promo'] = $value->calonSiswa->siswaPembayaran->keringanan ? true : false;
                    $data[$key]['nama_keringanan'] = $value->calonSiswa->siswaPembayaran->keringanan->nama;
                    $data[$key]['nominal_per_item'] = $value->calonSiswa->siswaPembayaran->keringanan->detailKeringanan;
                } else {
                    $data[$key]['promo'] = false;
                    $data[$key]['nama_keringanan'] = 'Normal';
                    $data[$key]['nominal_per_item'] = NominalPendaftaran::select('id as item_id', 'nominal')->get();
                }
                $data[$key]['biaya_normal'] = NominalPendaftaran::sum('nominal');
                $data[$key]['total'] = $value->calonSiswa->siswaPembayaran->total;
                if ($value->calonSiswa->siswaPembayaran->pembayaranHistory) {
                    $data[$key]['pembayaran_history'] = $value->calonSiswa->siswaPembayaran->pembayaranHistory;
                    $data[$key]['jumlah_dibayar'] = $value->calonSiswa->siswaPembayaran->pembayaranHistory->sum('jumlah');
                } else {
                    $data[$key]['pembayaran_history'] = null;
                    $data[$key]['jumlah_dibayar'] = 0;
                }
                $data[$key]['sisa'] = $value->calonSiswa->siswaPembayaran->sisa;
            } else {
                $itemNominal = NominalPendaftaran::select('id as item_id')->get();
                $itemNominalBaru = $itemNominal->map(function($item) {
                    $item->nominal = 0;
                    return $item;
                });
                $data[$key]['promo'] = false;
                $data[$key]['nama_keringanan'] = '-';
                $data[$key]['nominal_per_item'] = $itemNominalBaru;
                $data[$key]['biaya_normal'] = NominalPendaftaran::sum('nominal');
                $data[$key]['total'] = 0;
                $data[$key]['pembayaran_history'] = null;
                $data[$key]['jumlah_dibayar'] = 0;
                $data[$key]['sisa'] = '-';
            }
        }
        $dataE['tahun_ajaran'] = $tahunAjaran;
        $dataE['data'] = $data;
        $dataE['normal'] = NominalPendaftaran::all();
        $dataE['max_jumlah_cicilan'] = PembayaranHistory::groupBy('pembayaran_id')->selectRaw('count(*) as jumlah')->get()->max('jumlah');

        return view('export.data-pembayaran', [
            'data' => $dataE,
        ]);
    }

    public function title(): string
    {
        return 'Data Siswa';
    }
}
