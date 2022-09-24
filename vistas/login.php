<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
}
require '../utils/bd.php';

if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $records = $this->database->prepare('SELECT id, usuario, clave FROM usuarios WHERE usuario = :usuario AND clave = :clave');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->bindParam(':clave', $_POST['clave']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /php-login");
    } else {
        $message = 'Sorry, those credentials do not match';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
<body>
<?php require 'componentes/header.php' ?>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>

<h1>Login</h1>
<span>or <a href="signup.php">SignUp</a></span>

<form action="login.php" method="POST">
    <input name="usuario" type="text" placeholder="Usuario">
    <input name="clave" type="password" placeholder="Contraseña">
    <input type="submit" value="Submit">
</form>
</body>
</html>
