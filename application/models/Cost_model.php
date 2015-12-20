<?php
	class Cost_Model extends CI_Model {
	    public function __construct() {
			$this->load->database();
		}

		public function init_cost($userid) {
			// get book
			$sql = "select a.name as book_name, a.id as book_id from book a,book_user b where a.id=b.book_id and b.user_id=$userid";
			$query = $this->db->query($sql);
			$bookList = $query->result_array();
			// get type 
			$sql = "select * from type";
			$query = $this->db->query($sql);
			$typeList = $query->result_array();
			$data = array(
				'book_list' => $bookList,
				'type_list' => $typeList,
			);
			return $data;
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

			$sql = "select a.id as cost_id, a.type_id, a.money, a.description, a.book_name, a.book_id, a.user_id, a.create_time, b.name as type_name from cost a, type b where a.type_id=b.id and  a.book_id=$bookid and a.create_time>='$starttime' and a.create_time<='$endtime' order by a.create_time desc";
			$query = $this->db->query($sql);
			return $query->result_array();
		}

		public function add_cost($userid, $bookid, $bookname, $typeid, $money, $description='') {
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
			$where = array(
				'id' => $typeid,
			);
			$query = $this->db->get_where('type', $where);
			$query = $query->row_array();
			//type(typeid) dosn't exist
			if (empty($query)) {
				return false;
			}
			$where = array(
				'id' => $bookid,
				'book_name' => $bookname,
			);
			$query = $this->db->get_where('book', $where);
			$query = $query->row_array();
			//book(bookid, bookname) dosn't exist
			if (empty($query)) {
				return false;
			}
			$sql = "insert into cost(user_id, book_id, book_name, type_id, money, description, create_time) values($userid, $bookid, '$bookname', $typeid, $money, '$description', now())";
			$query = $this->db->query($sql);
			return $query;
		}
	}

?>
