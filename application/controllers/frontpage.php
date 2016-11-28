<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpage extends CI_Controller {



	public function index()
	{
		$data['title'] = 'Tinderbox Volunteer';
		$data['headline'] = 'Tinderbox Volunteer';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('main_view', $data);
	}

}

?>