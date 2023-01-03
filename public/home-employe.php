<html>

<head>
    <title>AutoCars | Accueil</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="shortcut icon" href="img/favicon.ico" />
</head>

<body>
    <nav>
        <section class="nav-left"> <a class="nav-logo invert" href="home-employe.php"><img src="img/logo.png" alt="logo" /></a>
            <div> <a href="home-employe.php">Accueil</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="emploisDuTemps">Emplois du temps</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="#">Opérations</a>
                <div class="dropdown-content"><a href="listeOperations">Liste des opérations à effectuer</a><a href="operationsDuJour">Opérations du jour</a></div>
            </div>
            <div><a href="informationsClients">Informations client</a>
                <div class="dropdown-content"></div>
            </div>
            <div><a href="#">Pièces</a>
                <div class="dropdown-content"><a href="stockPieces">Consulter le stock des pièces</a><a href="demanderPieces">Demander des pièces</a></div>
            </div>
        </section>
        <section class="nav-right">
        <a class="invert" href="logout.php">
                <img class="logout" src="img/logout.png" alt="Déconnexion" />
            </a>
        </section>
    </nav>
    <main class="menu"> <a href="emploisDuTemps">
            <article class="btn-menu"><img src="img/rdv.png" alt="Emplois du temps" />
                <h3>Emplois du temps</h3>
            </article>
        </a>
        <article class="btn-menu operations"><img src="img/operation.png" alt="Opérations" />
            <h3>Opérations</h3>
        </article><a href="informationsClients">
            <article class="btn-menu client"><img src="img/client.png" alt="Client" />
                <h3>Informations Clients</h3>
            </article>
        </a>
        <article class="btn-menu piece"><img src="img/pieces.png" alt="Pièces" />
            <h3>Pièces</h3>
        </article>
    </main>
    <section class="popupmenu operations-full hidden">
        <main class="menu"><a href="listeOperations">
                <article class="btn-menu listclient"><img src="img/operationsList.png" alt="Liste des clients" />
                    <h3>Liste des opérations à effectuer</h3>
                </article>
            </a><a href="operationsDuJour">
                <article class="btn-menu createclient"><img src="img/operationsToday.png" alt="Création client" />
                    <h3>Opérations du jour</h3>
                </article>
            </a></main><button class="back">✖</button>
    </section>
    <section class="popupmenu pieces-full hidden">
        <main class="menu"><a href="creer-piece">
                <article class="btn-menu client"><img src="img/pieces.png" alt="Liste Pièces" />
                    <h3>Consulter le stock des pièces</h3>
                </article>
            </a><a href="liste-pieces">
                <article class="btn-menu facture"><img src="img/buyPieces.png" alt="Factures" />
                    <h3>Demander des pièces</h3>
                </article>
            </a></main><button class="back">✖</button>
    </section>
    <script src="js/accueilEmployee.js"></script>
</body>
</html>