<?php
session_start();
require "autoload.php";

if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}
$message = "";

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Marque = new MarqueDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());

// Création date courante pour le client

$date = new DateTime();
$dateCli = $date->format('Y-m-d');

if (isset($_POST['validation_create_client'])) {
    $newClient = new Client(DAO::UNKNOWN_ID, $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['tel'], $_POST['email'], $dateCli);
    $message = $_POST['nom'] . " " . $_POST['prenom'] . " a bien été ajouté.";
    $TheClient->insert($newClient);

    var_dump($TheVehicule->getAll());
} else {
    $erreur = "une erreur c'est produite lors de l'insertion de l'utilisateur";
}

//formulaire vehicules
if (isset($_POST["marque"])) {
    $_SESSION["marque"] = $_POST["marque"];
}
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Créer un client</title>
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
        <img src="img/logout.png" alt="Déconnexion" class="logout">
    </section>
</nav>


<main class="interface">
    <h2>Création de client</h2>
    <section>
        <form class="createuser" method="post">
            <section>
                <div class="personalData">
                    <h3>Informations personnelles</h3>
                    <label for="fname">Prénom</label>
                    <input type="text" class="fname" name="prenom" placeholder="François" required>
                    <label for="fname">Nom</label>
                    <input type="text" class="lname" name="nom" placeholder="Duchemin" required>
                    <br>
                    <label for="fname">Adresse</label>
                    <input type="text" class="address" name="adresse" placeholder="1234 rue de la Paix" required>
                    <label for="fname">Ville</label>
                    <input type="text" class="city" name="ville" placeholder="Montréal" required>
                    <label for="fname">Code postal</label>
                    <input type="text" class="postalCode" name="cp" placeholder="H2T 2M4" required>

                </div>
        </form>
        <div class="vehicledetails">
            <h3>Véhicule</h3>

            <form method="post" onchange="submit()">
                    <label for="marque">Marque</label>
                    <?php
                    if (isset($_SESSION["marque"]) && !empty($_SESSION["marque"])) {
                        $value = $_SESSION["marque"];
                    } else {
                        $value = "";
                    }
                    echo '<input type="text" name="marque" id="marque" class="marque" placeholder="Nissan" list="listemarques" value="' . $value . '">';
                    ?>
                    <datalist id="listemarques">
                        <?php
                        foreach ($Marque->getAll() as $marque) {
                            echo '<option value="' . $marque->getMarque() . '">';
                        }
                        ?>
                    </datalist>

                    <label for="modele">Modèle</label>
                    <?php
                    if (isset($_POST["modele"]) && !empty($_POST["modele"])) {
                        $value = $_POST["modele"];
                    } else {
                        $value = "";
                    }
                    echo '<input type="text" name="modele" id="modele" class="modele" placeholder="Micra" list="listemodeles" value="' . $value . '">';
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

            </form>
            <!--<label for="marque">Marque</label>
            <input type="text" class="marque" name="marque" placeholder="Ford" required>
            <label for="modele">Modèle</label>
            <input type="text" class="modele" name="modele" placeholder="Mustang" required>-->
            <form method="post">
                <label for="annee">Année</label>
                <input type="text" class="annee" name="annee" placeholder="2018" required>
                <label for="immatriculation">Immatriculation</label>
                <input type="text" class="immatriculation" name="immat" placeholder="ABC1234" required>
                <label for="serie">N° de série</label>
                <input type="text" class="serie" name="serie" placeholder="2UH287490YHU1IH" required>
            </form>
        </div>
        <div class="contact">
            <h3>Contact</h3>
            <form>
                <label for="email">Adresse e-mail</label>
                <input type="email" class="email" name="email" placeholder="jean.dujardin@mail.com" id="email" required>
                <label for="phone">Numéro de téléphone</label>
                <input type="tel" class="phone" name="tel" placeholder="06 12 34 56 78" id="phone" required>
        </div>
        <?php
        //var_dump($TheClient->getAll());
        ?>
    </section>
    <div class="btn">
        <input type="reset" value="Réinitialiser">
        <input type="submit" name="validation_create_client" value="Créer l'utilisateur">
    </div>
    <?php
    echo $message;
    ?>
    </form>

    </section>
</main>

<script src="js/script.js"></script>
</body>

</html>