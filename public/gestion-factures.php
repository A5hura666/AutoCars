<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Marque = new MarqueDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());


?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Gestion des factures</title>
    <link rel="stylesheet" href="css/gestion-utilisateur.css">
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

    <main class="interface">
        <h2>Gestion des factures</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher un utilisateur</h3>
                    <form action="">
                        <div>
                            <label for="clientname">Nom</label>
                            <input type="text" name="clientname" id="clientname" placeholder="Dujardin">
                        </div>
                        <div>
                            <label for="clientfname">Prénom</label>
                            <input type="text" name="clientfname" id="clientfname" placeholder="Jean">
                        </div>
                        <div>
                            <label for="clientemail">Email</label>
                            <input type="text" name="clientemail" id="clientemail" placeholder="jean.dujardin@mail.fr">
                        </div>
                        <div>
                            <label for="clientphone">Téléphone</label>
                            <input type="text" name="clientphone" id="clientphone" placeholder="067816382029">
                        </div>

                        <input type="submit" value="Rechercher">
                    </form>
                </div>
                <div>
                    <h3>Liste des clients</h3>
                    <ul class="list">
                        <?php
                        //Affichage des clients
                        foreach ($TheClient->getAll() as $clients) {
                            echo "<li>";
                            echo '<span>' . $clients->getLastName() . " " . $clients->getFirstName() . '</span>';
                            echo '<input type="submit" name="Consulter" class="consulter" value="' . $clients->getCodeClient() . '">';
                            echo "</li>";

                            //echo '<input  type="text" name="" hidden value="'.$clients->getCodeClient().'">' . "</li>";
                            if (isset($_POST['Consulter'])) {
                                $_SESSION['info_clients'] = $_POST['Consulter'];
                            }
                        }

                        //Recuperation des different champs du client sélectionner
                        if (isset($_SESSION['info_clients'])) {
                            $newClient = $TheClient->getOne($_SESSION['info_clients']);
                        } else {
                            $newClient = $TheClient->getOne($_POST['Consulter']);
                        }
                        ?>
                    </ul>
                </div>
            </aside>
            <div class="details">
                <h3>Détails du client</h3>
                <div>
                    <form class="sectiondetails">
                        <div>
                            <label for="clientname">Informations</label>
                            <div>
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" value="<?php echo $newClient->getLastName() ?>">
                            </div>
                            <div>
                                <label for="fname">Prénom</label>
                                <input type="text" name="fname" id="fname" value="<?php echo $newClient->getFirstName() ?>">
                            </div>
                        </div>
                        <div>
                            <label for="email">Contact</label>
                            <div>
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $newClient->getMail() ?>">
                            </div>
                            <div>
                                <label for="phone">Téléphone</label>
                                <input type="tel" name="phone" id="phone" value="<?php echo $newClient->getTelephone() ?>">
                            </div>
                        </div>
                        <div class="adressse">
                            <label for="adresse">Adresse</label>
                            <div>
                                <label for="address">Adresse</label>
                                <input type="text" name="address" id="address" value="<?php echo $newClient->getAddress() ?>">
                            </div>
                            <div>
                                <label for="zip">Code postal</label>
                                <input type="text" name="zip" id="zip" value="<?php echo $newClient->getCP() ?>">
                            </div>
                            <div>
                                <label for="city">Ville</label>
                                <input type="text" name="city" id="city" value="<?php echo $newClient->getCity() ?>">
                            </div>
                        </div>


                        <div>
                            <label>Véhicule</label>
                            <?php
                            foreach ($TheVehicule->getAll() as $vehicule) {
                                echo '<div> <label for="marque">Marque</label>
                                <input type="text" class="marque" id="marque" value="' . $vehicule->getMarque() . '">
                            </div>
                            <div>
                                <label for="modele">Modèle</label>
                                <input type="text" class="modele"  id="modele" value="Clio">
                            </div>
                            <div>

                                <label for="immat">Immatriculation</label>
                                <input type="text" class="immat" id="immat" value="AB-123-CD">
                            </div>';
                            }
                            ?>

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