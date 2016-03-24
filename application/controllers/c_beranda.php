<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_beranda extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('v_beranda');
	}
    
    public function do_login()
    {
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
                redirect(site_url()."/c_beranda/index");        //redirect ke halaman beranda
                exit();   
            }
            else
            {
                
            }
        }
    }
    
    public function do_logout()
    {
        $this->session->unset_userdata('username');
        redirect(site_url()."/c_beranda/index");
        exit();
    }
    
    public function do_insert(){
        echo "<pre>";
        print_r($_POST);
        echo "<pre>";
    }
    
    /*echo "<pre>".json_encode($_POST['summernote'],JSON_PRETTY_PRINT)."</pre>";*/
}
