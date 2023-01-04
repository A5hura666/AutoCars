<?php
session_start();
require_once "autoload.php";
require "checkAccess.php";

checkAccess("Opérateur")


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Gestion des Véhicule</title>
    <link rel="stylesheet" href="css/gestion-utilisateur.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/liste.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="home-employe.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-employe.php">Accueil</a>
            </div>
            <div>
                <a href="operations.php">Opérations</a>
            </div>
            <div>
                <a href="info-client.php">Informations client</a>
            </div>
            <div><a href="#">Pièces</a>
                <div class="dropdown-content">
                    <a href="stockPieces">Consulter le stock des pièces</a>
                    <a href="demanderPieces">Demander des pièces</a>
                </div>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>

    <main class="interface">
        <h2>Liste des opérations</h2>
        <section>
            <aside>
                <div>
                    <h3>Liste des opérations</h3>
                    <ul class="list list-big">
                        <span>01/04/2022</span>
                        <li><span>🚧 Duchemin - Changement pneus</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>🚧 Martin - Réparation phare</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>📃 Leclerc - Changement filtre à air</span><a href="#" class="consulter">Consulter</a></li>

                        <span>01/04/2022</span>
                        <li><span>📃 Lucci - Réparation pare-brise</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>📃 Metge - Mise à jour du système de navigation</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>📃 Seg - Changement liquide de boite de vitesse</span><a href="#" class="consulter">Consulter</a></li>

                        <span>01/04/2022</span>
                        <li><span>📃 Dupont - Nettoyage vehicule</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>📃 Objois - Réparation courroie distribution</span><a href="#" class="consulter">Consulter</a></li>
                        <li><span>📃 Durand - Réparation climatisation</span><a href="#" class="consulter">Consulter</a></li>


                    </ul>
                </div>
            </aside>
            <div class="details">
                <h3>Détails de l'opération</h3>
                <div>
                    <form class="sectiondetails">
                        <div>
                            <label>Client</label>
                            <div>
                                <label for="clientname">Nom</label>
                                <input type="text" name="clientname" id="clientname" disabled>
                            </div>
                            <div>
                                <label for="clientlastname">Prénom</label>
                                <input type="text" name="clientlastname" id="clientlastname" disabled>
                            </div>
                            <div>
                                <label for="clientphone">Téléphone</label>
                                <input type="tel" name="clientphone" id="clientphone" disabled>
                            </div>
                            <div>
                                <label for="clientmail">Email</label>
                                <input type="email" name="clientmail" id="clientmail" disabled>
                            </div>
                        </div>


                        <div>
                            <label>Vehicule</label>
                            <div>
                                <label for="detailsmarque">Marque</label>
                                <input type="text" name="detailsmarque" id="detailsmarque" disabled>
                            </div>
                            <div>
                                <label for="detailsmodele">Modèle</label>
                                <input type="text" name="detailsmodele" id="detailsmodele" disabled>
                            </div>
                            <div>
                                <label for="detailsimmatriculation">Immatriculation</label>
                                <input type="text" name="detailsimmatriculation" id="detailsimmatriculation" disabled>
                            </div>
                        </div>

                        <div>
                            <label>Opération</label>
                            <div>
                                <label for="detailsoperation">Opération</label>
                                <input type="text" name="detailsoperation" id="detailsoperation" disabled>
                            </div>
                            <div>
                                <label for="detailsdate">Etat</label>
                                <select name="detailsdate" id="detailsdate">
                                    <option value="en attente">En attente</option>
                                    <option value="en cours">En cours</option>
                                    <option value="terminé">Terminé</option>
                                </select>
                            </div>

                        </div>


                        <input type="submit" value="Enregistrer">

                    </form>
                </div>
            </div>
        </section>
    </main>

</body>

</html>