<?php
session_start();
unset($_SESSION['logged']);
$_SESSION['messages'] =  ['unlogged'];

header('Location: index.php');
