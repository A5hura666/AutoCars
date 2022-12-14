<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Marque = new MarqueDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());
if (!isset($_POST['Consulter'])) {
    $_POST['Consulter'] = "1";
}

if (isset($_POST['Modifier'])){
    $clibeforup = $TheClient->getOne($_POST['id']);
    $cli = new Client($_POST['id'],$_POST['name'],$_POST['fname'],$_POST['address'],$_POST['zip'],$_POST['city'],$_POST['phone'],$_POST['email'],$clibeforup->getDateCreation());
    $TheClient->update($cli);
}
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
                <a href="liste-rdv.php">Factures</a>
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
        <h2>Gestion des clients</h2>
        <section>
            <aside>
                <!-- <div class="recherche">
                    <h3>Rechercher un utilisateur</h3>
                    <form method="post" action="">
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
                </div> -->
                <div>
                    <h3>Liste des clients</h3>
                    <form method="post">
                        <ul class="list list-big">
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
                    </form>
                </div>
            </aside>
            <div class="details">
                <h3>Détails du client</h3>
                <div>
                    <form class="sectiondetails" method="post">
                        <div>
                            <label for="clientname">Informations</label>
                            <div>
                                <input type="text" name="id" id="id" value="<?php echo $newClient->getCodeClient() ?>" hidden>
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
                            <?php
                            $info_vehicule = $TheVehicule->getByIdClient($newClient->getCodeClient());
                            $info_modele = $Modele->getOne($info_vehicule->getNumModele())->getModèle();
                            $marque = $info_vehicule->getMarque();

                            ?>
                            <label>Véhicule</label>

                            <div>
                                <label for="marque">Marque</label>
                                <input type="text" class="marque" id="marque" value="<?php echo $marque ?>">
                            </div>
                            <div>
                                <label for="modele">Modèle</label>
                                <input type="text" class="modele" id="modele" value="<?php echo $info_modele ?>">
                            </div>
                            <div>

                                <label for="immat">Immatriculation</label>
                                <input type="text" class="immat" id="immat" value="<?php echo $info_vehicule->getNoImmatriculation() ?>">
                            </div>
                        </div>
                        <div>
                            <div class="frow">
                                <input type="submit" name="Modifier" value="Modifier">
                                <input type="submit" value="Supprimer">
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