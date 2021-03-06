<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class login_model extends CI_Model{

    function __construct() {
        parent::__construct();
    }

    public function validate_user($data) {
        $this->db->where('namaAdmin', $data['username']);       //Query Builder untuk WHERE namaAdmin
        $this->db->where('password', sha1($data['password']));  //Query Builder untuk WHERE password
        $query =  $this->db->get('admin')->row();               //Query Builder untuk SELECT table admin
        if(empty($query))//kalau Query yang dihasilkan kosong berarti TIDAK BISA LOGIN
            echo "0";       
        else//kalau Query yang dihasilkan tidak kosong berarti BISA LOGIN
        {
            echo "1";
            $this->session->set_userdata('username', $_POST['username']);
        }        
    }
    
    public function edit_password($data){
        $this->db->where('namaAdmin', $data['username']);       //Query Builder untuk WHERE namaAdmin
        $this->db->where('password', sha1($data['passwordLama']));  //Query Builder untuk WHERE password
        $query =  $this->db->get('admin')->row();               //Query Builder untuk SELECT table admin
        if(empty($query))//kalau Query yang dihasilkan kosong berarti TIDAK BISA LOGIN
            echo "0";       
        else//kalau Query yang dihasilkan tidak kosong berarti BISA LOGIN
        {
            echo "1";
            
            $editPass = array(
              'password' => sha1($data['passwordBaru'])
            );
            
            $this->db->where('namaAdmin', $data['username']);
            $this->db->update('admin', $editPass);
        }
    }

    public function create_users($data){
        $this->db->insert($this->admin, $data);
        return $this->db->insert_id();
    }
}