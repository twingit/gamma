<?php

class Poke extends CI_Model {

	function create_poke($id) {

		$query = "INSERT INTO pokes (poker_id, poked_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
		$current_user = $this->session->userdata['user_info']['id'];
		$values = array($current_user, $id, date("Y-m-d, H:i:s"), date("Y-m-d, H:i:s"));

		return $this->db->query($query, $values);

	}

	function count_people_poked() {

		$current_user = $this->session->userdata['user_info']['id'];
		$query = $this->db->query = "SELECT poker_id, count(distinct poked_id) as people_count_poked
									 FROM pokes
									 WHERE poker_id = ?";
		$value = array($current_user);

		return $this->db->query($query, $value)->row_array();

	}

	function count_people_poked_by() {

		$current_user = $this->session->userdata['user_info']['id'];
		$query = $this->db->query = "SELECT poked_id, count(distinct poker_id) as people_count_poked_by
									 FROM pokes
									 WHERE poked_id = ?";
		$value = array($current_user);

		return $this->db->query($query, $value)->row_array();

	}

	function get_user_poker_counts() {

		$current_user = $this->session->userdata['user_info']['id'];
		$query = $this->db->query = "SELECT users.name as poked_name, pokes.*, count(1) as count
									 FROM users
									 INNER JOIN pokes
									 	ON pokes.poked_id = users.id
									 WHERE poker_id = ?
									 GROUP BY poked_id";
		$value = array($current_user);

		return $this->db->query($query, $value)->result_array();

	}

	function get_user_poked_counts() {

		$current_user = $this->session->userdata['user_info']['id'];
		$query = $this->db->query = "SELECT users.name as poker_name, pokes.*, count(1) as count
									 FROM users
									 INNER JOIN pokes
									 	ON pokes.poker_id = users.id
									 WHERE poked_id = ?
									 GROUP BY poker_id";
		$value = array($current_user);

		return $this->db->query($query, $value)->result_array();

	}

	function get_all_poke_counts() {

		// $count = 0;

		// if ($count == 0) {
			
		// 	$result['total_pokes'] = '0';

		// } else {
			
		// 	$result['total_pokes'] = $count + 1;

		// }

		return $this->db->query("SELECT users.name as poked, users.id, users.alias, users.email, count(pokes.id) as count from users 
			left join pokes on users.id = pokes.poked_id group by poked")->result_array();
		
		// return $this->db->query("SELECT users1.name as poker_name, users2.name as poked_name, users2.alias as poked_alias, users2.email as poked_email, pokes.*, count(1) as count
		// 	FROM users as users1
		// 	INNER JOIN pokes
		// 		ON(pokes.poker_id = users1.id)
		// 	INNER JOIN users as users2
		// 		ON(pokes.poked_id = users2.id)
		// 	GROUP BY poked_id
		// 	ORDER BY count DESC")->result_array();

		// $query = "SELECT DISTINCT poker_id as poker
		// 		  FROM pokes
		// 		  WHERE poked_id = ?
		// 		  GROUP BY poker_id";

		// $current_user = $this->session->userdata['user_info']['id'];

		// $pokers = $this->db->query($query, array($current_user))->result_array();

		// $count = 0;

		// foreach ($pokers as $poker) {
			
		// 	$count = $count + 1;

		// }

		// if ($count == 0) {
			
		// 	$result['total_pokes'] = '0'; // Why string?

		// } else {
			
		// 	$result['total_pokes'] = $count;
		// 	$query = "";

		// }
		
		// $query = "SELECT users.name, users.alias, users.email, count(pokes.poked_id) as total
		// 		  FROM users
		// 		  LEFT JOIN pokes
		// 		  ON pokes.poked_id = users.id
		// 		  GROUP BY users.id";
		// return $this->db->query($query)->result_array();

	}

	// EXPLAIN
	// SELECT users1.name as poker_name, users2.name as poked_name, pokes.*, count(1) FROM users as users1
	// INNER JOIN pokes
	// 	ON(pokes.poker_id = users1.id)
	// INNER JOIN users as users2
	// 	ON(pokes.poked_id = users2.id)
	// GROUP BY poked_id
	// ;

	// SELECT users.name, users2.name AS friend_name FROM users
	// LEFT JOIN friendships ON friendships.user_id = users.id
	// LEFT JOIN users AS users2 ON friendships.friend_id = users.id

}

?>