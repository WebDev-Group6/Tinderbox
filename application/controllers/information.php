<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Information';
		$data['headline'] = 'Tinderbox Volunteer';

		$this->info_auth->method('GET');

		$this->load->model('information_model');
		
		$view = array(
			$this->load->view('main_view', $data, true)
		);

		$this->output
		->set_header('HTTP/1.1 200 OK')
		->set_header('Content-Type: application/json')
		->set_output(json_encode($this->information_model->get_info()))
		->_display();

		die();
	}
	public function add_info()
	{
		$this->info_auth->method('POST');

		$this->load->model('information_model');

		$post = file_get_contents('php://input');
		$post = json_decode($post);

		if ($post->info_title && $post->info_content)
		{
			$res = $this->information_model->set_info([
				'info_title' => $post->info_title ,
				'info_content' => $post->info_content
			]);

			$this->output
			->set_header('HTTP/1.1. 200 OK')
			->set_header('Content-Type: application/json')
			->set_output(json_encode([
				'status' => 200,
				'statusCode' => 'OK',
				'response' => $this->information_model->get_info($res)
				]))
			->_display();
		}
		else
		{
			$this->output
			->set_header('HTTP/1.1. 500 NOT OK')
			->set_header('Content-Type: application/json')
			->set_output(json_encode([
				'status' => 500,
				'statusCode' => 'NOT OK',
				'response' => 'Title or content missing'
				]))
			->_display();	
		}
		die();
	}

}
