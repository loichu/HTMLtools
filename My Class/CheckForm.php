<?php

include 'values.php'; // contient les tableaux de valeurs pour les champs multiplechoice
include 'HTMLtools.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function CheckText($name, $text, &$errors, $required = false, &$error) {
    if ((str_replace(" ", "", $text)) != "") {
        $text = trim(filter_input(INPUT_POST, $name, FILTER_SANITIZE_SPECIAL_CHARS));
        $errors[$name] = "";
    } else {
        $text = "";
        if ($required) {
            $errors[$name] = "You can't leave it empty";
            $error = true;
        }
    }
    return $text;
}

function CheckMultipleChoice($name, $value, &$errors, $required = false, &$error, $values) {
    if ((str_replace(" ", "", $value)) != "" && array_key_exists($value, $values)) {
        $errors[$name] = "";
        $text = $value;
    } else {
        $text = "";
        if ($required) {
            $errors[$name] = "You can't leave it empty";
            $error = true;
        }
    }
    return $text;
}

function CheckCheckbox($name, $value, &$errors, $required = false, &$error, $values, $chkName) {
    foreach ($value as $index => $value) {
        if ((str_replace(" ", "", $value)) != "" && array_key_exists($value, $values)) {
            $errors[$_SESSION[$chkName]] = "";
            $checked[$index] = $value;
        }
    }
    if (empty($checked)) {
        if ($required) {
            $errors[$_SESSION[$chkName]] = "You can't leave it empty";
            $error = true;
        }
    }
    return $checked;
}

$_SESSION['form'] = array();
$checkboxName = [$_SESSION[$chkName]] . "[]";

foreach ($_POST as $name => $value) {
    //echo"HELLO!";
    //debug($_POST, "POST:");
    //debug($_SESSION, "SESSION:");
    if ($_SESSION['formTypes'][$name] == 'text') {
        //echo "ici";
        $_SESSION['form'][$name] = CheckText($name, $value, $_SESSION['formErrors'], true, $_SESSION['formError']);
        //echo CheckText($name, $value, $_SESSION['formErrors'], true, $_SESSION['formError']);
    } elseif ($_SESSION['formTypes'][$name] == 'multipleChoice') {
        $values = $name . "Values"; //Cette ligne crée le nom de la variable qui contient les valeurs
        $_SESSION['form'][$name] = CheckMultipleChoice($name, $value, $_SESSION['formErrors'], true, $_SESSION['formError'], $$values);
    } elseif ($_SESSION['formTypes'][$name] == 'checkbox') {
        echo "coucou";
        $values = $name . "Values"; //Cette ligne crée le nom de la variable qui contient les valeurs
        $_SESSION['form'][$name] = CheckCheckbox($name, $value, $_SESSION['formErrors'], true, $_SESSION['formError'], $$values, $chkName);
    } 
    //die();
}
if(!isset($_POST[$rdbName])){
    $_SESSION['formErrors'][$rdbName] = "You can't leave it empty";
}
if(!isset($_POST[[$_SESSION[$chkName]]])){
    echo "coucou";
    $_SESSION['formErrors'][$_SESSION[$chkName]] = "You can't leave it empty";
}
    

if ($_SESSION['formError'] == true) {
    debug($_POST, "POST:");
    debug($_SESSION, "SESSION:");
    //header('Location:Exemples.php');
} else {
    debug($_POST, "POST:");
    debug($_SESSION, "SESSION:");
    //echo "ici";
    //header('Location:Test.php');
}