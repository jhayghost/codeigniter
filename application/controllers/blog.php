<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Blog extends CI_Controller {
	
	function Blog()	{
		 parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
		$this->load->model('m_blog');
		$this->m_user->sendtologin();
	}
	function index() {
		// check if user is logged in
		$this->m_user->sendtologin();
		
			$this->load->view('_header');
			$this->load->view('user/draftboard');
			$this->load->view('_footer');
		
	}
	function create() {
	
			$base = 'trim|xss_clean';
	
			$this->form_validation->set_rules('title', 'Title', $base.'|required|max_length[50]')
						->set_rules('body', 'Body', $base.'|max_length[500]')
						->set_rules('author', 'Author', $base);
	
			if ($this->form_validation->run())
			{
				$dbinfo = array(
									"title"=> $this->input->post('title'),
									"body"=> $this->input->post('body'),
									"author"=> $this->input->post('author')
								);
				if($id = $this->m_blog->create( $dbinfo ))
				redirect("blog/edit/".$id);
			}
	
			$this->load->view('_header');
			$this->load->view('blog/create');
			$this->load->view('_footer');
	}
	
	function edit( $id = "" ) {
			$base = 'trim|xss_clean';
	
			$this->form_validation->set_rules('title', 'Title', $base.'|required|max_length[50]')
						->set_rules('body', 'Body', $base.'|max_length[500]')
						->set_rules('author', 'Author', $base);
	
			if ($this->form_validation->run())
			{
				$dbinfo = array(
									"title"=> $this->input->post('title'),
									"body"=> $this->input->post('body'),
									"author"=> $this->input->post('author')
								);
				$this->m_blog->edit( $id, $dbinfo );
	
				redirect("blog/edit/".$id);
			}
			$this->m_blog->getData($id);
			
			$this->load->view('_header');
			$this->load->view('blog/create');
			$this->load->view('_footer');
	}
	function bloglist(){
			$this->load->view('_header');
			$this->load->view('blog/list');
			$this->load->view('_footer');
	}
	
	function delete($id = ""){
		$this->m_blog->delete( $id);
		redirect("blog/bloglist");
	}
	
}