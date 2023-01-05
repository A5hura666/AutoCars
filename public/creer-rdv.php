<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

$TheClient = new ClientsDAO(MaBD::getInstance());
$TheUser = new UsersDAO(MaBD::getInstance());
$TheVehicule = new VehiculesDAO(MaBD::getInstance());
$TheOperation = new OperationDAO(MaBD::getInstance());
$Theentredeux = new entredeuxDAO(MaBD::getInstance());
$TheArticle = new ArticleDAO(MaBD::getInstance());
$TheInterv = new Dde_InterventionDAO(MaBD::getInstance());
$TheFacture = new FactureDAO(MaBD::getInstance());
$TheDevis = new DevisDAO(MaBD::getInstance());
$ThePreOp = new Prévoir_OpDAO(MaBD::getInstance());
$TheReaOp = new Réaliser_OpDAO(MaBD::getInstance());

//Session pour les opérations et calcul du prix total
$prix = 0;
$temps = new DateTime('0:0:0');
if (isset($_POST["operation"]) && !empty($_POST['operation'])) {
    array_push($_SESSION["operation"], $_POST["operation"]);
}
if (isset($_SESSION['operation'])) {
    foreach ($_SESSION['operation'] as $op) {
        $theop = $TheOperation->getOneByLibOP($op);
        $time = explode(':', $theop->getDureeOp());
        $temps->add(new DateInterval('PT' . $time[1] . 'H' . $time[2] . 'M0S'));
        $prix += (int)$theop->getTarifHoraire();
        foreach ($Theentredeux->getArticleForOneOperation($theop->getCodeOp()) as $thop) {
            $var = $TheArticle->getOnebyId($thop->getCodeArticle());
            $prix += round($var->getPrixUnitActuelHT() * $thop->getQtt(), 2);
        }
    }
}
if (isset($_POST['dateestime']) && !empty($_POST['dateestime'])){
    $_SESSION['dateestime'] = $_POST['dateestime'];
}

if(isset($_POST['km_actu'])){
    $_SESSION['km_actu'] = $_POST['km_actu'];
}

if (isset($_POST['operator']) && !empty($_POST['operator'])){
    $_SESSION['operator'] = $_POST['operator'];
}

$temps = $temps->format('H:i');
$temps = explode(':', $temps);
$hour = $temps[0];
$min = $temps[1];


if (isset($_POST["sub"])) {
    date_default_timezone_set('Europe/Paris');
    $date = date('d-m-y h:i:s');
    $date = explode(' ',$date);
    $horaire = $date[1];
    $date = $date[0];


    $facture = new Facture(DAO::UNKNOWN_ID,"",20,0,"En attente");
    $interv = new Dde_Intervention(DAO::UNKNOWN_ID,$TheVehicule->getByIdClient($_COOKIE['clientid'])->getNoImmatriculation(),$TheUser->getOne($_SESSION['operator'])->getIdUser(),$_COOKIE['clientid'],$date,$horaire,"",$_SESSION['km_actu'],"En attente");
    $TheInterv->insert($interv);
    $TheFacture->insert($facture);
    if($TheFacture->lastIdFact!=-1 && $TheInterv->lastIdInterv!=-1){
        $devis = new Devis(DAO::UNKNOWN_ID,$TheFacture->lastIdFact,$TheInterv->lastIdInterv,$date,$prix,$facture->getTauxTVA(),$_SESSION['dateestime']);
        $TheDevis->insert($devis);
    }
    if ($TheDevis->lastIdDevis!=-1){
        $reaOp = new Réaliser_Op($TheFacture->lastIdFact,$TheOperation->lastIdOp);
        $preOP = new Prévoir_Op($TheOperation->lastIdOp,$TheDevis->lastIdDevis);
        $ThePreOp->insert($preOP);
        $TheReaOp->insert($reaOp);
        $factureup = new Facture($TheFacture->lastIdFact,"",20,$prix,"En attente");
    }



}



?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Création de RDV</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/creer-rdv.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="img/favicon.ico"/>
</head>

<body <?php if (isset($_COOKIE['clientid'])) {
    echo 'onload="alsoChoise(' . $_COOKIE['clientid'] . ')"';
} else echo '' ?>>
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
            <img class="logout" src="img/logout.png" alt="Déconnexion"/>
        </a>
    </section>
</nav>

<main class="interface">
    <h2>Création de rendez-vous</h2>
    <section>
        <section>
            <div class="client">
                <section>
                    <h3>Client</h3>
                    <input type="text" class="usersearchbar" placeholder="Recherche un client" list="clientlist"
                           onchange="select_client()" required>
                    <datalist id="clientlist">
                        <?php
                        foreach ($TheClient->getAll() as $client) {
                            echo '<option value="' . $client->getLastName() . " " . $client->getFirstName() . '"></option>';
                        }
                        ?>
                    </datalist>
                </section>


                <section class="clientdetails">
                    <div>
                        <label for="lname">Nom</label>
                        <input type="text" class="lname" placeholder="Duchemin" disabled>
                    </div>
                    <div>
                        <label for="fname">Prénom</label>
                        <input type="text" class="fname" placeholder="Partice" disabled>
                    </div>
                    <div>
                        <label for="adress">Rue</label>
                        <input type="text" class="adress" placeholder="1a rue des lilas" disabled>
                    </div>
                    <div>
                        <label for="cp">Code postal</label>
                        <input type="number" class="cp" placeholder="26000" disabled>
                        <label for="ville">Ville</label>
                        <input type="text" class="ville" placeholder="Valence" disabled>
                    </div>
                    <div>
                        <label for="phone">Téléphone</label>
                        <input type="text" class="phone" placeholder="06 78 13 30 95" disabled>
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="text" class="email" placeholder="patrice.duchemin@gmail.com" disabled>
                    </div>
                </section>
            </div>


            <div class="vehicle">
                <section>
                    <h3>Vehicule</h3>
                </section>


                <section class="vehicledetails">
                    <div>
                        <label for="brand">Marque</label>
                        <input type="text" class="brand" placeholder="Fiat" disabled>
                    </div>
                    <div>
                        <label for="model">Modèle</label>
                        <input type="text" class="model" placeholder="Multipla" disabled>
                    </div>
                    <div>
                        <label for="serialnumber">N° de série</label>
                        <input type="text" class="serialnumber" placeholder="1897968269HA" disabled>
                    </div>
                    <div>
                        <label for="immat">Immatriculation</label>
                        <input type="text" class="immat" placeholder="DE-193-EA" disabled>
                    </div>
                    <div>
                        <label for="drivingdate">Mise en circulation</label>
                        <input type="date" class="drivingdate" placeholder="12/11/2007" disabled>
                    </div>
                </section>
            </div>

            <form class="createrdv" method="post" onchange="submit()">
                <div class="operation">
                    <section>
                        <h3>Liste d'opérations</h3>

                        <div>
                            <label for="operationlist">Operation</label>
                            <?php
                            if (empty($_SESSION["operation"])) {
                                $_SESSION["operation"] = [];
                            }
                            echo '<input type="text" name="operation" class="operationsearchbar" placeholder="Ajoutez une opération" list="operationlist">';
                            ?>
                            <datalist id="operationlist">
                                <?php
                                foreach ($TheOperation->getAll() as $operation) {
                                    echo '<option value="' . $operation->getLibelleOp() . '">';
                                }
                                ?>
                            </datalist>
                        </div>

                    </section>

                    <section class="operationlist">
                        <ul>
                            <?php
                            if (empty($_SESSION["operation"])) {
                                echo "<li> </li>";
                            } else {
                                foreach ($_SESSION["operation"] as $operation) {
                                    echo "<li>" . $operation . "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </section>
                    <div>
                        <p>Temps estimé : <span><?php echo $hour . 'h' . $min ?></span></p>
                        <p>Prix estimé : <span><?php echo round($prix * 1.2, 2) ?></span>€</p>
                    </div>
                </div>

                <div>
                    <label for="operatorlist">Opérator</label>
                    <input type="text" name="operator" class="operatorsearchbar" placeholder="Ajoutez un operator" list="operatorlist" <?php if(isset($_SESSION['operator'])){echo 'value="'.$_SESSION['operator'].'"';} ?>>
                    <datalist id="operatorlist">
                        <?php
                        foreach ($TheUser->getAllOperator() as $operator) {
                            echo '<option value="' . $operator->getLastName().' '.$operator->getFirstName() . '">';
                        }
                        ?>
                    </datalist>
                </div>
                <div>
                    <label>Esitmation fin</label>
                    <input type="date" name="dateestime" id="dateestime" <?php if(isset($_SESSION['dateestime'])){echo 'value="'.$_SESSION['dateestime'].'"';} ?>>
                </div>
                <div>
                    <label>kilometrage actuel</label>
                    <input type="number" step="0.01" name="km_actu" id="Km_actu" <?php if(isset($_SESSION['km_actu'])){echo 'value="'.$_SESSION['km_actu'].'"';} ?>>
                </div>
                <div class="btn">
                    <input type="reset" value="Réinitialiser">
                    <input type="submit" value="Créer le devis" name="sub">
                </div>
            </form>
        </section>

    </section>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/rdv_script.js"></script>

</body>

</html>


