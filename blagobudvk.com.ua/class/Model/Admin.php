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
		return $this->db->query($query)->fetchAll();
	}

}

