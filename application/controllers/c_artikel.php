<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_artikel extends CI_Controller{


    public function index(){
     	$this->load->view('v_artikel');   
    }

}

?>