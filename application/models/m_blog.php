<?php
class m_blog extends CI_Model {
	var $data = array();
    function __construct()
    {
        parent::__construct();
		
    }
	function create($info){
		
		$data = array(
			'title'   	=> $info['title'],
			'body' 		=> $info['body'],
			'userid'	=> $this->ci_auth->userid(),
			'author'	=>$info['author'],
			'datetime'	=> CURDATETIME
		);
		$insertquery = $this->db->insert('blog', $data);
		if($insertquery)
			return $this->db->insert_id();
		else
			return FALSE;
	}
	function edit($id = "", $info){
		
		if(empty($id))
		return FALSE;
		
		$data = array(
			'title'   	=> $info['title'],
			'body' 	  	=> $info['body'],
			'author'	=>$info['author'],
			'userid'	=> $this->ci_auth->userid(),
			'datetime'	=> CURDATETIME
		);
		
		if( $this->db->where(array("id" => xss_clean($id), "userid"=>$this->ci_auth->userid()))
						->update('blog', $data))
			return TRUE;
		else
			return FALSE;
	}
	
	function getData($id = ""){
		if(empty($id))
		return FALSE;
		
		$query = $this->db->get_where('blog', array('id' => $id, "userid"=>$this->ci_auth->userid()), 1);
		if ($query->num_rows() == 0)
		return FALSE;
		
		$this->data = $query->row();
	}
	function getFieldData($field){
		return isset($this->data->$field) ? $this->data->$field :"";
		
	}
	function delete($id = ""){
		
		if(empty($id))
		return FALSE;
		
		$query = $this->db->delete('blog', array('id' => $id, "userid"=>$this->ci_auth->userid()));
	}
	function bloglist(){
		return $this->db->where("userid", $this->ci_auth->userid() )->get('blog');
	}
}