<?php

include_once("bd.php");

class User extends BaseDatos {

    private $user;
    private $password;

    public function userExist($user,$password){
        $md5pass = md5($password);

        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE usuario = :user AND clave = :password');

        //$query->execute(['user' => $user, 'pass' => $md5pass]);

        if($query->rowCount()){
            return true;
        }else {
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE usuario = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser){
            $this->user = $currentUser['usuario'];
            $this->password = $currentUser['clave'];
        }
    }

    public function getUser(){
        return $this->usuario;
    }

}

?>
