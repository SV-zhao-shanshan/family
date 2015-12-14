<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Family extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('url_helper');
		$input = new CI_Input();
		$this->params = array_merge($input->get(), $input->post());
		$this->checkLogin();
	}
	
	public function checkLogin() {
		if (isset($_COOKIE['userinfo'])) {
			return;
		}
		$input = $this->params;
		$isLogin = '0';
		if (!isset($input['username']) || !isset($input['password'])) {
		} else {
			$data = $this->user_model->get_user($input['username'], $input['password']);
			if (!empty($data)) {
				$isLogin = '1';
				unset($data['password']);
				$_COOKIE['userinfo'] = json_encode($data);
				setcookie('userinfo', json_encode($data), time() + 3600*24*360);
			}
		}
		$_COOKIE['isLogin'] = $isLogin;
		if ($isLogin == '0') {
			echo '{"errno":1,"msg":"Please login"}';
			die();
		}
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		echo json_encode($_COOKIE);
		$this->load->view('welcome_message');
	}

	public function login()
	{
		$output = array(
			'errno' => 0,
			'msg' => 'success',
		);
		$input = $this->params;
		//$data = $this->user_model->get_user();
		echo json_encode($output);
	}
}