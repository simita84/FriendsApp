<?php 
Class Friend extends CI_model
{
	public function __construct()
	{
	   $this->load->library('form_validation');
	}

	public function create_friend($user_id,$friend_id)
	{
		$friendship_data = array(
										   'user_id'       => $user_id ,
										   'friend_id'     => $friend_id,
										   'created_at'    => date('m-d-y h:s:i'),
										   'updated_at'    => date('m-d-y h:i:s a')
	);

	return $this->db->insert('friends', $friendship_data);

	}

	public function get_user_friends($user_id)
	{
			$select_query = " SELECT  friends.user_id , friends.friend_id  
							  FROM friends 
							  WHERE 
							  friends.user_id   = ? 
							  OR 
							  friends.friend_id = ? ";

			return $this->db->query($select_query,array($user_id,$user_id) )->result_array();
	}

	public function not_friends($friend_ids)
	{  
       $this->db->where_not_in('id', $friend_ids);
       $query = $this->db->get('users');
       return $query->result_array() ;
	}

	
}
?>