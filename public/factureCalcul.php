<?php

session_start();
require "autoload.php";
require "pdfcrowd.php";
require "checkAccess.php";

checkAccess("Chef d'atelier");


// create a function createFacture with one parameter an of $id
function createFacture($id, $type)
{
    $PrevoirOp = new Prévoir_OpDAO(MaBD::getInstance());
    $RealiserOp = new Réaliser_OpDAO(MaBD::getInstance());
    $Operation = new OperationDAO(MaBD::getInstance());
    $EntreDeux = new entredeuxDAO(MaBD::getInstance());
    $Article = new ArticleDAO(MaBD::getInstance());




    $_SESSION["total"] = 0;
    $_SESSION["operations"] = [];

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

        array_push($_SESSION["operations"], $operationInfo);

        $_SESSION["total"] += $tempOpPrice;
    }

    var_dump($_SESSION);


    if (file_exists('facture.html')) {

        
        
        // $handle = fopen('facture.html', 'w+');
        // fwrite($handle, "<div>test</div><br><p>test</p>");
        // fclose($handle);



        // try {
        //     // create the API client instance
        //     $client = new \Pdfcrowd\HtmlToPdfClient("autocars", "3117be013b8ead56672293cfc9cc62ea");

        //     // run the conversion and write the result to a file
        //     $client->convertFileToFile("facture.html", "facture.pdf");

        //     // redirect to facture.pdf
        //     header('Location: facture.pdf');
        // } catch (\Pdfcrowd\Error $why) {
        //     // report the error
        //     error_log("Pdfcrowd Error: {$why}\n");

        //     // rethrow or handle the exception
        //     throw $why;
        // }
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
    createFacture(2, "facture");
    ?>
</body>

</html>