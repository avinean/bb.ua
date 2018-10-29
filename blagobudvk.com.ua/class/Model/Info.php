<?php

namespace App\Model;
use App\Core\Model;

class Info extends Model {

	public function getRows($opts = []) {

		if (isset($opts['where'])) $where = $this->db->where($opts['where']);
		else $where = 1;

		if (isset($opts['limit'])) $limit = intval($opts['limit']);
		else $limit = 10;

		if (isset($opts['offset'])) $offset = intval($opts['offset']);
		else $offset = 0;

		$query = '
			SELECT id, DATE(datetime) as datetime, title, description, img 
			FROM info 
			WHERE '.$where.'
			LIMIT '.$limit.'
			OFFSET '.$offset;
		$res = $this->db->query($query)->fetchAll();

		return $res;
	}
	
	public function getSingleRow($opts) {
		return $this->db->query('SELECT id, DATE(datetime) as datetime, title, description, img  FROM info WHERE id = '.intval($opts['id']))->fetchAssoc();
	}

	public function getFinder() {
		$finders = [];

		foreach ($this->db->query('SELECT page,title,description FROM pages')->fetchAll() as $val) {
			$finders[] = [
				"url" => "/".$val['page'],
				"title" => $val['title'],
				"description" => $val['description']
			];
		}

		foreach ($this->db->query('SELECT id,title,description FROM sales')->fetchAll() as $val) {
			$finders[] = [
				"url" => "/sales/".$val['id'],
				"title" => $val['title'],
				"description" => $val['description']
			];
		}

		foreach ($this->db->query('SELECT id,title,description FROM news')->fetchAll() as $val) {
			$finders[] = [
				"url" => "/news/".$val['id'],
				"title" => $val['title'],
				"description" => $val['description']
			];
		}

		foreach ($this->db->query('SELECT id,title,description FROM info')->fetchAll() as $val) {
			$finders[] = [
				"url" => "/info/".$val['id'],
				"title" => $val['title'],
				"description" => $val['description']
			];
		}

		foreach ($this->db->query('SELECT id,type,title,description FROM goods')->fetchAll() as $val) {
			$finders[] = [
				"url" => "/catalog/".$val['type']."/".$val['id'],
				"title" => $val['title'],
				"description" => $val['description']
			];
		}

		return $finders;
	}

	public function getMeta() {
		return $this->db->query('SELECT * FROM meta')->fetchAssoc();
	}
}