<?php

class User extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
	}

	public function login()
	{
		//$this->load->(library)->
			$this->session->set_userdata([
				'id' => 1
				]);

			$session = $this->session->all_userdata();
			print_r($session);
	}

	public function get()
	{
		$data = $this->Users_model->get(3);
		print_r($data);

		/* Denne linje giver et output på det givende view,
			der viser alle de Database Querys som bliver requestet
			
		$this->output->enable_profiler(true);

		*/
	}

	 public function insert()
	{
		$result = $this->Users_model->insert([
			'first_name' => 'Arne'
			]);
		print_r($result);
	}
	 

	public function update()
	{
		$result = $this->Users_model->update([
			'first_name' => 'NotDorthe'
			], 3);
		print_r($result);

	}
	 

	public function delete()
	{
		$result = $this->Users_model->delete(6);
		print_r($result);
	}
	 
	// public function index()
	// {
	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('username', 'Username', 'required|valid_email|min_length[8]');
	// 	$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

	// 	if($this->form_validation->run() === true)
	// 	{
	// 		//sprintf() $this->load->view('information_veiw');
	// 		//echo $this->load->view('information_veiw');
	// 	}

	// 	$this->load->view('_view');
	// 	echo 'you failed badly';
	// }

	// public function test()
	// {
	// 	$this->load->helper('date');
	// 	echo mdate('%Y-%M-%d', time());
	// }

	// public function url()
	// {
	// 	$this->load->helper('url');
	// 	echo base_url();
	// }

	// public function userlist()
	// {
	// 	$this->load->model('users_model');
	// 	$users = $this->users_model->get_users();

	// 	$this->load->view('userlist_view', ['users' => $users,
	// 		]);
	// }
}