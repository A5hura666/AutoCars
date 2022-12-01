<?php
session_start();
require "autoload.php";


if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}

$TheClient = new ClientsDAO(MaBD::getInstance());

?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Créer un client</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
<nav>
    <section class="nav-left">
        <img src="img/logo.png" alt="logo">
        <a href="#">Accueil</a>
        <a href="#">Clients & Véhicules</a>
        <a href="#">Rendez-vous</a>
        <a href="#">Factures</a>
        <a href="#">Pièces</a>
    </section>
    <section class="nav-right">
        <img src="img/logout.png" alt="Déconnexion" class="logout">
    </section>
</nav>

<?php
var_dump($TheClient->getAll());
?>
<main class="interface">
    <h2>Création de client</h2>
    <section>
        <form class="createuser" method="post">
            <section>
                <div class="personalData">
                    <h3>Informations personnelles</h3>
                    <label for="fname">Prénom</label>
                    <input type="text" class="fname" name="prenom" placeholder="François" required>
                    <label for="fname">Nom</label>
                    <input type="text" class="lname" name="nom" placeholder="Duchemin" required>
                    <br>
                    <label for="fname">Adresse</label>
                    <input type="text" class="address" name="adresse" placeholder="1234 rue de la Paix" required>
                    <label for="fname">Ville</label>
                    <input type="text" class="city" name="ville" placeholder="Montréal" required>
                    <label for="fname">Code postal</label>
                    <input type="text" class="postalCode" name="cp" placeholder="H2T 2M4" required>

                </div>
                <div class="vehicledetails">
                    <h3>Véhicule</h3>

                    <label for="marque">Marque</label>
                    <input type="text" class="marque" name="marque" placeholder="Ford" required>
                    <label for="modele">Modèle</label>
                    <input type="text" class="modele" name="modele" placeholder="Mustang" required>
                    <label for="annee">Année</label>
                    <input type="text" class="annee" name="annee" placeholder="2018" required>
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" class="immatriculation" name="immat" placeholder="ABC1234" required>
                    <label for="serie">N° de série</label>
                    <input type="text" class="serie" name="serie" placeholder="2UH287490YHU1IH" required>
                </div>
                <div class="contact">
                    <h3>Contact</h3>
                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="email" name="email" placeholder="jean.dujardin@mail.com" id="email" required>
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" class="phone" name="tel" placeholder="06 12 34 56 78" id="phone" required>

                </div>
            </section>
            <div class="btn">
                <input type="reset" value="Réinitialiser">
                <input type="submit" name="validation_create_client" value="Créer l'utilisateur">
            </div>
        </form>
    </section>
</main>

<script src="js/script.js"></script>
</body>

</html>
