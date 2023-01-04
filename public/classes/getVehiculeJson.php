<?php
require __DIR__."/../autoload.php";
$data['id'] = $argv[1] ?? $_GET['id'] ?? "";

// Pour insérer il faut au moins un nom ou un prénom
if (empty($data['id'])) {
    echo "ERREUR : id non existant";
} else {
    // Créer un nouveau Contact avec les infos reçues
    // Ajouter le contact à la BD
    $vehiculedao = new VehiculesDAO(MaBD::getInstance());
    $res = $vehiculedao->getByIdClient($data['id']);
    $modeledao = new ModeleDAO(MaBD::getInstance());
    $modele = $modeledao->getOne($res->getNumModele());
    $marquedao = new MarqueDAO(MaBD::getInstance());
    $marque = $marquedao->getOne($modele->getNumMarque());
    $rep = ["NoImmatriculation" => $res->getNoImmatriculation(),
        "CodeClient" => $res->getCodeClient(),
        "NumModele" => $modele->getModèle(),
        "NoSerie" => $res->getNoSerie(),
        "DateMiseEnCirculation" => $res->getDateMiseEnCirculation(),
        "marque" => $marque->getMarque()];
    if ($rep === 0)
        echo "ERREUR : n'a pas été trouvé";
    else
        // On renvoie le contact créé pour pouvoir afficher un feedback pertinent

        echo json_encode($rep);
}