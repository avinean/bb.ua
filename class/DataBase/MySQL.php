<?php

namespace App\DataBase;

use App\Core\Response;
use App\Core\Request;
use App\Core\Singleton;

class MySQL extends Singleton {

	public function getMySQL($db) {

        switch ($db) {
            case 'local':
            $HOST = "localhost";
            $USER = "root";
            $PASS = "";
            $DB = "";
            break;
			case 'prod':
			$HOST = "localhost";
			$USER = "id3784881_avinean";
			$PASS = "Coba1953";
			$DB = "";
			break;
            default:
            break;
        }

        $res = [
            "h" => $HOST,
            "u" => $USER,
            "p" => $PASS,
            "d" => $DB,
        ];

        return $res;
    }
    
    private function open_conn() {
        $i = $this->getMySQL('local');
        return mysqli_connect( $i['h'], $i['u'], $i['p'], $i['d']); 
    }

    private function close_conn($conn) {
        mysqli_close($conn);
    }

    public function query($query) {
        $this->conn = $this->open_conn();

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