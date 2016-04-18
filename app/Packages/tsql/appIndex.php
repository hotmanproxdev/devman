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
use App\Packages\tsql\appQuery as appQuery;

class appIndex
{
    public $data=array();
    public $appTable;
    public $request;
    public $appQuery;
    public $app;
    public $admin;

    public function __construct(Request $request,appTable $appTable,appQuery $appQuery)
    {
        $this->appTable=$appTable;
        $this->request=$request;
        $this->appQuery=$appQuery;
        //base service provider
        $this->app=app()->make("Base");
        //admin data
        $this->admin=$this->app->admin();
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

    public function fields($fields=array(),$row=false,$auth=array())
    {
        $authfield=[];
        if(array_key_exists("auth",$auth))
        {
            if(count($auth['auth']))
            {
                foreach ($auth['auth'] as $key=>$function)
                {
                    if(is_callable($function))
                    {
                        $liste=call_user_func($function);
                        $authfield[$key]=$liste;
                    }
                }
            }
        }



        foreach ($this->data['query'][0] as $key=>$value)
        {
            $list[]=$key;
        }

        if(count($fields))
        {
            foreach ($fields as $ff=>$f)
            {
                if(array_key_exists($ff,$authfield))
                {
                    if($authfield[$ff]==true)
                    {
                        $flist[$ff]=$f;
                    }
                }
                else
                {
                    $flist[$ff]=$f;
                }
            }

            $fields=[];
            $fields=$flist;



            $this->data['wanted_fields']=$fields;

            foreach ($fields as $key=>$value)
            {
                if(!in_array($key,$list) and array_key_exists($key,$this->appQuery->getField($this->data['query'])))
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

            $arg['data']['lang']=$this->app->getLang(['url_path'=>'default','lang'=>$this->admin->lang]);


            if($this->request->ajax())
            {
                if(array_key_exists("changesql",\Input::all()))
                {
                    if($arg['data']['name']==\Input::get("pxname"))
                    {
                        foreach ($arg['data']['filter'] as $ckey=>$cval)
                        {
                            if($cval['name']==\Input::get("changesql"))
                            {
                                if(array_key_exists("changesql",$cval))
                                {
                                    if(is_callable($cval['changesql']['query']))
                                    {
                                        $changesqlcall=call_user_func_array($cval['changesql']['query'],array(\Input::get("changesqlval")));

                                        if(array_key_exists("none",$cval['default']))
                                        {
                                            $lchange[]='<option value="none">'.$cval['default']['none'].'</option>';
                                        }

                                        foreach ($changesqlcall as $lkey=>$lval)
                                        {
                                            $lchange[]='<option value="'.$lkey.'">'.$lval.'</option>';
                                        }

                                        return implode("",$lchange);
                                    }

                                }



                            }
                        }
                    }
                    else
                    {
                        return '';
                    }


                }
                if(array_key_exists("tsqlpage",\Input::all()))
                {
                    //return view
                    $viewPag=view("".config("app.admin_dirname").".tsql_table_main",$arg['data'])->renderSections();

                    $viewListPag='tsqlpagination_'.\Input::get("pxname");

                    if(array_key_exists($viewListPag,$viewPag))
                    {
                        return $viewPag[$viewListPag];
                    }
                    else
                    {
                        return '';
                    }

                }


                //return view
                $view=view("".config("app.admin_dirname").".tsql_table_main",$arg['data'])->renderSections();


                if(array_key_exists("filter",\Input::all()))
                {
                    $viewList='tsqltable_'.\Input::get("filter");
                }
                else
                {
                    $viewList='tsqltable_'.\Input::get("pxname");
                }



                if(array_key_exists($viewList,$view))
                {
                    return $view[$viewList];
                }
                else
                {
                    return '';
                }


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