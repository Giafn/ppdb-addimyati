@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')

<div class="lg:w-1/2 lg:mx-auto">
    <div class="w-full h-fit bg-lime-700 rounded-b-full">
        <div class="container mx-auto px-2 sm:px-6 lg:px-8 pt-10 pb-10 mb-6">
            <div class="flex flex-col items-center justify-center">
                <h1 class="text-sm font-bold text-white text-center">Formulir Pendaftaran Siswa Baru</h1>
                <h1 class="text-base font-bold text-white text-center">SMK Terpadu Ad-Dimyati</h1>
                <h1 class="text-xs font-bold text-white text-center">Tahun Pelajaran 2021/2022</h1>
            </div>
        </div>
    </div>
    <div class="mb-3 px-8 formPage1">
        <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Pribadi</h1>
        <div class="mb-3">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="mt-1">
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan nama lengkap">
            </div>
        </div>
        <div class="mb-3">
            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
            <div class="mt-1">
                <input type="number" name="nik" id="nik" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan NIK">
            </div>
            <div class="text-xs mt-1" id="nikError"></div>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <div class="mt-1">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
            </div>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <div class="mt-1">
                <select name="jenis_kelamin" id="jenis_kelamin" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="l">Laki-laki</option>
                    <option value="p">Perempuan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <div class="grid grid-cols-2 gap-2 mt-1">
                <div class="col-span-2">
                    <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kecamatan">
                </div>
                <div class="col-span-2">
                    <input type="text" name="kota" id="kota" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kota">
                </div>
                <div class="col-span-2">
                    <input type="text" name="provinsi" id="provinsi" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Provinsi">
                </div>
                <div>
                    <input type="text" name="kode_pos" id="kode_pos" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kode Pos">
                </div>
                <div class="col-span-2">
                    <input type="text" name="desa" id="desa" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Desa">
                </div>
                <div>
                    <input type="text" name="rt" id="rt" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RT">
                </div>
                <div>
                    <input type="text" name="rw" id="rw" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RW">
                </div>
                <div class="col-span-2">
                    <input type="text" name="alamat" id="alamat" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan detail alamat">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
            <div class="mt-1">
                <select name="agama" id="agama" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Agama</option>
                    <option value="islam">Islam</option>
                    <option value="kristen">Kristen</option>
                    <option value="katholik">Katholik</option>
                    <option value="hindu">Hindu</option>
                    <option value="budha">Budha</option>
                    <option value="konghucu">Konghucu</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
            <div class="mt-1">
                <input type="number" name="no_hp" id="no_hp" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan no hp">
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input type="email" name="email" id="email" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan email">
            </div>
        </div>
    </div>
    <div class="mb-3 px-8 formPage2 hidden">
        <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Akademik</h1>
        <div class="mb-3">
            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
            <div class="mt-1">
                <input type="number" name="nisn" id="nisn" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan NISN">
            </div>
        </div>
        <div class="mb-3">
            <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
            <div class="mt-1">
                <input type="text" name="asal_sekolah" id="asal_sekolah" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan asal sekolah">
            </div>
        </div>
        <div class="mb-3">
            <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700">Alamat Sekolah</label>
            <div class="mt-1">
                <textarea name="alamat_sekolah" id="alamat_sekolah" cols="30" rows="5" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan alamat sekolah"></textarea>
            </div>
        </div>
        <h1 class="text-base font-bold text-emerald-800 mb-3">Jurusan Dipilih</h1>
        <div class="mb-3">
            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan utama</label>
            <div class="mt-1">
                <select name="jurusan" id="jurusan" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jurusan</option>
                    <option value="rpl">Rekayasa Perangkat Lunak</option>
                    <option value="tkj">Teknik Komputer dan Jaringan</option>
                    <option value="mm">Multimedia</option>
                    <option value="bdp">Bisnis Daring dan Pemasaran</option>
                    <option value="ak">Akuntansi</option>
                    <option value="pm">Pemasaran</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="jurusan2" class="block text-sm font-medium text-gray-700">Jurusan kedua</label>
            <div class="mt-1">
                <select name="jurusan2" id="jurusan2" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jurusan</option>
                    <option value="rpl">Rekayasa Perangkat Lunak</option>
                    <option value="tkj">Teknik Komputer dan Jaringan</option>
                    <option value="mm">Multimedia</option>
                    <option value="bdp">Bisnis Daring dan Pemasaran</option>
                    <option value="ak">Akuntansi</option>
                    <option value="pm">Pemasaran</option>
                </select>
            </div>
        </div>
    </div>
    <div class="px-8 mb-5">
        <div class="formPage1 flex justify-end">
            <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium" id="nextPage2">Selanjutnya</button>
        </div>
        <div class="formPage2 flex justify-between hidden">
            <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium" id="backPage1">Kembali</button>
            <button type="submit" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Kirim</button>
        </div>
    </div>
</div>
{{-- footer --}}
<div class="w-full py-4 px-8">
    <div class="flex items-center justify-center">
        <img src="/image/logo.png" class="h-10" alt="logo">
        <h1 class="text-xs font-bold text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h1>
    </div>
</div>
@endsection
@section('script')
<script src="/js/nik_parse.min.js"></script>
<script>
    $('#nik').on('keyup', function() {
        setTimeout(() => {
            let nik = $('#nik').val();
            nikParse(nik, function(result) {
                if (result.status == "error") {
                    $('#nikError').html(result.pesan);
                    $('#nikError').removeClass('text-green-500');
                    $('#nikError').addClass('text-red-500');
                } else {
                    console.log(result);
                    $('#nikError').html(result.pesan);
                    $('#nikError').removeClass('text-red-500');
                    $('#nikError').addClass('text-green-500');
                    $('#nik').addClass('text-green-500');
                    
                    let tgl = result.data.lahir.split('/');
                    let tanggal_lahir = tgl[2] + "-" + tgl[1] + "-" + tgl[0];
                    $('#tanggal_lahir').val(tanggal_lahir);
                    let jk = result.data.kelamin == "LAKI-LAKI" ? "l" : "p";
                    $('#jenis_kelamin').val(jk);
                    $('#kecamatan').val(result.data.kecamatan);
                    $('#kota').val(result.data.kotakab);
                    $('#provinsi').val(result.data.provinsi);
                    $('#kode_pos').val(result.data.tambahan.kodepos);
                    
                }
            });
        }, 2000);
    });
    
    $('#nextPage2').on('click', function() {
        let nik = $('#nik').val();
        let nama_lengkap = $('#nama_lengkap').val();
        let tanggal_lahir = $('#tanggal_lahir').val();
        let jenis_kelamin = $('#jenis_kelamin').val();
        let agama = $('#agama').val();
        let alamat = $('#alamat').val();
        let no_hp = $('#no_hp').val();
        let email = $('#email').val();
        
        if (nik == "" || nama_lengkap == "" || tanggal_lahir == "" || jenis_kelamin == "" || agama == "" || alamat == "" || no_hp == "" || email == "") {
            alert('Semua data wajib diisi');
        } else {
            $('.formPage1').addClass('hidden');
            $('.formPage2').removeClass('hidden');
        }
    });
    
    $('#backPage1').on('click', function() {
        $('.formPage1').removeClass('hidden');
        $('.formPage2').addClass('hidden');
    });
    
</script>
@endsection