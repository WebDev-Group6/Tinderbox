<?php

public function messages()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('messages_view');
		$this->load->view('footer_view');
	}
}
