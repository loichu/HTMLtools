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

function CheckCheckbox2($formName, $frmEntry, $frmCaracteristic, $post) {
    // initialise le tableau des erreurs
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();
    // Probleme de checkbox, le nom à des [] mais pas le post !!!
    $frmEntryPostName = substr($frmEntry, 0, -2);
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = array();
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = $post[$frmEntryPostName];

    // check that posted values are set
    if (count($post[$frmEntryPostName])) {
        foreach ($post[$frmEntryPostName] as $value) {
            if (!array_key_exists($value, $_SESSION['forms'][$formName][$frmEntry]['values'])) {
                $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "This value doesn't exists !";
            } else {
                $_SESSION['forms'][$formName][$frmEntry]['is_selected'][] = $value;
            }
        }
    }
    if (!count($post[$frmEntryPostName]) && $_SESSION['forms'][$formName][$frmEntry]['is_required']) {
        $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "Please select at least one value for " . strtolower($_SESSION['forms'][$formName][$frmEntry]['label'] . "...");
    }
}

/*$_SESSION['form'] = array();
$checkboxName = $_SESSION[$chkName] . "[]" ;
*/
foreach ($_SESSION['forms'] as $formName => $formEntry) {
    foreach ($formEntry as $frmEntry => $frmEntryValues) {
        echo "<pre>";
            print $frmEntry;
            print_r($frmEntryValues);
        echo "</pre>";

        switch ($frmEntryValues['type']) {
        case 'checkbox':
            CheckCheckbox2($formName, $frmEntry, $frmEntryValues, $_POST);
            break;
        default:
            echo "Je ne connais pas (encore) ce type de champs";
            break;
    }


    }

}
/*
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
        //echo "coucou1";
        $values = $name . "Values"; //Cette ligne crée le nom de la variable qui contient les valeurs
        $_SESSION['form'][$name] = CheckCheckbox($name, $value, $_SESSION['formErrors'], true, $_SESSION['formError'], $$values, $chkName);
    }
    //die();
}
if(!isset($_POST[$rdbName])){
    $_SESSION['formErrors'][$rdbName] = "You can't leave it empty";
}
if(!isset($_POST[$_SESSION[$chkName]])){
    echo "coucou2";
    $_SESSION['formErrors'][$_SESSION[$chkName]] = "You can't leave it empty";
}
*/
debug($_POST, "POST:");
debug($_SESSION, "SESSION:");

/*
if ($_SESSION['formError'] == true) {
    echo '$_SESSION[formError] = true';
    debug($_POST, "POST:");
    debug($_SESSION, "SESSION:");
    //header('Location:Exemples.php');
} else {
    echo '$_SESSION[formError] = false';
    debug($_POST, "POST:");
    debug($_SESSION, "SESSION:");
    //echo "ici";
    //header('Location:Test.php');
}*/
