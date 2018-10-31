<?php

namespace App\Model;
use App\Core\Model;

class InfoPage extends Model {

	public function getPage($opts = []) {
		return $this->db->query(
			'SELECT * FROM pages WHERE page = '.$this->db->quote($opts['page'])
		)->fetchAssoc();
	}

}