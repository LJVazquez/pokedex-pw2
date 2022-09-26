<?php
session_start();
if(!isset($_SESSION["logueado"])){
    echo  session_destroy();
    header("location: login.php");


}
