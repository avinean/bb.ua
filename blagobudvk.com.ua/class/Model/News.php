<?php

namespace App\Model;
use App\Core\Model;

class News extends Model {

	public function getRows($opts = []) {

		if (isset($opts['where'])) $where = $this->db->where($opts['where']);
		else $where = 1;

		if (isset($opts['limit'])) $limit = intval($opts['limit']);
		else $limit = 10;

		if (isset($opts['offset'])) $offset = intval($opts['offset']);
		else $offset = 0;

		$query = '
			SELECT id, DATE(datetime) as datetime, title, description, img 
			FROM news 
			WHERE '.$where.'
			ORDER BY datetime DESC
			LIMIT '.$limit.'
			OFFSET '.$offset;
		$res = $this->db->query($query)->fetchAll();

		return $res;
	}
	
	public function getSingleRow($opts) {
		return $this->db->query('SELECT id, DATE(datetime) as datetime, title, description, img  FROM news WHERE id = '.intval($opts['id']))->fetchAssoc();
	}
}