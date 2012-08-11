<?php
/**
 * Model class UserGroups for BareBoneMVC.
 *
 * @package BareBone\Model\User 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelUserUserGroups extends Model {
	/**
	 * Function to add a usergroup.
	 *
	 * @level public
	 * @param array $data The data-array that will be inserted
	 *
	 * @return void
	 *
	 */	
	public function addUserGroup($data) {
		$data['permission']['access'][] = 'common/filemanager';
		$data['permission']['modify'][] = 'common/filemanager';
		$this->db->query("INSERT INTO " . FW_PREFIX . "user_group SET name = '" . $this->db->escape($data['name']) . "', permission = '" . (isset($data['permission']) ? serialize($data['permission']) : '') . "'");
	}
	/**
	 * Function to add a usergroup.
	 *
	 * @level public
	 * @param int $user_group_id The id of the usergroup that will be updated
	 * @param array $data The data-array that will be used to update the usergroup
	 *
	 * @return void
	 *
	 */	
	public function editUserGroup($user_group_id, $data) {
		$data['permission']['access'][] = 'common/filemanager';
		$data['permission']['modify'][] = 'common/filemanager';
		$this->db->query("UPDATE " . FW_PREFIX . "user_group SET name = '" . $this->db->escape($data['name']) . "', permission = '" . (isset($data['permission']) ? serialize($data['permission']) : '') . "' WHERE user_group_id = '" . (int)$user_group_id . "'");
	}
	/**
	 * Function to delete a usergroup.
	 *
	 * @level public
	 * @param int $user_group_id The usergroupid that will be deleted
	 *
	 * @return void
	 *
	 */	
	public function deleteUserGroup($user_group_id) {
		$this->db->query("DELETE FROM " . FW_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_group_id . "'");
	}
	/**
	 * Function to add permissions for a certain page to a usergroup.
	 *
	 * @level public
	 * @param int $user_id The userid that will be used to get the groupid
	 * @param string $type The type of permission to set (access/modify)
	 * @param string $page The page for which the permissions are beeing set
	 *
	 * @return void
	 *
	 */	
	public function addPermission($user_id, $type, $page) {
		$user_query = $this->db->query("SELECT DISTINCT user_group_id FROM " . FW_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
		
		if ($user_query->num_rows) {
			$user_group_query = $this->db->query("SELECT DISTINCT * FROM " . FW_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
		
			if ($user_group_query->num_rows) {
				$data = unserialize($user_group_query->row['permission']);
		
				$data[$type][] = $page;
		
				$this->db->query("UPDATE " . FW_PREFIX . "user_group SET permission = '" . serialize($data) . "' WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");
			}
		}
	}
	/**
	 * Function to get the data for a usergroup.
	 *
	 * @level public
	 * @param int $user_group_id The usergroupid that will be used to get the data
	 *
	 * @return array
	 *
	 */	
	public function getUserGroup($user_group_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . FW_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_group_id . "'");
		
		$user_group = array(
			'name'       => $query->row['name'],
			'permission' => unserialize($query->row['permission'])
		);
		
		return $user_group;
	}
	/**
	 * Function to get the data for all usergroups.
	 *
	 * @level public
	 * @param array $data The data that will be used to sort/limit the selection
	 *
	 * @return array
	 *
	 */	
	public function getUserGroups($data = array()) {
		$sql = "SELECT * FROM " . FW_PREFIX . "user_group";
		
		$sql .= " ORDER BY name";	
			
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
	 * Function to get the count of all usergroups.
	 *
	 * @level public
	 *
	 * @return int
	 *
	 */	
	public function getTotalUserGroups() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . FW_PREFIX . "user_group");
		
		return $query->row['total'];
	}	
}
?>