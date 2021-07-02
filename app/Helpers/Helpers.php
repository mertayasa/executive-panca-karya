<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

function uploadFile($base_64_foto){
    try{
        $foto = base64_decode($base_64_foto['data']);
        $folderName = 'images/uploaded/';
        $safeName = time().$base_64_foto['name'];
        $destinationPath = public_path().'/' . $folderName;
        file_put_contents($destinationPath.$safeName, $foto);
    }catch(Exception $e){
        Log::info($e->getMessage());
        return 0;
    }

    return $safeName;
}
