<?php

namespace App\Http\Controllers\Manager\Services;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Routing\ResponseFactory;

class postDataController extends Controller
{
    public $request;

    public function __construct (Request $request)
    {
        $this->request=$request;
    }

    public function output($data,$ext=array())
    {
        if(!$this->request->ajax())
        {
            if(count($ext))
            {
                if(array_key_exists("redirect",$ext))
                {
                    return redirect("".config("app.admin_dirname")."/".$ext['redirect']."");
                }
                return response()->json($data);
            }
            return $data;
        }

        if(count($data))
        {
            return response()->json([
                'result' => true, 'cookie' => $this->request->header('Cookie'),'data'=>$data
            ]);
        }

        return response()->json([
            'result' => false, 'cookie' => $this->request->header('Cookie'),'data'=>$data
        ]);

    }
}
