<?php
	class Type_Model extends CI_Model {
	    public function __construct() {
			$this->load->database();
		}

		public function get_type($id = false) {
			if (false === $id) {
				$query = $this->db->get('type');
				return $query->result_array();
			}
			$query = $this->db->get_where('type', array('id' => $id));
			return $query->row_array();
		}
	}

?>
