<?php
//Import model
include './model/model_user.php';

class  ManagerUser extends User {
    /*---------------------------------------------
                    METHODS
    ---------------------------------------------*/
    //Account creation:
    public function addUser($bdd):void
    {//object instance:
        $login = $this->getLoginUser();
        $pass = $this->getpassUser();
        $mail = $this->getMailUser();
        $img = $this->getImgUser();
        try
        {//SQL request 
            $req = $bdd->prepare('INSERT INTO user(login_user, pass_user, mail_user, img_user) 
            VALUES (:login_user, :pass_user, :mail_user, :img_user)');
            $req -> execute(array(
                'login_user' => $login,
                'pass_user' => $pass,
                'mail_user' => $mail,
                'img_user' => $img
            ));
        }//Catching and return exception:
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
    //Method to show an user by his mail
    public function getUserByMail($bdd)
    {
        try
        {//SQL request
            $req = $bdd->prepare('SELECT login_user, img_user, id_user, pass_user FROM user WHERE mail_user = :mail_user');
            $req -> execute(array(
                'mail_user' => $this->getMailUser(), 
            ));
            $data = $req -> fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }//Catching and return exception:
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }
}
?>