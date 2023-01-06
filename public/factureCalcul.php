<?php

require "autoload.php";
require "pdfcrowd.php";


if (sizeof($_GET) == 2) {
    calculCost($_GET['id'], $_GET['type'], false);
}

//On calcule le coût total de la facture.
function calculCost($id, $type, $bool)
{
    $rescalcul = [];

    $PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
    $RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
    $Operation = new OperationDAO(MaBD::getInstance());
    $EntreDeux = new entredeuxDAO(MaBD::getInstance());
    $Article = new ArticleDAO(MaBD::getInstance());




    $rescalcul["total"] = 0;
    $rescalcul["operations"] = [];

    //Si le document est une facture ou un devis, on utilise le comportement adéquat.
    if ($type == "facture") {
        $operationList = $RealiserOp->getOperationForOneFacture($id);
    } else if ($type == "devis") {
        $operationList = $PrevoirOp->getOperationForOneDevis($id);
    }


    //On récupère les détails de chaque opération pour les intégrer à la facture.
    foreach ($operationList as $operation) {
        $operationDetails = $Operation->getOne($operation->getCodeOp());
        $tempOpPrice = $operationDetails->getCodeTarif();

        $articleNeccessary = $EntreDeux->getArticleForOneOperation($operation->getCodeOp());

        foreach ($articleNeccessary as $article) {
            $articleDetails = $Article->getOne($article->getCodeArticle());
            $tempOpPrice += $articleDetails->getPrixUnitActuelHT() * $article->getQtt();
        }


        $operationInfo = [];
        $operationInfo["nom"] = $operationDetails->getLibelleOp();
        $operationInfo["prix"] = $tempOpPrice;

        array_push($rescalcul["operations"], $operationInfo);

        $rescalcul["total"] += $tempOpPrice;
    }

    
    if ($bool) {
        return $rescalcul;
    } else {
        createFacture($rescalcul, $id, $type);
    }
}

//On créé une nouvelle facture.
function createFacture($data, $id, $type)
{


    $PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
    $RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
    $Facture = new FactureDAO(MaBD::getInstance());
    $Devis = new DevisDAO(MaBD::getInstance());
    $Client = new ClientsDAO(MaBD::getInstance());
    $DDE = new Dde_InterventionDAO(MaBD::getInstance());
    //On vérifie si une facture existe déjà.
    if (file_exists('facture.html')) {
        $date = "Undifined";



        //On utilise différents comportements selon que le document soit un devis ou une facture.
        if ($type == "facture") {
            $date = $Facture->getOne($RealiserOp->getOne($id)->getNoFacture())->getDateFacture();

            $nofacture = $RealiserOp->getOne($id)->getNoFacture();
            $listDevis = $Devis->getAll();
            foreach ($listDevis as $devis) {
                if ($devis->getNoFacture() == $nofacture) {
                    $noDDE = $DDE->getOne($devis->getNoDevis());
                }
            }
            $detailsClient = $Client->getOne($noDDE->getCodeClient());
            $fname = $detailsClient->getFirstName();
            $lname = $detailsClient->getLastName();
        } else if ($type == "devis") {
            $date = $Devis->getOne($PrevoirOp->getOne($id)->getNoDevis())->getDateDevis();

            $noDDE = $DDE->getOne($PrevoirOp->getOne($id)->getNoDevis());
            $detailsClient = $Client->getOne($noDDE->getCodeClient());
            $fname = $detailsClient->getFirstName();
            $lname = $detailsClient->getLastName();
        }


        //Contenu de la facture
        $htmlcode = "<!DOCTYPE html><head><meta charset='UTF-8'></head><body><h1 style='text-align: center;'>Facture</h1><br>";

        $htmlcode .= "<p><strong>" . $fname . " " . $lname . ",</strong><br>Voici votre facture du " . $date . ".</p><br>";

        $htmlcode .= "<h2>Montant total</h2><p>" . $data["total"] . "€</p><br>";
        $htmlcode .= "<h2>Liste des opérations effectuées</h2><ul>";
        if ($type == "facture") {
            foreach ($data["operations"] as $operation) {
                $htmlcode .= "<li>" . $operation["nom"] . " : <strong>" . $operation["prix"] . "€</strong></li>";
            }
        } else if ($type == "devis") {
            foreach ($data["operations"] as $operation) {
                $htmlcode .= "<li>" . $operation["nom"] . " </li>";
            }
        }
        $htmlcode .= "</ul></body></html>";


        //On écrit les données dans la facture.
        $handle = fopen('facture.html', 'w+');
        fwrite($handle, $htmlcode);
        fclose($handle);


        try {
            //On créé la connexion client.
            $client = new \Pdfcrowd\HtmlToPdfClient("autocars", "3117be013b8ead56672293cfc9cc62ea");

            //On exécute la conversion et l'enregistre dans un document.
            $client->convertFileToFile("facture.html", "facture.pdf");

            //On redirige vers "facture.pdf".
            header('Location: facture.pdf');
        } catch (\Pdfcrowd\Error $why) {
            //En cas d'erreur, on la retourne.
            error_log("Pdfcrowd Error: {$why}\n");

            //Relance ou prend en main l'exception.
            throw $why;
        }
    } else {
        echo 'Le fichier n\'existe pas';
    }
}
?>

