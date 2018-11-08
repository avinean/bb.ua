<?php

namespace App\DataBase;

use App\Core\Response;
use App\Core\Request;
use App\Core\Singleton;

class MySQL extends Singleton {

    function __construct() {
    	global $config;
        $this->config = $config;
    }

    private function open_conn() {
        $i = $this->config['DataBase'];
        return mysqli_connect( $i['h'], $i['u'], $i['p'], $i['d']); 
    }

    private function close_conn($conn) {
        mysqli_close($conn);
    }

    public function query($query) {
        $this->conn = $this->open_conn();
        mysqli_set_charset($this->conn,"utf8");
        $result = mysqli_query($this->conn, $query.' --');

        $response = new Response;
        $response->Set('response', $result);
        $response->Set('conn', $this->conn);
		if ($response->conn->errno || $response->conn->connect_errno) {
			print_r($response->conn);
		}
        return $response;
    }

    public function quote($str) {
        return "'".mysqli_real_escape_string($this->open_conn(), $str)."'";
    }

    public function escape($str) {
        return mysqli_real_escape_string($this->open_conn(), $str);
    }

    public function where($opts) {
        if (is_array($opts)) {

			$where = [1];
			foreach ($opts as $value) {
				if (isset($value['type']) && isset($value['comp']) && isset($value['val']) && isset($value['field'])) {
					
					$field = $this->escape($value['field']);

					if ($value['comp'] === '>') $comp = '>';
					if ($value['comp'] === '<') $comp = '<';
					if ($value['comp'] === '=') $comp = '=';

					if ($value['type'] === 's') $val = $this->quote($value['val']);
					if ($value['type'] === 'i') $val = intval($value['val']);

					$where[] = $field . ' ' . $comp . ' ' . $val;
				}
			}
			return '(' .implode(') AND (', $where) . ')';
        }
        return [1];
    }
}