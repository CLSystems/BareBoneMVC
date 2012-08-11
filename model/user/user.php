<?php
/**
 * Model class User for SilverJet BareBone.
 *
 * @package BareBone\Model\User 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelUserUser extends Model {
	/**
	 * Function to add a user.
	 *
	 * @level public
	 * @param array $data The data-array that will be inserted
	 *
	 * @return void
	 *
	 */	
	public function addUser($data) {
		$this->db->query("INSERT INTO `" . FW_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', password = '" . $this->db->escape(md5($data['password'])) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}
	/**
	 * Function to edit a user.
	 *
	 * @level public
	 * @param int $user_id The userid that will be edited
	 * @param array $data The data-array that will be used to update the user
	 *
	 * @return void
	 *
	 */	
	public function editUser($user_id, $data) {
		$this->db->query("UPDATE `" . FW_PREFIX . "user` SET username = '" . $this->db->escape($data['username']) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");
		
		if ($data['password']) {
			$this->db->query("UPDATE `" . FW_PREFIX . "user` SET password = '" . $this->db->escape(md5($data['password'])) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}
	/**
	 * Function to edit a user-password.
	 *
	 * @level public
	 * @param int $user_id The userid that will be updated
	 * @param string $password The password-string that will be used to update the user
	 *
	 * @return void
	 *
	 */	
	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE `" . FW_PREFIX . "user` SET password = '" . $this->db->escape(md5($password)) . "' WHERE user_id = '" . (int)$user_id . "'");
	}
	/**
	 * Function to edit a user-code.
	 * To be used before updating a user-password, based on email.
	 *
	 * @level public
	 * @param string $email The email of the user that will be updated
	 * @param string $code The code-string that will be used to update the user
	 *
	 * @return void
	 *
	 */	
	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . FW_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE email = '" . $this->db->escape($email) . "'");
	}
	/**
	 * Function to delete a user.
	 *
	 * @level public
	 * @param int $user_id The userid that will be deleted
	 *
	 * @return void
	 *
	 */	
	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM `" . FW_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	}
	/**
	 * Function to get the data of a user.
	 *
	 * @level public
	 * @param int $user_id The userid that will be returned
	 *
	 * @return array
	 *
	 */	
	public function getUser($user_id) {
		$query = $this->db->query("SELECT * FROM `" . FW_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	
		return $query->row;
	}
	/**
	 * Function to get the data of a user based on the username.
	 *
	 * @level public
	 * @param string $username The user that will be returned
	 *
	 * @return array
	 *
	 */	
	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM `" . FW_PREFIX . "user` WHERE username = '" . $this->db->escape($username) . "'");
	
		return $query->row;
	}
	/**
	 * Function to get the data of a user based on the generated code for password reset.
	 *
	 * @level public
	 * @param string $code The user that will be returned
	 *
	 * @return array
	 *
	 */	
	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . FW_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");
	
		return $query->row;
	}
	/**
	 * Function to get the data of all users.
	 *
	 * @level public
	 * @param array $data The data that will be used to sort and/or limit the list
	 *
	 * @return array
	 *
	 */	
	public function getUsers($data = array()) {
		$sql = "SELECT * FROM `" . FW_PREFIX . "user`";
			
		$sort_data = array(
			'username',
			'status',
			'date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY username";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			
			
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			
		$query = $this->db->query($sql);
	
		return $query->rows;
	}
	/**
	 * Function to get the count of all users.
	 *
	 * @level public
	 *
	 * @return int
	 *
	 */	
	public function getTotalUsers() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . FW_PREFIX . "user`");
		
		return $query->row['total'];
	}
	/**
	 * Function to get the count of all users based in a certain group.
	 *
	 * @level public
	 *
	 * @return int
	 *
	 */	
	public function getTotalUsersByGroupId($user_group_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . FW_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");
		
		return $query->row['total'];
	}
	/**
	 * Function to get the count of all users based on email.
	 *
	 * @level public
	 *
	 * @return int
	 *
	 */	
	public function getTotalUsersByEmail($email) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . FW_PREFIX . "user` WHERE email = '" . $this->db->escape($email) . "'");
		
		return $query->row['total'];
	}	
}
?>