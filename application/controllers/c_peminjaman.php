<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_peminjaman extends CI_Controller{


    public function index(){
     	$this->load->view('v_peminjaman');   
    }
    
        
    public function tambah_peminjaman()
    {
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->tambahPeminjaman($this->input->post());
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
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->editPeminjaman($this->input->post());
    }
    
    public function hapus_peminjaman()
    {
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->hapusPeminjaman($this->input->post('idHapus'));
    }
    
    public function lihat_penanggungjawab()
    {
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->lihatPenanggungJawab();
    }
    
    public function tambah_penanggung_jawab()
    {
        $this->load->model('peminjaman_model');
        $this->peminjaman_model->tambahPJ($this->input->post());
    }

}

?>