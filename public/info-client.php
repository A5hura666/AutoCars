<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Opérateur");

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Marque = new MarqueDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());

?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Gestion des clients</title>
    <link rel="stylesheet" href="css/gestion-utilisateur.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/liste.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="home-employe.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-employe.php">Accueil</a>
            </div>
            <div><a href="emploisDuTemps">Emplois du temps</a>
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
        <h2>Consulter les clients</h2>
        <section>
            <aside>

                <div>
                    <h3>Liste des clients</h3>
                    <form method="post">
                        <ul class="list list-big">
                            <?php
                            //Affichage des clients
                            foreach ($TheClient->getAll() as $clients) {
                                echo "<li>";
                                echo '<span>' . $clients->getLastName() . " " . $clients->getFirstName() . '</span>';
                                echo '<input type="submit" name="Consulter" class="consulter" value="' . $clients->getCodeClient() . '" >';
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
                    </form>
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
                                <input type="text" name="name" id="name" value="<?php echo $newClient->getLastName() ?>" disabled>
                            </div>
                            <div>
                                <label for="fname">Prénom</label>
                                <input type="text" name="fname" id="fname" value="<?php echo $newClient->getFirstName() ?>" disabled>
                            </div>
                        </div>
                        <div>
                            <label for="email">Contact</label>
                            <div>
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" value="<?php echo $newClient->getMail() ?>" disabled>
                            </div>
                            <div>
                                <label for="phone">Téléphone</label>
                                <input type="tel" name="phone" id="phone" value="<?php echo $newClient->getTelephone() ?>" disabled>
                            </div>
                        </div>
                        <div class="adressse">
                            <label for="adresse">Adresse</label>
                            <div>
                                <label for="address">Adresse</label>
                                <input type="text" name="address" id="address" value="<?php echo $newClient->getAddress() ?>" disabled>
                            </div>
                            <div>
                                <label for="zip">Code postal</label>
                                <input type="text" name="zip" id="zip" value="<?php echo $newClient->getCP() ?>" disabled>
                            </div>
                            <div>
                                <label for="city">Ville</label>
                                <input type="text" name="city" id="city" value="<?php echo $newClient->getCity() ?>" disabled>
                            </div>
                        </div>


                        <div>
                            <?php
                            $info_vehicule = $TheVehicule->getByIdClient($newClient->getCodeClient());
                            $info_modele = $Modele->getOne($info_vehicule->getNumModele())->getModèle();
                            $marque = $info_vehicule->getMarque();

                            ?>
                            <label>Véhicule</label>

                            <div>
                                <label for="marque">Marque</label>
                                <input type="text" class="marque" id="marque" value="<?php echo $marque ?>" disabled>
                            </div>
                            <div>
                                <label for="modele">Modèle</label>
                                <input type="text" class="modele" id="modele" value="<?php echo $info_modele ?>" disabled>
                            </div>
                            <div>

                                <label for="immat">Immatriculation</label>
                                <input type="text" class="immat" id="immat" value="<?php echo $info_vehicule->getNoImmatriculation() ?>" disabled>
                            </div>
                        </div>

                </div>


                </form>
            </div>
            </div>
        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>