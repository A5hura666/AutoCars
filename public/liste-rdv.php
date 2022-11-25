<?php
session_start();
require "autoload.php";
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Log In</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/liste.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
<nav>
    <section class="nav-left">
        <img src="img/logo.png" alt="logo">
        <a href="home-ca.html">Accueil</a>
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
    <h2>Gestion rendez-vous</h2>
    <section>
        <aside>
            <div class="recherche">
                <h3>Rechercher un rendez-vous</h3>
                <form action="">
                    <div>
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date">
                    </div>
                    <div>
                        <label for="client">Client</label>
                        <input type="text" name="client" id="client">
                    </div>
                    <div>
                        <label for="vehicule">Véhicule</label>
                        <input type="text" name="vehicule" id="vehicule">
                    </div>
                    <div>
                        <label for="etat">Etat</label>
                        <select name="etat" id="etat">
                            <option value="en attente">En attente</option>
                            <option value="en cours">En cours</option>
                            <option value="terminé">Terminé</option>
                        </select>
                    </div>
                    <input type="submit" value="Rechercher">
                </form>
            </div>
            <div>
                <h3>Liste des rendez-vous</h3>
                <ul class="list">
                    <li><span>11/12/2022 - Duchemin</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>11/12/2022 - Metge</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>11/12/2022 - Jean</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>12/12/2022 - Dupont</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>12/12/2022 - Durand</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>12/12/2022 - Martin</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>13/12/2022 - Dazo</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>13/12/2022 - Charensol</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>13/12/2022 - De Sauza</span><a href="#" class="consulter">Consulter</a></li>
                    <li><span>13/12/2022 - Argentiéri</span><a href="#" class="consulter">Consulter</a></li>
                </ul>
            </div>
        </aside>
        <div class="details">
            <h3>Détails du rendez-vous</h3>
            <div>
                <form>

                    <div>
                        <label>Date</label>
                        <input type="date" name="date" id="date" value="11/12/2020">
                    </div>
                    <div>
                        <label>Heure</label>
                        <input type="time" name="heure" id="heure" value="11:00">
                    </div>
                    <div>
                        <label>Client</label>
                        <input type="text" name="client" id="client" value="Duchemin" list="clientlist">
                        <datalist id="clientlist">
                            <option value="Duchemin">
                            <option value="Metge" selected>
                            <option value="Jean">
                            <option value="Dupont">
                            <option value="Durand">
                            <option value="Martin">
                            <option value="Dazo">
                            <option value="Charensol">
                            <option value="De Sauza">
                            <option value="Argentiéri">
                        </datalist>
                    </div>
                    <div>
                        <label>Véhicule</label>
                        <input type="text" class="vehicule" value="Renault Clio" list="vehiclelist">
                        <datalist id="vehiclelist">
                            <option value="Renault Clio">
                            <option value="Renault Clio">
                            <option value="Renault Clio">
                            <option value="Renault Clio">
                            <option value="Renault Clio">
                        </datalist>
                    </div>
                    <div>
                        <label>Etat</label>
                        <select name="etat" id="etat">
                            <option value="en attente" selected>En attente</option>
                            <option value="en cours">En cours</option>
                            <option value="terminé">Terminé</option>
                        </select>
                    </div>


                    <div>
                        <h4>Liste des opérations</h4>
                        <ul class="list operationlist">
                            <li><span>Devis</span><a href="#">X</a></li>
                            <li><span>Changement pneux</span><a href="#">X</a></li>
                            <li><span>Ménage voiture</span><a href="#">X</a></li>
                            <li><span>Contrôle technique</span><a href="#">X</a></li>
                            <li><span>Peinture</span><a href="#">X</a></li>
                            <li><span>Réparation pare brise</span><a href="#">X</a></li>
                            <li><span>Mise à jour système de bord</span><a href="#">X</a></li>
                            <li><span>Changement des freins</span><a href="#">X</a></li>
                            <li><span>Remplacement rétroviseurs</span><a href="#">X</a></li>
                        </ul>
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