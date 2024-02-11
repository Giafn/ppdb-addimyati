<html>
<head>
  @php
    $jumlahItemPembayaran = $data['normal']->count();
    $colCount = 17 + $jumlahItemPembayaran;
    $defaultJumlahCicilan = 7;
    $jumlahCicilan = $data['max_jumlah_cicilan'] > $defaultJumlahCicilan ? $data['max_jumlah_cicilan'] : $defaultJumlahCicilan;
  @endphp
    <table class="tftable" style="font-size: 16px; color: #333333; width: 60%; border-width: 1px;  background-color: #00B0F0; border: 1px solid #000; border-collapse: collapse; font-family: arial, sans-serif;">
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <th style="font-size: 16px; background-color: #92D050; text-align: center;" bgcolor="#92D050" align="center" colspan="{{ $colCount }}">Rekap Pembayaran PPDB</th>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">No</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">NAMA LENGKAP</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">JK</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">GEL</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">REFERENSI</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">BIAYA NORMAL</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="6">RINCIAN BIAYA</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">TOTAL PEMBAYARAN</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" colspan="8">CICILAN PEMBAYARAN</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">JUMLAH</td>
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border-style: solid; border: 1px solid #000; text-align: center;" rowspan="2">SISA PEMBAYARAN</td>
        </tr>
        <tr style="background-color: #ffffff;" bgcolor="#ffffff">
          @foreach ($data['normal'] as $item)
            <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 7px 5px; border: 1px solid #000; text-align: center;">{{ strtoupper($item->nama) }}</td>
          @endforeach
          <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">PENDAFTARAN</td>
          @for ($i = 0; $i < $jumlahCicilan; $i++)
            <td style="font-size: 16px; border-width: 1px;  background-color: #00B0F0; padding: 5px; border-style: solid; border: 1px solid #000; text-align: center;">{{ $i + 1 }}</td>
          @endfor
        </tr>

        @php
          $temp = null;
        @endphp
        @foreach ($data['data'] as $item)
          @if ($temp != $item['gelombang'])
            <tr style="background-color: #ffffff;" bgcolor="#ffffff">
              <th style="font-size: 16px; background-color: #FF0000; text-align: center; color:#ffffff;" bgcolor="#FF0000" align="center" colspan="{{ $colCount }}">Gelombang {{ $item['gelombang'] }}</th>
            </tr>
            @php
              $temp = $item['gelombang'];
            @endphp
          @endif
          <tr style="background-color: #ffffff;" bgcolor="#ffffff">
            <td style="font-size: 16px; border-width: 1px; padding: 5px; border: 1px solid #000; text-align: center;">{{ $item['no'] }}</td>
            <td style="font-size: 16px; border-width: 1px; padding: 5px; border: 1px solid #000;">{{ strtoupper($item['nama']) }}</td>
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: center;">{{ strtoupper($item['jk']) }}</td>
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: center;">{{ strtoupper($item['gelombang']) }}</td>
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: center;">{{ strtoupper($item['nama_keringanan']) }}</td>
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">{{ "Rp. " . number_format($item['biaya_normal'], 0, ',', '.') }}</td>
            @foreach ($data['normal'] as $item2)
              @php
                $itemPembayaran = $item['nominal_per_item']->where('item_id', $item2->id)->first();
              @endphp
              <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">{{ $itemPembayaran ? "Rp. " . number_format($itemPembayaran->nominal, 0, ',', '.') : '' }}</td>
            @endforeach
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">{{ "Rp. " . number_format($item['total'], 0, ',', '.') }}</td>
            @for ($i = 0; $i < 8; $i++)
              @php
                $count = $item['pembayaran_history'] ? $item['pembayaran_history']->count() : 0;
                if ($i < $count) {
                  $itemPembayaran = array_key_exists($i, $item['pembayaran_history']->toArray()) ? $item['pembayaran_history'][$i] : null;
                } else {
                  $itemPembayaran = null;
                }
              @endphp
              <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">{{ $itemPembayaran ? "Rp. " . number_format($itemPembayaran['jumlah'], 0, ',', '.') : '' }}</td>
            @endfor
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">{{ "Rp. " . number_format($item['jumlah_dibayar'], 0, ',', '.') }}</td>
            <td style="font-size: 16px; border-width: 1px; border: 1px solid #000; padding: 5px; text-align: right;">
              {{-- {{ $item['status_pembayaran'] !== 2 ? ( $item['sisa'] !== '-' || $item['sisa'] !== '0' ? "Rp. " . number_format($item['sisa'], 0, ',', '.') : '-' ) : 'LUNAS' }} --}}
              @if ($item['status_pembayaran'] !== 2)
              @dd($item['sisa'] !== '-' || $item['sisa'] !== '0', $item['sisa'])
                @if ($item['sisa'] !== '-' || $item['sisa'] !== '0')
                  {{ "Rp. " . number_format($item['sisa'], 0, ',', '.') }}
                @else
                  LUNAS
                @endif
              @else
                LUNAS
              @endif
            </td> 
          </tr>
        @endforeach
      </table>
</html>