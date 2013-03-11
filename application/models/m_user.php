<?php
class M_user extends CI_Model {
	var $data= array();
    function __construct()
    {
        parent::__construct();
		    
		if($this->session->userdata('user_id')){
			$data = array(
               'lastlogin' => CURDATETIME
            );

			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->update('auth_users', $data); 	
		}
	}
	function sendtologin(){
		if(!$this->session->userdata('user_id'))
		 redirect("user/login");
	}
	function getUser(){
		
		$query = $this->db->where('user_id', $this->session->userdata('user_id'))->get("auth_users");
		
		if ($query->num_rows() == 0)
			return FALSE;
		
		$this->data = $query->row();
	}
	
}