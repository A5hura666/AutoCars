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
    <title>Gestion des Véhicule</title>
    <link rel="stylesheet" href="css/gestion-utilisateur.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/liste.css">
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
        <h2>Gestion des Véhicule</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher un véhicule</h3>
                    <form action="">
                        <div>
                            <label for="marque">Marque</label>
                            <input type="text" name="marque" id="marque" placeholder="Nissan" list="listemarques">

                            <datalist id="listemarques">
                                <option value="Nissan">
                                <option value="Renault">
                                <option value="Peugeot">
                                <option value="Citroën">
                                <option value="Toyota">
                                <option value="Ford">
                                <option value="BMW">
                                <option value="Mercedes">
                                <option value="Audi">
                                <option value="Volkswagen">
                                <option value="Fiat">
                                <option value="Opel">
                                <option value="Honda">
                                <option value="Hyundai">
                            </datalist>
                        </div>
                        <div>
                            <label for="modele">Modèle</label>
                            <input type="text" name="modele" id="modele" placeholder="Micra" list="listemodeles">

                            <datalist id="listemodeles">
                                <option value="Micra">
                                <option value="Clio">
                                <option value="308">
                                <option value="C3">
                                <option value="Yaris">
                                <option value="Fiesta">
                                <option value="Série 3">
                                <option value="Classe C">
                                <option value="A3">
                                <option value="Golf">
                                <option value="Punto">
                                <option value="Corsa">
                                <option value="Civic">
                                <option value="i30">
                            </datalist>
                        </div>
                        <input type="submit" value="Rechercher">
                    </form>
                </div>
                <div>
                    <h3>Liste des véhicules</h3>
                    <ul class="list">
                        <li><span>Ford - Fiesta</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Nissan - Micra</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Renault - Clio</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Peugeot - 308</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Citroën - C3</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Toyota - Yaris</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>BMW - Série 3</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Mercedes - Classe C</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Audi - A3</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Volkswagen - Golf</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Fiat - Punto</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Opel - Corsa</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Honda - Civic</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>Hyundai - i30</span><a href="#" class="consulter">Consulter</a></li>

                    </ul>
                </div>
            </aside>
            <div class="details">
                <h3>Détails du véhicule</h3>
                <div>
                    <form class="sectiondetails">
                        <div>
                            <label for="clientname">Informations</label>
                            <div>
                                <label for="detailsmarque">Marque</label>
                                <input type="text" name="detailsmarque" id="detailsmarque" value="Ford">
                            </div>
                            <div>
                                <label for="detailsmodele">Modèle</label>
                                <input type="text" name="detailsmodele" id="detailsmodele" value="Fiesta">
                            </div>
                            <div>
                                <label for="detailsannee">Année</label>
                                <input type="number" name="detailsannee" id="detailsannee" value="2021">
                            </div>
                        </div>

                        <div>
                            <label>Véhicule</label>

                            <div>
                                <label for="detailsnbclients">Nombre de client le possédant </label>
                                <input type="number" class="detailsnbclients" id="detailsnbclients" value="13" disabled>
                            </div>
                        </div>

                </div>






                <div>
                    <input type="submit" value="Modifier">
                    <input type="submit" value="Supprimer">
                </div>
                </form>
            </div>
            </div>
        </section>
    </main>




    <script src="js/script.js"></script>
</body>

</html>