<?php

namespace application\models;
use application\core\Model;

/**
 * модель
 */

class Login extends Model 
{
    public function user_verif($log,$pass)
    {
        $user = $this->db->GetOneSqlRequest("SELECT * FROM `users` WHERE `login`=:login",['login'=>$log]);
        
            if(password_verify($pass,$user['password'])){
                
                    $_SESSION['authorize']['id'] = $user['id'];
					$_SESSION['authorize']['login'] = $user['login'];
					$_SESSION['authorize']['key'] = password_hash('mwtW94ptB'.$user['id'].'lWK4MqrKpM'.$user['login'].'CG2KKFe6yQ', PASSWORD_DEFAULT);
					$_SESSION['key'] = password_hash('SnYospldgNllWZs5B6LutQhCmfFLoSfKtHTf5CuuiZeL6', PASSWORD_DEFAULT) ;
					return true;
            }

    }
}