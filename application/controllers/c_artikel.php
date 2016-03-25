<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_artikel extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('artikel_model');
    }
    
    public function index(){
        $data = $this->artikel_model->GetData();
     	$this->load->view('v_artikel', array('data' => $data));
    }
    
    public function do_upload(){
        $this->load->helper('date');
        $judulArtikel = $this->input->post('judulArtikel');
        $isiArtikel = $this->input->post('isiArtikel');
        
        $foto = time().$_FILES['userfile']['name'];
        $config['file_name']=$foto;
        $config['upload_path']= './assets/uploads';
        $config['allowed_types']='gif|jpeg|png|jpg|bmp';
        $config['max_size']='5000';
        $config['max_width']='10000';
        $config['max_height']='10000';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        
        $id = $this->db->query("SELECT count(`idArtikel`) as `count` FROM `pu`.`artikel`" )->row_array()['count'];
        
        if($judulArtikel == NULL && $isiArtikel == NULL){
            echo "Please fill";
            $this->load->view('v_artikel');
        }
        else{
            if($this->upload->do_upload('userfile')){
                //Setting values for tabel columns
                $data = array(
                    'idArtikel' => $id,
                    'judulArtikel' => $this->input->post('judulArtikel'),
                    'isiArtikel' => $this->input->post('isiArtikel'),
                    'waktu' => date('Y-m-d', now()),
                    'pathGambar' => $foto
                );
                //Transfering data to Model
                $this->m_artikel->form_insert($data);
                $data['message'] = 'Data Inserted Successfully';
                redirect('/c_artikel', 'refresh');
            }
            else{
                 $data = array(
                    'idArtikel' => $id,
                    'judulArtikel' => $this->input->post('judulArtikel'),
                    'isiArtikel' => $this->input->post('isiArtikel'),
                    'waktu' => date('Y-m-d', now())
                );
                $this->m_artikel->form_insert($data);
                $data['message'] = 'Data Inserted Successfully';
                redirect('/c_artikel', 'refresh');
            }
        }
    }
    
    
    
    /*public function summernote_upload(){
        $allowed = array('png', 'jpg', 'gif','zip');

        if(isset($_FILES['file']) && $_FILES['file']['error'] == 0){
            $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if(!in_array(strtolower($extension), $allowed)){
                echo '{"status":"error"}';
            exit;
            }
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'assets/uploads/'.$_FILES['file']['name'])){
                $tmp='images/'.$_FILES['file']['name'];
                echo 'images/'.$_FILES['file']['name'];
                //echo '{"status":"success"}';
                exit;
            }
        }
        echo '{"status":"error"}';
        exit;
    }*/
}
?>