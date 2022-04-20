<?php

namespace application\controllers;
use application\core\Controller;

class AdminController extends Controller
{

    /**
     * вывод на страницу
     */
    public function indexAction()
    {
        
        $params = $this->model->buildTree($this->model->getCategory());
        $category = $this->model->getCategory();
        if (!empty($this->post)) {
            if (!empty($this->post['category']) and !empty($this->post['description'])) {
                $this->model->addData($this->post['parent'],
                    $this->post['category'],
                    $this->post['description']);
                    $this->view->redirect('/admin');
            }
        }
        
        $this->view->insert_on_layout('Админка',
            [$this->view->render(['params'=>$params,'parent_id'=>0]),
            $this->view->statrender('admin/form',['params'=>$category])]
        );
        
    }

    public function updateAction()
    {
        $params = $this->model->buildTree($this->model->getCategory());
        
        if (!empty($this->post)) {
            if (!empty($this->post['category']) and !empty($this->post['description'])) {
                $this->model->updateData(
                    $this->route['id'],
                    $this->post['parent'],
                    $this->post['category'],
                    $this->post['description']);
                    $this->view->redirect('/admin/update/'.$this->route['id']);
            }
        }
        $category = $this->model->getCategory();
        $categoryfromid = $this->model->getCategoryFromId($this->route['id']);
        $parent = $this->model->getCategoryFromId($categoryfromid['parent_id']);
        $this->view->insert_on_layout('Админка',
            [$this->view->render(['params'=>$params,'parent_id'=>0]),
            $this->view->statrender('admin/formupdate',['params'=>$category,'data'=>$categoryfromid,'parent'=>$parent])]
        );
    }

    public function deleteAction()
    {
        $this->model->recursdelete($this->route['id']);
        $this->view->redirect('/admin');
    }


}
