<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class m_artikel extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function m_artikel(){
        parent::Model();
        $this->load->database();
    }
    
    public function form_insert($data){
        $res = $this->db->insert('artikel', $data);
        return $res;
    }
    
    public function GetData(){
        $data = $this->db->query('select * from artikel');
        return $data->result_array();
    }
    
    public function form_update($data,$where){
        $res = $this->db->update('artikel', $data, $where);
        return $res;
    }
    
    public function form_delete($data,$where){
        $res = $this->db->delete('artikel', $data, $where);
        return $res;
    }
}

?>