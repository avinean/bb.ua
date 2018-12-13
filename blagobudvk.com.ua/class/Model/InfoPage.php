<?php

namespace App\Model;
use App\Core\Model;

class InfoPage extends Model {

	public function getPage($opts = []) {
		return $this->db->query(
			'SELECT * FROM pages WHERE page = '.$this->db->quote($opts['page'])
		)->fetchAssoc();
	}

	public function getAllPages($opts = []) {
		$tmp = $this->db->query(
			'SELECT page,title,description,page_title,page_description,page_keywords FROM pages'
		)->fetchAll();
		$res = [];
		foreach ($tmp as $page) {
			$res[$page['page']] = $page;
		}
		return $res;
	}

}