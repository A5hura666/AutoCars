<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

$message = "";
$erreur = "";

$theOperations = new OperationDAO(MaBD::getInstance());

if (isset($_POST['createOperation'])) {
    $newOperation = new Operation(DAO::UNKNOWN_ID, $_POST['nom'], $_POST['prix'], $_POST['duree']);
    $message = $_POST['nom'] . " " . " a bien été ajouté.";
    $theOperations->insert($newOperation);
} else {
    $erreur = "une erreur c'est produite lors de la créa de l'opération";
}



?>

<html>

<head>
    <title>AutoCars | Créer une opération</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="accueilAdmin"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-admin.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="creer-utilisateur">Créer un utilisateur</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="statistiques">Statistiques</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="#">Opérations</a>
                <div class="dropdown-content"><a href="creer-operation.php">Créer une opération</a><a href="gestion-operations.php">Gérer les opérations</a></div>
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="interface">
        <h2>Créer une opération</h2>
        <section>
            <form class="createoperation">
                <section>
                    <div class="operationdetails">
                        <h3>Détails de l'opération</h3><label for="opname">Nom</label><input class="opname" type="text" placeholder="Changement peneux" required="required" /><label for="opprice">Prix (en €)</label><input class="opprice" type="number" placeholder="100" required="required" /><label for="opduration">Durée (en minutes)</label><input class="opduration" type="number" placeholder="30" required="required" />
                    </div>
                </section>
                <div class="btn"><input type="reset" value="Réinitialiser" /><input type="submit" value="Créer l'opération" /></div>
            </form>
        </section>
    </main>
    <?php
    if (!empty($message)) {
        echo "<div class='alert'>" . $message . "</div>";
    }
    
    ?>
    
<script src="js/alert.js"></script>
</body>

</html>