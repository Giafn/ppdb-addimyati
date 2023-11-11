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
    <form method="POST" action="#" enctype="multipart/form-data" id="formPendaftaran">
    @csrf
    <div class="mb-3 px-8 formPage1">
        <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Pribadi</h1>
        <div class="mb-3">
            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
            <div class="mt-1">
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}">
            </div>
            @if($errors->has('nama_lengkap'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_lengkap') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
            <div class="mt-1">
                <input type="number" name="nik" id="nik" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan NIK" value="{{ old('nik') }}">
            </div>
            <div class="text-xs mt-1" id="nikError">
            @if($errors->has('nik'))
                <span class="text-red-500">{{ $errors->first('nik') }}</span>
            @endif
            </div>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
            <div class="mt-1">
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('tanggal_lahir') }}">
            </div>
            @if($errors->has('tanggal_lahir'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('tanggal_lahir') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <div class="mt-1">
                <select name="jenis_kelamin" id="jenis_kelamin" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="l" @if(old('jenis_kelamin') == 'l') selected @endif>
                        Laki-laki
                    </option>
                    <option value="p" @if(old('jenis_kelamin') == 'p') selected @endif>
                        Perempuan
                    </option>
                </select>
            </div>
            @if($errors->has('jenis_kelamin'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('jenis_kelamin') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
            <div class="grid grid-cols-2 gap-2 mt-1">
                <div class="col-span-2">
                    <input type="text" name="kecamatan" id="kecamatan" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kecamatan" value="{{ old('kecamatan') }}">
                    @if($errors->has('kecamatan'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kecamatan') }}</div>
                    @endif
                </div>
                <div class="col-span-2">
                    <input type="text" name="kota" id="kota" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kota" value="{{ old('kota') }}">
                    @if($errors->has('kota'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kota') }}</div>
                    @endif
                </div>
                <div class="col-span-2">
                    <input type="text" name="provinsi" id="provinsi" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Provinsi" value="{{ old('provinsi') }}">
                    @if($errors->has('provinsi'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('provinsi') }}</div>
                    @endif
                </div>
                <div>
                    <input type="text" name="kode_pos" id="kode_pos" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Kode Pos" value="{{ old('kode_pos') }}">
                    @if($errors->has('kode_pos'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kode_pos') }}</div>
                    @endif
                </div>
                <div class="col-span-2">
                    <input type="text" name="desa" id="desa" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Desa" value="{{ old('desa') }}">
                    @if($errors->has('desa'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('desa') }}</div>
                    @endif
                </div>
                <div>
                    <input type="text" name="rt" id="rt" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RT" value="{{ old('rt') }}">
                    @if($errors->has('rt'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('rt') }}</div>
                    @endif
                </div>
                <div>
                    <input type="text" name="rw" id="rw" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RW" value="{{ old('rw') }}">
                    @if($errors->has('rw'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('rw') }}</div>
                    @endif
                </div>
                <div class="col-span-2">
                    <input type="text" name="alamat" id="alamat" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan detail alamat" value="{{ old('alamat') }}">
                    @if($errors->has('alamat'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('alamat') }}</div>
                    @endif
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="agama" class="block text-sm font-medium text-gray-700">Agama</label>
            <div class="mt-1">
                <select name="agama" id="agama" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Agama</option>
                    <option value="islam" @if(old('agama') == 'islam') selected @endif>Islam</option>
                    <option value="kristen" @if(old('agama') == 'kristen') selected @endif>Kristen</option>
                    <option value="katholik" @if(old('agama') == 'katholik') selected @endif>Katholik</option>
                    <option value="hindu" @if(old('agama') == 'hindu') selected @endif>Hindu</option>
                    <option value="budha" @if(old('agama') == 'budha') selected @endif>Budha</option>
                    <option value="konghucu" @if(old('agama') == 'konghucu') selected @endif>Konghucu</option>
                </select>
            </div>
            @if($errors->has('agama'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('agama') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
            <div class="mt-1">
                <input type="number" name="no_hp" id="no_hp" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan no hp" value="{{ old('no_hp') }}">
            </div>
            @if($errors->has('no_hp'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('no_hp') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
                <input type="email" name="email" id="email" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan email" value="{{ old('email') }}">
            </div>
            @if($errors->has('email'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('email') }}</div>
            @endif
        </div>
    </div>
    <div class="mb-3 px-8 formPage2 hidden">
        <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Akademik</h1>
        <div class="mb-3">
            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
            <div class="mt-1">
                <input type="number" name="nisn" id="nisn" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
            </div>
            @if($errors->has('nisn'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('nisn') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
            <div class="mt-1">
                <input type="text" name="asal_sekolah" id="asal_sekolah" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan asal sekolah" value="{{ old('asal_sekolah') }}">
            </div>
            @if($errors->has('asal_sekolah'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('asal_sekolah') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700">Alamat Sekolah</label>
            <div class="mt-1">
                <textarea name="alamat_sekolah" id="alamat_sekolah" cols="30" rows="5" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Masukkan alamat sekolah">{{ old('alamat_sekolah') }}</textarea>
            </div>
            @if($errors->has('alamat_sekolah'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('alamat_sekolah') }}</div>
            @endif
        </div>
        <h1 class="text-base font-bold text-emerald-800 mb-3">Jurusan Dipilih</h1>
        <div class="mb-3">
            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan utama</label>
            <div class="mt-1">
                <select name="jurusan" id="jurusan" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}" @if(old('jurusan') == $j->id) selected @endif>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            @if($errors->has('jurusan'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('jurusan') }}</div>
            @endif
        </div>
        <div class="mb-3">
            <label for="jurusan2" class="block text-sm font-medium text-gray-700">Jurusan kedua</label>
            <div class="mt-1">
                <select name="jurusan2" id="jurusan2" class="shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                    <option value="">Pilih Jurusan</option>
                    @foreach($jurusan as $j)
                    <option value="{{ $j->id }}" @if(old('jurusan2') == $j->id) selected @endif>{{ $j->nama }}</option>
                    @endforeach
                </select>
            </div>
            @if($errors->has('jurusan2'))
                <div class="text-xs mt-1 text-red-500">{{ $errors->first('jurusan2') }}</div>
            @endif
        </div>
    </div>
    </form>
    <div class="px-8 mb-5">
        <div class="formPage1 flex justify-end">
            <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium" id="nextPage2">Selanjutnya</button>
        </div>
        <div class="formPage2 flex justify-between hidden">
            <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium" id="backPage1">Kembali</button>
            <button id="subButton" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Kirim</button>
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
        
        // if (nik == "" || nama_lengkap == "" || tanggal_lahir == "" || jenis_kelamin == "" || agama == "" || alamat == "" || no_hp == "" || email == "") {
        //     alert('Semua data wajib diisi');
        // } else {
            $('.formPage1').addClass('hidden');
            $('.formPage2').removeClass('hidden');
        // }
    });
    
    $('#backPage1').on('click', function() {
        $('.formPage1').removeClass('hidden');
        $('.formPage2').addClass('hidden');
    });

    $('#subButton').on('click', function() {
        // form submit
        $('#formPendaftaran').submit();
    });
    
</script>
@endsection