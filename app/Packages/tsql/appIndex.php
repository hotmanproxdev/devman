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
                foreach ($field['list'][$key]['query'] as $qkey=>$qvalue)
                {
                    $keyex=explode(":",$qkey);


                    if($keyex[0]==$keyex[1])
                    {
                        foreach ($field['data']['query'] as $result)
                        {
                            if(array_key_exists($qvalue,$field['data']['fillIn']['matching']))
                            {
                                $result->$key=$field['data']['fillIn']['matching'][$qvalue][$result->$qvalue];
                            }
                            else
                            {
                                $result->$key=$result->$qvalue;
                            }

                        }
                    }
                    else
                    {
                        foreach (explode("|",$keyex[1]) as $mval)
                        {

                            foreach ($field['data']['query'] as $result)
                            {
                                if($result->$keyex[0]==$mval)
                                {
                                    if($key=="all")
                                    {
                                        $exclist=[];
                                        if(array_key_exists("except",$field['list'][$key]))
                                        {
                                            foreach ($field['list'][$key]['except'] as $exc)
                                            {
                                                $exclist[]=$exc;
                                            }
                                        }

                                        foreach ($field['data']['fields'] as $f)
                                        {
                                            if($f!=="id" && !in_array($f,$exclist))
                                            {
                                                $result->$f=$qvalue;
                                            }

                                        }

                                    }
                                    else
                                    {
                                        $result->$key=$qvalue;
                                    }

                                }

                            }
                        }

                        foreach ($field['data']['query'] as $result)
                        {
                            if(!in_array($result->$keyex[0],explode("|",$keyex[1])))
                            {
                                if(array_key_exists("default",$field['list'][$key]))
                                {
                                    $result->$key=$field['list'][$key]['default'];
                                }
                            }
                        }
                    }


                }
            }
            else
            {
                if(!array_key_exists($key, $field['data']['fillIn']['matching']))
                {
                    $field['data']['fillIn']['matching'][$key]=$field['list'][$key];
                }


                if(array_key_exists($key,$field['data']['fillIn']['matching']))
                {
                    foreach ($field['data']['fillIn']['matching'][$key] as $a=>$b)
                    {
                        if(array_key_exists("all",$field['list'][$key]))
                        {
                            if(is_array($field['list'][$key]['all']))
                            {
                                if(array_key_exists("date",$field['list'][$key]['all']))
                                {
                                    foreach ($field['data']['query'] as $result)
                                    {
                                        $result->$key=date($field['list'][$key]['all']['date'],$result->$key);
                                    }
                                }
                            }
                            else
                            {
                                foreach ($field['data']['query'] as $result)
                                {
                                    $result->$key=$field['list'][$key]['all'];
                                }
                                //$field['data']['fillIn']['matching'][$key][$a]=$field['list'][$key]['all'];
                            }

                        }
                        else
                        {
                            if(array_key_exists($a,$field['list'][$key]))
                            {
                                if(is_array($field['list'][$key][$a]))
                                {
                                    if(array_key_exists("date",$field['list'][$key][$a]))
                                    {
                                        $field['data']['fillIn']['matching'][$key][$a]=date($field['list'][$key][$a]['date'],$a);
                                    }

                                }
                                else
                                {
                                    $field['data']['fillIn']['matching'][$key][$a]=$field['list'][$key][$a];
                                }

                            }
                            else
                            {
                                $field['data']['fillIn']['matching'][$key][$a]=$b;
                            }
                        }


                    }

                }
                else
                {
                    $field['data']['fillIn']['matching'][$key]=$field['list'][$key];
                }
            }



        }

        return $field['data'];
    }
}