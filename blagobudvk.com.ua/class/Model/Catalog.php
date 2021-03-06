<?php

namespace App\Model;
use App\Core\Model;

class Catalog extends Model {

	public function getGoods($opts = []) {

		if (isset($opts['where'])) $where = $this->db->where($opts['where']);
		else $where = 1;

		$query = 'SELECT * FROM goods WHERE '.$where;
		$res = $this->db->query($query)->fetchAll();

		return $res;
	}
	
	public function getColors() {
		$response = $this->db->query('SELECT * FROM colors')->fetchAll();
		$res = [];
		foreach($response as $val) {
			$res[$val['id']] = $val['title'];
		}
		return $res;
	}
	
	public function getProduct($opts = []) {
		return $this->db->query('SELECT * FROM goods WHERE id = '.intval($opts['id']))->fetchAssoc();
	}
}