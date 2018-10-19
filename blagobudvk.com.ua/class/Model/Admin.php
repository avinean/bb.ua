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

	public function changePageData($opts = []) {

		$set = [];

		foreach ($opts['data'] as $key => $val) {
			$set[] = $this->db->escape($key).' = '.$this->db->quote($val);
		}

		$query = '
			UPDATE '.$this->db->escape($opts['table']).'
			SET '.implode(',', $set).'
			WHERE id = '.intval($opts['data']['id']);

		return $this->db->query($query)->fetchAll();
	}

	public function addRow($opts = []) {

		$keys = [];
		$vals = [];

		foreach ($opts['data'] as $k => $v) {
			if ($k == 'folder') continue;
			$keys[] = $this->db->escape($k);
			$vals[] = $this->db->quote($v);
		}

		$query = '
			INSERT INTO '.$this->db->escape($opts['table']).'
			('.implode(",", $keys).')
			VALUES ('.implode(",", $vals).')';
		return $this->db->query($query)->ID();
	}

	public function deleteRow($opts = []) {

		$query = '
			DELETE FROM '.$this->db->escape($opts['table']).'
			WHERE id = '.intval($opts['id']);
		return $this->db->query($query)->fetchAll();
	}

	public function uploadImg($cur_folder) {
		$file = $_FILES['userpic'];
		$root = $_SERVER['DOCUMENT_ROOT'];
		$tmp_name = $file['tmp_name'];
		$file_name = basename($file['name']);
		$name_parts = explode('.', $file_name);
		$file_extention	= array_pop($name_parts);

		$path_to_file = $root."/img/$cur_folder/".$file_name;

		for ($i = 1; file_exists($path_to_file); $i++) {
			$file_name =  implode('.', $name_parts).'_'.$i.'.'.$file_extention;
			$path_to_file = $root.$file_name;
		}

		$folder = $root."/img/$cur_folder/".$file_name;

		if( move_uploaded_file($tmp_name, $folder) ) {
			return "/img/$cur_folder/".$file_name;
		}
	}

	public function getColors() {
		return $this->db->query('SELECT * FROM colors')->fetchAll();
	}

	public function getFields($opts) {
		$response = $this->db->query('SHOW COLUMNS FROM '.$this->db->escape($opts['table']))->fetchAll();
		$res = [];
		foreach ($response as $key => $value) {
			$res[] = $value['Field'];
		}
		return $res;
	}

}

