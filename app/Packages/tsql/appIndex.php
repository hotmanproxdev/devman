<?php
/**
 * Created by Ali Gurbuz.
 * User: spartan
 * Date: 28/03/16
 * Time: 10:01
 */

namespace App\Packages\tsql;
use App\Packages\tsql\appTable as appTable;
use Illuminate\Http\Request;

class appIndex
{
    public $data=array();
    public $appTable;
    public $request;

    public function __construct(Request $request,appTable $appTable)
    {
        $this->appTable=$appTable;
        $this->request=$request;
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
        foreach ($this->data['query'][0] as $key=>$value)
        {
            $list[]=$key;
        }

        if(count($fields))
        {
            $this->data['wanted_fields']=$fields;

            foreach ($fields as $key=>$value)
            {
                if(!in_array($key,$list))
                {
                    foreach ($this->data['query'] as $result)
                    {
                        $result->$key='';
                    }
                }
            }

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


    public function pagination($pagination=array())
    {
        if(count($pagination))
        {
            $this->data['pagination']=$pagination;
        }
        return $this;
    }


    public function filter($filter=array())
    {
        if(count($filter))
        {
            $this->data['filter']=$filter;
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
            if($this->request->ajax())
            {
                if(array_key_exists("tsqlpage",\Input::all()))
                {
                    //return view
                    $view=view("".config("app.admin_dirname").".tsql_table_main",$arg['data'])->renderSections();
                    return $view['tsqlpagination'];
                }
                //return view
                $view=view("".config("app.admin_dirname").".tsql_table_main",$arg['data'])->renderSections();
                return $view['tsqltable'];
            }


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
            if(array_key_exists("fillIn",$this->data))
            {
                foreach ($this->data['fillIn']['matching'] as $key=>$val)
                {
                    if(in_array($key,$field))
                    {
                        $list[$key]=$val;
                    }
                }
            }


            return call_user_func_array($callback,array($list));
        }


        if(array_key_exists("sql",$field['list']))
        {
            //$field['data']['query']=$field['list']['sql'];
        }


        foreach ($field['list'] as $key=>$val)
        {
            if(array_key_exists("query",$field['list'][$key]))
            {
                if(!is_array($field['list'][$key]['query']))
                {
                    if(is_callable($field['list'][$key]['query']))
                    {
                        $cuf=call_user_func_array($field['list'][$key]['query'],array($field['data']['query']));

                        foreach ($field['data']['query'] as $x=>$result)
                        {
                            $result->$key=$cuf[$x];
                        }
                    }
                    else
                    {
                        foreach ($field['data']['query'] as $x=>$result)
                        {
                            $result->$key=$field['list'][$key]['query'][$x];
                        }
                    }


                }

            }

        }

        return $field['data'];
    }
}