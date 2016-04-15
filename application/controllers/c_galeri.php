<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_galeri extends CI_Controller{
    public funtion __construct(){
        parent::__construct();
	        $this->load->helper(array('form', 'url'));
	        $this->load->model('galeri_model');
            $this->load->library('pagination');
    }

    public function index(){
        $data = $this->galeri_model->getalldata();
        $this->load->view('v_galeri', array('data' => $data));
    }

    public function do_upload(){
        //fungsi untuk input gambar ke database
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
        
        if(!$this->upload->do_upload('userfile')){
                //Jika error
                $upload_error = array('error' => $this->upload->display_errors());
                redirect('c_galeri', $upload_error);
            }
        else{
            //jika berhasil
             $data = array(
                    'idGaleri' => '',
                    'keteranganGambar' => $this->input->post('keteranganGambar'),
                    'pathGambar' => $foto
                );
                
                $this->galeri_model->form_insert($data);
                $data['success'] = 'Gambar Berhasil Diupload';
                redirect('c_galeri',$data);
            }
    }
    
    public function delete($idGaleri)
    {
      $this->galeri_model->delete($idGaleri);
      $this->galeri_model->gambar_delete($idGaleri);
      $this->session->set_flashdata('message','Gambar telah Dihapus..');
      redirect('c_galeri');
    }
}

?>
