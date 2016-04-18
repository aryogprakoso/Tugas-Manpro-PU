<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class model_baca extends CI_Model{

   public function per_id($id){
        $this->db->where('idArtikel',$id); 
        $query=$this->db->get('artikel');
        return $query->result_array();
    }

    public function per_id2($id){
        $this->db->where('idBerita',$id); 
        $query=$this->db->get('berita');
        return $query->result_array();
    }
    
}

?>
