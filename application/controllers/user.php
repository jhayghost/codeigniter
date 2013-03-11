<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	
	function User()	{
		 parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->library('ci_auth');
		$this->load->helper(array('form', 'url'));
		$this->load->model('m_user');
	}
	function index() {
		// check if user is logged in
			$this->m_user->sendtologin();
		
			$this->load->view('_header');
			$this->load->view('user/draftboard');
			$this->load->view('_footer');
		
	}
	function register() {
	
			$base = 'required|trim|xss_clean';
	
			$this->form_validation->set_rules('firstname', 'First Name', $base.'|max_length[50]')
						->set_rules('lastname', 'Last Name', $base.'|max_length[50]')
						->set_rules('email', 'Email', $base.'|valid_email|max_length[50]|is_unique[auth_users.email]')
						->set_rules('password', 'Password', $base.'|matches[password_conf]')
						->set_rules('password_conf', 'Password Confirmation', $base.'|min_length[5]');
	
			if ($this->form_validation->run())
			{
				$dbinfo = array(
									"firstname"=> $this->input->post('firstname'),
									"lastname"=> $this->input->post('lastname'),
									"password"=> $this->input->post('password'),
									"username"=> $this->input->post('username'),
									"email"=> $this->input->post('email')
								);
				$this->ci_auth->create_user( $dbinfo );
	
				redirect("user/register_success");
			}
	
			$this->load->view('_header');
			$this->load->view('user/register');
			$this->load->view('_footer');
	}
	
	function register_success() {
			$this->load->view('_header');
			$this->load->view('user/register_success');
			$this->load->view('_footer');
	}
	function login(){
		
	//	$this->output->enable_profiler(TRUE);

        $base = 'email|required|trim|xss_clean';

        $this->form_validation->set_rules('email', 'email', $base.'|max_length[40]')
                    ->set_rules('password', 'Password', $base);

        $data = array(
            'login_error' => FALSE,
        );

        if ($this->form_validation->run())
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            if (FALSE !== ($user = $this->ci_auth->log_in($email, $password)))
            {
                redirect('user/');
            }

            $data['login_error'] = TRUE;
        }

			$this->load->view('_header');
			$this->load->view('user/login', $data);
			$this->load->view('_footer');
	}
	function logout(){
		$this->ci_auth->log_out();
		redirect();
	}
	function activation($val = "", $urlemail = ""){
			$this->load->view('_header');
			$data['status'] = '0';
		
			if( $this->ci_auth->activation($val, $urlemail) ) {
				$data['status'] = '1';
			}
			
			$this->load->view('user/activation',$data);
			$this->load->view('_footer');
		
	}
}