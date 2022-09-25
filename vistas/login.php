<?php

if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
}
require '../utils/bd.php';
//include_once ('sesion.php');

$database = new BaseDatos();
$usuario = $_GET['usuario'];
$clave = $_GET['clave'];

$sql = "SELECT id, usuario, clave FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";

$records = $database->selectAll($sql);

if($records){
    session_start();
    $_SESSION['user_id'] = true;
    header("Location: index.php");
}else{
    session_start();
    session_destroy();
}


/*
if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $records = $database->selectAll($sql);
    //$records->bindParam('ss', $_POST['usuario'], $_POST['clave']);
    //$records->bindParam('s', $_POST['clave']);
    //$records->execute();
    //$results = $records->fetch(PDO::FETCH_ASSOC);

    //$message = '';

    var_dump($records);

    if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /php-login");
    } else {
        $message = 'Sorry, those credentials do not match';
    }

}
*/

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
<body>
<?php require 'componentes/header.php';

var_dump($records);
?>


<h1>Login</h1>
<span>or <a href="signup.php">SignUp</a></span>

<form action="login.php" method="GET">
    <input name="usuario" type="text" placeholder="Usuario">
    <input name="clave" type="password" placeholder="Contraseña">
    <input type="submit" value="Submit">
</form>
</body>
</html>
