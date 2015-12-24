<?php

namespace App\Http\Controllers\Manager\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class fileUploadController extends Controller
{
    public function upload($data,$sql=array())
    {
        // GET ALL THE INPUT DATA , $_GET,$_POST,$_FILES.
        $input = $data['input'];

        $file = array_get($input,$data['name']);
        // SET UPLOAD PATH
        $destinationPath = $data['path'];
        // GET THE FILE EXTENSION
        $extension = $file->getClientOriginalExtension();
        // RENAME THE UPLOAD WITH RANDOM NUMBER
        $fileName = rand(11111, 99999) . '.' . $extension;
        // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY
        $upload_success = $file->move($destinationPath, $fileName);

        // IF UPLOAD IS SUCCESSFUL SEND SUCCESS MESSAGE OTHERWISE SEND ERROR MESSAGE
        if ($upload_success) {
            return 'basarili';
        }
    }
}
