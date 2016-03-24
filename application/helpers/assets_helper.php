<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed');

if(!function_exists('test_method')){
    function assets(){
        return base_url()."assets/";
    }
}
?>