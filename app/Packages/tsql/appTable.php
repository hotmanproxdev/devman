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
    public $data=array("wanted_fields"=>[],'wanted_fields_row'=>false,'fillIn'=>[],'fieldCss'=>[],'contentCss'=>[],'pagination'=>['status'=>false]);
    public $appQuery;
    public $app;

    public function __construct(appQuery $appQuery)
    {
        $this->appQuery=$appQuery;
        $this->app=app()->make("Base");
    }

    public function drawTable($data=false,$callback=false)
    {
        $this->data['name']=$data['name'];
        $this->data['header']=$data['header'];
        $this->data['original']=$this->appQuery->getField($data['query']);
        $this->data['fields']=$this->appQuery->getField($data['query']);
        $this->data['query']=$data['query'];


        //wanted fields
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

        //field css
        if(array_key_exists("fieldCss",$data))
        {
            $this->data['fieldCss']=$data['fieldCss'];
        }


        //content css
        if(array_key_exists("contentCss",$data))
        {
            $this->data['contentCss']=$data['contentCss'];
        }

        //field css
        if(array_key_exists("pagination",$data))
        {
            $this->data['pagination']=$data['pagination'];
        }

        //fill in
        if(array_key_exists("fillIn",$data))
        {
            if(count($data['fillIn']))
            {

                //matching
                if(array_key_exists("matching",$data['fillIn']))
                {
                    foreach ($data['fillIn']['matching'] as $key=>$value)
                    {
                        if(in_array($key,$this->data['original']))
                        {
                            if(!is_array($value))
                            {
                                if(preg_match('@query.*@is',$value))
                                {
                                    $valuex=explode(":",$value);

                                    foreach ($data['query'] as $result)
                                    {
                                        if(is_numeric($result->$key))
                                        {
                                            $smquery=\DB::table($this->app->dbTable([$valuex[1]]))->where("id","=",$result->$key)->get()[0]->$valuex[2];

                                            $sqlmatchlist[$result->$key]=$smquery;
                                        }
                                        else
                                        {
                                            $sqlmatchlist[$result->$key]='';
                                        }

                                    }

                                    $this->data['fillIn']['matching'][$key]=$sqlmatchlist;
                                }
                            }
                            else
                            {
                                $this->data['fillIn']['matching'][$key]=$value;
                            }

                        }

                    }
                }




                //img manager
                if(array_key_exists("img",$data['fillIn']))
                {
                    foreach ($data['fillIn']['img'] as $key=>$value)
                    {
                        if(array_key_exists("query",$value))
                        {
                            $valuex=explode(":",$value['query']);

                            foreach ($data['query'] as $result)
                            {
                                $sqlimglist[$result->id]=\DB::table($this->app->dbTable([$valuex[1]]))->where("id","=",$result->$valuex[0])->get()[0]->$valuex[2];
                            }
                        }
                        $this->data['fillIn']['img'][$key]=$sqlimglist;
                        $this->data['fillIn']['img']['path']=$data['fillIn']['img'][$key]['path'];

                        if(array_key_exists("style",$data['fillIn']['img'][$key]))
                        {
                            $this->data['fillIn']['img']['style']=$data['fillIn']['img'][$key]['style'];
                        }
                        else
                        {
                            $this->data['fillIn']['img']['style']='width:50px; height:50px;';
                        }


                        if(array_key_exists("link",$data['fillIn']['img'][$key]))
                        {
                            $linkex=explode("/",$data['fillIn']['img'][$key]['link']);

                            $lex=[];
                            foreach ($linkex as $l)
                            {
                                foreach ($data['query'] as $result)
                                {
                                    if(preg_match('@:.*@is',$l,$lar))
                                    {
                                        $lf=str_replace(":","",$lar[0]);
                                        $lex[$result->id][$lar[0]] = $result->$lf;
                                    }

                                    if(array_key_exists($result->id,$lex))
                                    {
                                        if(array_key_exists($l,$lex[$result->id]))
                                        {
                                            $lx[$result->id][]=$lex[$result->id][$l];
                                        }
                                        else
                                        {
                                            $lx[$result->id][]=$l;
                                        }
                                    }
                                    else
                                    {
                                        $lx[$result->id][]=$l;
                                    }

                                }


                            }

                            foreach ($lx as $key=>$val)
                            {
                                $rlx[$key]=implode("/",$val);
                            }


                            $this->data['fillIn']['img']['link']=$rlx;
                        }


                    }
                }
            }
        }

        if($callback)
        {
            return $this->data;
        }

        //return view
        return view("".config("app.admin_dirname").".tsql_table",$this->data);
    }


}