<?php
session_start();
require_once "autoload.php";

$theUsers = new UsersDAO(MaBD::getInstance());

$param['login'] = isset($_POST['login'])?trim($_POST['login']):"";
$param['password'] = isset($_POST['password'])?trim($_POST['password']):"";
$param['message'] = "";
$erreur="";

//Les Users Connexion
if (isset($_POST['login']) && isset($_POST['password'])) {
    if (($theUser = $theUsers->check($_POST['login'],$_POST['password'])) != null) {
        $_SESSION['login'] = $theUser;
        header("Location: home-ca.php");
        exit(0);
    } else {
        $erreur = "Login or password wrong !";
    }
}
?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body class="loginpage">
<?php
if(!empty($erreur)){
    echo '<p>'.$erreur.'</p>';
}
?>
<main class="login">

    <section id="login">
        <form method="post">
            <h1>Connexion</h1>

            <section>
                <section class="credentials">
                    <label>ID d'employé</label>
                    <input type="text" name="login" placeholder="DufourT">
                </section>

                <section class="credentials">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="********">
                </section>
            </section>

            <section class="login-btn">
                <input type="submit" value="Se connecter">
            </section>
        </form>
    </section>


    <section id="logo">
        <img src="img/logo.png" alt="logo">
        <h2>Auto Cars</h2>
    </section>

</main>
</body>

</html>
