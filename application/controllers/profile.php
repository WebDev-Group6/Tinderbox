<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Your Profile';
		$data['headline'] = 'Messages';
		$this->load->view('header_view', $data);
		$this->load->view('profile_view');
		$this->load->view('footer_view');
	
	}
	public function upload_image()
	{
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
		$path = 'assets/uploads/'; // upload directory

		if(isset($_FILES['image']))
		{
			$img = $_FILES['image']['name'];
 			$tmp = $_FILES['image']['tmp_name'];
  
 			// get uploaded file's extension
 			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
 
 			// can upload same image using rand function
			$final_image = rand(1000,1000000).$img;
 
 			// check's valid format
 			if(in_array($ext, $valid_extensions)) 
 			{     
 				$path = $path.strtolower($final_image); 
   
  				if(move_uploaded_file($tmp, $path)) 
  				{
   					echo '<img src="' . $path . '">';
  				}
 			} 
 		else 
 		{
  			echo 'invalid file';
 		}
		}
	}
}
