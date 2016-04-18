<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class search_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function m_berita(){
        parent::Model();
        $this->load->database();
    }
    


    public function get_search(){
        $match = $this->input->post('search');
        if($match != null){
            
             $this->db->like('judulberita', $match);
             $data = $this->db->get('berita');
            return $data->result_array();

        }
           }
 public function get_search2(){
        $match = $this->input->post('search');
        if($match != null){
            
             $this->db->like('judulArtikel', $match);
             $data = $this->db->get('artikel');
            return $data->result_array();

        }
           }
    
   
}

?>
