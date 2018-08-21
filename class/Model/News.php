<?php

namespace App\Model;
use App\Core\Model;

class News extends Model {

	public function getNews($opts = []) {

		if (isset($opts['where'])) $where = $this->db->where($opts['where']);
		else $where = 1;

		if (isset($opts['limit'])) $limit = intval($opts['limit']);
		else $limit = 10;

		if (isset($opts['offset'])) $offset = intval($opts['offset']);
		else $offset = 0;

		$query = '
			SELECT * 
			FROM news 
			WHERE '.$where.'
			LIMIT '.$limit.'
			OFFSET '.$offset;
		$res = $this->db->query($query)->fetchAll();

		return $res;
    }
}