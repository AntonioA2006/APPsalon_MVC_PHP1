<?php

function deBuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
//autenticasion
function esUltimo( $actual,  $proximo){

    if ($actual !== $proximo) {
        return true;
    }
    return false;

}

function isAuth(): void{
    if (!isset($_SESSION['login'])) {
        # code...
        header('Location: / ');
    }

}
function isAdmin(): void{
    if (!isset($_SESSION['admin'])) {
        header("Location: /");
    }
}
