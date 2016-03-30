<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class Galeri_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function galeri_model(){
        parent::Model();
        $this->load->database();
    }
    
    public function form_insert($data){
        $res = $this->db->insert('galeri', $data);
        return $res;
    }
    
    public function GetData(){
        $data = $this->db->query('select * from galeri');
        return $data->result_array();
    }
    
    public function form_update($data,$where){
        $res = $this->db->update('galeri', $data, $where);
        return $res;
    }
    
    public function form_delete($data,$where){
        $res = $this->db->delete('galeri', $data, $where);
        return $res;
    }
}

?>
