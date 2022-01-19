<?php 

class M_login extends CI_Model{	
	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	public function update($where, $data)
	{
		$this->db->where($where);
		$hasil = $this->db->update('user_system',$data);
		return $hasil;
	}

	public function cek_userIsLogedIn()
	{
    	$this->secure_header();
		if($this->session->userdata('is_logedin')==TRUE)
	    {
	      return TRUE;
	    }  
	    else
	    {
	      return FALSE;
	    }
	}	

    public function secure_header()
    {
     	// Prevent some security threats, per Kevin
		// Turn on IE8-IE9 XSS prevention tools
		$this->output->set_header('X-XSS-Protection: 1; mode=block');
		// Don't allow any pages to be framed - Defends against CSRF
		$this->output->set_header('X-Frame-Options: DENY');
		// prevent mime based attacks
    	$this->output->set_header('X-Content-Type-Options: nosniff');
    }
}