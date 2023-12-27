<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Load library atau helper yang diperlukan
		$this->load->helper('security');
	}

	public function index()
	{
		echo "auth";
	}

	public function generateToken()
	{
		$jwt = new JWT();

		$jwt_secret_key = "akbar123";
		$data = array(
			"USERNAME" => "akbar",
			"EMAIL" => "akbar@gmail.com",
			"valid_until" => time() + 3600
		);

		$token = $jwt->encode($data, $jwt_secret_key, 'HS256');
		echo $token;
	}

	public function validateToken()
	{
		// $token = $this->input->get_request_header('Authorization');
		// get bearer token
		$token = $this->input->get_request_header('Authorization');

		echo json_encode($token);
		// $jwt = new JWT();

		// validation
		// $decode_token = $jwt->decode($token, "akbar123", array('HS256'));
	}

	//create session
	public function createSession()
	{
		$this->session->set_userdata('username', 'akbar');
		$this->session->set_userdata('email', 'akbar@gmail');
		$this->session->set_userdata('valid_until', time() + 3600);

		echo json_encode($this->session->userdata());
	}

	//login
	public function login()
	{
		$EMAIL = $this->input->post('EMAIL');
		$password = $this->input->post('PASSWORD');

		//hash password


		$this->db->select('*');
		$this->db->from('tb_m_user');
		$this->db->where('EMAIL', $EMAIL);
		// $this->db->where('PASSWORD', $password);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$user_password = $query->row()->PASSWORD;

			if (password_verify($password, $user_password)) {
				//login success
				//create session
				$this->session->set_userdata('EMAIL', $EMAIL);
				$this->session->set_userdata('valid_until', time() + 3600);

				$response = array(
					'status' => 'success',
					'message' => 'Login success'
				);
			} else {
				//login failed
				$response = array(
					'status' => 'error',
					'message' => 'Login failed'
				);

				// echo json_encode($response);
			}

			//login success
			//create session
			$this->session->set_userdata('EMAIL', $EMAIL);
			$this->session->set_userdata('valid_until', time() + 3600);

			// $response = array(
			// 	'status' => 'success',
			// 	'message' => 'Login success'
			// );
		} else {
			//login failed
			$response = array(
				'status' => 'error',
				'message' => 'Login failed'
			);
		}

		echo json_encode($response);
	}

	// logout
	public function logout()
	{
		$this->session->unset_userdata('EMAIL');
		$this->session->unset_userdata('valid_until');

		$response = array(
			'status' => 'success',
			'message' => 'Logout success'
		);

		echo json_encode($response);
	}
}
