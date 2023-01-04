<?php
require __DIR__."/../autoload.php";
$data['LastName'] = $argv[1] ?? $_GET['LastName'] ?? "";
$data['FirstName'] = $argv[2] ?? $_GET['FirstName'] ?? "";

// Pour insérer il faut au moins un nom ou un prénom
if (empty($data['LastName']) || empty($data['FirstName'])) {
    echo "ERREUR : il faut au moins un nom ou un prénom";
} else {
    // Créer un nouveau Contact avec les infos reçues
    // Ajouter le contact à la BD
    $clientdao = new ClientsDAO(MaBD::getInstance());
    $res = $clientdao->getOneByName($data['LastName'],$data['FirstName']);
    if ($res === 0)
        echo "ERREUR : n'a pas été trouvé";
    else
        // On renvoie le contact créé pour pouvoir afficher un feedback pertinent

        echo json_encode($res->toArray());
}