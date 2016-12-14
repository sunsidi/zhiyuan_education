<?php 
class Model_school extends CI_Model{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getSchool($school_id) 
	{
		$query = $this->db->get_where('school', array('id' => $school_id));
		return $query->row_array();
	}

	public function getSchoolList($order)
	{
		$this->db->order_by('name',$order);
		$query = $this->db->get('school');
				
		return $query->result_array();
	}

	public function addNewSchool($post)
	{
		$array = array(
		    'name' => $post['name'],
		    'description' => $post['description'],
		    'address' => $post['address'],
		    'website' => $post['website'],
		    'tel' => $post['tel'],
		    'email' => $post['email'],
		);

		$this->db->set($array);
		$this->db->insert('school');
	}

	public function editSchool($post)
	{
		$array = array(
		    'name' => $post['name'],
		    'description' => $post['description'],
		    'address' => $post['address'],
		    'website' => $post['website'],
		    'tel' => $post['tel'],
		    'email' => $post['email'],
		);

		$this->db->where('id', $post['school_id']);
		$this->db->update('school', $array);
	}

	public function deleteSchool($school_id)
	{
		$this->db->delete('school',array('id' => $school_id));
	}

	public function validateDelete($school_id)
	{
		$query = $this->db->get_where('recruitment', array('school_id' => $school_id));
		$results = $query->result_array();

		return count($results) > 0 ? false : true;
	}
}