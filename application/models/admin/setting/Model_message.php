<?php
/**
 * Created by SD.
 * Date: 09/07/2017
 */
class Model_message extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function sendMessage($post)
    {
        $mode = $post['mode'];

        date_default_timezone_set('Asia/Shanghai');

        if ($mode == 1) { // send message to multiple-users

            $usernames = explode(',', $post['user']);

            // get seller_ids from their username
            foreach ($usernames as $username) {
                $this->db->select('vendor_id');
                $this->db->where('username', $username);
                $query = $this->db->get('vendor');
                $row = $query->row();
                if (isset($row)) {
                    $seller_ids[] = $row->vendor_id;
                } else { // if cannot find the username, return false
                    return false;
                }
            }
            // send message by seller_id
            foreach ($seller_ids as $seller_id) {
                $data = array(
                    'content' => $post['content'],
                    'seller_id' => $seller_id,
                    'is_read' => 0,
                    'date_added' => date("Y-m-d H:i:s"),
                );
                $this->db->insert('msg', $data);
            }
            return true;

        } else if ($mode == 0) { // send message to group

            $data = array(
                'content' => $post['content'],
                'group_id' => $post['user'],
                'is_read' => 0,
                'date_added' => date("Y-m-d H:i:s"),
            );
            $this->db->insert('msg', $data);
            return true;
        }
    }
}