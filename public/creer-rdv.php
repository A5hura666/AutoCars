<?php
session_start();
require "autoload.php";


if (!isset($_SESSION['login'])) {
    // On renvoie vers la page d'accueil
    header("Location: login.php");
    exit(0);
}

$TheClient = new ClientsDAO(MaBD::getInstance());
if (isset($_POST['usersearchbar'])){
    $Name = explode(" ",$_POST['usersearchbar']);
    $selected_client = $TheClient->getOneByName($Name[0],$Name[1]);
    var_dump($selected_client);
}


?>
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Création de RDV</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/creer-rdv.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta lang="utf-8" content="text/html; charset=utf-8">
</head>

<body>
    <nav>
        <?php var_dump($_POST['usersearchbar']);?>
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
            <img src="img/logout.png" alt="Déconnexion" class="logout">
        </section>
    </nav>

    <main class="interface">
        <h2>Création de rendez-vous</h2>
        <section>
            <form class="createrdv">
                <section>
                    <div class="client">
                        <section>
                            <h3>Client</h3>
                            <input type="text" name="usersearchbar" id="usersearchbar" onchange="select_client()" class="usersearchbar" placeholder="Recherche un client" list="clientlist"
                                required>
                            <datalist id="clientlist">
                                <?php
                                foreach ($TheClient->getAll() as $client){
                                    echo '<option value="' . $client->getLastName() . " " . $client->getFirstName() . '"></option>';
                                }
                                ?>
                            </datalist>
                        </section>



                        <section class="clientdetails">
                            <div>
                                <label for="lname">Nom</label>
                                <input type="text" class="lname" placeholder="<?php if(isset($selected_client)) echo $selected_client->getLastName(); else echo "Duchemin" ?>" disabled>
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
                            <input type="text" class="vehiclesearchbar" placeholder="Choisir un véhicule" list="vehiclelist"
                                required>
                            <datalist id="vehiclelist">
                                <option value="Fiat Multipla"></option>
                                <option value="Renaut Zoé"></option>
                            </datalist>
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
                    

                    <div class="operation">
                        <section>
                            <h3>Liste d'opérations</h3>
                            <input type="text" class="operationsearchbar" placeholder="Ajoutez une opération" list="operationlist"
                                required>
                            <datalist id="operationlist">
                                <option value="Devis"></option>
                                <option value="Oscultation du véhicule"></option>
                                <option value="Changement des pneux"></option>
                                <option value="Réparation pare brise"></option>
                            </datalist>
                        </section>


                        <section class="operationlist">
                            <ul>
                                <li><span>Devis</span><a href="#">X</a></li>
                                <li><span>Changement pneux</span><a href="#">X</a></li>
                                <li><span>Ménage voiture</span><a href="#">X</a></li>
                                <li><span>Contrôle technique</span><a href="#">X</a></li>
                                <li><span>Peinture</span><a href="#">X</a></li>
                                <li><span>Réparation pare brise</span><a href="#">X</a></li>
                                <li><span>Mise à jour système de bord</span><a href="#">X</a></li>
                                <li><span>Changement des freins</span><a href="#">X</a></li>
                                <li><span>Remplacement rétroviseurs</span><a href="#">X</a></li>
                            </ul>
                        </section>
                        <div>
                            <p>Temps estimé : <span>5h30</span></p>
                            <p>Prix estimé : <span>500</span>€</p>
                        </div>
                    </div>
                </section>
                <div class="btn">
                    <input type="reset" value="Réinitialiser">
                    <input type="submit" value="Créer le devis">
                </div>
            </form>
        </section>
    </main>




    <script src="js/script.js"></script>
<script src="js/rdv_script.js"></script>
</body>

</html>