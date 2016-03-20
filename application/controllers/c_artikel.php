<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_artikel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }
    
    public function index(){
     	$this->load->view('v_artikel');   
    }
    
    public function create(){
        $judulArtikel = $this->input->post('judulArtikel');
        $isiArtikel = $this->input->post('isiArtikel');
        $foto = time().$_FILES['userfile']['name'];
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
        //$configUpload['file_name'] = $foto;
        $this->load->library('upload', $this->config);
        //$this->upload->initialize($configUpload);
        if($this->upload->do_upload($foto)){
            echo "file upload success";
        }
        else{
           echo "file upload failed";
        }
    }
}

?>