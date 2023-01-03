<?php
session_start();
require_once "autoload.php";

if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}



?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Accueil</title>
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
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>

    <main class="menu">

        <article class="btn-menu rdv">
            <img src="img/rdv.png" alt="Rendez-vous">
            <h3>Rendez-vous</h3>
        </article>

        <article class="btn-menu client">
            <img src="img/client.png" alt="Client">
            <h3>Clients et Véhicules</h3>
        </article>

        <article class="btn-menu facture">
            <img src="img/factures.png" alt="Factures">
            <h3>Factures</h3>
        </article>

        <article class="btn-menu piece">
            <img src="img/pieces.png" alt="Pièces">
            <h3>Pièces</h3>
        </article>


    </main>

    <section class="popupmenu rdv-full hidden">
        <main class="menu">
            <a href="creer-rdv.php">
                <article class="btn-menu newrdv">
                    <img src="img/createRdv.png" alt="Nouveau rendez-vous">
                    <h3>Créer un rendez-vous</h3>
                </article>
            </a>

            <a href="liste-rdv.php">
                <article class="btn-menu listrdv">
                    <img src="img/searchRdv.png" alt="Liste rendez-vous">
                    <h3>Consulter les <br> rendez-vous</h3>
                </article>
            </a>
        </main>
        <button class="back">✖</button>
    </section>

    <section class="popupmenu client-full hidden">
        <main class="menu">
            <a href="gestion-clients.php">
                <article class="btn-menu listclient">
                    <img src="img/client.png" alt="Liste des clients">
                    <h3>Gestion des clients</h3>
                </article>
            </a>

            <a href="creer-client.php">
                <article class="btn-menu createclient">
                    <img src="img/createClient.png" alt="Création client">
                    <h3>Créer un client</h3>
                </article>
            </a>

            <a href="gestion-vehicules.php">
                <article class="btn-menu managevehicles">
                    <img src="img/car.png" alt="Création client">
                    <h3>Gestion des véhicules</h3>
                </article>
            </a>
        </main>
        <button class="back">✖</button>
    </section>

    <section class="popupmenu facture-full hidden">
        <main class="menu">
            <a href="creer-rdv.php">
                <article class="btn-menu client">
                    <img src="img/createFacture.png" alt="Créer facture">
                    <h3>Créer un devis</h3>
                </article>
            </a>

            <a href="gestion-factures.php">
                <article class="btn-menu facture">
                    <img src="img/factures.png" alt="Liste factures">
                    <h3>Consulter les factures</h3>
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
                    <h3>Consulter le stock <br> des pièces</h3>
                </article>
            </a>

            <a href="#">
                <article class="btn-menu facture">
                    <img src="img/buyPieces.png" alt="Factures">
                    <h3>Commander des pièces</h3>
                </article>
            </a>
        </main>
        <button class="back">✖</button>
    </section>


    <script src="js/accueilChef.js"></script>
</body>

</html>