<?php

namespace App\Model;
use App\Core\Model;

class Admin extends Model {

	public function getRows($opts = []) {
		$query = 'SELECT * FROM '.$this->db->escape($opts['table']);
		return $this->db->query($query)->fetchAll();
	}

}

