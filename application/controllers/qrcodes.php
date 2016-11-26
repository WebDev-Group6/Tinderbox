<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcodes extends CI_Controller {

public function index()
	{
		$data['title'] = 'QR Codes';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->model('qrcode_model');
		// you can place the Session
		$id=5;
		$result= $this->qrcode_model->get_qr($id);
		$data['qr'] = $result;
		$this->load->view('header_view', $data);
		$this->load->view('qr_view', $data);
		$this->load->view('footer_view', $data);



}
}