<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_galeri extends CI_Controller{
    public funtion __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('m_galeri');
    }

    public function index(){
        $data = $this->m_galeri->GetData();
     	$this->load->view('v_galeri', array('data' => $data));
    }

    public function do_upload(){
        $keteranganGambar = $this->input->post('keteranganGambar');
        
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
        
        $id = $this->db->query("SELECT count(`idGaleri`) as `count` FROM `pu`.`galeri`" )->row_array()['count'];
        
        if($this->upload->do_upload('userfile')){
                //Setting values for tabel columns
                $data = array(
                    'idGaleri' => $id,
                    'keteranganGambar' => $this->input->post('keteranganGambar'),
                    'pathGambar' => $foto
                );
                //Transfering data to Model
                $this->m_galeri->form_insert($data);
                $data['message'] = 'Gambar Berhasil Diupload';
                redirect('/c_galeri', 'refresh');
            }
        else{

            }
    }
}

?>
