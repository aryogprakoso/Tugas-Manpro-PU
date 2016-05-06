<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_pencarian extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('model_baca');
        $this->load->model('search_model');
      
    }
	public function index(){
        $berita = $this->search_model->get_search();
        $artikel = $this->search_model->get_search2();
        $this->load->helper('html_divider');
        $this->load->view('v_pencarian2', array('berita' => $berita, 'artikel' => $artikel));
	}

     function selanjutnya(){
        $id=$this->uri->segment(3);
        $data = $this->model_baca->per_id($id);

        $this->load->helper('html_divider');
        for($i = 0; $i < count($data); $i++){
            
            $isi = $this->db->query('select isiArtikel from isiartikel where idArtikel = '.$data[$i]['idArtikel'])->result_array();
            
            $isi_processed = array();
            
            foreach($isi as $item_isi){
                $isi_processed[] = $item_isi['isiArtikel'];
            }
            $isi_hasil = htmlJoin($isi_processed);
            
            $data[$i]['isiArtikel'] = $isi_hasil;
        }
           $this->load->view('v_pencarian3', array('data' => $data)); 
    }


     function selanjutnya2(){

        $id=$this->uri->segment(3);
        $data = $this->model_baca->per_id2($id);

        $this->load->helper('html_divider');
        for($i = 0; $i < count($data); $i++){
            
            $isi = $this->db->query('select isiBerita from isiberita where idBerita = '.$data[$i]['idBerita'])->result_array();
            
            $isi_processed = array();
            
            foreach($isi as $item_isi){
                $isi_processed[] = $item_isi['isiBerita'];
            }
            $isi_hasil = htmlJoin($isi_processed);
            
            $data[$i]['isiBerita'] = $isi_hasil;
        }
           $this->load->view('v_pencarian4', array('data' => $data)); 
    }
}
?>
