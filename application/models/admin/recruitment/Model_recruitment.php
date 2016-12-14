<?php
date_default_timezone_set('Asia/Shanghai');
class Model_recruitment extends CI_Model{

	public function getRecruitmentNum($school_id)
	{
		$this->db->where('school_id', $school_id);
		$this->db->from('recruitment');
		$total = $this->db->count_all_results();

		return $total;
	}

    public function getJob($job_id)
    {
        $query = $this->db->get_where('recruitment', array('id' => $job_id));
        return $query->row();
    }

	public function getJobs($school_id, $order)
	{
        if (isset($order)) {
            $this->db->order_by('title', $order);
        }
		$query = $this->db->get_where('recruitment', array('school_id' => $school_id));
		return $query->result_array();
	}

	public function addNewRecruitment($post)
	{
		$array = array(
            'school_id'     => $post['school_id'],
			'title'         => $post['title'],
			'type'          => $post['type'],
			'description'   => $post['description'],
			'requirements'  => $post['requirements'],
			'benefits'      => $post['benefits'],
			'contact'       => $post['contact'],
            'endtime'       => $post['endtime'],
            'status'        => $post['status'],
		);

		$this->db->set($array);
		$this->db->insert('recruitment');
	}

    public function editJob($post)
    {
        $array = array(
            'title'         => $post['title'],
            'type'          => $post['type'],
            'description'   => $post['description'],
            'requirements'  => $post['requirements'],
            'benefits'      => $post['benefits'],
            'contact'       => $post['contact'],
            'endtime'       => $post['endtime'],
            'status'        => $post['status'],
        );

        $this->db->where('id', $post['recruitment_id']);
        $this->db->update('recruitment', $array);
    }

    public function deleteJob($job_id)
    {
        $this->db->delete('recruitment',array('id' => $job_id));
    }
}