<?php

namespace application\core;

/**
 * Класс вида. Шаблонизирует и показывает страницы
 * @var mixed $path путь к подгружаемой странице
 * @var mixed $route массив controller & action
 * @var string $layout шаблон страницы
 */

class View {

	private $path;
	private $route;
	private static $layout = 'default';

	/**
	 * инкапсулием в $route данные о controller & action
	 * создаем в $path путь из названия controller & action
	 * @param array $route
	 */

	public function conf($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	/**
	 * шаблонизатор 
	 * @param string $title название страницы
	 * @param array $vars переменные передаваемые на страницу
	 */

	public function render($vars = []) {
		extract($vars);
		
		$path = 'application/views/'.$this->path.'.php';
				
		if (file_exists($path)) {
			
			ob_start();
			
			require $path;
			$content = ob_get_clean();
		}

		return $content;
	}

	public function insert_on_layout($title,$content)
	{
		if (is_array($content)) {
			require 'application/views/layoutsarray/'.static::$layout.'.php';
		}else
		require 'application/views/layouts/'.static::$layout.'.php';
	}

	/**
	 * шаблонизатор статический для подгрузки рекурсивного вида 
	 * @param string $title название страницы
	 * @param array $vars переменные передаваемые на страницу
	 * return @var string $content
	 */

	public static function statrender($path, $vars = [])
	{
		extract($vars);
		
		$path = 'application/views/'.$path.'.php';
				
		if (file_exists($path)) {
			
			ob_start();
			require $path;
			$content = ob_get_clean();
			
		}
		
		return $content;
	}

	/**
	 * Подгрузка логина без автоматической подгрузки пути
	 * @param string $title название страницы
	 */

	public function login($title)
	{

		require 'application/views/login/index.php';
	}

	/**
	 * редирект на другую страницу
	 * @param string $url - url куда делать редиркт
	 */

	public function redirect($url) {
		header('location: '.$url);
		exit;
	}


	/**
	 * вывод страниц ошибок 
	 * @param int $code код ошибки
	 */

	public function errorCode($code) {
		http_response_code($code);

		$path = 'application/views/errors/'.$code.'.php';
		if (file_exists($path)) {
			require $path;
		}
		exit;
	}

	/**
	 * Отладочные функции
	 */

	public function message($status, $message) {
		exit(json_encode(['status' => $status, 'message' => $message]));
	}

	public function location($url) {
		exit(json_encode(['url' => $url]));
	}

}	