<?php

namespace application\core;

use application\lib\Db;

/**
 * Абстрактная модель для настледования
 * @var \application\lib\Db $db
 */

abstract class Model {

	public $db;
	
	public function __construct() {
		$this->db = new Db;
		
	}


}