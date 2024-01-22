<?php

namespace App\Providers;

use App\Models\Ppdb;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('nik', function ($attribute, $value, $parameters, $validator) {
            if (preg_match('/^\d{16}$/', $value) !== 1) {
                return false;
            }

            $kodeWilayah = substr($value, 0, 6);
        
            $tanggalLahir = substr($value, 6, 6);
            $day = substr($tanggalLahir, 0, 2);
            $month = substr($tanggalLahir, 2, 2);
            $year = substr($tanggalLahir, 4, 2);
        
            if (!checkdate($month, $day, $year)) {
                return false;
            }

            $nomorUrut = substr($value, -4);
            return true;
        });

        Validator::replacer('nik', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'NIK tidak valid.');
        });

        Validator::extend('alphanum', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z0-9]+$/', $value);
        });

        Validator::replacer('alphanum', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Hanya boleh mengandung huruf dan angka.');
        });

        // aplha num space comma dot
        Validator::extend('alpha_space', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[a-zA-Z0-9,. ]+$/', $value);
        });

        Validator::replacer('alpha_space', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Hanya boleh mengandung huruf, angka, spasi, koma, dan titik.');
        });
    }

}
