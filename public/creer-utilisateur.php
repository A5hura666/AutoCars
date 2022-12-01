<?php
session_start();
require "autoload.php";

if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}

$message = "";
$erreur = "";

$theUsers = new UsersDAO(MaBD::getInstance());

if (isset($_POST['createUser'])) {
    $newUser = new Users(DAO::UNKNOWN_ID, $_POST['nom'], $_POST['prenom'], $_POST['role'], $_POST['login'], password_hash($_POST['password'], PASSWORD_ARGON2ID));
    $message = $_POST['nom'] . " " . $_POST['prenom'] . " " . $_POST['role'] . " a bien été ajouté.";
    $theUsers->insert($newUser);
} else {
    $erreur = "une erreur c'est produite lors de l'insertion de l'utilisateur";
}


if (isset($_POST['deconnexion'])) {
    session_destroy();
    header("Location: Connexion.php");
    exit(0);
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Création utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
    <nav>
        <section class="nav-left">
            <img src="img/logo.png" alt="logo">
            <div>
                <a href="home-ca.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>

            <div>
                <a href="#">Rendez-vous</a>
                <div class="dropdown-content">
                    <a href="creer-rdv.php">Créer un rendez-vous</a>
                    <a href="liste-rdv.php">Gestion des rendez-vous</a>
                </div>
            </div>

            <div>
                <a href="#">Clients & Véhicules</a>
                <div class="dropdown-content">
                    <a href="gestion-clients.php">Gestion des clients</a>
                    <a href="creer-client.php">Créer un client</a>
                    <a href="gestion-vehicules.php">Gestion des véhicules</a>
                </div>
            </div>


            <div>
                <a href="#">Factures</a>
                <div class="dropdown-content">
                    <a href="creer-rdv.php">Créer une facture</a>
                    <a href="gestion-factures.php">Gestion des factures</a>
                </div>
            </div>


            <div>
                <a href="#">Pièces</a>
                <div class="dropdown-content">
                    <a href="consulter-pieces.php">Consulter le stock des pièces</a>
                    <a href="commander-pieces.php">Commander des pièces</a>
                </div>
            </div>



        </section>
        <section class="nav-right">
            <img src="img/logout.png" alt="Déconnexion" class="logout">
        </section>
    </nav>

    <main class="interface">
        <h2>Création d'utilisateur</h2>
        <section>
            <form class="createuser" method="post">

                <section>
                    <div class="personalData">
                        <h3>Informations personnelles</h3>
                        <label for="fname">Prénom</label>
                        <input type="text" class="fname" name="prenom" placeholder="François" required>
                        <label for="fname">Nom</label>
                        <input type="text" class="lname" name="nom" placeholder="Duchemin" required>
                    </div>
                    <div class="role">
                        <h3>Rôle</h3>
                        <div>
                            <input type="radio" name="role" id="Administrateur" value="Administrateur" required>
                            <label for="Administrateur">Administrateur</label><br>
                        </div>
                        <div>
                            <input type="radio" name="role" id="Chef d'atelier" value="Chef d'atelier" required>
                            <label for="Chef d'atelier">Chef d'atelier</label><br>
                        </div>
                        <div>
                            <input type="radio" name="role" id="Employé" value="Employé" required>
                            <label for="Employé">Employé</label>
                        </div>
                    </div>
                    <div class="credentials">
                        <h3>Identifiants</h3>
                        <label for="username">Nom d'utilisateur</label>
                        <input type="text" class="username" name="login" placeholder="fduchemin" required>
                        <label for="password">Mot de passe</label>
                        <input type="text" class="password" name="password" placeholder="**************" required>
                    </div>
                </section>
                <div class="btn">
                    <input type="reset" value="Réinitialiser">
                    <input type="submit" name="createUser" value="Créer l'utilisateur">
                </div>
            </form>
        </section>
    </main>

    <?php
    if (!empty($message)) {
        echo $message;
    }
    ?>

    <script src="js/script.js"></script>
</body>

</html>