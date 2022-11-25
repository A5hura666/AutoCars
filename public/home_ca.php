<?php
session_start();
require_once "autoload.php";

if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}

if(isset($_POST['logout'])){
    session_destroy();
    header("Location: login.php");
    exit(0);
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

<body>
<nav>
    <section class="nav-left">
        <img src="img/logo.png" alt="logo">
        <p>Accueil</p>
        <p>Clients & Véhicules</p>
        <p>Rendez-vous</p>
        <p>Factures</p>
        <p>Pièces</p>
    </section>
    <section class="nav-right">
        <form method="post">
            <input type="submit" name="logout" value="" class="logout">
<!--            <img src="img/logout.png" alt="deconnexion" class="logout">-->
        </form>
    </section>
</nav>

<main class="menu">

    <article class="btn-menu rdv">
        <img src="img/rdv.png" alt="Rendez-vous">
        <h2>Rendez-vous</h2>
    </article>

    <article class="btn-menu client">
        <img src="img/client.png" alt="Client">
        <h2>Clients et Véhicules</h2>
    </article>

    <article class="btn-menu facture">
        <img src="img/factures.png" alt="Factures">
        <h2>Factures</h2>
    </article>

    <article class="btn-menu piece">
        <img src="img/pieces.png" alt="Pièces">
        <h2>Pièces</h2>
    </article>


</main>

<section class="popupmenu rdv-full hidden">
    <main class="menu">
        <a href="#">
            <article class="btn-menu newrdv">
                <img src="img/createRdv.png" alt="Nouveau rendez-vous">
                <h2>Créer un rendez-vous</h2>
            </article>
        </a>

        <a href="#">
            <article class="btn-menu listrdv">
                <img src="img/searchRdv.png" alt="Liste rendez-vous">
                <h2>Consulter les <br> rendez-vous</h2>
            </article>
        </a>
    </main>
    <button class="back">✖</button>
</section>

<section class="popupmenu client-full hidden">
    <main class="menu">
        <a href="#">
            <article class="btn-menu listclient">
                <img src="img/client.png" alt="Liste des clients">
                <h2>Gestion des clients</h2>
            </article>
        </a>

        <a href="#">
            <article class="btn-menu createclient">
                <img src="img/createClient.png" alt="Création client">
                <h2>Créer un client</h2>
            </article>
        </a>

        <a href="#">
            <article class="btn-menu managevehicles">
                <img src="img/car.png" alt="Création client">
                <h2>Gestion des véhicules</h2>
            </article>
        </a>
    </main>
    <button class="back">✖</button>
</section>

<section class="popupmenu facture-full hidden">
    <main class="menu">
        <a href="#">
            <article class="btn-menu client">
                <img src="img/createFacture.png" alt="Créer facture">
                <h2>Créer une facture</h2>
            </article>
        </a>

        <a href="#">
            <article class="btn-menu facture">
                <img src="img/factures.png" alt="Liste factures">
                <h2>Consulter les factures</h2>
            </article>
        </a>
    </main>
    <button class="back">✖</button>
</section>

<section class="popupmenu pieces-full hidden">
    <main class="menu">
        <a href="#">
            <article class="btn-menu client">
                <img src="img/pieces.png" alt="Liste Pièces">
                <h2>Consulter le stock <br> des pièces</h2>
            </article>
        </a>

        <a href="#">
            <article class="btn-menu facture">
                <img src="img/buyPieces.png" alt="Factures">
                <h2>Commander des pièces</h2>
            </article>
        </a>
    </main>
    <button class="back">✖</button>
</section>

<script src="js/script.js"></script>
</body>

</html>
