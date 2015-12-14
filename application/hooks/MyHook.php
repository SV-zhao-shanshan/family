<?php
class MyHook extends CI_Controller{
	public function __construct() {
		parent::__construct();
		//$this->load = load_class('Loader', 'core');
		//$this->load->initialize();
		$this->load->model('user_model');
		//$/this->load->helper('url_helper');
		//$this->user_model = new User_Model();
		//load_class('');
		$input = new CI_Input();
		$this->params = array_merge($input->get(), $input->post());
	}
	public function checkLogin($params) {
		$input = $this->params;
		$isLogin = '0';
		if (!isset($input['username']) || !isset($input['password'])) {
		} else {
			$data = $this->user_model->get_user($input['username'], $input['password']);
			if (!empty($data)) {
				$isLogin = '1';
			}
		}
		$_COOKIE['isLogin'] = $isLogin;
		if ($isLogin == '0') {
			echo '{"errno":1,"msg":"Please login"}';
			die();
		}
	}
}

?>
