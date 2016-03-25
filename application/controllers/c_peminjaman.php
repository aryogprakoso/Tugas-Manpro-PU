<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_peminjaman extends CI_Controller{


    public function index(){
     	$this->load->view('v_peminjaman');   
    }
    
    public function lihat_data()
    {
        //CEK apakah ada POST dengan KEY 'waktu'
        if($this->input->post('waktu'))
        {
            //jika ada POST dengan KEY 'waktu' LOAD model 'peminjaman_model'
            $this->load->model('peminjaman_model');
            //lempar VALUE dari POST dengan KEY 'waktu' ke fungsi lihatData pada model 'peminjaman_model'
            $this->peminjaman_model->lihatData($this->input->post('waktu'));
        }
    }
    
    public function tambah_data()
    {
        
    }

}

?>