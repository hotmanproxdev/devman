<?php
/**
 * Created by Ali Gurbuz.
 * User: spartan
 * Date: 28/03/16
 * Time: 10:01
 */

namespace App\Packages\tsql;
use App\Packages\tsql\appQuery as appQuery;

class appTable
{
    public $data=array("wanted_fields"=>[],'wanted_fields_row'=>false,'fillIn'=>[],'fieldCss'=>[],'contentCss'=>[]);
    public $appQuery;

    public function __construct(appQuery $appQuery)
    {
        $this->appQuery=$appQuery;
    }

    public function drawTable($data=false)
    {
        $this->data['fields']=$this->appQuery->getField($data['query']);
        $this->data['query']=$data['query'];

        if(array_key_exists("wanted_fields",$data))
        {
            $this->data['wanted_fields']=$data['wanted_fields'];

            if(array_key_exists("wanted_fields_row",$data))
            {
               if($data['wanted_fields_row'])
               {
                   $this->data['fields']=array();
                   foreach ($data['wanted_fields'] as $key=>$val)
                   {
                       $this->data['fields'][]=$key;
                   }
               }
            }

        }


        if(array_key_exists("fieldCss",$data))
        {
            $this->data['fieldCss']=$data['fieldCss'];
        }

        if(array_key_exists("contentCss",$data))
        {
            $this->data['contentCss']=$data['contentCss'];
        }

        if(array_key_exists("fillIn",$data))
        {
            if(count($data['fillIn']))
            {
                if(array_key_exists("matching",$data['fillIn']))
                {
                    foreach ($data['fillIn']['matching'] as $key=>$value)
                    {
                        $this->data['fillIn']['matching'][$key]=$value;
                    }
                }
            }
        }



        //return view
        return view("".config("app.admin_dirname").".tsql_table",$this->data);
    }


}