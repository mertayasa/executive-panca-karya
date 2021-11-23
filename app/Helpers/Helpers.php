<?php

use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function uploadFile($base_64_foto, $folder, $savepdf = null)
{
    try {
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/' . $folder;

        $formatted_file_name = str_replace(' ', '-', $base_64_foto['name']);

        if (file_exists($folderName . '/' . $formatted_file_name)) {
            return $folder . '/' . $formatted_file_name;
        };

        if (!file_exists($folderName)) {
            mkdir($folderName, 0755, true);
        }

        if (isset($savepdf)) {
            if (!file_exists($folderName . '/pdf')) {
                mkdir($folderName . '/pdf', 0755, true);
            }
        }

        // dd('asdas');

        // return $folderName;

        $safeName = time() . $formatted_file_name;
        $inventoriePath = public_path() . '/' . $folderName;
        file_put_contents($inventoriePath . '/' . $safeName, $foto);

        if (isset($savepdf)) {
            ConvertApi::setApiSecret(env('CONVERT_API_KEY'));
            $result = ConvertApi::convert('pdf', ['File' => 'images/' . $folder . '/' . $safeName]);
            $result->getFile()->save(base_path() . '/public/images/' . $folder . '/' . 'pdf/' . $safeName . '.pdf');
        }
    } catch (Exception $e) {
        Log::info($e->getMessage());
        return 0;
    }

    return $folder . '/' . $safeName;
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
    return Carbon::parse($date)->isoFormat('DD MMM Y');
}
