<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_beranda extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('berita_model');
    }
    
    public function index(){
        $data  = $this->berita_model->GetData();
        $data2 = $this->berita_model->get_search();

        if($data2 != null){
                    $this->load->helper('html_divider');
            for($i = 0; $i < count($data2); $i++){
                $isi2 = $this->db->query('select isiBerita from isiberita where idBerita = '.$data2[$i]['idBerita'])->result_array();
            
            $isi_processed = array();
            
            foreach($isi2 as $item_isi){
                $isi_processed[] = $item_isi['isiBerita'];
            }
            $isi_hasil = htmlJoin($isi_processed);
            
            $data2[$i]['isiBerita'] = $isi_hasil;
            }
             $this->load->view('v_beranda2', array('data2' => $data2));    
             
        }else{
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
        
        $this->load->view('v_beranda', array('data2' => $data));    
        }
        
    }
    
    public function do_upload(){
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulBerita = $this->input->post('judulBerita');
        $isiBerita = $this->input->post('isiBerita');
        
        $id = $this->db->query("SELECT max(`idBerita`) as `count` FROM `pu`.`berita`" )->row_array()['count']+1;
        
        if($judulBerita == NULL || $isiBerita == NULL){
            echo "Please fill";
            $this->load->view('v_beranda');
        }
        else{
            $html = $this->input->post('isiBerita');
            //start parsing
                        
            $html = preg_replace_callback("/src=\"data:([^\"]+)\"/", function ($matches) {
                 list($contentType, $encContent) = explode(';', $matches[1]);
                 
                 if (substr($encContent, 0, 6) != 'base64') {
                     return $matches[0]; // Don't understand, return as is
                 }
                 $imgBase64 = substr($encContent, 6);
                 $imgFilename = base64_encode(time()).base64_encode(rand(0,1000));//md5($imgBase64); // Get unique filename
                 $imgExt = '';
                 switch($contentType) {
                     case 'image/jpeg':  $imgExt = 'jpg'; break;
                     case 'image/gif':   $imgExt = 'gif'; break;
                     case 'image/png':   $imgExt = 'png'; break;
                     default:            return $matches[0]; // Don't understand, return as is
                 }
                 $imgPath = 'assets/uploads/'.$imgFilename.'.'.$imgExt;
                 // Save the file to disk if it doesn't exist
                try{
                     if (!file_exists($imgPath)) {
                         $imgDecoded = base64_decode($imgBase64);
                         $fp = fopen($imgPath, 'w');
                         if (!$fp) {
                             return $matches[0];
                         }
                         fwrite($fp, $imgDecoded);
                         fclose($fp);
                     }
                 }catch(\Exception $e){
                     if($fp!=null){
                         fclose($fp);
                     }
                 }
                return 'src="'.assets().'uploads/'.$imgFilename.'.'.$imgExt.'"';
                return "i";
            }, $html);
            
            //Setting values for tabel columns
            try{
                $this->db->trans_start();
                $data = array(
                    'idBerita' => $id,
                    'judulBerita' => $this->input->post('judulBerita'),
                    'waktu' => date('Y-m-d', now())
                );
                if($this->berita_model->form_insert($data)===false){
                    throw new \Exception;
                }
                $this->load->helper('html_divider');

                $substring = htmlDivide($html);
                for($i = 0; $i < count($substring); $i++){
                    $data = array(
                        'idBerita' => $id,
                        'isiBerita' => $substring[$i]
                    );
                    if($this->berita_model->isi_insert($data)===false){
                        throw new \Exception;
                    }
                }
                $this->db->trans_complete();
                
            }catch(\Exception $e){
                $this->db->trans_rollback();
            }
            redirect('/c_beranda', 'refresh');
        }
    }
    
    public function load_data($index){
        $data = $this->berita_model->load_one_index($index);
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
        echo json_encode($data);
    }
        
    public function do_edit(){
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulBerita = $this->input->post('judulBerita');
        $isiBerita = $this->input->post('isiBerita');
        
        $id = $this->input->post('idBerita');
        
        if($judulBerita == NULL || $isiBerita == NULL){
            echo "Please fill";
            $this->load->view('v_beranda');
        }
        else{
            $html = $this->input->post('isiBerita');
            //start parsing
            
            $html = preg_replace_callback("/src=\"data:([^\"]+)\"/", function ($matches) {
                 list($contentType, $encContent) = explode(';', $matches[1]);
                 
                 if (substr($encContent, 0, 6) != 'base64') {
                     return $matches[0]; // Don't understand, return as is
                 }
                 $imgBase64 = substr($encContent, 6);
                 $imgFilename = rtrim(strtr(base64_encode(time()), '+/', '-_'), '=').rtrim(strtr(base64_encode(rand(0,1000)), '+/', '-_'), '=');
                 $imgExt = '';
                 switch($contentType) {
                     case 'image/jpeg':  $imgExt = 'jpg'; break;
                     case 'image/gif':   $imgExt = 'gif'; break;
                     case 'image/png':   $imgExt = 'png'; break;
                     default:            return $matches[0]; // Don't understand, return as is
                 }
                 $imgPath = 'assets/uploads/'.$imgFilename.'.'.$imgExt;
                 // Save the file to disk if it doesn't exist
                try{
                     if (!file_exists($imgPath)) {
                         $imgDecoded = base64_decode($imgBase64);
                         $fp = fopen($imgPath, 'w');
                         if (!$fp) {
                             return $matches[0];
                         }
                         fwrite($fp, $imgDecoded);
                         fclose($fp);
                     }
                 }catch(\Exception $e){
                     if($fp!=null){
                         fclose($fp);
                     }
                 }
                return 'src="'.assets().'uploads/'.$imgFilename.'.'.$imgExt.'"';
            }, $html);
            
            //Setting values for tabel columns
            try{
                $this->db->trans_start();
                $data = array(
                    'idBerita' => $id,
                    'judulBerita' => $this->input->post('judulBerita'),
                    'waktu' => date('Y-m-d', now())
                );
                //diubah jadi update
                if($this->berita_model->form_update($id,$data)===false){
                    throw new \Exception;
                }
                $this->berita_model->isi_delete($id);
                $this->load->helper('html_divider');
                
                $substring = htmlDivide($html);
                for($i = 0; $i < count($substring); $i++){
                    $data = array(
                        'idBerita' => $id,
                        'isiBerita' => $substring[$i]
                    );
                    if($this->berita_model->isi_update($id,$data)===false){
                        throw new \Exception;
                    }
                }
                $this->db->trans_complete();
                
            }catch(\Exception $e){
                $this->db->trans_rollback();
            }
            redirect('/c_beranda', 'refresh');
        }
    }
    
    public function delete(){
        $id = $this->input->post('idBerita');
        $this->berita_model->form_delete($id);
        $this->berita_model->isi_delete($id);
        $status = new stdClass();
        $status->status = "success";
        echo json_encode($status);
    }
    
    //LOGIN
    public function do_login(){
        $this->load->library('user_agent'); //load library user_agent buat referrer (lihat bawah)
        //CEK apakah ada POST dengan KEY username
        if($this->input->post('username'))
        {
            //jika ada POST dengan KEY username, maka LOAD model 'login_model'
            $this->load->model('login_model');
            //Validasi POST dengan KEY 'username' dan 'password' dengan fungsi validate_user dari login_model
            if($this->login_model->validate_user($this->input->post())) 
            {
                //set SESSION dengan KEY 'username' dan VALUE dari $_POST['username']
                $this->session->set_userdata('username', $_POST['username']); 
                redirect($this->agent->referrer()); //referrer digunakan untuk lihat page yang dikunjungi sebelumnya
                exit();   
            }
            else
            {
                redirect($this->agent->referrer()); //referrer digunakan untuk lihat page yang dikunjungi sebelumnya
            }
        }
    }
    
    public function do_logout(){
        $this->load->library('user_agent'); //load library user_agent buat referrer (lihat bawah)
        $this->session->unset_userdata('username'); 
        redirect($this->agent->referrer()); //referrer digunakan untuk lihat page yang dikunjungi sebelumnya
        exit();
    }
}
?>

