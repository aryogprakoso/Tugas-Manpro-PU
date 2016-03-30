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
    
    public function do_upload(){
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulArtikel = $this->input->post('judulArtikel');
        $isiArtikel = $this->input->post('isiArtikel');
        
        $id = $this->db->query("SELECT max(`idArtikel`) as `count` FROM `pu`.`artikel`" )->row_array()['count']+1;
        
        if($judulArtikel == NULL || $isiArtikel == NULL){
            echo "Please fill";
            $this->load->view('v_artikel');
        }
        else{
            $html = $this->input->post('isiArtikel');
            //start parsing
            
            /*
            $curr_pointer = 0;
            while(true){
                $curr_img = strpos($html,'<img',$curr_pointer);
                $curr_src = strpos($html,'src="data:',$curr_img+1);
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
                
                    $curr_src_open = $curr_src + 5;
                    $curr_src_close = strpos($html,'"',$curr_src_open+1);
                    
                    $src_content = substr($html, $curr_src_open, $curr_src_close-$curr_src_open);
                    
                    $curr_data_start = $curr_src_open + 5;
                    $curr_data_end = $curr_src_close;
                    
                    $imgdata = substr($html, $curr_data_start, $curr_data_end-$curr_data_start);
                    list($contentType, $encContent) = explode(';', $imgdata);
                    
                    //Cek base64
                    if (substr($encContent, 0, 6) != 'base64'){
                        throw new \Exception;
                    }
                    
                    $imgExt = '';
                    
                    //Cek image extension
                    switch($contentType){
                        case 'image/jpeg':  $imgExt = 'jpg'; break;
                        case 'image/gif':   $imgExt = 'gif'; break;
                        case 'image/png':   $imgExt = 'png'; break;
                        default:            throw new \Exception;
                    }
                    
                    $imgBase64 = substr($encContent, 6);
                    $imgFilename = strtr(base64_encode(time()), '+/=', '-_,').strtr(base64_encode(rand(0,10000)), '+/=', '-_,');
                    $imgPath = 'assets/uploads/'.$imgFilename.'.'.$imgExt;
                    $urlPath = assets().'uploads/'.$imgFilename.'.'.$imgExt;
                    
                    //Make file
                    try{
                        substr_replace($html, $urlPath, $curr_src_open, $curr_src_open - $curr_src_close);
                        
                        if (!file_exists($imgPath)){
                            $imgDecoded = base64_decode($imgBase64);
                            $fp = fopen($imgPath, 'w');
                            if (!$fp){
                                return $matches[0];
                            }
                            fwrite($fp, $imgDecoded);
                            fclose($fp);
                        }
                    }catch(\Exception $e){
                        if($fp!=null){
                            fclose($fp);
                        }
                        throw new \Exception;
                    }
                    
                }catch(\Exception $exception){}
                $curr_pointer = $curr_close+1;
            }
            */            
            
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
                
            }catch(\Exception $e){
                $this->db->trans_rollback();
            }
            redirect('/c_artikel', 'refresh');
        }
    }
    
    public function load_data($index){
        $data = $this->artikel_model->load_one_index($index);
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
        echo json_encode($data);
    }
        
    public function do_edit(){
        $this->load->helper('assets_helper');
        $this->load->helper('date');
        $judulArtikel = $this->input->post('judulArtikel');
        $isiArtikel = $this->input->post('isiArtikel');
        
        $id = $this->input->post('idArtikel');
        
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
                //diubah jadi update
                if($this->artikel_model->form_update($id,$data)===false){
                    throw new \Exception;
                }
                $this->load->helper('html_divider');
                
                //delete isiArtikel dari database
                //isi ulang
                $this->db->delete('isiartikel',array('idArtikel' => $id));
                echo $html;
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
                
            }catch(\Exception $e){
                $this->db->trans_rollback();
            }
            redirect('/c_artikel', 'refresh');
        }
    }
    
    public function delete(){
        $id = $this->input->post('idArtikel');
        $this->artikel_model->form_delete($id);
        $this->artikel_model->isi_delete($id);
        $status = new stdClass();
        $status->status = "success";
        echo json_encode($status);
    }
}
?>

