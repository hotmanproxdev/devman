<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EnvironmentController extends Controller
{

    public $request;
    public $app;
    public $paths=array("Api"=>'App\Http\Controllers\Api\Custom');
    public $apiversion='V1';
    public $data=array();
    public $method;
    public $name=null;
    public $load=null;
    public $main=null;
    public $model='Source';
    public $provision=false;

    public function __construct(Request $request)
    {
        //request method
        $this->request=$request;
        //base service provider
        $this->app=app()->make("Base");
    }

    public function system($system=array())
    {
        if(count($system))
        {
            $this->data=array_merge($this->data,$system);
            return $this;
        }
    }

    public function get($method)
    {
        $this->method=$method;
        return $this;
    }

    public function name($name)
    {
        $this->name=$name;
        return $this;
    }

    public function load($load)
    {
        $this->load=$load;
        return $this;
    }

    public function main()
    {
        $this->main='main';
        return $this;
    }

    public function model()
    {
        $this->model='Model';
        return $this;
    }

    public function run ($arg=false)
    {
        if($this->data[1]=="Api")
        {
            if(preg_match('@\\\V(\d+)\\\@is',$this->data[0],$v))
            {
                $aversion='V'.$v[1].'';
            }

            $originalclass=explode("\\",$this->data[0]);
            $class=explode("\\",$this->data[0]);
            unset($class[key( array_slice( $class, -1, 1, TRUE ) )]);

            if($this->name!==NULL)
            {
                unset($class[key( array_slice( $class, -1, 1, TRUE ) )]);


                $exist=\App\Models\ApiModels::where("custom_models","=",$this->name)->where("version","=",1)->get();
                $dir=str_replace("V1/","",$exist[0]->custom_dir);


                if($this->load!==NULL)
                {
                    if($this->main!==NULL)
                    {
                        $source='\\'.$this->paths['Api'].'\\'.$aversion.'\\'.$dir.'\\'.$this->load.'Api';
                    }
                    else
                    {
                        $source='\\'.$this->paths['Api'].'\\'.$aversion.'\\'.$dir.'\\'.$this->model.'\\'.$this->load.'Api'.$this->model.'';
                    }

                }
                else
                {
                    if($this->main!==NULL)
                    {
                        $source='\\'.$this->paths['Api'].'\\'.$aversion.'\\'.$dir.'\\'.$this->name.'Api';
                    }
                    else
                    {
                        $source='\\'.$this->paths['Api'].'\\'.$aversion.'\\'.$dir.'\\'.$this->model.'\\'.$this->name.'Api'.$this->model.'';
                    }


                }



            }
            else
            {

                $source='\\'.implode("\\",$class).'\\'.$this->model.'\\'.end($originalclass).''.$this->model.'';
            }



            $method=($this->method==NULL) ? 'get' : $this->method;






            if($arg=="using")
            {
                return \DB::table($this->app->dbTable(['api_reference']))->select(['request_class',
                    'request_class_method','request_version','requested_version','created_at'])
                    ->where("requested_class","=",$source)->where("requested_class_method","=",$method)->get();
            }
            else
            {
                if(app()->env=="local")
                {
                    if(\Session("apref")==false)
                    {
                        //reference truncate
                        \DB::table($this->app->dbTable(['api_reference']))->where("request_class","=",$this->data[0])
                            ->where('request_class_method',"=",\Session("apiWorkingMethod"))->delete();

                        \Session::put("apref",true);
                    }



                    //reference control
                    $referenceControl=\DB::table($this->app->dbTable(['api_reference']))->where("request_class","=",$this->data[0])
                        ->where('request_class_method',"=",\Session("apiWorkingMethod"))
                        ->where("requested_class","=",$source)->where("requested_class_method","=",$method)->get();

                    if(preg_match('@\\\V(\d+)\\\@is',$this->data[0],$requestVersion))
                    {
                        $rVersion=$requestVersion[1];
                    }

                    if(preg_match('@\\\V(\d+)\\\@is',$source,$requestedVersion))
                    {
                        $reVersion=$requestedVersion[1];
                    }


                    if(count($referenceControl)==0 && \DB::table($this->app->dbTable(['api_reference']))->insert(['request_class'=>$this->data[0],
                            'request_class_method'=>\Session("apiWorkingMethod"),'requested_class'=>$source,'requested_class_method'=>$method,
                            'request_version'=>$rVersion,'requested_version'=>$reVersion,'created_at'=>time()]))
                    {

                        if($this->main!==NULL)
                        {
                            \Session::put("mainSource",true);
                            $mainarray=json_decode(app($source)->$method($arg),1);
                            return $mainarray['query'];
                        }
                        return app($source)->$method($arg);
                    }
                }


                return app($source)->$method($arg);


            }





        }

    }

    public function handle ($arg=false)
    {
        if($this->data[1]=="Api")
        {
            if(preg_match('@\\\V(\d+)\\\@is',$this->data[0],$v))
            {
                $aversion='V'.$v[1].'';
            }

            $originalclass=explode("\\",$this->data[0]);
            $class=explode("\\",$this->data[0]);
            unset($class[key( array_slice( $class, -1, 1, TRUE ) )]);

            if($this->name!==NULL)
            {
                unset($class[key( array_slice( $class, -1, 1, TRUE ) )]);

                $source='\\'.$this->paths['Api'].'\\'.$aversion.'\\'.$this->name.'\\HandleServer';
            }

            $method=($this->method==NULL) ? 'get' : $this->method;


            if(app()->env=="local")
            {
                if(\Session("apref")==false)
                {
                    //reference truncate
                    \DB::table($this->app->dbTable(['api_reference']))->where("request_class","=",$this->data[0])
                        ->where('request_class_method',"=",\Session("apiWorkingMethod"))->delete();

                    \Session::put("apref",true);
                }


                //reference control
                $referenceControl=\DB::table($this->app->dbTable(['api_reference']))->where("request_class","=",$this->data[0])
                    ->where('request_class_method',"=",\Session("apiWorkingMethod"))
                    ->where("requested_class","=",$source)->where("requested_class_method","=",$method)->get();

                if(preg_match('@\\\V(\d+)\\\@is',$this->data[0],$requestVersion))
                {
                    $rVersion=$requestVersion[1];
                }

                if(preg_match('@\\\V(\d+)\\\@is',$source,$requestedVersion))
                {
                    $reVersion=$requestedVersion[1];
                }

                if(count($referenceControl)==0 && \DB::table($this->app->dbTable(['api_reference']))->insert(['request_class'=>$this->data[0],
                        'request_class_method'=>\Session("apiWorkingMethod"),'requested_class'=>$source,'requested_class_method'=>$method,
                        'request_version'=>$rVersion,'requested_version'=>$reVersion,'created_at'=>time()]))
                {
                    return app($source)->$method($arg);
                }
            }

            return app($source)->$method($arg);

        }

    }


    public function provision($method=false)
    {
        if($this->data[1]=="Api")
        {
            if($method)
            {
                return app("\App\Http\Controllers\Api\ProvisionApi")->$method();
            }

            return app("\App\Http\Controllers\Api\ProvisionApi")->run();
        }

    }

    public function make ($methods,$callback)
    {
        $value=false;

        $booleanList=[];
        $booleanListMessage=[];
        foreach ($methods as $m)
        {
            $mclass=app("\App\Http\Controllers\Api\ProvisionApi")->$m();

            $booleanList[]=$mclass['success'];

            if($mclass['success']==false)
            {
                $booleanListMessage[]=$mclass['msg'];
            }

        }



        if(!in_array(false,$booleanList))
        {
            return ['success'=>true];
        }


        if($value)
        {
            if(is_callable($callback))
            {
                return call_user_func($callback);
            }
        }

        return ['success'=>false,'msg'=>$booleanListMessage[0]];

    }


    public function showUsing ($method)
    {
        $methodex=explode("::",$method);

        $method="\\".$methodex[0]."";

        return \DB::table($this->app->dbTable(['api_reference']))->select(['request_class',
            'request_class_method','request_version','requested_version','created_at'])->where("requested_class","=",$method)->where("requested_class_method","=",$methodex[1])->get();
    }




}
