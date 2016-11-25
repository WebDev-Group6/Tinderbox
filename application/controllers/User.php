<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {


	public function __construct() {
		parent::__construct();
		$this->load->library('auth');
		$this->load->model('users_model');
    }

	public function users() {
		$this->auth->method('GET');
		$this->auth->check_token();
		$this->auth->http_response(200, 'OK', $this->users_model->get_all_users());
	}

	public function user($id = null) {
		$this->auth->method('GET');
		$this->auth->check_token();
		// validate
		$this->auth->super_escape('validate', 'int', $id);
		// Sanitize
		$id = $this->auth->super_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->users_model->get_user($id));
	}

	public function add_user() {
		$this->auth->method('POST');


		// $this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);

		// Convert the $post object to an array, for testing
		$post = (array)$post;

		$args_check = array('first_name', 'last_name', 'email', 'password', 'phone_number', 'address', 'city', 'country', 'nationality', 'speak_danish', 'colleague', 'task' );

		// first, flips key/value in $args_check, then compares the two arrays, lastly test the count
		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			// convert $post back to an object, in order to use it with JSON
			$post = (object)$post;
			
			// Validate

			$this->auth->super_escape('validate', 'string', $post->first_name);
			$this->auth->super_escape('validate', 'string', $post->last_name);
			$this->auth->super_escape('validate', 'email', $post->email);
			$this->auth->super_escape('validate', 'password', $post->password);
			$this->auth->super_escape('validate', 'int', $post->phone_number);
			$this->auth->super_escape('validate', 'string', $post->address);
			$this->auth->super_escape('validate', 'string', $post->city);
			$this->auth->super_escape('validate', 'string', $post->country);
			$this->auth->super_escape('validate', 'string', $post->nationality);
			$this->auth->super_escape('validate', 'tinyint', $post->speak_danish);
			$this->auth->super_escape('validate', 'string', $post->colleague);
			$this->auth->super_escape('validate', 'string', $post->task);

			// Sanitize
			$safe_first_name = $this->auth->super_escape('sanitize', 2, $post->first_name);
			$safe_last_name = $this->auth->super_escape('sanitize', 2, $post->last_name);
			$safe_email = $this->auth->super_escape('sanitize', 2, $post->email);
			$safe_password = $this->auth->super_escape('sanitize', 2, $post->password);
			$safe_phone_number = $this->auth->super_escape('sanitize', 2, $post->phone_number);
			$safe_address = $this->auth->super_escape('sanitize', 2, $post->address);
			$safe_city = $this->auth->super_escape('sanitize', 2, $post->city);
			$safe_country = $this->auth->super_escape('sanitize', 2, $post->country);
			$safe_nationality = $this->auth->super_escape('sanitize', 2, $post->nationality);
			$safe_speak_danish = $this->auth->super_escape('sanitize', 2, $post->speak_danish);
			$safe_colleague = $this->auth->super_escape('sanitize', 2, $post->colleague);
			$safe_task = $this->auth->super_escape('sanitize', 2, $post->task);



			$safe_password = password_hash($safe_password, PASSWORD_BCRYPT, [
			'cost' => 10,
			]);

			$res = $this->users_model->set_user([

				'first_name' => $safe_first_name,
				'last_name' => $safe_last_name,
				'email' => $safe_email,
				'password' => $safe_password,
				'phone_number' => $safe_phone_number,
				'address' => $safe_address,
				'city' => $safe_city,
				'country' => $safe_country,
				'nationality' => $safe_nationality,
				'speak_danish' => $safe_speak_danish,
				'colleague' => $safe_colleague,
				'task' => $safe_task

			]);
			if($res) {
				$this->auth->http_response(201, 'Created', [
					'message' => 'User Created',
					'id' => $res
				]);
			}
		}
		
		$this->auth->http_response(406, 'Not Acceptable', ['message' => 'Check the JSON data - properties are not correctly']);
	}

	public function update_user($id = null) {
		$this->auth->method('PATCH');
		$this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);

		// Convert the $post object to an array, for testing
		$post = (array)$post;

		$args_check = array('first_name', 'last_name', 'email', 'password');


		// first, flips key/value in $args_check, then comapres the two arrays, lastly test the count
		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			// convert $post back to an object, in order to use it with JSON
			$post = (object)$post;

			// Validate
			$this->auth->super_escape('validate', 'string', $post->firstname);
			$this->auth->super_escape('validate', 'string', $post->lastname);
			$this->auth->super_escape('validate', 'email', $post->email);
			$this->auth->super_escape('validate', 'password', $post->password);

			// Sanitize
			$safe_firstname = $this->auth->super_escape('sanitize', 2, $post->firstname);
			$safe_lastname = $this->auth->super_escape('sanitize', 2, $post->lastname);
			$safe_email = $this->auth->super_escape('sanitize', 2, $post->email);
			$safe_password = $this->auth->super_escape('sanitize', 2, $post->password);


			$options = [
			'cost' => 8,
			];
			$safe_password = password_hash($safe_password, PASSWORD_BCRYPT, $options);

			$send_args = [

				'id' => $id,
				'firstname' => $safe_firstname,
				'lastname' => $safe_lastname,
				'email' => $safe_email,
				'password' => $safe_password
			];

			$res = $this->users_model->update_user($send_args);
			
			if($res) {
				$this->auth->http_response(200, 'OK', [
					'message' => 'User Updated',
					'id' => $res
					]);
			}
		}
		
		$this->auth->http_response(406, 'Not Acceptable', ['message' => 'Check the JSON data - properties are not set correctly']);
	}

	public function delete_user($id = null) {
		$this->auth->method('DELETE');
		$this->auth->check_token();
		// validate
		$this->auth->super_escape('validate', 'int', $id);

		// Sanitize
		$safe_id = $this->auth->super_escape('sanitize', 2, $id);

		$res = $this->users_model->delete_user($safe_id);

		if($res) {
			$this->auth->http_response(200, 'OK', [
				'message' => 'User deleted'
			]);
		}

		$this->auth->http_response(404, 'Not Found', [
			'message' => 'User not found'
		]);
	}


	public function Login() {

		$this->auth->method('GET');
		$this->auth->handle_login();
	}

	public function all_shifts() {
		$this->auth->method('GET');
		$this->auth->check_token();
		$this->auth->http_response(200, 'OK', $this->shifts_model->get_all_shifts());
	}

	public function shifts($id = null) {
		$this->auth->method('GET');
		$this->auth->check_token();

		// validate
		$this->auth->super_escape('validate', 'int', $id);

		// Sanitize
		$safe_id = $this->auth->super_escape('sanitize', 2, $id);

		$this->auth->http_response(200, 'OK', $this->shifts_model->get_shifts($safe_id));
	}

	public function add_shift() {
		$this->auth->method('POST'); 
		$this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);

		$post = (array)$post;
		$args_check = array('shift_userid', 'shift_name', 'shift_content', 'shift_station', 'shift_location', 'shift_start', 'shift_end');

		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			$post = (object)$post;

			// Validate
			$this->auth->super_escape('validate', 'int', $post->shift_userid);
			$this->auth->super_escape('validate', 'string', $post->shift_name);
			$this->auth->super_escape('validate', 'string', $post->shift_content);
			$this->auth->super_escape('validate', 'string', $post->shift_station);
			$this->auth->super_escape('validate', 'string', $post->shift_location);
			$this->auth->super_escape('validate', 'string', $post->shift_start);
			$this->auth->super_escape('validate', 'string', $post->shift_end);

			// Sanitize
			$safe_shift_userid = $this->auth->super_escape('sanitize', 2, $post->shift_userid);
			$safe_shift_name = $this->auth->super_escape('sanitize', 2, $post->shift_name);
			$safe_shift_content = $this->auth->super_escape('sanitize', 2, $post->shift_content);
			$safe_shift_station = $this->auth->super_escape('sanitize', 2, $post->shift_station);
			$safe_shift_location = $this->auth->super_escape('sanitize', 2, $post->shift_location);
			$safe_shift_start = $this->auth->super_escape('sanitize', 2, $post->shift_start);
			$safe_shift_end = $this->auth->super_escape('sanitize', 2, $post->shift_end);
		
			$res = $this->shifts_model->set_shift([

				'shift_userid' => $safe_shift_userid,
				'shift_name' => $safe_shift_name,
				'shift_content' => $safe_shift_content,
				'shift_station' => $safe_shift_station,
				'shift_location' => $safe_shift_location,
				'shift_start' => $safe_shift_start,
				'shift_end' => $safe_shift_end
			]);
			if($res) {
				$this->auth->http_response(201, 'Created', [
					'message' => 'Shift Created',
					'id' => $res
				]);
			}
		}

		$this->auth->http_response(406, 'Not Acceptable', [
			'message' => 'Check the JSON data - properties are not correct' 
		]);

	}

	public function update_shift($id = null) {
		$this->auth->method('PATCH');
		$this->auth->check_token();
		// Validate
		$this->auth->super_escape('validate', 'int', $id);
		// Sanitize
		$safe_id = $this->auth->super_escape('sanitize', 2, $id);

		$post = file_get_contents('php://input');
		$post = json_decode($post);

		$post = (array)$post;
		$args_check = array('shift_userid', 'shift_name', 'shift_content', 'shift_station', 'shift_location', 'shift_start', 'shift_end');

		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {

			$post = (object)$post;

			// Validate
			$this->auth->super_escape('validate', 'int', $post->shift_userid);
			$this->auth->super_escape('validate', 'string', $post->shift_name);
			$this->auth->super_escape('validate', 'string', $post->shift_content);
			$this->auth->super_escape('validate', 'string', $post->shift_station);
			$this->auth->super_escape('validate', 'string', $post->shift_location);
			$this->auth->super_escape('validate', 'string', $post->shift_start);
			$this->auth->super_escape('validate', 'string', $post->shift_end);

			// Sanitize
			$safe_shift_userid = $this->auth->super_escape('sanitize', 2, $post->shift_userid);
			$safe_shift_name = $this->auth->super_escape('sanitize', 2, $post->shift_name);
			$safe_shift_content = $this->auth->super_escape('sanitize', 2, $post->shift_content);
			$safe_shift_station = $this->auth->super_escape('sanitize', 2, $post->shift_station);
			$safe_shift_location = $this->auth->super_escape('sanitize', 2, $post->shift_location);
			$safe_shift_start = $this->auth->super_escape('sanitize', 2, $post->shift_start);
			$safe_shift_end = $this->auth->super_escape('sanitize', 2, $post->shift_end);

			$res = $this->shifts_model->update_shift([
				'shift_userid' => $safe_shift_userid,
				'shift_name' => $safe_shift_name,
				'shift_content' => $safe_shift_content,
				'shift_station' => $safe_shift_station,
				'shift_location' => $safe_shift_location,
				'shift_start' => $safe_shift_start,
				'shift_end' => $safe_shift_end,
				'sid' => $safe_id
			]);
			if($res) {
				$this->auth->http_response(200, 'OK', [
					'message' => 'Shift Updated',
					'id' => $res
				]);
			}
		}

		$this->auth->http_response(406, 'Not Acceptable', [
			'message' => 'Check the JSON data - properties are not correct'
		]);
	}

	public function delete_shift($id = null) {
		$this->auth->method('DELETE');
		$this->auth->check_token();
		// Validate
		$this->auth->super_escape('validate', 'int', $id);
		// Sanitize
		$safe_id = $this->auth->super_escape('sanitize', 2, $id);

		$res = $this->shifts_model->delete_shift($safe_id);
		
		if($res) {
			$this->auth->http_response(200, 'OK', [
				'message' => 'Shift is deleted'
			]);
		} else {
			$this->auth->http_response(404, 'Not Found', [
				'message' => 'Shift not found'
			]);
		}
	}
}