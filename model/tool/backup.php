<?php
/**
 * Model class Backup for BareBoneMVC.
 *
 * @package BareBone\Model\Tool 
 *
 * @author Jeroen Guyt <jeroen@clsystems.nl>
 *
 * @since 0.0.1
 *
 */
  

class ModelToolBackup extends Model {
	/**
	 * Function to restore the database
	 *
	 * @level public
	 * @param string $sql The sql-text to be used for restore ($_FILES[]) 
	 *
	 * @return void 
	 *
	 */	
	public function restore($sql) {
		foreach (explode(";\n", $sql) as $sql) {
    		$sql = trim($sql);
    		
			if ($sql) {
      			$this->db->query($sql);
    		}
  		}
		
		$this->cache->delete('*');
	}
	/**
	 * Function to get the tables from the database.
	 * To be used for the select-box.
	 *
	 * @level public
	 *
	 * @return array The table-data
	 *
	 */	
	public function getTables() {
		$table_data = array();
		
		$query = $this->db->query("SHOW TABLES FROM `" . DB_DATABASE . "`");
		
		foreach ($query->rows as $result) {
			if (utf8_substr($result['Tables_in_' . DB_DATABASE], 0, strlen(DB_PREFIX)) == DB_PREFIX) {
				if (isset($result['Tables_in_' . DB_DATABASE])) {
					$table_data[] = $result['Tables_in_' . DB_DATABASE];
				}
			}
		}
		
		return $table_data;
	}
	/**
	 * Function to backup the selected tables from the database.
	 *
	 * @level public
	 * @param array $tables The tables to be back-upped 
	 *
	 * @return string The sql-text generated
	 *
	 */	
	public function backup($tables) {
		$output = '';

		foreach ($tables as $table) {
			if (DB_PREFIX) {
				if (strpos($table, DB_PREFIX) === false) {
					$status = false;
				} else {
					$status = true;
				}
			} else {
				$status = true;
			}
			
			if ($status) {
				$output .= 'TRUNCATE TABLE `' . $table . '`;' . "\n\n";
			
				$query = $this->db->query("SELECT * FROM `" . $table . "`");
				
				foreach ($query->rows as $result) {
					$fields = '';
					
					foreach (array_keys($result) as $value) {
						$fields .= '`' . $value . '`, ';
					}
					
					$values = '';
					
					foreach (array_values($result) as $value) {
						$value = str_replace(array("\x00", "\x0a", "\x0d", "\x1a"), array('\0', '\n', '\r', '\Z'), $value);
						$value = str_replace(array("\n", "\r", "\t"), array('\n', '\r', '\t'), $value);
						$value = str_replace('\\', '\\\\',	$value);
						$value = str_replace('\'', '\\\'',	$value);
						$value = str_replace('\\\n', '\n',	$value);
						$value = str_replace('\\\r', '\r',	$value);
						$value = str_replace('\\\t', '\t',	$value);			
						
						$values .= '\'' . $value . '\', ';
					}
					
					$output .= 'INSERT INTO `' . $table . '` (' . preg_replace('/, $/', '', $fields) . ') VALUES (' . preg_replace('/, $/', '', $values) . ');' . "\n";
				}
				
				$output .= "\n\n";
			}
		}

		return $output;	
	}
}
?>