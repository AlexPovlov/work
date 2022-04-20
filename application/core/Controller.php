<?php

namespace application\core;

use application\core\View;
/**
 * Абстрактный контроллер для настледования
 * @var array $route подгрузка с конфига данных о роутах
 * @var array $post обработанный от лишних знаков и html символов $_POST 
 * @var array $get обработанный от лишних знаков и html символов $_GET
 * @var application\core\View $view обект вида View
 * @var array $acl разрешения пользователя
 * @var object|void $model обьект модели
 */
abstract class Controller {

	public $route;
	protected $post;
	protected $get;
	protected $view;
	protected $acl;
	protected $model;

	/**
	 * @var array $route
	 */

	public function __construct($route) {
		//наполняем массив роутов
		$this->route = $route;

		//обрабатываем глобальные массивы POST и GET 
		foreach ($_POST as $key => $value) {

			$key = htmlspecialchars($key, ENT_QUOTES);
			$key = trim($key, $characters = ' ');
			$key = str_replace(array('\n','\r','\t','\v','\0','\r\n','\n\r',PHP_EOL),'',$key);
		
			$value = htmlspecialchars($value, ENT_QUOTES);
			$value = trim($value,' ');
			$value = str_replace(array('\n','\r','\t','\v','\0','\r\n','\n\r',PHP_EOL),' ',strip_tags($value));
			$value = preg_replace("/[\r\n]/", ' ', $value);
			$value = preg_replace("/[ ]+/", ' ', $value);
			
			$this->post[$key] = $value;
		}

		foreach ($_GET as $keyg => $valueg) {

			$keyg = htmlspecialchars($keyg, ENT_QUOTES);
			$keyg = trim($keyg, $characters = ' ');
			$keyg = str_replace(array('\n','\r','\t','\v','\0','\r\n','\n\r',PHP_EOL),'',$keyg);
		
			$valueg = htmlspecialchars($valueg, ENT_QUOTES);
			$valueg = trim($valueg, $characters = ' ');
			$valueg = str_replace(array('\n','\r','\t','\v','\0','\r\n','\n\r',PHP_EOL),' ',$valueg);
			
			$this->get[$keyg] = $valueg;
		}
		
		// Инкапсулируем вид
		$this->view = new View();

		$this->view->conf($route);

		//Подгружаем модель
		$this->model = $this->loadModel($route['controller']);
		
		//Проверка разрешений
		// if (!$this->checkAcl() and $route['controller'] != 'login' and $route['controller'] != 'main' and $route['controller'] != 'admin' ) {
		// 	$this->view->errorCode(403);
		// }

		
	}

	public function loadModel($name) {
		$path = 'application\models\\'.ucfirst($name);
		if (class_exists($path)) {
			return new $path;
		}
	}

	public function checkAcl() {
		if (isset($_SESSION['authorize']['id'])) {
			
			$this->acl = require 'application/config/acl.php';;
			
			if ($this->acl[$this->route['controller']] == 'all') {
				return true;
			}

		}else {
			return false;
		}
		
	}

	

}