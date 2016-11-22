<?php

class Info_auth
{
	private $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function method($allow_method = array('GET', 'PUT'))
	{
		$method = $_SERVER ['REQUEST_METHOD'];

		if($allow_method === $method)
		{
			return true;
		}

		$this->ci->output
		->set_header('HTTP/1.1 405 Method Not Allowed')
		->set_header('Content-Type: application/json')
		->set_output(json_encode([
			'error' => 405,
			'errorCode' => 'Method Not Allowed']))
		->_display();

		die();
	}
}