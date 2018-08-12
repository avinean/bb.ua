<?php

namespace App\Model;
use App\Core\Model;

class Catalog extends Model {

	public function getGoodsByCategory($opts = []) {

		if (isset($opts['where'])) $where = $this->db->where($opts['where']);

		$query = 'SELECT * FROM blagobud.goods WHERE '.$where;
		$res = $this->db->query($query)->fetchArray();

		return $res;
    }
}