<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

$message = "";
$erreur = "";

$theOperations = new OperationDAO(MaBD::getInstance());
$theArticles = new ArticleDAO(MaBD::getInstance());

function formFilling(string $sessionName,int $number,string $type ,string $name, string $placeholder): void
{
    if (isset($_SESSION[$sessionName][$number]) && !empty($_SESSION[$sessionName][$number])) {
        $value = $_SESSION[$sessionName][$number];
    } else {
        $value = "";
    }
    echo '<input type="'.$type.'" name="' . $name . '" placeholder="' . $placeholder . '" value="' . $value . '" min="1" required>';
}

if (isset($_POST['createOperation'])) {
    print_r($_POST["createOperation"]);
    $newOperation = new Operation(DAO::UNKNOWN_ID, $_POST['LibelleOp'], $_POST['CodeTarif'], $_POST['DureeOp'],'');
    $message = $_POST['LibelleOp'] . " " . " a bien été ajouté.";
    $theOperations->insert($newOperation);

    if($theOperations->lastIdOp !=-1){
        $codeArticle = $theArticles->getOneByName($_POST['listeArticles'])->getCodeArticle();

        $newEntrevue = new entredeux();
    }

} else {
    $erreur = "une erreur c'est produite lors de la création de l'opération";
}

//formulaire création opération
if (isset($_POST["LibelleOp"]) || isset($_POST["CodeTarif"]) ||isset($_POST["DureeOp"])) {
    $_SESSION["CreationOp"] = [$_POST["LibelleOp"],$_POST["CodeTarif"],$_POST["DureeOp"]];
}
//formulaire articles nécessaires
if (isset($_POST["listeArticles"]) || isset($_POST["QuantiteArt"])) {
    $_SESSION["listeArticles"] = $_POST["listeArticles"];
    $_SESSION["QuantiteArt"] = $_POST["QuantiteArt"];
    //$_SESSION["infoArticles"] = [$_SESSION["listeArticles"],$_SESSION["QuantiteArt"]];
}

if (isset($_POST["listeArticles"]) && isset($_POST["QuantiteArt"])) {
    array_push($_SESSION["infoArticles"],$_POST["listeArticles"],$_POST["QuantiteArt"]);
}

function test(): void{
    array_push($_SESSION["infoArticles"],$_SESSION["listeArticles"],$_SESSION["QuantiteArt"]);
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
            <div><a href="creer-utilisateur.php">Créer un utilisateur</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="statistiques">Statistiques</a>
                <div class="dropdown-content"></div>
            </div>
            <div>
                <a href="creer-operation.php">Créer une opération</a>
                <!-- <a href="#">Opérations</a> -->
                <!-- <div class="dropdown-content"> -->
                    <!-- <a href="gestion-operations.php">Gérer les opérations</a> -->
                <!-- </div> -->
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
            <form class="createoperation" method="post">
                <section>
                    <a href="creer-operation.php?idprod=1">adaadazdazda</a>
                    <?php
                    if ($_GET['idprod']){
                        var_dump($_GET['idprod']);
                    }
                    ?>

                    <div class="operationdetails">
                        <h3>Détails de l'opération</h3>
                        <label for="LibelleOp">Nom</label>
                        <?php formFilling("CreationOp",0,"text", "LibelleOp", "Changement pneu"); ?>
<!--                        <input class="LibelleOp" id="LibelleOp" name="LibelleOp" type="text" placeholder="Changement peneux" required="required" />-->
                        <label for="CodeTarif">Prix (en €)</label>
                        <?php
                        formFilling("CreationOp",1,"number", "CodeTarif", "100");
                        ?>
<!--                        <input class="CodeTarif" id="CodeTarif" name="CodeTarif" type="number" placeholder="100" required="required" />-->
                        <label for="DureeOp">Durée (en minutes)</label>
                        <?php formFilling("CreationOp",2,"number", "DureeOp", "30"); ?>
<!--                        <input class="DureeOp" id="DureeOp" name="DureeOp" type="number" placeholder="30" required="required" />-->
                    </div>
                    <div class="necessaryarticles">
                        <h3>Articles nécessaires</h3>
                        <div class="article">
                            <label for="CodeArt">Article</label>

                            <?php
                            if (isset($_SESSION["listeArticles"]) && !empty($_SESSION["listeArticles"])) {
                                $value = $_SESSION["listeArticles"];
                            } else {
                                $value = "";
                            }
                            echo '<input type="text" name="listeArticles" list="listeArticles" placeholder="Batterie" required>';
                            ?>

                            <datalist id="listeArticles">
                                <?php
                                foreach ($theArticles->getAll() as $article) {
                                    echo '<option value="' . $article->getLibelleArticle() . '">';
                                }
                                ?>
                            </datalist>

                            
                            <label for="QuantiteArt">Quantité</label>
                            <?php

                            if (isset($_SESSION["QuantiteArt"]) && !empty($_SESSION["QuantiteArt"])) {
                                $value = $_SESSION["QuantiteArt"];
                            } else {
                                $value = "";
                            }
                            echo '<input class="QuantiteArt" id="QuantiteArt" min="1" name="QuantiteArt" type="number" placeholder="1" required="required" />';
                            ?>

                            <ul>
                            <?php

                            var_dump($_SESSION["infoArticles"]);
                            if (empty($_SESSION["infoArticles"])) {
                                echo "<li> </li>";
                            } else {
                                foreach ($_SESSION["infoArticles"] as $infoArticle) {
                                    echo "<li>" . $infoArticle["qte"] . "</li>";
                                }
                            }
                            ?>
                            </ul>
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