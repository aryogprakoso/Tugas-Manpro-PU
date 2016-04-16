<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_indexroute extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('berita_model');
    }
    
    public function index(){
        redirect('c_beranda','refresh');
    }
}
?>

