<html>
    <table class="tftable" style="font-size: 12px; color: #333333; width: 60%; border-width: 1px; border: 1px solid #000; border-collapse: collapse; font-family: arial, sans-serif;">
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="3"><b>DATA CALON SISWA/SISWI {{ $namaJurusan }}</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
            <th style="font-size: 14px; text-align: center;" align="center" colspan="3"><b>SMK TERPADU ADDIMYATI</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="3"><b>TAHUN AJARAN {{ $tahunAjaran }}</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="3"></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <td style="font-size: 12px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;"><b>No</b></td>
          <td style="font-size: 12px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;"><b>Nama Lengkap</b></td>
          <td style="font-size: 12px; border-width: 1px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;"><b>Jenis Kelamin</b></td>
        </tr>
        @foreach ($data as $key => $item)
            <tr style="background-color: #ffffff;" bgcolor="#ffffff">
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $key + 1 }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000;">{{ $item['nama'] ?? '' }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $item['jenis_kelamin'] ?? '' }}</td>
            </tr>
        @endforeach
      </table>
</html>