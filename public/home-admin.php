<?php
session_start();
require_once "autoload.php";
require "checkAccess.php";
//On vérifie que l'utilisateur soit bien un administrateur, 
//sinon on le renvoie sur la page correspondante.
checkAccess("Administrateur");

?>


<html>

<head>
    <title>AutoCars | Accueil</title>
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
            <div>
                <a href="statistiques.php">Statistiques</a>
                <div class="dropdown-content"></div>
            </div>
            <div>
                <a href="creer-operation.php">Opérations</a>
                <!-- <div class="dropdown-content">
                    <a href="creer-operation.php">Créer une opération</a>
                    <a href="gestion-operations.php">Gérer les opérations</a>
                </div> -->
            </div>
        </section>
        <section class="nav-right">
            <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="menu"> <a href="creer-utilisateur.php">
            <article class="btn-menu"><img src="img/createClient.png" alt="Création utilisateur" />
                <h3>Créer un utilisateur</h3>
            </article>
        </a><a href="statistiques.php">
            <article class="btn-menu client"><img src="img/stats.png" alt="Statistiques" />
                <h3>Statistiques</h3>
            </article>
        </a>
        <a href="creer-operation.php">
            <article class="btn-menu operation">
                <img src="img/operation.png" alt="Operations" />
                <h3>Opérations</h3>
            </article>
        </a>
    </main>
    <!-- <section class="popupmenu operation-full hidden">
        <main class="menu"><a href="creer-operation.php">
                <article class="btn-menu"><img src="img/operation.png" alt="Création opération" />
                    <h3>Créer une opération</h3>
                </article>
            </a><a href="gerer-operations.php">
                <article class="btn-menu"><img src="img/operationsList.png" alt="Gestion opérations" />
                    <h3>Gérer les opérations</h3>
                </article>
            </a></main><button class="back">✖</button>
    </section> -->
    <script src="js/accueilAdmin.js"></script>
</body>

</html>