<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_artikel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('artikel_model');
    }
    
    public function index(){
        $data = $this->artikel_model->GetData();
        
        $this->load->helper('html_divider');
        for($i = 0; $i < count($data); $i++){
            
            $isi = $this->db->query('select isiArtikel from isiartikel where idArtikel = '.$data[$i]['idArtikel'].' order by id_isi_artikel')->result_array();
            
            $isi_processed = array();
            
            foreach($isi as $item_isi){
                $isi_processed[] = $item_isi['isiArtikel'];
            }
            $isi_hasil = htmlJoin($isi_processed);
            
            $data[$i]['isiArtikel'] = $isi_hasil;
        }
        
     	$this->load->view('v_artikel', array('data' => $data));
    }
    
    public function getlist(){
        $ret = [];
        try{
            $data = $this->artikel_model->GetData();
            $this->load->helper('html_divider');
            for($i = 0; $i < count($data); $i++){

                $isi = $this->db->query('select isiArtikel from isiartikel where idArtikel = '.$data[$i]['idArtikel'].' order by id_isi_artikel')->result_array();

                $isi_processed = array();

                foreach($isi as $item_isi){
                    $isi_processed[] = $item_isi['isiArtikel'];
                }
                $isi_hasil = htmlJoin($isi_processed);

                $data[$i]['isiArtikel'] = $isi_hasil;
            }
            $ret['status'] = "success";
            $ret['artikel'] = $data;
        }
        catch(\Exception $e){
            $ret['status'] = "error";
            $ret['message'] = $e->getMessage();
        }
        echo json_encode($ret);
    }
    
    public function do_upload(){
        $error = array();
        $success = array();
        if(!$this->session->userdata('username')){
            redirect('/c_artikel', 'refresh');
            return;
        }
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulArtikel = $this->input->post('judulArtikel');
        
        if($judulArtikel == null || trim($judulArtikel)==''){
            $this->session->set_flashdata('success',$success);
            $this->session->set_flashdata('error',$error);
            return;
        }
        
        $isiArtikel = $this->input->post('isiArtikel');
        
        $id = $this->db->query("SELECT max(`idArtikel`) as `count` FROM `pu`.`artikel`" )->row_array()['count']+1;
        
        $html = $this->input->post('isiArtikel');
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
                'idArtikel' => $id,
                'judulArtikel' => $this->input->post('judulArtikel'),
                'waktu' => date('Y-m-d', now())
            );
            if($this->artikel_model->form_insert($data)===false){
                throw new \Exception;
            }
            $this->load->helper('html_divider');

            $substring = htmlDivide($html);
            for($i = 0; $i < count($substring); $i++){
                $data = array(
                    'idArtikel' => $id,
                    'isiArtikel' => $substring[$i]
                );
                if($this->artikel_model->isi_insert($data)===false){
                    throw new \Exception;
                }
            }
            $this->db->trans_complete();
            $success[] = "Artikel berhasil ditambahkan";
        }catch(\Exception $e){
            $this->db->trans_rollback();
            $error[] = "Gagal menambahkan artikel";
        }
        $this->session->set_flashdata('success',$success);
        $this->session->set_flashdata('error',$error);
        redirect('/c_artikel', 'refresh');
    }
    
    public function load_data($index){
        $data = $this->artikel_model->load_one_index($index);
        if($data == null){
            $data = array();
        }
        else{
            $this->load->helper('html_divider');
            for($i = 0; $i < count($data); $i++){

                $isi = $this->db->query('select isiArtikel from isiartikel where idArtikel = '.$data[$i]['idArtikel'].' order by id_isi_artikel')->result_array();

                $isi_processed = array();

                foreach($isi as $item_isi){
                    $isi_processed[] = $item_isi['isiArtikel'];
                }
                $isi_hasil = htmlJoin($isi_processed);

                $data[$i]['isiArtikel'] = $isi_hasil; 
            }
        }
        echo json_encode($data);
    }
        
    public function do_edit(){
        $error = array();
        $success = array();
        if(!$this->session->userdata('username')){
            redirect('/c_artikel', 'refresh');
            return;
        }
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulArtikel = $this->input->post('judulArtikel');
        $isiArtikel = $this->input->post('isiArtikel');
        
        $id = $this->input->post('idArtikel');
        
        //error handling belum benar
        if($judulArtikel == NULL || $isiArtikel == NULL){
            echo "Please fill";
            $this->load->view('v_artikel');
        }
        else{
            $html = $this->input->post('isiArtikel');
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
                    'idArtikel' => $id,
                    'judulArtikel' => $this->input->post('judulArtikel'),
                    'waktu' => date('Y-m-d', now())
                );
                //diubah jadi update
                if($this->artikel_model->form_update($id,$data)===false){
                    throw new \Exception;
                }
                $this->artikel_model->isi_delete($id);
                $this->load->helper('html_divider');
                
                $substring = htmlDivide($html);
                for($i = 0; $i < count($substring); $i++){
                    $data = array(
                        'idArtikel' => $id,
                        'isiArtikel' => $substring[$i]
                    );
                    if($this->artikel_model->isi_update($id,$data)===false){
                        throw new \Exception;
                    }
                }
                $this->db->trans_complete();
                $success[] = "Artikel berhasil diedit";
                
            }catch(\Exception $e){
                $this->db->trans_rollback();
                $error[] = "Gagal mengedit artikel";
            }
            $this->session->set_flashdata('success',$success);
            $this->session->set_flashdata('error',$error);
            redirect('/c_artikel', 'refresh');
        }
    }
    
    public function delete(){
        if(!$this->session->userdata('username')){
            $status = new stdClass();
            $status->status = "success";
            echo json_encode($status);
        }
        $id = $this->input->post('idArtikel');
        $this->artikel_model->form_delete($id);
        $this->artikel_model->isi_delete($id);
        $status = new stdClass();
        $status->status = "success";
        echo json_encode($status);
        //redirect('/c_artikel', 'refresh');
    }
}
?>

