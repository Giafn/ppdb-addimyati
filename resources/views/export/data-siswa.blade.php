<html>
    <table class="tftable" style="font-size: 16px; color: #333333; width: 60%; border-width: 1px; border: 1px solid #000; border-collapse: collapse; font-family: arial, sans-serif;">
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 16px; background-color: #FEC000; text-align: center;" bgcolor="#FEC000" align="center" colspan="21">PENDAFTARAN PPDB {{ $data['tahun_ajaran'] }}</th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
            <th style="font-size: 16px; background-color: #FEC000; text-align: center;" bgcolor="#FEC000" align="center" colspan="21">SMK TERPADU ADDIMYATI</th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">No</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">NAMA LENGKAP</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">JK</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">ANAK KE</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="3">NAMA ORANG TUA</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="3">PENDIDIKAN ORANG TUA</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="3">PEKERJAAN ORANG TUA</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="5">ALAMAT</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">ASAL SEKOLAH</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">NO WA</td>
          <td style="font-size: 16px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">NISN</td>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">AYAH</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">IBU</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">WALI</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">AYAH</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">IBU</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">WALI</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">AYAH</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">IBU</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">WALI</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">JALAN/GG</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">RT/RW</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">KEL/DESA</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">KECAMATAN</td>
          <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">KAB/KOTA</td>
        </tr>
        @foreach($data['data'] as $key => $value)
            <tr style="background-color: #ffffff;" bgcolor="#ffffff">
                <th style="font-size: 16px; background-color: #FEC000; text-align: center;" bgcolor="#FEC000" align="center" colspan="21">Gelombang {{ $key }}</th>
            </tr>
            @foreach($value as $key2 => $value)
                <tr style="background-color: #ffffff;" bgcolor="#ffffff">
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ $key2+1 }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ $value->nama_lengkap }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ strtoupper($value->jenis_kelamin) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ $value->anak_ke }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->nama_ayah) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->nama_ibu) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->nama_wali) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ strtoupper($value->pendidikan_ayah) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ strtoupper($value->pendidikan_ibu) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ strtoupper($value->pendidikan_wali) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->pekerjaan_ayah) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->pekerjaan_ibu) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->pekerjaan_wali) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ $value->alamat_jln .", ". $value->alamat_gg }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ str_pad($value->alamat_rt, 3, '0', STR_PAD_LEFT) }} / {{ str_pad($value->alamat_rw, 3, '0', STR_PAD_LEFT) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->alamat_desa) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->alamat_kecamatan) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->alamat_kab_kota) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ ucwords($value->asal_sekolah) }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ $value->nomor_wa }}</td>
                <td style="font-size: 16px; border-width: 1px; padding: 5px; border-style: solid; text-align: center; border: 1px solid #000;">{{ (int) $value->nisn }}</td>
                </tr>
            @endforeach
        @endforeach
      </table>
</html>