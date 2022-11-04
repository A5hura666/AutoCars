<?php
session_start();
require_once "autoload.php";

/*$lesContacts = new AdministrateursDAO(MaBD::getInstance());
$param['login'] = isset($_POST['login'])?trim($_POST['login']):"";
$param['password'] = isset($_POST['password'])?trim($_POST['password']):"";
$param['message'] = "";

if (isset($_POST['login']) && isset($_POST['password'])) {
    if (($theAdmin = $lesContacts->check($_POST['login'], $_POST['password'])) != null) {
        $_SESSION['login'] = $theAdmin;
        header("Location: home_ca.php");
        exit(0);
    } else {
        $erreur = "login ou mdp incorrect";
    }
}*/

$erreur="";

$lesEmployes = new employeDAO(MaBD::getSchema());
$param['login'] = isset($_POST['login'])?trim($_POST['login']):"";
$param['password'] = isset($_POST['password'])?trim($_POST['password']):"";
$param['message'] = "";

if (isset($_POST['login']) && isset($_POST['password'])) {
    if (($theUser = $lesEmployes->check($_POST['password'],$_POST['login'])) != null) {
        $_SESSION['login'] = $theUser;
        header("Location: home_ca.php");
        exit(0);
    } else {
        $erreur = "login ou mdp incorrect";
    }
}

?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="../../AutoCars/public/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
<?php
if(!empty($erreur)){
    echo '<p>Message de classe '.$erreur.'</p>';
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
