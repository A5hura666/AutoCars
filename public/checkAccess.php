<?php

// On vérifie que l'utilisateur est connecté, s'il ne l'est pas, on le redirige vers la page de connexion.
function checkLogin()
{
    if (!isset($_SESSION['role'])) {
        header("Location: login.php");
        exit(0);
    }
}

// Si un utilisateur esssaye de se connecter à une page auquel il n'a pas accès,
//en fonction de son rôle, on le redirige vers sa page d'accueil correspondante.
function checkAccess($role)
{
    checkLogin();

    
    if (isset($_SESSION['role']) && $_SESSION['role'] == $role) {
        return true;
    } else {
        if ($_SESSION['role'] == "Chef d'atelier") {
            header("Location: home-ca.php");
            exit(0);
        }
        if ($_SESSION['role'] == "Opérateur") {
            header("Location: home-employe.php");
            exit(0);
        }
        if ($_SESSION['role'] == "Administrateur") {
            header("Location: home-admin.php");
            exit(0);
        }
    }
}
