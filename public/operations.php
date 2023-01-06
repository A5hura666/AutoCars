<?php
session_start();
require_once "autoload.php";
require "checkAccess.php";
checkAccess("Opérateur");

$Dde_Intervention = new Dde_InterventionDAO(MaBD::getInstance());
$TheUsers = new UsersDAO(MaBD::getInstance());
$TheClients = new ClientsDAO(MaBD::getInstance());
$RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
$PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
$TheFacture = new FactureDAO(MaBD::getInstance());
$TheDevis = new DevisDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$Modele = new ModeleDAO(MaBD::getInstance());

//Pour gérer les états
$TabEtat = ["En attente", "En cours", "Terminé", "Annulé"];
if (isset($_POST['consulter'])) {
    $_SESSION['info_dde'] = $_POST['consulter'];
}

if (!isset($_SESSION["consulter"])) {
    $DdeForOneOp=$Dde_Intervention->getOneByOp($_SESSION["idUser"]);
    $etatDefault=$DdeForOneOp->getEtatDemande();
    $_SESSION["consulter"] = $etatDefault;
}


function etatRdv(string $etat, string $emoji): void
{
    $Dde_Intervention = new Dde_InterventionDAO(MaBD::getInstance());
    $TheClients = new ClientsDAO(MaBD::getInstance());

    foreach ($Dde_Intervention->getOneAllByOp($_SESSION["idUser"]) as $dde_Intervention) {
        if ($etat==$dde_Intervention->getEtatDemande()){
            $infoOperateur = $TheClients->getOne($dde_Intervention->getCodeClient());
            echo '<span>' . $dde_Intervention->getDateRdv() . '</span>';
            echo '<li>' . $emoji . '<p>'.$dde_Intervention->getNumDde() ." " . $infoOperateur->getFirstName() . " " . $infoOperateur->getLastName()." - ". $dde_Intervention->getDescriptifDemande() . '</p><span></span>';
            echo '<input type="submit" name="consulter" value="'.$dde_Intervention->getNumDde().'"></li> ';
        }
    }
}

//var_dump($Dde_Intervention->getOneAllByOp($_SESSION["idUser"]));
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
            <div>
                <a href="liste-pieces.php">Pièces</a>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>

    <main class="interface">
        <form method="post">
        <h2>Liste des opérations</h2>
        <section>
            <aside>
                <div>
                    <h3>Liste des opérations</h3>
                    <ul class="list list-big">
                        <?php
                        etatRdv("En attente","📃");
                        etatRdv("En cours","⏳");

                        if (isset($_SESSION['info_dde'])) {
                            $DemandeInter=$Dde_Intervention->getOne($_SESSION['info_dde']);
                            $CodeClient = $DemandeInter->getCodeClient();
                            $newClient = $TheClients->getOne($CodeClient);
                        } else {
                            $DdeForOneOp=$Dde_Intervention->getOneByOp($_SESSION["idUser"]);
                            $newClient = $TheClients->getOne($DdeForOneOp->getCodeClient());
                        }
                        ?>
                    </ul>
                </div>
                </form>
            </aside>
            <div class="details">
                <h3>Détails de l'opération</h3>
                <div>
                    <form method="post" onchange="submit()" class="sectiondetails">

                        <div>
                            <label>Vehicule</label>
                            <?php
                            $info_vehicule = $TheVehicule->getByIdClient($newClient->getCodeClient());
                            $info_modele = $Modele->getOne($info_vehicule->getNumModele())->getModèle();
                            $marque = $info_vehicule->getMarque();
                            ?>
                            <div>
                                <label for="detailsmarque">Marque</label>
                                <input type="text" name="detailsmarque" id="detailsmarque" value="<?php echo $marque ?>" disabled>
                            </div>
                            <div>
                                <label for="detailsmodele">Modèle</label>
                                <input type="text" name="detailsmodele" id="detailsmodele" value="<?php echo $info_modele ?>" disabled>
                            </div>
                            <div>
                                <label for="detailsimmatriculation">Immatriculation</label>
                                <input type="text" name="detailsimmatriculation" id="detailsimmatriculation" value="<?php echo $info_vehicule->getNoImmatriculation() ?>" disabled>
                            </div>
                        </div>

                        <div>
                            <label>Opération</label>
                            <div>
                                <label for="detailsoperation">Opération</label>
                                <input type="text" name="detailsoperation" id="detailsoperation" disabled>
                            </div>
                        </div>

                        <div>
                            <label for="detailsdate">Etat</label>
                            <select name="detailsdate" id="detailsdate">
                            <?php
                            if (isset($_SESSION['info_dde'])) {
                                $DemandeInter=$Dde_Intervention->getOne($_SESSION['info_dde']);
                                $etatDde = $DemandeInter->getEtatDemande();
                                var_dump($etatDde);
                                echo '<option value="'.$etatDde.'" selected disabled>'.$etatDde.'</option>';
                            }
                            foreach ($TabEtat as $tabstate){
                                if ($tabstate!=$etatDde){
                                    echo '<option value="'.$tabstate.'">'.$tabstate.'</option>';
                                }
                            }
                            ?>
                            </select>
                        </div>


                        <input type="submit" value="Enregistrer">

                    </form>
                </div>
            </div>
        </section>
    </main>

</body>

</html>