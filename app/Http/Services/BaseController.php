<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{

    public function __construct()
    {
        //base service provider
        $this->app=app()->make("Base");
    }

    public function test()
    {
        return 'asa';
    }

    /**
     * Copy a file, or recursively copy a folder and its contents
     * @author      Aidan Lister <aidan@php.net>
     * @version     1.0.1
     * @link        http://aidanlister.com/2004/04/recursively-copying-directories-in-php/
     * @param       string   $source    Source path
     * @param       string   $dest      Destination path
     * @param       int      $permissions New folder creation permissions
     * @return      bool     Returns true on success, false on failure
     */
    public function xcopy($source, $dest, $permissions = 0777)
    {
        // Check for symlinks
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }

        // Simple copy for a file
        if (is_file($source)) {
            return copy($source, $dest);
        }


        // Make destination directory
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }


        // Loop through the folder
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }

            // Deep copy directories
            $this->xcopy("$source/$entry", "$dest/$entry", $permissions);
        }

        // Clean up
        $dir->close();
        return true;
    }


    public function listFolderFiles($dir,$slash,$x=false)
    {
        $ffs = scandir($dir);

        if($x)
        {

        }
        else
        {
            $list=[];
        }

        foreach($ffs as $ff){
            if($ff != '.' && $ff != '..'){
                $path="".$dir."/".$ff."";


                if(is_dir($path))
                {
                    $list[]=$this->listFolderFiles($path,$slash,true);
                }
                else
                {
                   $list[]=$path;

                }
            }
        }



     return $list;


    }
}
