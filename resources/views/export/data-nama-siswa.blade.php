<html>
    <table class="tftable" style="font-size: 12px; color: #333333; width: 60%; border-width: 1px; border: 1px solid #000; border-collapse: collapse; font-family: arial, sans-serif;">
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="8"><b>DATA CALON SISWA/SISWI</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
            <th style="font-size: 14px; text-align: center;" align="center" colspan="8"><b>SMK TERPADU ADDIMYATI</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="8"><b>TAHUN AJARAN {{ $tahunAjaran }}</b></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 14px; text-align: center;" align="center" colspan="8"></th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">No</td>
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" >Nama Lengkap</td>
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" >Jenis Kelamin</td>
          <td style="font-size: 12px; padding: 7px 5px;"></td>
          <td style="font-size: 12px; padding: 7px 5px;"></td>
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">No</td>
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" >Nama Lengkap</td>
          <td style="font-size: 12px; border-width: 1px; background-color: #FFFF00; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" >Jenis Kelamin</td>
        </tr>
        @php
            $maxLoop = count($data['laki_laki']) > count($data['perempuan']) ? count($data['laki_laki']) : count($data['perempuan']);
        @endphp

        @for ($i = 0; $i < $maxLoop; $i++)
            <tr style="background-color: #ffffff;" bgcolor="#ffffff">
                @if (isset($data['laki_laki'][$i]))
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $i + 1 }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000;">{{ $data['laki_laki'][$i]['nama'] ?? '' }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $data['laki_laki'][$i]['jenis_kelamin'] ?? '' }}</td>
                @else
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                @endif

                <td style="font-size: 12px; padding: 7px 5px;"></td>
                <td style="font-size: 12px; padding: 7px 5px;"></td>

                @if (isset($data['perempuan'][$i]))
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $i + 1 }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000;">{{ $data['perempuan'][$i]['nama'] ?? '' }}</td>
                <td style="font-size: 12px; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $data['perempuan'][$i]['jenis_kelamin'] ?? '' }}</td>
                @else
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                <td style="font-size: 12px; padding: 7px 5px;"></td>
                @endif
            </tr>
        @endfor
      </table>
</html>