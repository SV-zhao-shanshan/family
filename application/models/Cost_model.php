<?php
	class Cost_Model extends CI_Model {
	    public function __construct() {
			$this->load->database();
		}

		public function get_user($username = false) {
			if (false === $username) {
				$query = $this->db->get('user');
				return $query->result_array();
			}
			$query = $this->db->get_where('user', array('username' => $username));
			return $query->row_array();
		}
	}

?>
