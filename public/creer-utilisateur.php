<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

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



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Création utilisateur</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="home-admin.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-admin.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="creer-utilisateur.php">Créer un utilisateur</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="statistiques.php">Statistiques</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="#">Opérations</a>
                <div class="dropdown-content"><a href="creer-operation.php">Créer une opération</a><a href="gestion-operations.php">Gérer les opérations</a></div>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
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
        echo "<div class='alert'>" . $message . "</div>";
    }
    ?>

    <script src="js/script.js"></script>
    <script src="js/alert.js"></script>
</body>

</html>