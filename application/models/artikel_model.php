<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class artikel_model extends CI_Model{
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
    
    public function isi_insert($data){
        $res = $this->db->insert('isiartikel', $data);
        return $res;
    }
    
    public function GetData(){
        $data = $this->db->query('select * from artikel order by idArtikel desc');
        return $data->result_array();
    }
    
    public function form_update($id,$data){
        $res = $this->db->where('idArtikel', $id);
        $res = $this->db->update('artikel', $data);
        return $res;
    }
    
    public function isi_update($id,$data){
        $res = $this->db->where('idArtikel', $id);
        $res = $this->db->insert('isiartikel', $data);
        return $res;
    }
    
    public function form_delete($id){
        $res = $this->db->where('idArtikel', $id);
        $res = $this->db->delete('artikel');
        return $res;
    }
    
    public function isi_delete($id){
        $data = $this->db->get_where('isiartikel', array('idArtikel' => $id));
        $data = $data->result_array();
        $this->load->helper('assets_helper');
        $this->load->helper('file');
        for($i = 0; $i<count($data); $i++){
            $html = $data[$i]['isiArtikel'];
            //parsing
            $curr_pointer = 0;
            while(true){
                if($curr_pointer >= strlen($html)){
                    break;
                }
                
                $curr_img = strpos($html,'<img',$curr_pointer);
                $curr_src = strpos($html,'src="',$curr_img+1);
                $curr_close = strpos($html,'>',$curr_img+1);

                if($curr_img===false){                              //kalo ga nemu
                    break;
                }

                if($curr_src===false){                              //kalo src tidak ada
                    break;
                }

                if($curr_close===false){                            //kalo tag tidak valid
                    break;
                }

                try{
                    if($curr_close<$curr_src){                          //kalo tag img tidak ada srcnya
                        throw new \Exception;
                    }
                    $curr_open_url = $curr_src + 5; //nemu filename
                    $curr_close_url = strpos($html,'"',$curr_open_url); //nemu " terakhir
                    
                    if($curr_close_url>$curr_close){
                        throw new \Exception;
                    }
                    
                    $curr_slash = $curr_close_url-1;
                    while(true){
                        if($html[$curr_slash] == "/" || $curr_slash == $curr_open_url-1){
                            break;
                        }
                        else{
                            $curr_slash -= 1;
                        }
                    }
                    $delete_filename = substr($html,$curr_slash+1, $curr_close_url-($curr_slash+1));
                    $path = './assets/uploads/'.$delete_filename;
                    @unlink($path);

                }catch(\Exception $exception){}
                $curr_pointer = $curr_close+1;
            }
        }
        
        
        
        $res = $this->db->delete('isiartikel',array('idArtikel' => $id));
        return $res;
    }
    
    public function load_one_index($id){
        $data = $this->db->query('select * from artikel where idArtikel = '.$id);
        return $data->result_array();
    }
}

?>