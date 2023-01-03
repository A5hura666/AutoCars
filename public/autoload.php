<?php
// Répertoire courant ou répertoire du fichier autoload.php
spl_autoload_register(
    function ($className) {
        @include "$className.php";
    }
);
// Répertoire Classes du répertoire courant ou du répertoire contenant autoload.php
// Sur une seule ligne pour montrer que le format est libre 
spl_autoload_register(function ($className) {
    @include "classes/$className.php";
});
