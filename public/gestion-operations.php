<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

$message = "";
$erreur = "";

?>

<html>

<head>
    <title>AutoCars | Gestion des opérations</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/liste.css" />
    <link rel="stylesheet" href="css/gestion-utilisateur.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> 
            <a   class="nav-logo invert" href="home-ca.php">
                <img src="img/logo.png" alt="logo" />
            </a>
            <div> <a href="home-ca.php">Accueil</a>
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
                <img class="logout" src="img/logout.png"  alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="interface">
        <h2>Gestion des opérations</h2>
        <section class="manageOperation">
            <aside>
                <div class="recherche">
                    <h3>Rechercher une opération </h3>
                    <form>
                        <div><label for="clientname">Nom</label><input type="text" name="clientname" id="clientname" placeholder="Dujardin" /></div><input type="submit" value="Rechercher" />
                    </form>
                </div>
                <div>
                    <h3>Liste des opérations </h3>
                    <ul class="list">
                        <ul>
                            <li> <span>Changement Pneus</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Controle technique</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Vidange</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Peinture</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Devis</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Ménage</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Reparation</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Révision</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Réparation pare brise</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Mise à jour du système de bord</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Réparation pneu</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Réparation vitre</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Mise à jour du système de navigation</span><a class="consulter" href="#">Consulter</a></li>
                            <li> <span>Changement des freins</span><a class="consulter" href="#">Consulter</a></li>
                        </ul>
                    </ul>
                </div>
            </aside>
            <div class="details">
                <h3>Détails de l'opération</h3>
                <div>
                    <form class="sectiondetails">
                        <div> <label>Informations</label>
                            <div><label for="opname">Nom</label><input class="opname" type="text" name="opname" required="required" /></div>
                            <div><label for="opprice">Prix (en €)</label><input class="opprice" type="number" name="opprice" required="required" /></div>
                            <div> <label for="opduration">Durée (en minutes)</label><input class="opduration" type="number" name="opduration" required="required" /></div>
                        </div>
                    </form>
                </div>
                <div><input class="opSave" type="button" value="Enregistrer" /><input class="opDelete" type="submit" value="Supprimer" /></div>
            </div>
        </section>
    </main>
</body>
<script src="js/bundle.js"></script>

</html>