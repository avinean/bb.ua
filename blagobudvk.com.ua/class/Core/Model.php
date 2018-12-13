<?php

namespace App\Core;

use App\Core\Singleton;

class Model extends Singleton {

    function __construct() {
        $this->db = new \App\DataBase\MySQL;
        $this->req = new \App\Core\Request;
		$this->home = '/';
    }

    public function json($arr = []) {
        return json_encode($arr);
    }

	public function writeVisitStat($opts) {
		$this->db->query(
			'INSERT INTO visit_stat 
				(
					full_path,
					path,
					page,
					ip,
					referrer,
					category,
					page_id,
					agent,
					server,
					router
				) 
			VALUES 
				(
					'.$this->db->quote($opts['fullPath']).',
					'.$this->db->quote($opts['path']).',
					'.$this->db->quote($opts['page']).',
					'.$this->db->quote($_SERVER['REMOTE_ADDR']).',
					'.$this->db->quote($_SERVER['HTTP_REFERER']).',
					'.$this->db->quote($opts['category']).',
					'.$this->db->quote($opts['id']).',
					'.$this->db->quote($_SERVER['HTTP_USER_AGENT']).',
					'.$this->db->quote(json_encode($_SERVER)).',
					'.$this->db->quote(json_encode($opts)).'
				)
			'
		);
	}

	public function writeContactStat($opts) {
		$referrer = isset($opts['referrer']) ? $this->db->quote($opts['referrer']) : '""';
		$name = isset($opts['name']) ? $this->db->quote($opts['name']) : '""';
		$email = isset($opts['email']) ? $this->db->quote($opts['email']) : '""';
		$phone = isset($opts['phone']) ? $this->db->quote($opts['phone']) : '""';
		$viber = isset($opts['viber']) ? $this->db->quote($opts['viber']) : '""';

		$this->db->query(
			'INSERT INTO contact_stat 
				(
					referrer,
					name,
					email,
					phone,
					viber
				) 
			VALUES 
				(
					'.$referrer.',
					'.$name.',
					'.$email.',
					'.$phone.',
					'.$viber.'
				)
			'
		);
	}

	public function writeProductsOrderStat($opts) {
		$cnt = isset($opts['cnt']) ? intval($opts['cnt']) : -1;
		$id = isset($opts['id']) ? intval($opts['id']) : -1;

		$this->db->query(
			'INSERT INTO order_stat 
				(
					cnt,
					prod_id
				) 
			VALUES 
				(
					'.$cnt.',
					'.$id.'
				)
			'
		);
	}
}