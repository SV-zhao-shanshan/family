<?php
	class User_Model extends CI_Model {
	    public function __construct() {
			$this->load->database();
		}

		public function get_user($username = false, $password = false) {
			if (false === $username) {
				$query = $this->db->get('user');
				return $query->result_array();
			}
			$query = $this->db->get_where('user', array('username' => $username, 'password' => $password));
			return $query->row_array();
		}
	}

?>
