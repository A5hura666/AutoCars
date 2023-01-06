<?php

require "autoload.php";
require "pdfcrowd.php";


if (sizeof($_GET) == 2) {
    calculCost($_GET['id'], $_GET['type'], false);
}


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
    $Facture = new FactureDAO(MaBD::getInstance());
    $Devis = new DevisDAO(MaBD::getInstance());
    $Client = new ClientsDAO(MaBD::getInstance());
    $DDE = new Dde_InterventionDAO(MaBD::getInstance());

    if (file_exists('facture.html')) {
        $date = "Undifined";




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



        if ($type == "facture") {
            $htmlcode = "<!DOCTYPE html><head><meta charset='UTF-8'></head><body><h1 style='text-align: center;'>Facture</h1><br>";
        } else if ($type == "devis") {
            $htmlcode = "<!DOCTYPE html><head><meta charset='UTF-8'></head><body><h1 style='text-align: center;'>Devis</h1><br>";
        }
        $htmlcode .= "<p><strong>" . $fname . " " . $lname . ",</strong><br>Voici votre facture du " . $date . ".</p><br>";

        $htmlcode .= "<h2>Montant total</h2><p>" . $data["total"] . "€</p><br>";
        $htmlcode .= "<h2>Liste des opérations effectuées</h2><ul>";
        if ($type == "facture") {

            $htmlcode .= "<table><tr style='background-color:black;color:white;'><th>Opération</th><th>ㅤㅤㅤㅤㅤ</th><th>Prix</th></tr>";
            $previous = true;
            foreach ($data["operations"] as $operation) {
                if ($previous) {
                    $color = "white";
                    $text = "black";
                    $previous = false;
                } else {
                    $color = "grey";
                    $text = "white";
                    $previous = true;
                }
                $htmlcode .= "<tr style='background-color: " . $color . "; color:" . $text . "'><td>" . $operation["nom"] . "</td><td>ㅤㅤㅤㅤ</td><td>" . $operation["prix"] . "€</td></tr>";
            }
            $htmlcode .= "</table>";
        } else if ($type == "devis") {
            $htmlcode .= "<table><tr style='background-color:black;color:white;'><th>Opération</th></tr>";
            $previous = true;

            foreach ($data["operations"] as $operation) {
                if ($previous) {
                    $color = "white";
                    $text = "black";
                    $previous = false;
                } else {
                    $color = "grey";
                    $text = "white";
                    $previous = true;
                }

                $htmlcode .= "<tr style='background-color: " . $color . "; color:" . $text . "'><td>" . $operation["nom"] . "</td></tr>";
            }
            $htmlcode .= "</table>";
        }
        $htmlcode .= "</ul><br><br><br>
        <footer>
            <h3 style='margin:5px'>Autocars</h3>
            <p style='margin:2px'>Adresse: 1 rue de la Vallée</p>
            <p style='margin:2px'>Ville: 26000 Valence</p>
            <p style='margin:2px'>Téléphone: 01 23 45 67 89</p>
        </footer>
        </body></html>";



        $handle = fopen('facture.html', 'w+');
        fwrite($handle, $htmlcode);
        fclose($handle);

        // header('Location: facture.html');
        // var_dump($data);

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
