<?php

namespace application\core;

use application\core\View;

/**
 * Класс маршрутов
 * @var array $routes
 * @var array $params
 * @var application\core\View $view
 */

class Router {

    protected $routes = [];
    protected $params = [];
    private $view;

    /**
     * Подгружаем конфиг с маршрутами и наполняяем $routes маршрутами
     */
    
    public function __construct() {
        
        $arr = require 'application/config/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }

        
    }

    /**
     * наполненеие роутера с добавлением спец знаков для поиска регулярным выражением 
     */

    private function add($route, $params) {
        
        $route = preg_replace('/{([a-z]+):([^\}]+)}/', '(?P<\1>\2)', $route);
        
        $route = '#^'.$route.'$#';
        $this->routes[$route] = $params;
    }

    /**
     * Поиск в uri маршрута 
     * return bool true
     */

    private function match() {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = preg_replace("/\?.+/", "", $url);
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        if (is_numeric($match)) {
                            $match = (int) $match;
                        }
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * проверка на наличие сессии
     * return bool true
     */

    private function ses()
	{
		
            if (isset($_SESSION['authorize']['id']) and isset($_SESSION['authorize']['login'])) {
                if ($this->veryfuser()) {
                    
                    return true;
                   
                }else {
                    
                    return false;
                    
                }
                 
            }else {
                return false;
            }

	}


    /**
     * Проверка на валидность сессии
     * return bool true
     */
    private function veryfuser()
    {
        if (!empty($_SESSION)) {
            if (password_verify('mwtW94ptB'.$_SESSION['authorize']['id'].'lWK4MqrKpM'.$_SESSION['authorize']['login'].'CG2KKFe6yQ',$_SESSION['authorize']['key']) and password_verify('SnYospldgNllWZs5B6LutQhCmfFLoSfKtHTf5CuuiZeL6',$_SESSION['key'])) {
               
                return true;
            }else {
                return false;
            }
        }else {
            return false;
        }
        
    }

    /**
     * Главный метод который запускает контроллеры и модели а если не находит их отправляет ошибку 404
     */

    public function run(){
        $this->view = new View();
        if ($this->match()) {
            $this->view->conf($this->params);
            
            $url = trim($_SERVER['REQUEST_URI'], '/');
        
            if (!$this->ses() and $this->params['controller'] != 'login' and  $this->params['controller'] != 'main') {
                $_SESSION = [];
                session_destroy();
                $_COOKIE = [];
                
                $this->view->redirect('/login');
            }else{
                
                $path = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
                
                if (class_exists($path)) {
                    $action = $this->params['action'].'Action';

                    if (method_exists($path, $action)) {
                        $controller = new $path($this->params);
                            
                        $controller->$action();
                    } else {
                        $this->view->errorCode(404);
                    }
                }else {
                    $this->view->errorCode(404);
                }
            }
            
        }else {
            $this->view->errorCode(404);
        }
    }

}