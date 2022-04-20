<?php

namespace application\controllers;
use application\core\Controller;

class MainController extends Controller
{

    /**
     * вывод на страницу
     */
    public function indexAction()
    {
        $params = $this->model->buildTree($this->model->getCategory());

        $this->view->insert_on_layout('Главная страница',
            $this->view->render(['params'=>$params,'parent_id'=>0])
        );
        // $this->view->render('Главная страница', ['params'=>$params,'parent_id'=>0]);
    }


    /**
     * вывод на страницу данных по id
     */
    public function dataAction()
    {
        $params = $this->model->getOneCategory($this->route['id'])['description'];
        echo $params;
    }
}
