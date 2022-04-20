<?php 

namespace application\controllers;
use application\core\Controller;

class LoginController extends Controller
{

    /**
     * логин
     */
    public function indexAction()
    {

        
        if (!empty($this->post)) {
            if (!empty($this->post['name']) and !empty($this->post['pass'])) {
                
                if ($this->model->user_verif($this->post['name'],$this->post['pass'])) {
                    
                    $this->view->redirect('/admin');
                }
                
            }
        }
        $this->view->login('Вход');
        
    }

    public function logoutAction()
    {
        session_destroy();
        $this->view->redirect('/login');
    }

}
