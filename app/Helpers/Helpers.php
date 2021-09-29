<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function uploadFile($base_64_foto)
{
    try {
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/uploaded/';
        $safeName = time() . $base_64_foto['name'];
        $destinationPath = public_path() . '/' . $folderName;
        file_put_contents($destinationPath . $safeName, $foto);
    } catch (Exception $e) {
        Log::info($e->getMessage());
        return 0;
    }

    return $safeName;
}

function getGender($gender)
{
    return $gender == 0 ? 'Laki-Laki' : 'Perempuan';
}

function getRoleName()
{
    return Auth::user()->level == 0 ? 'staff' : 'pimpinan';
}

function formatPrice($value)
{
    return 'Rp ' . number_format($value, 0, ',', '.');
}

function formatPriceRaw($value)
{
    return number_format($value, 0, ',', '.');
}

function indonesianDate($date)
{
    return Carbon::parse($date)->isoFormat('LL');
}


function getStatus($active_status)
{
    return $active_status == 0 ? 'Tidak Aktif' : 'Aktif';
}

function getCategory($category)
{
    return $category == 0 ? 'Perorangan' : 'Instansi';
}

function indonesianDateNew($date)
{
    return Carbon::parse($date)->isoFormat('ll');
}
