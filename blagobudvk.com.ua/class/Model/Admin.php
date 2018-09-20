<?php

namespace App\Model;
use App\Core\Model;

class Admin extends Model {

	public function getRows($opts = []) {
		$query = 'SELECT * FROM '.$this->db->escape($opts['table']);
		return $this->db->query($query)->fetchAll();
	}

	public function changeField($opts = []) {

		$query = '
			UPDATE '.$this->db->escape($opts['table']).'
			SET '.$this->db->escape($opts['key']).' = '.$this->db->quote($opts['data'][$opts['key']]).'
			WHERE id = '.intval($opts['data']['id']);
			// return $query;
		return $this->db->query($query)->fetchAll();
	}

	public function addRow($opts = []) {

		$keys = [];
		$vals = [];

		foreach ($opts['data'] as $k => $v) {
			$keys[] = $this->db->escape($k);
			$vals[] = $this->db->quote($v);
		}

		$query = '
			INSERT INTO '.$this->db->escape($opts['table']).'
			('.implode(",", $keys).')
			VALUES ('.implode(",", $vals).')';
		return $this->db->query($query);
	}

	public function deleteRow($opts = []) {

		$query = '
			DELETE FROM '.$this->db->escape($opts['table']).'
			WHERE id = '.intval($opts['id']);
		return $this->db->query($query)->fetchAll();
	}

	public function uploadImg() {
			$file = $_FILES['userpic'];
			$root = $_SERVER['DOCUMENT_ROOT'];
			$tmp_name = $file['tmp_name'];
			$file_name = basename($file['name']);
			$name_parts = explode('.', $file_name);
			$file_extention	= array_pop($name_parts);
	
			$path_to_file = $root.'/img/'.$file_name;
	
			for ($i = 1; file_exists($path_to_file); $i++) {
				$file_name =  implode('.', $name_parts).'_'.$i.'.'.$file_extention;
				$path_to_file = $root.$file_name;
			}
	
			$folder = $root.'/img/'.$file_name;
	
			if( move_uploaded_file($tmp_name, $folder) ) {
				return '/img/'.$file_name;
			}
		}

}

