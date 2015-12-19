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
			} else {
				unset($_COOKIE['userinfo']);
				setcookie('userinfo', '', time() - 1);
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

	public function addCost() {
		$input = $this->params;
		$this->load->model('cost_model');
		$userId = $input['user_id'];
		$bookId = $input['book_id'];
		$bookName = $input['book_name'];
		$typeId = $input['type_id'];
		$money = $input['money'];
		$description = isset($input['description']) ? $input['description'] : '';
		$res = $this->cost_model->add_cost($userId, $bookId, $bookName, $typeId, $money, $description);
		if ($res == false) {
			$output = array(
				'errno' => 2,
				'msg' => 'Error occured, please try again!',
			);
		} else {
			$output = array(
				'errno' => 0,
				'msg' => 'Success',
			);
		}
		echo json_encode($output);
	}

	public function getCost() {
		$input = $this->params;
		$this->load->model('cost_model');
		$userId = $input['user_id'];
		$bookId = $input['book_id'];
		$startTime = $input['start_time'];
		$endTime = $input['end_time'];
		$data = $this->cost_model->get_cost($userId, $bookId, $startTime, $endTime);
		echo json_encode($data);
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
