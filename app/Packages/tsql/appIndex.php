<?php
/**
 * Created by Ali Gurbuz.
 * User: spartan
 * Date: 28/03/16
 * Time: 10:01
 */

namespace App\Packages\tsql;
use App\Packages\tsql\appTable as appTable;

class appIndex
{
    public $data=array();
    public $appTable;

    public function __construct(appTable $appTable)
    {
        $this->appTable=$appTable;
    }

    public function query($query=false)
    {
        if($query)
        {
            $this->data['query']=$query;
        }
        else
        {
            $this->data['query']=false;
        }

        return $this;
    }

    public function fields($fields=array(),$row=false)
    {
        if(count($fields))
        {
            $this->data['wanted_fields']=$fields;

            if($row)
            {
                $this->data['wanted_fields_row']=true;
            }
        }
        return $this;
    }


    public function contentIn($fill=array())
    {
        if(count($fill))
        {
            $this->data['fillIn']=$fill;
        }
        return $this;
    }

    public function fieldCss($fcss=array())
    {
        if(count($fcss))
        {
            $this->data['fieldCss']=$fcss;
        }
        return $this;
    }

    public function contentCss($ccss=array())
    {
        if(count($ccss))
        {
            $this->data['contentCss']=$ccss;
        }
        return $this;
    }

    public function run()
    {
        return $this->appTable->drawTable($this->data);
    }
}