<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

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
    $TheClient->insert($newClient);
        if($TheClient->lastId !=-1){
            $NumModele = $Modele->getOneByModele($_POST['modele'])->getNumModele();
            $newVehicule = new Vehicule($_POST['immat'],$TheClient->lastId,$NumModele,$_POST['serie'],$_POST['annee'],"");
            $TheVehicule->insert($newVehicule);
            $message = "création de l'utilisateur: ". $newClient->getFirstName() ." ". $newClient->getLastName() . " avec l'immatriculation du véhicule: " . $newVehicule->getNoImmatriculation();
        } else {
            $erreur = "une erreur c'est produite lors de l'insertion de l'utilisateur";
        }
    }

if(isset($_POST['reset'])){
    $_POST = array();
    $_SESSION["info_clients"]=array();
    $_SESSION["info_vehicules"]=array();
    $_SESSION["marque"]=array();
}

//formulaire client
if (isset($_POST["prenom"]) || isset($_POST["nom"]) || isset($_POST["adresse"]) || isset($_POST["ville"]) || isset($_POST["cp"]) || isset($_POST["email"]) || isset($_POST["tel"])) {
    $_SESSION["info_clients"] = [$_POST["prenom"], $_POST["nom"], $_POST["adresse"], $_POST["ville"], $_POST["cp"], $_POST["email"], $_POST["tel"]];
}

//formulaire vehicules
if (isset($_POST["marque"]) || isset($_POST["annee"]) || isset($_POST["immat"]) || isset($_POST["serie"])) {
    $_SESSION["marque"] = $_POST["marque"];
    $_SESSION["info_vehicules"] = [$_POST["annee"], $_POST["immat"], $_POST["serie"]];
}

function formFilling(string $sessionName,int $number,string $type ,string $name, string $placeholder): void
{
    if (isset($_SESSION[$sessionName][$number]) && !empty($_SESSION[$sessionName][$number])) {
        $value = $_SESSION[$sessionName][$number];
    } else {
        $value = "";
    }
    echo '<input type="'.$type.'" name="' . $name . '" placeholder="' . $placeholder . '" value="' . $value . '" required>';
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
        <img src="img/logout.png" alt="Déconnexion" class="logout">
    </section>
</nav>


<main class="interface">
    <h2>Création de client</h2>
    <section>
        <form class="createuser" method="post" onchange="submit()">
            <section>
                <div class="personalData">
                    <h3>Informations personnelles</h3>

                    <label for="fname">Prénom</label>
                    <?php formFilling("info_clients",0,"text", "prenom", "François"); ?>
                    <label for="lname">Nom</label>
                    <?php formFilling("info_clients",1,"text", "nom", "Duchemin"); ?>
                    <br>
                    <label for="address">Adresse</label>
                    <?php formFilling("info_clients",2,"text", "adresse", "1234 rue de la Paix"); ?>
                    <label for="city">Ville</label>
                    <?php formFilling("info_clients",3,"text", "ville", "Montréal"); ?>
                    <label for="postalCode">Code postal</label>
                    <?php formFilling("info_clients",4,"text", "cp", "H2T 2M4"); ?>
                </div>

                <div class="vehicledetails">
                    <h3>Véhicule</h3>

                    <label for="marque">Marque</label>
                    <?php
                    if (isset($_SESSION["marque"]) && !empty($_SESSION["marque"])) {
                        $value = $_SESSION["marque"];
                    } else {
                        $value = "";
                    }
                    echo '<input type="text" name="marque" id="marque" class="marque" placeholder="Nissan" list="listemarques" value="' . $value . '" required>';
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
                    echo '<input type="text" name="modele" id="modele" class="modele" placeholder="Micra" list="listemodeles" value="' . $value . '" required>';
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

                    <label for="annee">Année</label>
                    <?php formFilling("info_vehicules",0,"date","annee","2018"); ?>
                    <label for="immatriculation">Immatriculation</label>
                    <?php formFilling("info_vehicules",1,"text","immat","ABC1234"); ?>
                    <label for="serie">N° de série</label>
                    <?php formFilling("info_vehicules",2,"text","serie","2UH287490YHU1IH"); ?>
                </div>

                <div class="contact">
                    <h3>Contact</h3>
                    <label for="email">Adresse e-mail</label>
                    <?php formFilling("info_clients",5,"email", "email", "jean.dujardin@mail.com"); ?>
                    <label for="phone">Numéro de téléphone</label>
                    <?php formFilling("info_clients",6,"tel", "tel", "06 12 34 56 78"); ?>
                </div>

            </section>
            <div class="btn">
                <?php
                //var_dump($TheClient->getAll());
                ?>
                <input type="submit" name="reset" value="Réinitialiser">
                <input type="submit" name="validation_create_client" value="Créer l'utilisateur">
            </div>
            <?php
                if (!empty($message)) {
                    echo "<div class='alert'>" . $message . "</div>";
                }
            ?>
        </form>

    </section>
</main>

<script src="js/script.js"></script>
<script src="js/alert.js"></script>
</body>

</html>