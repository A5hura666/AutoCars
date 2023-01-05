<?php

require "autoload.php";
require "pdfcrowd.php";


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

    $PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
    $RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());


    if (file_exists('facture.html')) {

        $clientName = "test";
        $date = "22/02/2021";


        $htmlcode = "<!DOCTYPE html><head><meta charset='UTF-8'></head><body><h1 style='text-align: center;'>Facture</h1><br>";

        $htmlcode .= "<p><strong>" . $clientName . ",</strong><br>Voici votre facture du " . $date . ".</p><br>";

        $htmlcode .= "<h2>Montant total</h2><p>" . $data["total"] . "€</p><br>";
        $htmlcode .= "<h2>Liste des opérations effectuées</h2><ul>";
        foreach ($data["operations"] as $operation) {
            $htmlcode .= "<li>" . $operation["nom"] . " : <strong>" . $operation["prix"] . "€</strong></li>";
        }
        $htmlcode .= "</ul></body></html>";



        $handle = fopen('facture.html', 'w+');
        fwrite($handle, $htmlcode);
        fclose($handle);



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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    calculCost(2, "devis", false);
    ?>
</body>

</html>