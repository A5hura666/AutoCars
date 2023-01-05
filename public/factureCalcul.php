<?php

require "autoload.php";
require "pdfcrowd.php";

var_dump($_GET);

if(sizeof($_GET) == 2){
    calculCost($_GET['id'], $_GET['type'], false);
}


// if (isset($_GET['function'])) {
//     if ($_GET['function'] == 'calculCost') {
//         calculCost($_GET['id'], $_GET['type'], $_GET['bool']);
//     }
// }

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

    if ($type == "facture") {
        $operationList = $RealiserOp->getOperationForOneFacture($id);
    } else if ($type == "devis") {
        $operationList = $PrevoirOp->getOperationForOneDevis($id);
    }



    foreach ($operationList as $operation) {
        $operationDetails = $Operation->getOne($operation->getCodeOp());
        $tempOpPrice = $operationDetails->getCodeTarif();

        $articleNeccessary = $EntreDeux->getArticleForOneOperation($operation->getCodeOp());

        // var_dump($articleNeccessary);

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

    //var_dump($rescalcul);

    if ($bool) {
        return $rescalcul;
    } else {
        createFacture($rescalcul, $id, $type);
    }
}


function createFacture($data, $id, $type)
{

    echo "test";

    $PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
    $RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
    $Facture = new FactureDAO(MaBD::getInstance());
    $Devis = new DevisDAO(MaBD::getInstance());
    $Client = new ClientsDAO(MaBD::getInstance());
    $DDE = new Dde_InterventionDAO(MaBD::getInstance());

    if (file_exists('facture.html')) {
        $date = "Undifined";
        $clientName = "Undifined";




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



        $htmlcode = "<!DOCTYPE html><head><meta charset='UTF-8'></head><body><h1 style='text-align: center;'>~ Facture  ~</h1><br>";

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



        $handle = fopen('facture.html', 'w+');
        fwrite($handle, $htmlcode);
        fclose($handle);

        header('Location: facture.html');

        try {
            // create the API client instance
            $client = new \Pdfcrowd\HtmlToPdfClient("autocars", "3117be013b8ead56672293cfc9cc62ea");

            // run the conversion and write the result to a file
            $client->convertFileToFile("facture.html", "facture.pdf");

            // redirect to facture.pdf
            header('Location: facture.pdf');
        } catch (\Pdfcrowd\Error $why) {
            // report the error
            error_log("Pdfcrowd Error: {$why}\n");

            // rethrow or handle the exception
            throw $why;
        }
    } else {
        echo 'Le fichier n\'existe pas';
    }
}
?>

<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <button onclick="calculCost(1, 'facture', true)">Cliquez ici</button>
</body>

</html> -->