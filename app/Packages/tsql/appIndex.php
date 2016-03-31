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



    public function name($name=false)
    {
        if($name)
        {
            $this->data['name']=$name;
        }
        else
        {
            $this->data['name']='noname';
        }

        return $this;
    }


    public function header($header=false)
    {
        if($header)
        {
            $this->data['header']=$header;
        }
        else
        {
            $this->data['header']='noheader';
        }

        return $this;
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


    public function contentIn($fill=array(),$callback=false)
    {
        if(count($fill))
        {
            $this->data['fillIn']=$fill;
        }
        if(is_callable($callback))
        {
            call_user_func_array($callback,array($this->data['fillIn']));
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

    public function run($callback=false,$arg=array())
    {
        if(is_callable($callback))
        {
            return call_user_func_array($callback,array($this->run(1)));
        }

        if(count($arg))
        {
            //return view
            return view("".config("app.admin_dirname").".tsql_table",$arg['data']);
        }

        return $this->appTable->drawTable($this->data,$callback);
    }


    public function update($field,$callback=false)
    {
        if(is_callable($callback))
        {
            $list=[];
            foreach ($this->data['fillIn']['matching'] as $key=>$val)
            {
                if($field==$key)
                {
                    $list[$key]=$val;
                }
            }

            return call_user_func_array($callback,array($list));
        }


        foreach ($field['list'] as $key=>$val)
        {
            if(array_key_exists($key,$field['data']['fillIn']['matching']))
            {
                foreach ($field['data']['fillIn']['matching'][$key] as $a=>$b)
                {
                    if(array_key_exists($a,$field['list'][$key]))
                    {
                        $field['data']['fillIn']['matching'][$key][$a]=$field['list'][$key][$a];
                    }
                    else
                    {
                        $field['data']['fillIn']['matching'][$key][$a]=$b;
                    }

                }
            }
            else
            {
                $field['data']['fillIn']['matching']=$field['list'];
            }

        }

        return $field['data'];
    }
}