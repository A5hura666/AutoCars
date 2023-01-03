<?php


function checkLogin()
{
    if (!isset($_SESSION['role'])) {
        header("Location: login.php");
        exit(0);
    }
}

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
