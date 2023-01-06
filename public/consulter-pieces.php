<?php
session_start();
require "autoload.php";
require "checkAccess.php";

// On vérifie que l'utilisateur est chef d'atelier.
checkAccess("Chef d'atelier");

// On se connecte à la base de données pour d'éventuelles manipulations.
$TheArticle = new ArticleDAO(MaBD::getInstance());
if (isset($_POST['article'])) {
    $search_article = $_POST['article'];
} else {
    $search_article = "";
}
$message = "";

$tableau = array();

// On cherche dans la base de données la pièce saisie par l'utilisateur,
// et on retourne le résultat trouvé.
function cherche(array $tabArticle): array
{
    $res = [];
    if (isset($_POST['article'])) {
        $search_article = $_POST['article'];
    } else {
        $search_article = "";
    }
// Pour chaque article du tableau on va comparer son libellé avec la recherche
// pour trouver une correspondance.
    foreach ($tabArticle as $key => $article) {
        if (strstr($article['LibelleArticle'], $search_article)) {
            array_push($res, $key);
        }
    }
    return $res;
}
// On trie tous les articles dans le tableau, en affichant leur identifiant, leur libellé,
// leur type, leur prix et leur quantité.
foreach ($TheArticle->getAllSort() as $article) {
    array_push($tableau, [
        'CodeArticle' => $article->getCodeArticle(), 'LibelleArticle' => $article->getLibelleArticle(), 'TypeArticle' => $article->getTypeArticle(), 'PrixUnitActuelHT' => $article->getPrixUnitActuelHT(), 'quantite' => $article->getQuantite()
    ]);
}
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
        <h2>Gestion des stocks de pièces</h2>
        <section>
            <aside>
                <div class="recherche">
                    <h3>Rechercher une pièce</h3>
                    <form method="post" onchange="submit()">
                        <div>
                            <label for="article">Nom de la pièce</label>
                            <input type="text" name="article" id="article" placeholder="Pneus Hiver">
                        </div>
                        <input type="submit" name="validation_search" value="Recherche">
                </div>
                <div>
                    <h3>Liste des pièces</h3>
                    <ul class="list">
                        <?php
                        $sort_article = cherche($tableau);
                        if (isset($_POST["article"]) && !empty($_POST["article"])) {
                            foreach ($sort_article as $articles) {
                                echo "<li class='big'><span> " . $tableau[$articles]["LibelleArticle"] . " </span><input type='number' value=" . $tableau[$articles]["quantite"] . " class='small' disabled></li>";
                            }
                        } else {
                            $message = "Article inconnu";
                            foreach ($TheArticle->getAllSort() as $article) {
                                echo "<li class='big'><span> " . $article->getLibelleArticle() . " </span><input type='number' value=" . $article->getQuantite() . " class='small' disabled></li>";
                            }
                        }
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