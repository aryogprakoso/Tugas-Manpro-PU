<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

if(!function_exists('assets')){
    function assets(){
        return base_url()."assets/";
    }
}
?>