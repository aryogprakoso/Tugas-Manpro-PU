<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class berita_model extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    
    function m_berita(){
        parent::Model();
        $this->load->database();
    }
    
    public function form_insert($data){
        $res = $this->db->insert('berita', $data);
        return $res;
    }
    
    public function isi_insert($data){
        $res = $this->db->insert('isiberita', $data);
        return $res;
    }
    
    public function GetData(){
        $data = $this->db->query('select * from berita order by idBerita desc');
        return $data->result_array();
    }
    
    public function form_update($id,$data){
        $res = $this->db->where('idBerita', $id);
        $res = $this->db->update('berita', $data);
        return $res;
    }
    
    public function isi_update($id,$data){
        $res = $this->db->where('idBerita', $id);
        $res = $this->db->insert('isiberita', $data);
        return $res;
    }
    
    public function form_delete($id){
        $res = $this->db->where('idBerita', $id);
        $res = $this->db->delete('berita');
        return $res;
    }
    
    public function isi_delete($id){
        $data = $this->db->get_where('isiberita', array('idBerita' => $id));
        $data = $data->result_array();
        $this->load->helper('assets_helper');
        $this->load->helper('file');
        for($i = 0; $i<count($data); $i++){
            $html = $data[$i]['isiBerita'];
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
        
        
        
        $res = $this->db->delete('isiberita',array('idBerita' => $id));
        return $res;
    }
    
    public function load_one_index($id){
        $data = $this->db->query('select * from berita where idBerita = '.$id);
        return $data->result_array();
    }
}

?>