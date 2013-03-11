<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ci_auth
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function log_out() {
		$this->CI->session->sess_destroy();	
	}
	
	function is_login(){
		if($this->CI->session->userdata('email'))	
		return TRUE;
		else
		return FALSE;
	}
    public function create_user($dbinfo) {
	
		$this->CI->load->library('email');
		$this->CI->load->library('encrypt');
		
		$firstname = $dbinfo['firstname'];
		$lastname = $dbinfo['lastname'];
		$email = $dbinfo['email'];
		$password = $dbinfo['password'];
		$activation = rand(0,999999);
		$urlactivation = base64_encode($this->CI->encrypt->encode($activation));
		$urlemail = base64_encode($this->CI->encrypt->encode($email));
		
	    $qry = $this->CI->db->where('email', $email)
                        ->get('auth_users');

		if ($qry->num_rows() !== 0)
		{
			return FALSE;
		}
	
		$salt = $this->_create_salt();
	
		$data = array(
			'firstname'      => $firstname,
			'lastname'      => $lastname,
			'password'      => sha1($password.$salt),
			'email'         => $email,
			'salt'          => $salt,
			'status'        => 0,
			'datetime'        => CURDATETIME,
			'activation'        => $activation,
		);
		
		if( $this->CI->db->insert('auth_users', $data))
		{
			$this->CI->email->from('admin@localhost.loc', 'CI Activation');
			$this->CI->email->to($email);
			
			$this->CI->email->subject('Registration Activation');
			$this->CI->email->message('Hello '.$firstname.' '. $lastname.', please do not reply to this email, this is a "no reply" address, meaning that emails from this address are not reaching a real mailbox.
Before being able to access the members area you need to activate your account.
Please activate your account by clicking this link:
 
'. site_url("user/activation/".$urlactivation.'/'.$urlemail));
			
			$this->CI->email->send();
		}
		
		return $this->CI->db->insert_id();
			
	}
	/**
	 * Create Salt
	 *
	 * This function will create a salt hash to be used in 
	 * authentication
	 * 
	 * @return  string      the salt
	 */
	protected function _create_salt()
	{
		$this->CI->load->helper('string');
		return sha1(random_string('alnum', 32));
	}
	
    public function log_in($email, $password) {
		
		$qry = $this->CI->db->select('user_id, email, password, salt')
							->where('email', $email)
							->where('status', '1')
							->get('auth_users');
	
		// No results, we're done.
		if ($qry->num_rows() !== 1)
		{
			return FALSE;
		}
	
		if (sha1($password.$qry->row('salt')) == $qry->row('password'))
		{
			$data = array(
				'user_id'       => $qry->row('user_id'),
				'email'         => $qry->row('email'),
				'salt'          => $qry->row('salt'),
			);
	
			$this->CI->session->set_userdata($data);
	
			return $qry->row('user_id');
		}
	
		return FALSE;
	}

    public function activation($activation, $urlemail) {
		
		$this->CI->load->library('encrypt');
		
		$activation = $this->CI->encrypt->decode(base64_decode($activation));
		$email = $this->CI->encrypt->decode(base64_decode($urlemail));

		
		$qry = $this->CI->db->where('email', $email)
				->where('activation', $activation)
				->where('status', '0')
				->get('auth_users');

		if ($qry->num_rows() == 0)
		{
			return FALSE;
		}else{
			$data = array(
               'activation' => '',
               'status' => '1'
            );
			$this->CI->db->where('email', $email);
			$this->CI->db->update('auth_users', $data); 
			return TRUE;
		}
	
	}
	public function userid(){
			if($this->CI->session->userdata('user_id'))	
				return $this->CI->session->userdata('user_id');
				else
				return FALSE;
	}

}