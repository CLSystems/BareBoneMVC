<?php
/**
 * Model class Setting for SilverJet BareBone.
 *
 * @package BareBone\Model\Setting 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelSettingSetting extends Model {
	/**
	 * Function to get the settings for a certain group
	 *
	 * @level public
	 * @param string $group The group name 
	 *
	 * @return array 
	 *
	 */	
	public function getSetting($group) {
		$data = array(); 
		
		$query = $this->db->query("SELECT * FROM " . FW_PREFIX . "setting WHERE `group` = '" . $this->db->escape($group) . "'");
		
		foreach ($query->rows as $result) {
			if (!$result['serialized']) {
				$data[$result['key']] = $result['value'];
			} else {
				$data[$result['key']] = unserialize($setting['value']);
			}
		}

		return $data;
	}
	/**
	 * Function to edit the settings for a certain group
	 *
	 * @level public
	 * @param string $group The group name 
	 * @param array $data The data to be saved
	 *
	 * @return void 
	 *
	 */	
	public function editSetting($group, $data) {
		$this->db->query("DELETE FROM " . FW_PREFIX . "setting WHERE `group` = '" . $this->db->escape($group) . "'");

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$this->db->query("INSERT INTO " . FW_PREFIX . "setting SET `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape($value) . "'");
			} else {
				$this->db->query("INSERT INTO " . FW_PREFIX . "setting SET `group` = '" . $this->db->escape($group) . "', `key` = '" . $this->db->escape($key) . "', `value` = '" . $this->db->escape(serialize($value)) . "', serialized = '1'");
			}
		}
	}
	/**
	 * Function to delete the settings for a certain group
	 *
	 * @level public
	 * @param string $group The group name 
	 *
	 * @return void 
	 *
	 */	
	public function deleteSetting($group) {
		$this->db->query("DELETE FROM " . FW_PREFIX . "setting WHERE `group` = '" . $this->db->escape($group) . "'");
	}
}
?>