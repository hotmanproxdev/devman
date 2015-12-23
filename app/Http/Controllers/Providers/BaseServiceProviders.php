<?php

namespace App\Http\Controllers\Providers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class BaseServiceProviders extends Controller
{
    public function env()
    {
        if(preg_match('@local@is',gethostname()))
        {
            return 'developer';
        }

        return 'local';
    }

    public function json($data)
    {
        return json_encode($data);
    }

    public function jsonToArray($data)
    {
        return json_decode($data,true);
    }

    public function menuStatu($value)
    {
        $menu['small']['ul']='page-sidebar-menu page-sidebar-menu-hover-submenu page-sidebar-menu-closed ';
        $menu['small']['body']='page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo page-sidebar-closed page-sidebar-closed-hide-logo';

        $menu['normal']['ul']='page-sidebar-menu page-sidebar-menu-hover-submenu ';
        $menu['normal']['body']='page-boxed page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-sidebar-closed-hide-logo';

        return $menu[$value];

    }

    public function getLang($data)
    {
        //default word data
        $getWordDefault=DB::table("prosystem_words")->where(['url_path'=>'default','lang'=>$data['lang']])->get();

        //requested word data
        $getWord=DB::table("prosystem_words")->where($data)->get();

        if(count($getWord)==false)
        {
            //return
            $this->insertLang(['url_path'=>$data['url_path'],'word_data'=>['dashboard'=>'Test Sayfası','dashboard_info'=>'Test Sayfası Oluşturuldu'],'lang'=>1]);
            return array_merge(json_decode($getWordDefault[0]->word_data,true),json_decode(json_encode(array()),true));
        }

        //return
        return array_merge(json_decode($getWordDefault[0]->word_data,true),json_decode($getWord[0]->word_data,true));
    }

}
