@extends('front.layouts.app')
@section('title', 'PPDB Ad-Dimyati | ')
@section('content')

    @if (session('page'))
    @endif
    <div class="lg:w-1/2 lg:mx-auto">
        <div class="w-full h-fit bg-lime-700 rounded-b-full">
            <div class="container mx-auto px-2 sm:px-6 lg:px-8 pt-6 pb-5 mb-6">
                <div class="flex flex-col items-center justify-center">
                    <h1 class="text-sm font-bold text-white text-center">Formulir Pendaftaran Siswa Baru</h1>
                    <h1 class="text-base font-bold text-white text-center">SMK Terpadu Ad-Dimyati</h1>
                    <h1 class="text-xs font-bold text-white text-center">Tahun Pelajaran 2021/2022</h1>
                </div>
            </div>
        </div>
        <form method="POST" action="#" enctype="multipart/form-data" id="formPendaftaran">
            @csrf
            <div class="page0 h-screen"></div>
            <div class="mb-3 px-8 formPage1 hidden">
                <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Pribadi</h1>
                <div class="mb-3">
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan nama lengkap" value="{{ old('nama_lengkap') }}">
                    </div>
                    @if ($errors->has('nama_lengkap'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_lengkap') }}</div>
                    @endif
                </div>
                {{-- nama panggilan --}}
                <div class="mb-3">
                    <label for="nama_panggilan" class="block text-sm font-medium text-gray-700">Nama Panggilan</label>
                    <div class="mt-1">
                        <input type="text" name="nama_panggilan" id="nama_panggilan"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan nama panggilan" value="{{ old('nama_panggilan') }}">
                    </div>
                    @if ($errors->has('nama_panggilan'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_panggilan') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="nik" class="block text-sm font-medium text-gray-700">NIK<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="number" name="nik" id="nik"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan NIK" value="{{ old('nik') }}">
                    </div>
                    <div class="text-xs mt-1" id="nikError">
                        @if ($errors->has('nik'))
                            <span class="text-red-500">{{ $errors->first('nik') }}</span>
                        @endif
                    </div>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            value="{{ old('tanggal_lahir') }}">
                    </div>
                    @if ($errors->has('tanggal_lahir'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('tanggal_lahir') }}</div>
                    @endif
                </div>
                {{-- tempat lahir --}}
                <div class="mb-3">
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700">Tempat Lahir<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="tempat_lahir" id="tempat_lahir"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
                    </div>
                    @if ($errors->has('tempat_lahir'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('tempat_lahir') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700">Jenis Kelamin<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <select name="jenis_kelamin" id="jenis_kelamin"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="l" @if (old('jenis_kelamin') == 'l') selected @endif>
                                Laki-laki
                            </option>
                            <option value="p" @if (old('jenis_kelamin') == 'p') selected @endif>
                                Perempuan
                            </option>
                        </select>
                    </div>
                    @if ($errors->has('jenis_kelamin'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('jenis_kelamin') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="text" name="kecamatan" id="kecamatan"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Kecamatan" value="{{ old('kecamatan') }}">
                            @if ($errors->has('kecamatan'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('kecamatan') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="kota" id="kota"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Kota" value="{{ old('kota') }}">
                            @if ($errors->has('kota'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('kota') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="provinsi" id="provinsi"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Provinsi" value="{{ old('provinsi') }}">
                            @if ($errors->has('provinsi'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('provinsi') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="desa" id="desa"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Desa" value="{{ old('desa') }}">
                            @if ($errors->has('desa'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('desa') }}</div>
                            @endif
                        </div>
                        <div>
                            <input type="number" name="rt" id="rt"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="RT" value="{{ old('rt') }}">
                            @if ($errors->has('rt'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('rt') }}</div>
                            @endif
                        </div>
                        <div>
                            <input type="number" name="rw" id="rw"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="RW" value="{{ old('rw') }}">
                            @if ($errors->has('rw'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('rw') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="jalan" id="jalan"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Jalan" value="{{ old('jalan') }}">
                            @if ($errors->has('jalan'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('jalan') }}</div>
                            @endif
                        </div>
                        {{-- gang --}}
                        <div class="col-span-2">
                            <input type="text" name="gang" id="gang"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Gang/komplek" value="{{ old('gang') }}">
                            @if ($errors->has('gang'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('gang') }}</div>
                            @endif
                        </div>
                        <div class="col-span-1">
                            <input type="text" name="no_rumah" id="no_rumah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="No Rumah" value="{{ old('no_rumah') }}">
                            @if ($errors->has('no_rumah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('no_rumah') }}</div>
                            @endif
                        </div>
                        <div>
                            <input type="number" name="kode_pos" id="kode_pos"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                placeholder="Kode Pos" value="{{ old('kode_pos') }}">
                            @if ($errors->has('kode_pos'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('kode_pos') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="agama" class="block text-sm font-medium text-gray-700">Agama<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="agama" id="agama"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan agama" value="{{ old('agama') }}">
                    </div>
                    @if ($errors->has('agama'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('agama') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP (Whatsapp)<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="number" name="no_hp" id="no_hp"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan no hp Whatsapp" value="{{ old('no_hp') }}">
                    </div>
                    @if ($errors->has('no_hp'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('no_hp') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 px-8 formPage2 hidden">
                {{-- anak ke --}}
                <div class="mb-3">
                    <label for="anak_ke" class="block text-sm font-medium text-gray-700">Anak Ke<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="number" name="anak_ke" id="anak_ke"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Anak ke" value="{{ old('anak_ke') }}">
                    </div>
                    @if ($errors->has('anak_ke'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('anak_ke') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="saudara" class="block text-sm font-medium text-gray-700">Jumlah Saudara<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-1">
                            <input type="number" name="saudara" id="saudara_kandung"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('saudara') }}" placeholder="Sodara kandung">
                            @if ($errors->has('saudara'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('saudara') }}</div>
                            @endif
                        </div>
                        <div class="col-span-1">
                            <input type="number" name="saudara_tiri" id="saudara_tiri"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('saudara_tiri') }}" placeholder="Sodara tiri">
                            @if ($errors->has('saudara_tiri'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('saudara_tiri') }}</div>
                            @endif
                        </div>
                        {{-- sudah sekolah --}}
                        <div class="col-span-1">
                            <input type="number" name="sudah_sekolah" id="sudah_sekolah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('sudah_sekolah') }}" placeholder="sudah sekolah">
                            @if ($errors->has('sudah_sekolah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('sudah_sekolah') }}</div>
                            @endif
                        </div>
                        {{-- belum sekolah --}}
                        <div class="col-span-1">
                            <input type="number" name="belum_sekolah" id="belum_sekolah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('belum_sekolah') }}" placeholder="belum sekolah">
                            @if ($errors->has('belum_sekolah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('belum_sekolah') }}</div>
                            @endif
                        </div>
                        <span class="text-xs text-gray-500 col-span-2">
                            *Jika tidak ada, isi dengan - (strip)
                        </span>
                    </div>
                </div>
                <h1 class="text-base font-bold text-emerald-800 mb-3">Identitas Orang Tua</h1>
                <div class="mb-3">
                    <label for="nama_ayah" class="block text-sm font-medium text-gray-700">Nama Orang Tua<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="text" name="nama_ayah" id="nama_ayah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('nama_ayah') }}" placeholder="Ayah">
                            @if ($errors->has('nama_ayah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_ayah') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="nama_ibu" id="nama_ibu"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('nama_ibu') }}" placeholder="Ibu">
                            @if ($errors->has('nama_ibu'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_ibu') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- pendidikan Orang Tua --}}
                <div class="mb-3">
                    <label for="pendidikan_ayah" class="block text-sm font-medium text-gray-700">Pendidikan Orang Tua<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <select name="pendidikan_ayah" id="pendidikan_ayah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih Pendidikan Ayah</option>
                                <option value="sd" @if (old('pendidikan_ayah') == 'sd') selected @endif>
                                    SD
                                </option>
                                <option value="smp" @if (old('pendidikan_ayah') == 'smp') selected @endif>
                                    SMP
                                </option>
                                <option value="sma" @if (old('pendidikan_ayah') == 'sma') selected @endif>
                                    SMA
                                </option>
                                <option value="s1" @if (old('pendidikan_ayah') == 's1') selected @endif>
                                    S1
                                </option>
                                <option value="s2" @if (old('pendidikan_ayah') == 's2') selected @endif>
                                    S2
                                </option>
                                <option value="s3" @if (old('pendidikan_ayah') == 's3') selected @endif>
                                    S3
                                </option>
                            </select>
                            @if ($errors->has('pendidikan_ayah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pendidikan_ayah') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <select name="pendidikan_ibu" id="pendidikan_ibu"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih Pendidikan Ibu</option>
                                <option value="sd" @if (old('pendidikan_ayah') == 'sd') selected @endif>
                                    SD
                                </option>
                                <option value="smp" @if (old('pendidikan_ayah') == 'smp') selected @endif>
                                    SMP
                                </option>
                                <option value="sma" @if (old('pendidikan_ayah') == 'sma') selected @endif>
                                    SMA
                                </option>
                                <option value="s1" @if (old('pendidikan_ayah') == 's1') selected @endif>
                                    S1
                                </option>
                                <option value="s2" @if (old('pendidikan_ayah') == 's2') selected @endif>
                                    S2
                                </option>
                                <option value="s3" @if (old('pendidikan_ayah') == 's3') selected @endif>
                                    S3
                                </option>
                            </select>
                            @if ($errors->has('pendidikan_ibu'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pendidikan_ibu') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- pekerjaan orang tua --}}
                <div class="mb-3">
                    <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700">Pekerjaan Orang Tua<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('pekerjaan_ayah') }}" placeholder="Ayah">
                            @if ($errors->has('pekerjaan_ayah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pekerjaan_ayah') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('pekerjaan_ibu') }}" placeholder="Ibu">
                            @if ($errors->has('pekerjaan_ibu'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pekerjaan_ibu') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- agama orang tua --}}
                <div class="mb-3">
                    <label for="agama_ayah" class="block text-sm font-medium text-gray-700">Agama Orang Tua<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="text" name="agama_ayah" id="agama_ayah"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('agama_ayah') }}" placeholder="Ayah">
                            @if ($errors->has('agama_ayah'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('agama_ayah') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="agama_ibu" id="agama_ibu"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('agama_ibu') }}" placeholder="Ibu">
                            @if ($errors->has('agama_ibu'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('agama_ibu') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- tanggungan keluarga --}}
                <div class="mb-3">
                    <label for="tanggungan_keluarga" class="block text-sm font-medium text-gray-700">Tanggungan
                        Keluarga<span class="text-xs text-red-800">*</span></label>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="number" name="tanggungan_keluarga" id="tanggungan_keluarga"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('tanggungan_keluarga') }}" placeholder="jml tanggungan">
                            @if ($errors->has('tanggungan_keluarga'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('tanggungan_keluarga') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- wali --}}
                {{-- cekbox --}}
                <div class="mb-2">
                    <input type="checkbox" name="walicek" id="walicekbox" class="wali"
                        {{ old('walicek') == 'on' ? 'checked' : '' }}>
                    <label for="walicekbox" class="text-sm text-gray-500">Memiliki Wali</label>
                </div>
                <div class="mb-3 walifield hidden">
                    <label for="nama_wali" class="block text-sm font-medium text-gray-700">Informasi Wali</label>
                    <span class="text-xs text-gray-500">
                        *Isi jika orang tua sudah tidak ada
                    </span>
                    <div class="grid grid-cols-2 gap-2 mt-1">
                        <div class="col-span-2">
                            <input type="text" name="nama_wali" id="nama_wali"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('nama_wali') }}" placeholder="Nama Wali">
                            @if ($errors->has('nama_wali'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('nama_wali') }}</div>
                            @endif
                        </div>
                        {{-- pendidikan wali --}}
                        <div class="col-span-2">
                            <select name="pendidikan_wali" id="pendidikan_wali"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">Pilih Pendidikan Wali</option>
                                <option value="sd" @if (old('pendidikan_wali') == 'sd') selected @endif>
                                    SD
                                </option>
                                <option value="smp" @if (old('pendidikan_wali') == 'smp') selected @endif>
                                    SMP
                                </option>
                                <option value="sma" @if (old('pendidikan_wali') == 'sma') selected @endif>
                                    SMA
                                </option>
                                <option value="s1" @if (old('pendidikan_wali') == 's1') selected @endif>
                                    S1
                                </option>
                                <option value="s2" @if (old('pendidikan_wali') == 's2') selected @endif>
                                    S2
                                </option>
                                <option value="s3" @if (old('pendidikan_wali') == 's3') selected @endif>
                                    S3
                                </option>
                            </select>
                            @if ($errors->has('pendidikan_wali'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pendidikan_wali') }}</div>
                            @endif
                        </div>
                        {{-- pekerjaan wali --}}
                        <div class="col-span-2">
                            <input type="text" name="pekerjaan_wali" id="pekerjaan_wali"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('pekerjaan_wali') }}" placeholder="Pekerjaan Wali">
                            @if ($errors->has('pekerjaan_wali'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('pekerjaan_wali') }}</div>
                            @endif
                        </div>
                        {{-- agama wali --}}
                        <div class="col-span-2">
                            <input type="text" name="agama_wali" id="agama_wali"
                                class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                value="{{ old('agama_wali') }}" placeholder="Agama Wali">
                            @if ($errors->has('agama_wali'))
                                <div class="text-xs mt-1 text-red-500">{{ $errors->first('agama_wali') }}</div>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-700">Alamat Wali</label>
                            <div class="grid grid-cols-2 gap-2 mt-1">
                                <div class="col-span-2">
                                    <input type="text" name="kecamatan_wali" id="kecamatan_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Kecamatan" value="{{ old('kecamatan_wali') }}">
                                    @if ($errors->has('kecamatan_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kecamatan_wali') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="kota_wali" id="kota_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Kota" value="{{ old('kota_wali') }}">
                                    @if ($errors->has('kota_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kota_wali') }}</div>
                                    @endif
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="provinsi_wali" id="provinsi_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Provinsi" value="{{ old('provinsi_wali') }}">
                                    @if ($errors->has('provinsi_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('provinsi_wali') }}</div>
                                    @endif
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="desa_wali" id="desa_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Desa" value="{{ old('desa_wali') }}">
                                    @if ($errors->has('desa_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('desa_wali') }}</div>
                                    @endif
                                </div>
                                <div>
                                    <input type="text" name="rt_wali" id="rt_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="RT" value="{{ old('rt_wali') }}">
                                    @if ($errors->has('rt_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('rt_wali') }}</div>
                                    @endif
                                </div>
                                <div>
                                    <input type="text" name="rw_wali" id="rw_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="RW" value="{{ old('rw_wali') }}">
                                    @if ($errors->has('rw_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('rw_wali') }}</div>
                                    @endif
                                </div>
                                <div class="col-span-2">
                                    <input type="text" name="jalan_wali" id="jalan_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Jalan" value="{{ old('jalan_wali') }}">
                                    @if ($errors->has('jalan_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('jalan_wali') }}</div>
                                    @endif
                                </div>
                                {{-- gang --}}
                                <div class="col-span-2">
                                    <input type="text" name="gang_wali" id="gang_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Gang/komplek" value="{{ old('gang_wali') }}">
                                    @if ($errors->has('gang_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('gang_wali') }}</div>
                                    @endif
                                </div>
                                <div class="col-span-1">
                                    <input type="text" name="no_rumah_wali" id="no_rumah_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="No Rumah" value="{{ old('no_rumah_wali') }}">
                                    @if ($errors->has('no_rumah_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('no_rumah_wali') }}</div>
                                    @endif
                                </div>
                                <div>
                                    <input type="text" name="kode_pos_wali" id="kode_pos_wali"
                                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                                        placeholder="Kode Pos" value="{{ old('kode_pos_wali') }}">
                                    @if ($errors->has('kode_pos_wali'))
                                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('kode_pos_wali') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 px-8 formPage3 hidden">
                <h1 class="text-base font-bold text-emerald-800 mb-3">Informasi Akademik</h1>
                <div class="mb-3">
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="number" name="nisn" id="nisn"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                    </div>
                    @if ($errors->has('nisn'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('nisn') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="asal_sekolah" class="block text-sm font-medium text-gray-700">Asal Sekolah<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="asal_sekolah" id="asal_sekolah"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan asal sekolah" value="{{ old('asal_sekolah') }}">
                    </div>
                    @if ($errors->has('asal_sekolah'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('asal_sekolah') }}</div>
                    @endif
                </div>
                {{-- nomor sttb --}}
                <div class="mb-3">
                    <label for="no_sttb" class="block text-sm font-medium text-gray-700">Nomor STTB (pada izajah)<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="text" name="no_sttb" id="no_sttb"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan nomor sttb" value="{{ old('no_sttb') }}">
                    </div>
                    @if ($errors->has('no_sttb'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('no_sttb') }}</div>
                    @endif
                </div>
                {{-- tahun sttb --}}
                <div class="mb-3">
                    <label for="tahun_sttb" class="block text-sm font-medium text-gray-700">Tahun STTB (pada izajah)<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <input type="number" name="tahun_sttb" id="tahun_sttb"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan tahun sttb" value="{{ old('tahun_sttb') }}">
                    </div>
                    @if ($errors->has('tahun_sttb'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('tahun_sttb') }}</div>
                    @endif
                </div>
                <h1 class="text-base font-bold text-emerald-800 mb-3">Program Studi</h1>
                <div class="mb-3">
                    <label for="program_studi" class="block text-sm font-medium text-gray-700">Utama<span
                            class="text-xs text-red-800">*</span></label>
                    <div class="mt-1">
                        <select name="program_studi" id="program_studi"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}" @if (old('program_studi') == $j->id) selected @endif>
                                    {{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('program_studi'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('program_studi') }}</div>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="program_studi_pilihan_2" class="block text-sm font-medium text-gray-700">Pilihan
                        Kedua</label>
                    <div class="mt-1">
                        <select name="program_studi_pilihan_2" id="program_studi_pilihan_2"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Program Studi</option>
                            @foreach ($jurusan as $j)
                                <option value="{{ $j->id }}" @if (old('program_studi_pilihan_2') == $j->id) selected @endif>
                                    {{ $j->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if ($errors->has('program_studi_pilihan_2'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('program_studi_pilihan_2') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 px-8 formPage4 hidden">
                <h1 class="text-base font-bold text-emerald-800 mb-3">Lain Lain</h1>
                <div class="mb-3">
                    <label for="tinggi_badan" class="block text-sm font-medium text-gray-700">Tinggi Badan</label>
                    <div class="mt-1">
                        <input type="number" name="tinggi_badan" id="tinggi_badan"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Tinggi Badan" value="{{ old('tinggi_badan') }}">
                    </div>
                    @if ($errors->has('tinggi_badan'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('tinggi_badan') }}</div>
                    @endif
                </div>
                {{-- berat badan --}}
                <div class="mb-3">
                    <label for="berat_badan" class="block text-sm font-medium text-gray-700">Berat Badan</label>
                    <div class="mt-1">
                        <input type="number" name="berat_badan" id="berat_badan"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Berat Badan" value="{{ old('berat_badan') }}">
                    </div>
                    @if ($errors->has('berat_badan'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('berat_badan') }}</div>
                    @endif
                </div>
                {{-- golongan darah --}}
                <div class="mb-3">
                    <label for="golongan_darah" class="block text-sm font-medium text-gray-700">Golongan Darah</label>
                    <div class="mt-1 grid grid-cols-3 gap-1">
                        <select name="golongan_darah" id="golongan_darah"
                            class="col-span-2 text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Golongan Darah</option>
                            <option value="a" @if (old('golongan_darah') == 'a') selected @endif>A</option>
                            <option value="b" @if (old('golongan_darah') == 'b') selected @endif>B</option>
                            <option value="ab" @if (old('golongan_darah') == 'ab') selected @endif>AB</option>
                            <option value="o" @if (old('golongan_darah') == 'o') selected @endif>O</option>
                        </select>
                        {{-- min/plus --}}
                        <select name="rhesus" id="rhesus"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                            <option value="">Pilih Rhesus</option>
                            <option value="+" @if (old('rhesus') == '+') selected @endif>+</option>
                            <option value="-" @if (old('rhesus') == '-') selected @endif>-</option>
                        </select>
                    </div>
                    @if ($errors->has('golongan_darah'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('golongan_darah') }}</div>
                    @endif
                </div>
                {{-- penyakit kronis --}}
                <div class="mb-3">
                    <label for="penyakit_kronis" class="block text-sm font-medium text-gray-700">Penyakit Kronis</label>
                    <div class="mt-1">
                        <input type="text" name="penyakit_kronis" id="penyakit_kronis"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Penyakit Kronis" value="{{ old('penyakit_kronis') }}">
                    </div>
                    @if ($errors->has('penyakit_kronis'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('penyakit_kronis') }}</div>
                    @endif
                </div>
                {{-- cita cita --}}
                <div class="mb-3">
                    <label for="cita_cita" class="block text-sm font-medium text-gray-700">Cita Cita</label>
                    <div class="mt-1">
                        <input type="text" name="cita_cita" id="cita_cita"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Cita Cita" value="{{ old('cita_cita') }}">
                    </div>
                    @if ($errors->has('cita_cita'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('cita_cita') }}</div>
                    @endif
                </div>
                {{-- hobi --}}
                <div class="mb-3">
                    <label for="hobi" class="block text-sm font-medium text-gray-700">Hobi</label>
                    <div class="mt-1">
                        <input type="text" name="hobi" id="hobi"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Hobi" value="{{ old('hobi') }}">
                    </div>
                    @if ($errors->has('hobi'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('hobi') }}</div>
                    @endif
                </div>
                {{-- prestasi yang pernah di capai --}}
                <div class="mb-3">
                    <label for="prestasi" class="block text-sm font-medium text-gray-700">Prestasi yang pernah di
                        capai</label>
                    <div class="mt-1">
                        <input type="text" name="prestasi" id="prestasi"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Prestasi" value="{{ old('prestasi') }}">
                    </div>
                    @if ($errors->has('prestasi'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('prestasi') }}</div>
                    @endif
                </div>
                {{-- keahlian --}}
                <div class="mb-3">
                    <label for="keahlian" class="block text-sm font-medium text-gray-700">Keahlian</label>
                    <div class="mt-1">
                        <input type="text" name="keahlian" id="keahlian"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Keahlian" value="{{ old('keahlian') }}">
                    </div>
                    @if ($errors->has('keahlian'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('keahlian') }}</div>
                    @endif
                </div>
                {{-- ukuran seragam --}}
                <div class="mb-3">
                    <label for="ukuran_seragam" class="block text-sm font-medium text-gray-700">Ukuran Seragam<span
                            class="text-xs text-red-800">*</span></label>
                    <select name="ukuran_seragam" id="ukuran_seragam"
                        class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="">Pilih Ukuran Seragam</option>
                        <option value="s" @if (old('ukuran_seragam') == 's') selected @endif>S</option>
                        <option value="m" @if (old('ukuran_seragam') == 'm') selected @endif>M</option>
                        <option value="l" @if (old('ukuran_seragam') == 'l') selected @endif>L</option>
                        <option value="xl" @if (old('ukuran_seragam') == 'xl') selected @endif>XL</option>
                        <option value="xxl" @if (old('ukuran_seragam') == 'xxl') selected @endif>XXL</option>
                    </select>
                    @if ($errors->has('ukuran_seragam'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('ukuran_seragam') }}</div>
                    @endif
                </div>
                {{-- referensi --}}
                <div class="mb-3">
                    <label for="referensi" class="block text-sm font-medium text-gray-700">Referensi</label>
                    <div class="mt-1">
                        <input type="text" name="referensi" id="referensi"
                            class="text-xs shadow-sm focus:ring-emerald-800 focus:border-emerald-800 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Masukkan Referensi" value="{{ old('referensi') }}">
                    </div>
                    @if ($errors->has('referensi'))
                        <div class="text-xs mt-1 text-red-500">{{ $errors->first('referensi') }}</div>
                    @endif
                </div>
            </div>
            <div class="mb-3 px-8 formPage5 hidden">
                <h1 class="text-lg font-bold text-emerald-800 mb-3 text-center">Validasi data</h1>
                <div class="py-2 sm:px-4 sm:shadow-md">
                    <h2 class="text-base font-bold text-emerald-800 mb-3">Informasi Pribadi</h2>
                    <table class="table w-full">
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nama Lengkap
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm" id="dataNama">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nama Panggilan
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNamaPanggilan">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                NIK
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNik">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Tanggal Lahir
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataTglLahir">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Tempat Lahir
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataTempatLahir">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Jenis Kelamin
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataJenisKelamin">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Alamat
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataAlamat">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Agama
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataAgama">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                No Hp/Whatsapp
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNoHp">
                                : -
                            </td>
                        </tr>
                    </table>
                    <h2 class="text-base font-bold text-emerald-800 mb-3 pt-3">Informasi Keluarga</h2>
                    <table class="table w-full">
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Anak Ke
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataAnakKe">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Jumlah Saudara kandung/tiri
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataJumlahSaudara">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Jumlah Saudara Sekolah/belum sekolah
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataJumlahSaudaraSekolah">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nama Ayah
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNamaAyah">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Pekerjaan Ayah
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataPekerjaanAyah">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nama Ibu
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNamaIbu">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Pekerjaan Ibu
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataPekerjaanIbu">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Agama ayah/ibu
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataAgamaAyahIbu">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Tanggungan keluarga
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataTanggunganKeluarga">
                                : -
                            </td>
                        </tr>
                    </table>
                    <h2 class="text-base font-bold text-emerald-800 mb-3 pt-3">Informasi Akademik</h2>
                    <table class="table w-full">
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nisn
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNisn">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Asal Sekolah
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataAsalSekolah">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Nomor STTB
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataNoSttb">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Tahun STTB
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataTahunSttb">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                pilihan program studi
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataProgramStudi">
                                : -
                            </td>
                        </tr>
                    </table>
                    <h2 class="text-base font-bold text-emerald-800 mb-3 pt-3">Informasi Lain</h2>
                    <table class="table w-full">
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Tinggi Badan
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataTinggiBadan">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Berat Badan
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataBeratBadan">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Golongan darah
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataGolonganDarah">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Penyakit Kronis
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataPenyakitKronis">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Cita Cita
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataCitaCita">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Hobi
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataHobi">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Prestasi
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataPrestasi">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                Keahlian
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataKeahlian">
                                : -
                            </td>
                        </tr>
                        <tr>
                            <td class="w-1/2 text-xs sm:text-sm align-top">
                                ukuran seragam
                            </td>
                            <td class="max-w-1/2 text-xs sm:text-sm align-top" id="dataUkuranSeragam">
                                : -
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </form>
        <div class="px-8 mb-5 mt-10">
            <div class="formPage1 flex justify-between">
                <a href="/" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Kembali</a>
                <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium"
                    id="nextPage2">Selanjutnya</button>
            </div>
            <div class="formPage2 flex justify-between hidden">
                <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium"
                    id="backPage1">Kembali</button>
                <button id="nextPage3"
                    class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Selanjutnya</button>
            </div>
            <div class="formPage3 flex justify-between hidden">
                <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium"
                    id="backPage2">Kembali</button>
                <button id="nextPage4"
                    class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Selanjutnya</button>
            </div>
            <div class="formPage4 flex justify-between hidden">
                <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium"
                    id="backPage3">Kembali</button>
                <button id="nextPage5"
                    class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium">Selanjutnya</button>
            </div>
            <div class="formPage5 flex justify-between hidden">
                <button type="button" class="bg-lime-700 text-white rounded-lg px-4 py-2 text-sm font-medium"
                    id="backPage4">Kembali</button>
                    <button data-modal-target="confirm-modal" data-modal-toggle="confirm-modal"
                    class="block text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800"
                    type="button">
                    Submit
                </button>
            </div>
        </div>
    </div>

    <div id="confirm-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Konfirmasi Data
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="confirm-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        Pastikan data yang anda masukkan sudah benar, agar tidak terjadi kesalahan dalam proses
                    </p>
                </div>
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button id="subButton" data-modal-hide="confirm-modal" type="button"
                        class="text-white bg-lime-700 hover:bg-lime-800 focus:ring-4 focus:outline-none focus:ring-lime-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-lime-600 dark:hover:bg-lime-700 dark:focus:ring-lime-800">
                        Submit</button>
                    <button data-modal-hide="confirm-modal" type="button"
                        class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-lime-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="w-full py-4 px-8">
        <div class="flex items-center justify-center">
            <img src="/image/logo.png" class="h-10" alt="logo">
            <h1 class="text-xs font-bold text-emerald-800 text-center">SMK Terpadu Ad-Dimyati</h1>
        </div>
    </div>
@endsection
@push('script')
    <script src="/js/nik_parse.min.js"></script>
    <script>
        $(document).ready(function() {
            const page = '{{ session('page') ?? 1 }}'
            const walicek = '{{ old('walicek') ?? 'off' }}';
            if (walicek == 'on') {
                waliMenu('show');
            }
            goToPage(page);
        });
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
            nextPage(1);
        });
        $('#nextPage3').on('click', function() {
            nextPage(2);
        });
        $('#nextPage4').on('click', function() {
            nextPage(3);
        });
        $('#nextPage5').on('click', function() {
            drawList();
            nextPage(4);
        });
        $('#backPage1').on('click', function() {
            backPage(2);
        });
        $('#backPage2').on('click', function() {
            backPage(3);
        });
        $('#backPage3').on('click', function() {
            backPage(4);
        });
        $('#backPage4').on('click', function() {
            backPage(5);
        });

        $('#subButton').on('click', function() {
            $('#formPendaftaran').submit();
        });

        function nextPage(page) {
            $('.formPage' + page).addClass('hidden');
            $('.formPage' + (page + 1)).removeClass('hidden');
        }

        function backPage(page) {
            $('.formPage' + page).addClass('hidden');
            $('.formPage' + (page - 1)).removeClass('hidden');
        }

        function goToPage(page) {
            $('.page0').addClass('hidden');
            $('.formPage1').addClass('hidden');
            $('.formPage2').addClass('hidden');
            $('.formPage3').addClass('hidden');
            $('.formPage4').addClass('hidden');
            $('.formPage5').addClass('hidden');

            $('.formPage' + page).removeClass('hidden');
        }

        $('#walicekbox').on('click', function() {
            if ($(this).is(':checked')) {
                waliMenu('show');
            } else {
                waliMenu('hide');
            }
        });

        function waliMenu(view) {
            if (view == 'show') {
                $('.walifield').removeClass('hidden');
            } else {
                $('.walifield').addClass('hidden');
            }
        }

        function collectData() {
            let dataform = $('#formPendaftaran').serializeArray();
            let data = {};
            $.each(dataform, function(i, field) {
                data[field.name] = field.value;
            });
            return data;
        }

        function drawList() {
            let data = collectData();
            let jenisKelamin = data.jenis_kelamin == 'l' ? 'Laki-laki' : (data.jenis_kelamin == 'p' ? 'Perempuan' : '-');
            let programStudiList = '{{ json_encode($jurusan) }}';
            programStudiList = JSON.parse(programStudiList.replace(/&quot;/g, '"'));
            let programStudi = programStudiList.find(x => x.id == data.program_studi);
            let programStudiPilihan2 = programStudiList.find(x => x.id == data.program_studi_pilihan_2);
            programStudi = programStudi ? programStudi.nama : '';
            programStudiPilihan2 = programStudiPilihan2 ? programStudiPilihan2.nama : '';

            $('#dataNama').html(data.nama_lengkap ? ': ' + data.nama_lengkap : ': -');
            $('#dataNamaPanggilan').html(data.nama_panggilan ? ': ' + data.nama_panggilan : ': -');
            $('#dataNik').html(data.nik ? ': ' + data.nik : ': -');
            $('#dataTglLahir').html(data.tanggal_lahir ? ': ' + data.tanggal_lahir : ': -');
            $('#dataTempatLahir').html(data.tempat_lahir ? ': ' + data.tempat_lahir : ': -');
            $('#dataJenisKelamin').html(jenisKelamin ? ': ' + jenisKelamin : ': -');
            const alamat = data.jalan + ', ' + data.gang + ', ' + data.rt + '/' + data.rw + ', ' + data.no_rumah + ', ' +
                data.desa + ', ' + data.kecamatan + ', ' + data.kota + ', ' + data.provinsi + ', ' + data.kode_pos;
            if (data.jalan || data.gang || data.rt || data.rw || data.no_rumah || data.desa || data.kecamatan || data
                .kota || data.provinsi || data.kode_pos) {
                $('#dataAlamat').html(': ' + alamat);
            } else {
                $('#dataAlamat').html(': -');
            }
            $('#dataAgama').html(data.agama ? ': ' + data.agama : ': -');
            $('#dataNoHp').html(data.no_hp ? ': ' + data.no_hp : ': -');
            $('#dataAnakKe').html(data.anak_ke ? ': ' + data.anak_ke : ': -');
            $('#dataJumlahSaudara').html(data.saudara ? ': ' + data.saudara + (data.saudara_tiri ? '/' + data.saudara_tiri :
                '') : ': -');
            $('#dataJumlahSaudaraSekolah').html(data.sudah_sekolah ? ': ' + data.sudah_sekolah + (data.belum_sekolah ? '/' +
                data.belum_sekolah : '') : ': -');
            $('#dataNamaAyah').html(data.nama_ayah ? ': ' + data.nama_ayah : ': -');
            $('#dataPekerjaanAyah').html(data.pekerjaan_ayah ? ': ' + data.pekerjaan_ayah : ': -');
            $('#dataNamaIbu').html(data.nama_ibu ? ': ' + data.nama_ibu : ': -');
            $('#dataPekerjaanIbu').html(data.pekerjaan_ibu ? ': ' + data.pekerjaan_ibu : ': -');
            $('#dataAgamaAyahIbu').html(data.agama_ayah && data.agama_ibu ? ': ' + data.agama_ayah + '/' + data.agama_ibu :
                ': -');
            $('#dataTanggunganKeluarga').html(data.tanggungan_keluarga ? ': ' + data.tanggungan_keluarga : ': -');
            $('#dataNisn').html(data.nisn ? ': ' + data.nisn : ': -');
            $('#dataAsalSekolah').html(data.asal_sekolah ? ': ' + data.asal_sekolah : ': -');
            $('#dataNoSttb').html(data.no_sttb ? ': ' + data.no_sttb : ': -');
            $('#dataTahunSttb').html(data.tahun_sttb ? ': ' + data.tahun_sttb : ': -');
            $('#dataProgramStudi').html(data.program_studi ? ': ' + programStudi + (programStudiPilihan2 ? '/' +
                programStudiPilihan2 : '') : ': -');
            $('#dataTinggiBadan').html(data.tinggi_badan ? ': ' + data.tinggi_badan : ': -');
            $('#dataBeratBadan').html(data.berat_badan ? ': ' + data.berat_badan : ': -');
            $('#dataGolonganDarah').html(data.golongan_darah && data.rhesus ? ': ' + data.golongan_darah + data.rhesus :
                ': -');
            $('#dataPenyakitKronis').html(data.penyakit_kronis ? ': ' + data.penyakit_kronis : ': -');
            $('#dataCitaCita').html(data.cita_cita ? ': ' + data.cita_cita : ': -');
            $('#dataHobi').html(data.hobi ? ': ' + data.hobi : ': -');
            $('#dataPrestasi').html(data.prestasi ? ': ' + data.prestasi : ': -');
            $('#dataKeahlian').html(data.keahlian ? ': ' + data.keahlian : ': -');
            $('#dataUkuranSeragam').html(data.ukuran_seragam ? ': ' + data.ukuran_seragam : ': -');
        }
    </script>
@endpush
