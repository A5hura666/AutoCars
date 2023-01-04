<?php
session_start();
require "autoload.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");

$TheArticle = new ArticleDAO(MaBD::getInstance());
$search_article=$_POST['article'];
$message="";

$tableau= array();

function cherche(array $tabArticle): array{
    $res=[];
    $search_article=$_POST['article'];

    foreach ($tabArticle as $key => $article){
        if (strstr($article['LibelleArticle'],$search_article)){
            array_push($res,$key);
        }
    }
    return $res;
}

foreach ($TheArticle->getAllSort() as $article){
    array_push($tableau,[$article->getCodeArticle(),$article->getLibelleArticle(),$article->getTypeArticle(),$article->getPrixUnitActuelHT(),$article->getQuantite()]);
}
//var_dump($tableau);
?>

<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>AutoCars | Gestion des client</title>
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
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>

    <main class="interface">
        <h2>Gestion des clients</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher une pièces</h3>
                    <form method="post" onchange="submit()">
                        <div>
                            <label for="article">Nom de la pièce</label>
                            <input type="text" name="article" id="article" placeholder="Pneus Hiver">
                        </div>
                        <input type="submit" name="validation_search" value="Recherche">
                        <?php var_dump($search_article); ?>
                </div>
                <div>
                    <h3>Liste des pièces</h3>
                        <ul class="list">
                            <?php

                            $sort_article = cherche($tableau);
                            var_dump($sort_article);
//                            if (empty($sort_article)){
//                                $message="Article inconnu";
//                                foreach ($TheArticle->getAllSort() as $article){
//                                    echo "<li class='big'><span> ".$article->getLibelleArticle()." </span><input type='number' value=".$article->getQuantite()." class='small' disabled></li>";
//                                }
//                            }else{
//                                foreach ($sort_article as $articles){
//                                    echo "<li class='big'><span> ".$articles->getLibelleArticle()." </span><input type='number' value=".$articles->getQuantite()." class='small' disabled></li>";
//                                }
//                            }
                            ?>

                        </ul>
                </div>
                </form>
            </aside>

        </section>
    </main>
    <script src="js/script.js"></script>
</body>

</html>