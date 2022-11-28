<?php
session_start();
require "autoload.php";

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

<main class="interface">
    <h2>Création de client</h2>
    <section>
        <form class="createuser">
            <section>
                <div class="personalData">
                    <h3>Informations personnelles</h3>
                    <label for="fname">Prénom</label>
                    <input type="text" class="fname" placeholder="François" required>
                    <label for="fname">Nom</label>
                    <input type="text" class="lname" placeholder="Duchemin" required>
                    <br>
                    <label for="fname">Adresse</label>
                    <input type="text" class="address" placeholder="1234 rue de la Paix" required>
                    <label for="fname">Ville</label>
                    <input type="text" class="city" placeholder="Montréal" required>
                    <label for="fname">Code postal</label>
                    <input type="text" class="postalCode" placeholder="H2T 2M4" required>

                </div>
                <div class="vehicledetails">
                    <h3>Véhicule</h3>

                    <label for="marque">Marque</label>
                    <input type="text" class="marque" placeholder="Ford" required>
                    <label for="modele">Modèle</label>
                    <input type="text" class="modele" placeholder="Mustang" required>
                    <label for="annee">Année</label>
                    <input type="text" class="annee" placeholder="2018" required>
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" class="immatriculation" placeholder="ABC1234" required>
                    <label for="serie">N° de série</label>
                    <input type="text" class="serie" placeholder="2UH287490YHU1IH" required>
                </div>
                <div class="contact">
                    <h3>Contact</h3>
                    <label for="email">Adresse e-mail</label>
                    <input type="email" class="email" placeholder="jean.dujardin@mail.com" id="email" required>
                    <label for="phone">Numéro de téléphone</label>
                    <input type="tel" class="phone" placeholder="06 12 34 56 78" id="phone" required>

                </div>
            </section>
            <div class="btn">
                <input type="reset" value="Réinitialiser">
                <input type="submit" value="Créer l'utilisateur">
            </div>
        </form>
    </section>
</main>

<script src="js/script.js"></script>
</body>

</html>
