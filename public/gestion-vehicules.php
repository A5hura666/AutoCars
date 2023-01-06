<?php
session_start();

require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Marque = new MarqueDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());

if (isset($_POST["marque"])) {
    $_SESSION["marque"] = $_POST["marque"];
}

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
        <h2>Gestion des Véhicule</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher un véhicule</h3>

                    <form method="post" onchange="submit()">
                        <div>
                            <label for="marque">Marque</label>
                            <?php
                            if (isset($_SESSION["marque"]) && !empty($_SESSION["marque"])) {
                                $value = $_SESSION["marque"];
                            } else {
                                $value = "";
                            }
                            echo '<input type="text" name="marque" id="marque" placeholder="Nissan" list="listemarques" value="' . $value . '">';
                            ?>
                            <datalist id="listemarques">
                                <?php
                                foreach ($Marque->getAll() as $marque) {
                                    echo '<option value="' . $marque->getMarque() . '">';
                                }
                                ?>
                            </datalist>
                        </div>
                        <div>
                            <label for="modele">Modèle</label>
                            <?php
                            if (isset($_POST["modele"]) && !empty($_POST["modele"])) {
                                $value = $_POST["modele"];
                            } else {
                                $value = "";
                            }
                            echo '<input type="text" name="modele" id="modele" placeholder="Micra" list="listemodeles" value="' . $value . '">';
                            ?>
                            <datalist id="listemodeles">
                                <?php
                                if (isset($_SESSION["marque"]) && !empty($_SESSION["marque"])) {
                                    foreach ($Modele->getOneByMarque($_SESSION["marque"]) as $modele) {
                                        echo '<option value="' . $modele->getModèle() . '">';
                                    }
                                } else {
                                    foreach ($Modele->getAll() as $modele) {
                                        echo '<option value="' . $modele->getModèle() . '">';
                                    }
                                }
                                ?>
                            </datalist>
                        </div>
                    </form>
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
                                <input type="text" name="detailsmarque" id="detailsmarque" value="<?php if (isset($_SESSION['marque'])) echo $_SESSION['marque'];
                                                                                                    else echo ""; ?>">
                            </div>
                            <div>
                                <label for="detailsmodele">Modèle</label>
                                <input type="text" name="detailsmodele" id="detailsmodele" value="<?php if (isset($_POST['modele'])) echo $_POST['modele'];
                                                                                                    else echo "" ?>">
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
                                <input type="number" class="detailsnbclients" id="detailsnbclients" value="<?php
                                                                                                            $counter = 0;
                                                                                                            if (isset($_POST['modele'])) {
                                                                                                                foreach ($TheVehicule->getAll() as $vehicule) {
                                                                                                                    if ($Modele->getOne($vehicule->getNumModele())->getModèle() === $_POST['modele']) {
                                                                                                                        $counter++;
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                            echo $counter;

                                                                                                            ?>" disabled>

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