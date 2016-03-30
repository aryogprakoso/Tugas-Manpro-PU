<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

if(!function_exists('htmlDivide')){
    function htmlDivide($html){
        $substring = array();
        $index_bawah = 0;
        $index_atas;
        while(true){
            if($index_bawah>=strlen($html)){
                break;
            }

            $index_atas = $index_bawah + 255; //length varchar

            if($index_atas > strlen($html)){
                $index_atas = strlen($html);
            }

            $substring[] = substr($html, $index_bawah, $index_atas - $index_bawah);

            $index_bawah = $index_atas;
        }
        return $substring;
    }
}

if(!function_exists('htmlJoin')){
    function htmlJoin($substring){
        $html = "";
        for($i = 0; $i < count($substring); $i++){
            $html .= $substring[$i];
        }
        return $html;
    }
}
?>