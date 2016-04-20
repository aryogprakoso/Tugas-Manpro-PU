<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');
class Galeri_model extends CI_Model{

    function __construct(){
        parent::__construct();
    }
    
    //menload database
    function galeri_model(){
        parent::Model();
        $this->load->database();
    }
    
    //memasukan image ke database
    public function form_insert($data){
        $res = $this->db->insert('galeri', $data);
        return $res;
    }
    
    //mengambil semua data pada tabel galeri secara descending
    public function getalldata($limit = -1)
    {
        $this->db->select('*');
        $this->db->from('galeri');
        $this->db->order_by('idGaleri', 'DESC');
        if($limit<0)
        {
            $query = $this->db->get();
        }
        else
        {
            $offset = ($this->uri->segment(3)-1)*$limit;
            $query = $this->db->limit($limit, $offset)->get();
        }
        return $query->result_array();
    }
    
    //menghitung total gambar di database(digunakan untuk pagination)
    public function count(){
        return $this->db->count_all_results('galeri');
    }
    
    //mengakses 4 gambar terakhir sebagai image slider di beranda
    public function get_images_slider(){
        $this->db->select('*');
        $this->db->from('galeri');
        $this->db->order_by('idGaleri', 'DESC');
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    //mendelete path gambar
    public function gambar_delete($idGaleri){
        $data = $this->db->get_where('galeri', array('idGaleri' => $idGaleri));
        $data = $data->result_array();
        $this->load->helper('assets_helper');
        $this->load->helper('file');
        for($i = 0; $i<count($data); $i++){
            $html = $data[$i]['galeri'];
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
        
        
        
        $res = $this->db->delete('galeri',array('idGaleri' => $idGaleri));
        return $res;
    }
    
    //mendelete gambar dengan id tertentu pada database
    public function delete($idGaleri)
    {
      try {
         $this->db->where('idGaleri',$idGaleri)->delete('galeri');
         $imagepath = $config['upload_path'];
        unlink($imagepath . $pathGambar);
         return true;
      }
      //catch exception
      catch(Exception $e) {
          }
    }

}
?>


