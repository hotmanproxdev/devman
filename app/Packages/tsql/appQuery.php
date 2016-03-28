<?php
/**
 * Created by Ali Gurbuz.
 * User: spartan
 * Date: 28/03/16
 * Time: 10:01
 */

namespace App\Packages\tsql;


class appQuery
{
    public $data=array();

    public function getField($query=false)
    {
        if($query)
        {
            foreach ($query[0] as $key=>$value)
            {
                $list[]=$key;
            }

            return $list;
        }
    }


}