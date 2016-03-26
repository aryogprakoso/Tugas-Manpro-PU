<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_peminjaman extends CI_Controller{


    public function index(){
     	$this->load->view('v_peminjaman');   
    }
    
        
    public function tambah_peminjaman()
    {
        if($this->input->post('waktuModal') && $this->input->post('waktuSearch')  && $this->input->post('ruang') && $this->input->post('alat') && $this->input->post('keterangan') && $this->input->post('penanggungJawab'))
        {
            $this->load->model('peminjaman_model');
            $this->peminjaman_model->tambahPeminjaman($this->input->post());
        }
    }
    
    public function lihat_peminjaman()
    {
        //CEK apakah ada POST dengan KEY 'waktu'
        if($this->input->post('waktu'))
        {
            //jika ada POST dengan KEY 'waktu' LOAD model 'peminjaman_model'
            $this->load->model('peminjaman_model');
            //lempar VALUE dari POST dengan KEY 'waktu' ke fungsi lihatData pada model 'peminjaman_model'
            $this->peminjaman_model->lihatPeminjaman($this->input->post('waktu'));
        }
    }
    
    public function edit_peminjaman()
    {
        
    }
    
    public function hapus_peminjaman()
    {
        
    }
    
    public function lihat_penanggungjawab()
    {
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->lihatPenanggungJawab();
    }

}

?>