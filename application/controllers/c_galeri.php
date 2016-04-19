<?php if(! defined('BASEPATH')) exit ('No direct script access allowed');

class C_galeri extends CI_Controller{
    public function __construct(){
        parent::__construct();
	    $this->load->helper(array('form', 'url'));
	    $this->load->model('galeri_model');
            $this->load->library('pagination');
    }
    
    private $limit = 12;
	
    public function index(){
        redirect('/c_galeri/page/1');
    }
    
    //untuk menload seluruh image dengan Pagination
    public function page($pageno){
        if($pageno<1)
        {
            redirect();
            return;
        }
        
        $data = $this->galeri_model->getalldata($this->limit);
        $total_rows = $this->galeri_model->count();

        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->limit;
        $config['uri_segment'] = 3;
        $config['base_url'] = base_url().'index.php/c_galeri';
        $config['use_page_numbers']= TRUE;
    
        $maxpage = floor($total_rows/$this->limit);
        $maxpage += $total_rows%$this->limit>0 ? 1 : 0;
        $maxpage += $maxpage < 1 ? 1 : 0;
        
        $pagination = "<ul class='pagination paginations'>";
        for($i=1; $i<=$maxpage; $i++)
        {
            $pagination .= "<li";
            if($i == $pageno)
            {
                $pagination .= " class='active'";
            }
            $pagination .= ">";
            $pagination .= "<a href='".$i."'>";
            $pagination .= $i;
            $pagination .= "</a>";
            $pagination .= "</li>";
        }
        $pagination .= "</ul>";

        $this->load->view('v_galeri', compact('data', 'pageno', 'pagination'));
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
        $config['remove_spaces'] = FALSE;
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
    
    //untuk mendelete gambar dengan id tertentu
    public function delete($idGaleri)
    {
      $this->galeri_model->delete($idGaleri);
      $this->galeri_model->gambar_delete($idGaleri);
      $this->session->set_flashdata('message','Gambar telah Dihapus..');
      redirect('c_galeri');
    }
}

?>
