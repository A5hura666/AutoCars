<?php
session_start();
require "autoload.php";
require "checkAccess.php";
checkAccess("Chef d'atelier");

$Dde_Intervention = new Dde_InterventionDAO(MaBD::getInstance());
$TheUsers = new UsersDAO(MaBD::getInstance());
$RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
$PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());

//Pour gérer les états
$TabEtat=["Tous","En attente","En cours","Terminé","Annulé"];
if(isset($_POST["etat"])){
    $_SESSION["etat"] = $_POST["etat"];
}


?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Gestion RDV</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/liste.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.ico" />
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
                <a href="consulter-pieces.php">Pièces</a>
                <!-- <a href="#">Pièces</a>
                <div class="dropdown-content">
                    <a href="commander-pieces.php">Commander des pièces</a>
                </div> -->
            </div>



        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>

    <main class="interface">
        <h2>Gestion rendez-vous</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher un rendez-vous</h3>
                    <form method="post" onchange="submit()">
                        <div>
                            <label for="article">Nom du client</label>
                            <input type="text" name="article" id="article" placeholder="Pneus Hiver">
                        </div>
                        <div>
                            <label for="etat">Etat</label>
                            <select name="etat" id="etat">
                                <?php
                                if(isset($_SESSION['etat']) || !empty($_SESSION['etat'])){
                                    foreach ($TabEtat as $etat){
                                        echo '<option value="'.$etat.'"> '.$etat.' </option>';
                                    }
                                }else{
                                    echo '<option value="'.$TabEtat[0].'" > '.$TabEtat[0].' </option>';
                                }
                                ?>
                            </select>
                        </div>
                        <input type="submit" name="validation_search" value="Recherche">
                </div>
                <div class="interface-big">
                    <h3>Liste des rendez-vous</h3>
                    <ul class="list">
                        <label>En cours</label>
                        <li> 🚧 <p>Duchemin Martin</p> <span>200€</span><span>12/01/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> 🚧 <p>Martin Jean</p> <span>139€</span><span>01/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> 🚧 <p>Durant Clara</p> <span>984€</span><span>05/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>

                        <label>En attente</label>
                        <li> ⏳ <p>Duchemin Martin</p> <span>200€</span><span>12/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ⏳ <p>Martin Jean</p> <span>139€</span><span>16/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ⏳ <p>Durant Clara</p> <span>984€</span><span>22/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>

                        <label>Terminé</label>
                        <li> ✅ <p>Duchemin Martin</p> <span>200€</span><span>20/12/2022</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ✅ <p>Martin Jean</p> <span>139€</span><span>18/12/2022</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ✅ <p>Durant Clara</p> <span>984€</span><span>12/12/2022</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>

                        <label>Annulé</label>
                        <li> ❌ <p>Duchemin Martin</p> <span>200€</span><span>12/02/2023</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ❌ <p>Martin Jean</p> <span>139€</span><span>11/09/2021</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>
                        <li> ❌ <p>Durant Clara</p> <span>984€</span><span>31/10/2022</span><img src="https://cdn.freebiesupply.com/logos/large/2x/adobe-pdf-icon-logo-png-transparent.png" width="20px"></li>

                    </ul>
                </div>
                </form>
            </aside>
        </section>
    </main>




    <script src="js/script.js"></script>
</body>

</html>