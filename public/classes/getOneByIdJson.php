<?php
require __DIR__."/../autoload.php";
$data['id'] = $argv[1] ?? $_GET['id'] ?? "";

// Pour insérer il faut au moins un nom ou un prénom
if (empty($data['id'])) {
    echo "ERREUR : id non existant";
} else {
    // Créer un nouveau Contact avec les infos reçues
    // Ajouter le contact à la BD
    $clientdao = new ClientsDAO(MaBD::getInstance());
    $res = $clientdao->getOne($data['id']);
    if ($res === 0)
        echo "ERREUR : n'a pas été trouvé";
    else
        // On renvoie le contact créé pour pouvoir afficher un feedback pertinent

        echo json_encode($res->toArray());
}