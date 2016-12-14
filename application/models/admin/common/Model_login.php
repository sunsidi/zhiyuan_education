<?php 
class Model_login extends CI_Model{

	public function __construct()
	{
		$this->load->database();
		$this->load->library('session');
	}
	/**
	 * [if login successful set_session and record the ip]
	 * @param  [string] $username [username]
	 * @param  [string] $password [password]
	 * @return [bool]
	 */
	public function loginVerification($username, $password)
	{	
		$password = md5($password);
		$query = $this->db->select('*')
				->from('user')
				->where('username',$username)
				->where('password',$password)
				->get();
		$login = $query->result_array();

		if(is_array($login) && count($login) == 1){
			$this->set_session($login, 1800);
			$this->recordLogin($login);
			return true;
		}
		return false;
	}
	/**
	 * [set_session description]
	 * @param [array] $data [user information array]
	 */
	private function set_session($data, $timeout = 300){
		foreach($data as $session){
            $this->session->set_tempdata('user_id', $session['user_id'], $timeout);
            $this->session->set_tempdata('username', $session['username'], $timeout);
			$this->session->set_tempdata('usergroup', $session['status'], $timeout);
			$this->session->set_tempdata('image', $session['image'], $timeout);
			$this->session->set_tempdata('fullname', $session['fullname'], $timeout);
            // $this->session->token = token(32);
            $this->session->set_tempdata('isLoggedIn', true, $timeout);
		}
	}
	/**
	 * [insert login ip&time]
     * @param [array] $data [user information array]
	 * @return [null] 
	 */
	private function recordLogin($user)
	{
        date_default_timezone_set('Asia/Shanghai');
		$data = array(
			'ip' => $_SERVER['REMOTE_ADDR'],
			'login_time' => date("Y-m-d H:i:s"),
		);
		$this->db->where('user_id', $user[0]['user_id']);
		$this->db->update('user',$data);
	}
}