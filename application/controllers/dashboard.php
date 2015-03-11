<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('main.php');

class Dashboard extends Main {	 
	public function __construct()
	{
		parent::__construct();
		$this->load->Model('User');
		$this->load->Model('Friend');
		 
		if(! $this->is_login())
		{
			$this->session->set_flashdata("error_message","Please login");
			redirect(base_url('/'));
		} 
		 
		$this->output->enable_profiler();
	}

	public function index()
	{ 
		$current_user  			= $this->current_user;
		$all_users 				= $this->User->get_all_users(); 
		$current_user_friends 	= $this->Friend->get_user_friends($current_user['user_id']);
	 
	
		//To find the friends of current user
		$friend_ids = array();

		foreach ($current_user_friends as $friends) 
		{
			if($current_user['user_id'] == $friends['user_id'] )
			{
				$friend_ids[] = $friends['friend_id'];
			}
			else if($current_user['user_id'] == $friends['friend_id'])
			{
				$friend_ids[] = $friends['user_id'];
			}
		}
		if(!count($friend_ids)==0)
		{
			 $not_current_users_friends_ids = $this->Friend->not_friends($friend_ids);
		} 

		else
		{
			$not_current_users_friends_ids  =	$all_users ;
		}
       
		$this->load->view("dashboard/index" ,array(
											   									 'current_user'         => $current_user ,
		                                       'current_user_friends' => $friend_ids,
		                                       'all_users'            => $all_users,
		                                       'other_users'          => $not_current_users_friends_ids) );
		
	}

	public function view_profile($user_id)
	{
		$user_details = $this->User->get_user_by_id($user_id);
		$this->load->view("dashboard/profile",array(
																						'user_details' => $user_details 
																					)
		                  );
	}
	 
	public function add_friend($user_id=NULL,$friend_id=NULL)
	{
		if($user_id !== NULL && $friend_id !== NULL)
		{
			$this->Friend->create_friend($user_id,$friend_id);
			redirect(base_url('/dashboard/index'));
		}
		else
		{
			redirect(base_url('/dashboard/index'));
		}
	}

	public function remove_friend($user_id=NULL,$friend_id=NULL)
	{
		if($user_id !== NULL && $friend_id !== NULL)
		{
			$this->Friend->remove_friend($user_id,$friend_id);
			redirect(base_url('/dashboard/index'));
		}
		else
		{
			redirect(base_url('/dashboard/index'));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
}