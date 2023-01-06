<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Administrateur");

$message = "";
$erreur = "";

$theOperations = new OperationDAO(MaBD::getInstance());
$theArticles = new ArticleDAO(MaBD::getInstance());
$theEntredeux = new entredeuxDAO(MaBD::getInstance());

//On créé l'opération dans la base de données. Si l'insertion réussit, on retourne un message de réussite.
//Sinon, on retourne un message d'erreur.
if (isset($_POST['createOperation'])) {
    print_r($_POST["createOperation"]);
    $newOperation = new Operation(DAO::UNKNOWN_ID, (int) $_POST['CodeTarif'], $_POST['LibelleOp'], (int) $_POST['DureeOp'], 1);
    $message = $_POST['LibelleOp'] . " " . " a bien été ajouté.";
    $theOperations->insert($newOperation);
    if ($theOperations->lastIdOp != -1) {
        $lenQuantiteArt = count($_SESSION["QuantiteArt"]);
        $lenListeArticles = count($_SESSION["listeArticles"]);
        $lenLessTab = min($lenListeArticles, $lenQuantiteArt);
        for ($i = 0; $i < $lenLessTab; $i++) {
            $newEntredeux = new entredeux($theOperations->lastIdOp, (int) $_SESSION["codeArticle"][$i], (int) $_SESSION["QuantiteArt"][$i]);
            $theEntredeux->insert($newEntredeux);
        }
    }
} else {
    $erreur = "une erreur c'est produite lors de la création de l'opération";
}

//Lorsque l'on appuie sur le bouton de réinitialisation, on vide le formulaire.
if (isset($_POST["reset"])) {
    $_POST = array();
    $_SESSION["CreationOp"] = array();
    $_SESSION["listeArticles"] = array();
    $_SESSION["QuantiteArt"] = array();
}

//On créé un formulaire d'opération.
if (isset($_POST["LibelleOp"]) || isset($_POST["CodeTarif"]) || isset($_POST["DureeOp"])) {
    $_SESSION["CreationOp"] = [$_POST["LibelleOp"], (int) $_POST["CodeTarif"], (int) $_POST["DureeOp"]];
}

//On créé un formulaire des articles nécessaires à l'opération.
if (isset($_POST["listeArticles"]) && !empty($_POST["listeArticles"])) {
    array_push($_SESSION["listeArticles"], $_POST["listeArticles"]);
}
if (isset($_POST["QuantiteArt"]) && !empty($_POST["QuantiteArt"])) {
    array_push($_SESSION["QuantiteArt"], $_POST["QuantiteArt"]);
}

//On remplit le formulaire sur l'opération actuelle.
function formFillingOperation(string $sessionName, int $number, string $type, string $name, string $placeholder): void
{
    if (isset($_SESSION[$sessionName][$number]) && !empty($_SESSION[$sessionName][$number])) {
        $value = $_SESSION[$sessionName][$number];
    } else {
        $value = "";
    }
    echo '<input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" value="' . $value . '" min="1" required>';
}

if (!isset($_SESSION["codeArticle"])) {
    $_SESSION["codeArticle"] = [];
}
if (isset($_POST["listeArticles"]) && !empty($_POST["listeArticles"])) {
    array_push($_SESSION["codeArticle"], $theArticles->getOneByName($_POST['listeArticles'])->getCodeArticle());
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
        <section class="nav-left"> <a class="nav-logo invert" href="home-admin.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-admin.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="creer-utilisateur.php">Créer un utilisateur</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="statistiques.php">Statistiques</a>
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
                    <!--                    <a href="creer-operation.php?idprod=1">adaadazdazda</a>-->
                    <!--                    --><?php
                                                //                    if ($_GET['idprod']){
                                                //                        var_dump($_GET['idprod']);
                                                //                    }
                                                //                    
                                                ?>
                    <div class="operationdetails">
                        <h3>Détails de l'opération</h3>
                        <label for="LibelleOp">Nom</label>
                        <?php formFillingOperation("CreationOp", 0, "text", "LibelleOp", "Changement pneu"); ?>
                        <!--                        <input class="LibelleOp" id="LibelleOp" name="LibelleOp" type="text" placeholder="Changement peneux" required="required" />-->
                        <label for="CodeTarif">Prix (en €)</label>
                        <?php
                        formFillingOperation("CreationOp", 1, "number", "CodeTarif", "100");
                        ?>
                        <!--                        <input class="CodeTarif" id="CodeTarif" name="CodeTarif" type="number" placeholder="100" required="required" />-->
                        <label for="DureeOp">Durée (en minutes)</label>
                        <?php formFillingOperation("CreationOp", 2, "number", "DureeOp", "30"); ?>
                        <!--                        <input class="DureeOp" id="DureeOp" name="DureeOp" type="number" placeholder="30" required="required" />-->
                    </div>
                    <div class="necessaryarticles">
                        <h3>Articles nécessaires</h3>
                        <div class="article">
                            <label for="CodeArt">Article</label>

                            <!--                            --><?php
                                                                //                            if (isset($_SESSION["listeArticles"]) && !empty($_SESSION["listeArticles"])) {
                                                                //                                $value = $_SESSION["listeArticles"];
                                                                //                            } else {
                                                                //                                $value = "";
                                                                //                            }
                                                                //                            echo '<input type="text" name="listeArticles" list="listeArticles" placeholder="Batterie" required>';
                                                                //                            
                                                                ?>
                            <!---->
                            <!--                            <datalist id="listeArticles">-->
                            <!--                                --><?php
                                                                    //                                foreach ($theArticles->getAll() as $article) {
                                                                    //                                    echo '<option value="' . $article->getLibelleArticle() . '">';
                                                                    //                                }
                                                                    //                                
                                                                    ?>
                            <!--                            </datalist>-->

                            <?php
                            if (empty($_SESSION["listeArticles"])) {
                                $_SESSION["listeArticles"] = [];
                            }
                            echo '<input type="text" name="listeArticles" list="listeArticles" placeholder="Batterie">';
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
                            if (empty($_SESSION["QuantiteArt"])) {
                                $_SESSION["QuantiteArt"] = [];
                            }
                            echo '<input class="QuantiteArt" id="QuantiteArt" min="1" name="QuantiteArt" type="number" placeholder="1">';
                            ?>

                            <!--                            --><?php
                                                                //                            if (isset($_SESSION["QuantiteArt"]) && !empty($_SESSION["QuantiteArt"])) {
                                                                //                                $value = $_SESSION["QuantiteArt"];
                                                                //                            } else {
                                                                //                                $value = "";
                                                                //                            }
                                                                //                            echo '<input class="QuantiteArt" id="QuantiteArt" min="1" name="QuantiteArt" type="number" placeholder="1" required="required" />';
                                                                //                            
                                                                ?>
                            <section class="sect_article">
                                <ul>
                                    <?php
                                    //var_dump($_SESSION["listeArticles"]);
                                    //var_dump($_SESSION["QuantiteArt"]);

                                    if (empty($_SESSION["listeArticles"])) {
                                        echo "<li> </li>";
                                    } else {
                                        foreach ($_SESSION["listeArticles"] as $listeArticle) {
                                            echo "<li>" . $listeArticle . "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                                <ul>
                                    <?php
                                    if (empty($_SESSION["QuantiteArt"])) {
                                        echo "<li> </li>";
                                    } else {
                                        foreach ($_SESSION["QuantiteArt"] as $quantiteArt) {
                                            echo "<li>" . $quantiteArt . "</li>";
                                        }
                                    }
                                    ?>
                                </ul>
                            </section>
                        </div>
                </section>
                <div class="btn">
                    <input type="submit" value="Réinitialiser" name="reset" />
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