<?php

class dbLogin
{

    private $host;
    private $port;
    private $user;
    private $password;
    private $dbname;

    private $database;

    function __construct()
    {
        $dbData = parse_ini_file('../db.ini');
        $this->host = $dbData['HOST'];
        $this->port = $dbData['PORT'];
        $this->user = $dbData['USER'];
        $this->password = $dbData['PASSWORD'];
        $this->dbname = $dbData['DBNAME'];

        $this->database = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port)
        or die('Error en conexion a db' . mysqli_connect_error());
    }

    public function __destruct(){
        $this->database->close();

    }
    public function query($sql){
        $respuesta=$this->database->query($sql);
        return $respuesta->fetch_all(MYSQLI_ASSOC);
    }
}