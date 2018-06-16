<?php

namespace App\Http\Services\AccessControl;

use App\Http\Services\Tatuco\ParamService;
use Carbon\Carbon;

class ImageService
{
    /*
     *
     */

    public function images($images, $id = 'zippyttech')
    {
        //echo $images;
        $route = public_path().'/imagen/';//(new ParamService)->findValueForKey('UPLOAD_IMAGES')?:'/opt/tracking/images/';
        //$route_web = "http://192.168.0.115:8000/images/";
        //$route_web = "http://qatracking.zippyttech.com:8000/images/";
        $route_web = (new ParamService)->findValueForKey('UPLOAD_IMAGES')?:'/opt/AccessControl/images/';
//        echo $route_web;
        $now = Carbon::now()->format('Y-m-d');
        define('UPLOAD_DIR', $route);
        /*if(empty($images)){
            return $images = $route_web."5aba522ba909a-zippyttech-2018-03-27.png";
        }else{*/
        //echo "Valor de la Imagen ImagenService=========".$images;
        $img = $images;
        // $resu = str_pos($img,'jpg');
        // echo "Imagen:".$img;
        $ext = $this->get_extension($img);
        //echo "Extension==".$ext;
        $img = str_replace('data:image/'.$ext.';base64,', '', $img);
        $data = base64_decode($img);
        /* echo $img;
         $ext = $this->get_extension($img);
         echo $ext;*/
        $var_for = uniqid().'-'.$id.'-'.$now. '.'.$ext;
        $file = UPLOAD_DIR . $var_for;
        //$ruta = $url+$file;
        //echo "Ruta=".$file;
        $image = $route_web . $var_for;
        $success = file_put_contents($file, $data);
        if ($success) {
            //return $file;
            return $image;
        }else {
            return null;
        }
        //  }
    }

    public function get_extension($string)
    {
        $extension="";
        if(!empty($string)){
            $formats = ["jpg", "jpeg", "png", "gif"];
            //$ex = strpos($string, )
            //echo "Cadena Image=".$string;
            //echo("Valor Encabezado".substr($string,0,4));
            if(substr($string,0,4)=='http')
            {
                return $extension=3;
            }else {
                $data = $string;
                $pos = strpos($data, ';');
                //echo "Valor del Pos=".$pos;
                $type = explode(':', substr($data, 0, $pos))[1];
                $extension = preg_split("[/]", $type);
                return $extension[1];
            }
        }else{
            return "Extension de la Imagen Vacia o en Blanco, Verifique";
        }
    }
}
