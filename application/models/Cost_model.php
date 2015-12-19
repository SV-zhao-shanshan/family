<?php
	class Cost_Model extends CI_Model {
	    public function __construct() {
			$this->load->database();
		}

		public function get_cost($userid, $bookid, $starttime, $endtime) {
			$where = array(
				'book_id' => $bookid,
				'user_id' => $userid,
			);
			$query = $this->db->get_where('book_user', $where);
			$query = $query->row_array();
			//current user don't have this book
			if (empty($query)) {
				return array();
			}

			$sql = "select * from cost where book_id=$bookid and create_time>='$starttime' and create_time<='$endtime' order by create_time desc";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function add_cost($userid, $bookid, $bookname, $typeid, $money, $description='') {
			$sql = "insert into cost(user_id, book_id, book_name, type_id, money, description, create_time) values($userid, $bookid, '$bookname', $typeid, $money, '$description', now())";
			$query = $this->db->query($sql);
			return $query;
		}
	}

?>
