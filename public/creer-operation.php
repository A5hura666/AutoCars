<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

$message = "";
$erreur = "";

$theOperations = new OperationDAO(MaBD::getInstance());
$theArticles = new ArticleDAO(MaBD::getInstance());

if (isset($_POST['createOperation'])) {
    print_r($_POST["createOperation"]);
    $newOperation = new Operation(DAO::UNKNOWN_ID, $_POST['LibelleOp'], $_POST['CodeTarif'], $_POST['DureeOp']);
    $message = $_POST['LibelleOp'] . " " . " a bien été ajouté.";
    $theOperations->insert($newOperation);
} else {
    $erreur = "une erreur c'est produite lors de la créa de l'opération";
}

$codeArticle = $theArticles->getOneByName($_POST['listeArticles'])->getCodeArticle();

//formulaire création opération
if (isset($_POST["LibelleOp"]) || isset($_POST["CodeTarif"]) ||isset($_POST["DureeOp"])) {
    $_SESSION["CreationOp"] = [$_POST["LibelleOp"],$_POST["CodeTarif"],$_POST["DureeOp"]];
}
//formulaire articles nécessaires
if (isset($_POST["listeArticles"]) || isset($_POST["QuantiteArt"])) {
    $_SESSION["ArticleNess"] = [$_POST["listeArticles"],$_POST["QuantiteArt"]];
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
            <form class="createoperation" method="post" onchange="submit()">
                <section>
                    <div class="operationdetails">
                        <h3>Détails de l'opération</h3>
                        <label for="LibelleOp">Nom</label>
                        <?php formFilling("CreationOp",0,"text", "LibelleOp", "Changement pneu"); ?>
<!--                        <input class="LibelleOp" id="LibelleOp" name="LibelleOp" type="text" placeholder="Changement peneux" required="required" />-->
                        <label for="CodeTarif">Prix (en €)</label>
                        <input class="CodeTarif" id="CodeTarif" name="CodeTarif" type="number" placeholder="100" required="required" />
                        <label for="DureeOp">Durée (en minutes)</label>
                        <input class="DureeOp" id="DureeOp" name="DureeOp" type="number" placeholder="30" required="required" />
                    </div>
                    <div class="necessaryarticles">
                        <h3>Articles nécessaires</h3>
                        <div class="article">
                            <label for="CodeArt">Article</label>
                            <input type="text" name="listeArticles" list="listeArticles">
                            <datalist id="listeArticles">
                                <?php
                                $listeArticles = $theArticles->getAll();
                                foreach ($listeArticles as $article) {
                                    echo "<option value='" . $article->getLibelleArticle() . "'></option>";
                                }
                                ?>
                            </datalist>

                            
                            <label for="QuantiteArt">Quantité</label>
                            <input class="QuantiteArt" id="QuantiteArt" min="1" name="QuantiteArt" type="number" placeholder="1" required="required" />

                        </div>
                </section>
                <div class="btn"><input type="reset" value="Réinitialiser" />
                    <input type="submit" name="createOperation" value="Créer l'opération" />
                </div>
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