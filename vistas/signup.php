<?php

require '../utils/bd.php';

$message = '';

if (!empty($_POST['usuario']) && !empty($_POST['clave'])) {
    $sql = "INSERT INTO usuarios (usuario, clave) VALUES (:usuario, :clave)";
    $stmt = $this->conecction->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $clave = password_hash($_POST['clave'], PASSWORD_BCRYPT);
    $stmt->bindParam(':clave', $clave);

    if ($stmt->execute()) {
        $message = 'Successfully created new user';
    } else {
        $message = 'Sorry there must have been an issue creating your account';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
<body>

<?php require 'componentes/header.php' ?>

<?php if(!empty($message)): ?>
    <p> <?= $message ?></p>
<?php endif; ?>

<h1>SignUp</h1>
<span>or <a href="login.php">Login</a></span>

<form action="signup.php" method="POST">
    <input name="usuario" type="text" placeholder="Usuario">
    <input name="clave" type="password" placeholder="Clave">
    <input name="confirme_clave" type="password" placeholder="Repita su Clave">
    <input type="submit" value="Submit">
</form>

</body>
</html>