<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('auth');
		$this->load->model('users_model');
		$this->load->model('teams_model');
		// $this->load->model('shifts_model');
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
		$this->auth->secure_escape('validate', 'int', $id);
		// Sanitize
		$id = $this->auth->secure_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->users_model->get_user($id));
	}
	public function add_user() {
		$this->auth->method('POST');

		// $this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);
		// Convert the $post object to an array, for testing
		$post = (array)$post;

		$args_check = array('first_name', 'last_name', 'email', 'password', 'gender', 'dateofbirth', 'phone_number', 'address', 'city', 'zipcode', 'country', 'nationality', 'speak_danish', 'colleague', 'user_team_id');

		// first, flips key/value in $args_check, then compares the two arrays, lastly test the count
		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			// convert $post back to an object, in order to use it with JSON
			$post = (object)$post;
			
			// Validate

			$this->auth->secure_escape('validate', 'string', $post->first_name);
			$this->auth->secure_escape('validate', 'string', $post->last_name);
			$this->auth->secure_escape('validate', 'email', $post->email);
			$this->auth->secure_escape('validate', 'password', $post->password);
			$this->auth->secure_escape('validate', 'tinyint', $post->gender);
			$this->auth->secure_escape('validate', 'string', $post->dateofbirth);
			$this->auth->secure_escape('validate', 'int', $post->phone_number);
			$this->auth->secure_escape('validate', 'string', $post->address);
			$this->auth->secure_escape('validate', 'string', $post->city);
			$this->auth->secure_escape('validate', 'int', $post->zipcode);
			$this->auth->secure_escape('validate', 'string', $post->country);
			$this->auth->secure_escape('validate', 'string', $post->nationality);
			$this->auth->secure_escape('validate', 'tinyint', $post->speak_danish);
			$this->auth->secure_escape('validate', 'string', $post->colleague);
			$this->auth->secure_escape('validate', 'int', $post->user_team_id);
			// Sanitize
			$safe_first_name = $this->auth->secure_escape('sanitize', 2, $post->first_name);
			$safe_last_name = $this->auth->secure_escape('sanitize', 2, $post->last_name);
			$safe_email = $this->auth->secure_escape('sanitize', 2, $post->email);
			$safe_password = $this->auth->secure_escape('sanitize', 2, $post->password);
			$safe_gender = $this->auth->secure_escape('sanitize', 2, $post->gender);
			$safe_dateofbirth = $this->auth->secure_escape('sanitize', 2, $post->dateofbirth);
			$safe_phone_number = $this->auth->secure_escape('sanitize', 2, $post->phone_number);
			$safe_address = $this->auth->secure_escape('sanitize', 2, $post->address);
			$safe_zipcode = $this->auth->secure_escape('sanitize', 2, $post->zipcode);
			$safe_city = $this->auth->secure_escape('sanitize', 2, $post->city);
			$safe_country = $this->auth->secure_escape('sanitize', 2, $post->country);
			$safe_nationality = $this->auth->secure_escape('sanitize', 2, $post->nationality);
			$safe_speak_danish = $this->auth->secure_escape('sanitize', 2, $post->speak_danish);
			$safe_colleague = $this->auth->secure_escape('sanitize', 2, $post->colleague);
			$safe_user_team_id = $this->auth->secure_escape('sanitize', 2, $post->user_team_id);

			$safe_password = password_hash($safe_password, PASSWORD_BCRYPT, [
			'cost' => 10,
			]);
			$res = $this->users_model->set_user([
				'first_name' => $safe_first_name,
				'last_name' => $safe_last_name,
				'email' => $safe_email,
				'password' => $safe_password,
				'gender' => $safe_gender,
				'dateofbirth' => $safe_dateofbirth,
				'phone_number' => $safe_phone_number,
				'address' => $safe_address,
				'zipcode' => $safe_zipcode,
				'city' => $safe_city,
				'country' => $safe_country,
				'nationality' => $safe_nationality,
				'speak_danish' => $safe_speak_danish,
				'colleague' => $safe_colleague,
				'user_team_id' => $safe_user_team_id
			]);
			if($res) {
				$this->auth->http_response(201, 'Created', [
					'message' => 'User Created',
					'id' => $res
				]);
			}
		}
		
		$this->auth->http_response(406, 'Not Acceptable', ['message' => 'Check the JSON data - properties are not set correctly']);
	}
	public function update_user($id = null) {
		$this->auth->method('PATCH');
		//$this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);
		// Convert the $post object to an array, for testing
		$post = (array)$post;

		$args_check = array('first_name', 'last_name', 'email', 'password', 'gender', 'dateofbirth', 'phone_number', 'address', 'zipcode','city', 'country', 'nationality', 'speak_danish', 'colleague');

		// first, flips key/value in $args_check, then comapres the two arrays, lastly test the count
		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			// convert $post back to an object, in order to use it with JSON
			$post = (object)$post;
			// Validate
			$this->auth->secure_escape('validate', 'string', $post->first_name);
			$this->auth->secure_escape('validate', 'string', $post->last_name);
			$this->auth->secure_escape('validate', 'email', $post->email);
			$this->auth->secure_escape('validate', 'password', $post->password);
			$this->auth->secure_escape('validate', 'tinyint', $post->gender);
			$this->auth->secure_escape('validate', 'string', $post->dateofbirth);
			$this->auth->secure_escape('validate', 'int', $post->phone_number);
			$this->auth->secure_escape('validate', 'string', $post->address);
			$this->auth->secure_escape('validate', 'string', $post->city);
			$this->auth->secure_escape('validate', 'int', $post->zipcode);
			$this->auth->secure_escape('validate', 'string', $post->country);
			$this->auth->secure_escape('validate', 'string', $post->nationality);
			$this->auth->secure_escape('validate', 'tinyint', $post->speak_danish);
			$this->auth->secure_escape('validate', 'string', $post->colleague);
			// Sanitize
			$safe_first_name = $this->auth->secure_escape('sanitize', 2, $post->first_name);
			$safe_last_name = $this->auth->secure_escape('sanitize', 2, $post->last_name);
			$safe_email = $this->auth->secure_escape('sanitize', 2, $post->email);
			$safe_password = $this->auth->secure_escape('sanitize', 2, $post->password);
			$safe_gender = $this->auth->secure_escape('sanitize', 2, $post->gender);
			$safe_dateofbirth = $this->auth->secure_escape('sanitize', 2, $post->dateofbirth);
			$safe_phone_number = $this->auth->secure_escape('sanitize', 2, $post->phone_number);
			$safe_address = $this->auth->secure_escape('sanitize', 2, $post->address);
			$safe_zipcode = $this->auth->secure_escape('sanitize', 2, $post->zipcode);
			$safe_city = $this->auth->secure_escape('sanitize', 2, $post->city);
			$safe_country = $this->auth->secure_escape('sanitize', 2, $post->country);
			$safe_nationality = $this->auth->secure_escape('sanitize', 2, $post->nationality);
			$safe_speak_danish = $this->auth->secure_escape('sanitize', 2, $post->speak_danish);
			$safe_colleague = $this->auth->secure_escape('sanitize', 2, $post->colleague);
			$options = [
			'cost' => 8,
			];
			$safe_password = password_hash($safe_password, PASSWORD_BCRYPT, $options);
			$send_args = [
				'id' => $id,
				'first_name' => $safe_first_name,
				'last_name' => $safe_last_name,
				'email' => $safe_email,
				'password' => $safe_password,
				'gender' => $safe_gender,
				'dateofbirth' => $safe_dateofbirth,
				'phone_number' => $safe_phone_number,
				'address' => $safe_address,
				'zipcode' => $safe_zipcode,
				'city' => $safe_city,
				'country' => $safe_country,
				'nationality' => $safe_nationality,
				'speak_danish' => $safe_speak_danish,
				'colleague' => $safe_colleague
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
		$this->auth->secure_escape('validate', 'int', $id);
		// Sanitize
		$safe_id = $this->auth->secure_escape('sanitize', 2, $id);
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
	
	public function all_teams() {
		$this->auth->method('GET');
		//$this->auth->check_token();
		$this->auth->http_response(200, 'OK', $this->teams_model->get_all_teams());
	}

	public function team($id = null) {
		$this->auth->method('GET');
		$this->auth->check_token();
		// Validate Data

		$this->auth->secure_escape('validate', 'int', $id);

		// Sanitize Data
		$safe_id = $this->auth->secure_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->teams_model->get_team($safe_id));
	}
	public function user_team($id = null) {
		$this->auth->method('GET');
		//$this->auth->check_token();
		// Validate Data
		$this->auth->secure_escape('validate', 'int', $id);
		// Sanitize Data
		$safe_id = $this->auth->secure_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->users_model->get_user_team($safe_id));
	}
	public function team_leader($id = null) {
		$this->auth->method('GET');
		//$this->auth->check_token();
		// Validate Data
		$this->auth->secure_escape('validate', 'int', $id);
		// Sanitize Data
		$safe_id = $this->auth->secure_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->users_model->get_team_leader($safe_id));
	}
	public function team_members($id = null) {
		$this->auth->method('GET');
		//$this->auth->check_token();
		// Validate Data
		$this->auth->secure_escape('validate', 'int', $id);
		// Sanitize Data
		$safe_id = $this->auth->secure_escape('sanitize', 2, $id);
		$this->auth->http_response(200, 'OK', $this->teams_model->get_team_members($safe_id));
	}
	public function add_team() {
		$this->auth->method('POST'); 
		//$this->auth->check_token();
		$post = file_get_contents('php://input');
		$post = json_decode($post);
		$post = (array)$post;
		$args_check = array('team_name, team_info, first_shift_date, first_shift_start, first_shift_end, second_shift_date, second_shift_start, second_shift_end, team_place, team_leader_id');
		if(count(array_intersect_key(array_flip($args_check), $post)) === count($args_check)) {
			$post = (object)$post;
			// Validate Data
			$this->auth->secure_escape('validate', 'string', $post->team_name);
			$this->auth->secure_escape('validate', 'string', $post->team_info);
			$this->auth->secure_escape('validate', 'string', $post->first_shift_date);
			$this->auth->secure_escape('validate', 'string', $post->first_shift_start);
			$this->auth->secure_escape('validate', 'string', $post->first_shift_end);
			$this->auth->secure_escape('validate', 'string', $post->second_shift_date);
			$this->auth->secure_escape('validate', 'string', $post->second_shift_start);
			$this->auth->secure_escape('validate', 'string', $post->second_shift_end);
			$this->auth->secure_escape('validate', 'string', $post->team_place);
			$this->auth->secure_escape('validate', 'int', $post->team_leader_id);
			// Sanitize Data
			$safe_team_name = $this->auth->secure_escape('sanitize', 2, $post->team_name);
			$safe_team_info = $this->auth->secure_escape('sanitize', 2, $post->team_info);
			$safe_first_shift_date = $this->auth->secure_escape('sanitize', 2, $post->first_shift_date);
			$safe_first_shift_start = $this->auth->secure_escape('sanitize', 2, $post->first_shift_start);
			$safe_first_shift_end = $this->auth->secure_escape('sanitize', 2, $post->first_shift_end);
			$safe_second_shift_date = $this->auth->secure_escape('sanitize', 2, $post->second_shift_date);
			$safe_second_shift_start = $this->auth->secure_escape('sanitize', 2, $post->second_shift_start);
			$safe_second_shift_end = $this->auth->secure_escape('sanitize', 2, $post->second_shift_end);
			$safe_team_place = $this->auth->secure_escape('sanitize', 2, $post->team_place);
			$safe_team_leader_id = $this->auth->secure_escape('sanitize', 2, $post->team_leader_id);

			$res = $this->teams_model->set_team([
				'team_name' => $safe_team_name, 
				'team_info' => $safe_team_info, 
				'first_shift_date' => $safe_first_shift_date, 
				'first_shift_start' => $safe_first_shift_start, 
				'first_shift_end' => $safe_first_shift_end,
				'second_shift_date' => $safe_second_shift_date, 
				'second_shift_start' => $safe_second_shift_start, 
				'second_shift_end' => $safe_second_shift_end, 
				'team_place' => $safe_team_place, 
				'team_leader_id' => $safe_team_leader_id
				]);
			if($res) {
				$this->auth->http_response(201, 'Created', [
					'message' => 'Team Created',
					'id' => $res
				]);
			}
		}
		$this->auth->http_response(406, 'Not Acceptable', [
			'message' => 'Check the JSON data - properties are not correct' 
		]);
	}
	public function qr_code_true($id = null, $user_qr = null){
		$this->auth->method('PATCH');
		$post = file_get_contents('php://input');
		$post = json_decode($post);		
		$qr_bool = $this->users_model->get_qr_bool();
		
		if ($qr_bool === null) {
			$qr_bool = true;
			$this->users_model->set_qr_bool(true);
			print_r($qr_bool);
			print_r($id);
		};
	} 
}
