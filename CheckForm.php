<?php

/**
 * Ce fichier contrôle un formulaire créé à l'aide de HTMLtools.php
 */
include "SessionTools.php";
include "HTMLtools.php";

/**
 * Cette fonction sert à contrôler un champ texte.
 * @param string $formName Nom du formulaire
 * @param string $frmEntry Nom du champ
 * @param array $post Superglobale $_POST
 */
function CheckText($formName, $frmEntry, $post) {
    // Initialise le tableau des erreurs
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();

    // Retrouve la valeur postée
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = trim(filter_var($post[$frmEntry], FILTER_SANITIZE_SPECIAL_CHARS));

    // Stock la valeur si elle est remplie sinon message d'erreur
    if (!empty($_SESSION['forms'][$formName][$frmEntry]['posted_data'])) {
        $_SESSION['forms'][$formName][$frmEntry]['value'] = $_SESSION['forms'][$formName][$frmEntry]['posted_data'];
    } elseif ($_SESSION['forms'][$formName][$frmEntry]['is_required']) {
        $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "Please enter a " . strtolower($_SESSION['forms'][$formName][$frmEntry]['label'] . "...");
        $_SESSION['forms'][$formName]['error'] = true;
    }
}

/**
 * Cette fonction sert à contrôler un champ email.
 * @param string $formName Nom du formulaire
 * @param string $frmEntry Nom du champ
 * @param array $post Superglobale $_POST
 */
function CheckEmail($formName, $frmEntry, $post) {
    // Initialise le tableau des erreurs.
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();

    // Retrouve la valeur postée.
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = trim(filter_var($post[$frmEntry], FILTER_VALIDATE_EMAIL));
    
    // Stock la valeur si elle est remplie sinon message d'erreur.
    if ($_SESSION['forms'][$formName][$frmEntry]['posted_data']) {
        $_SESSION['forms'][$formName][$frmEntry]['value'] = $_SESSION['forms'][$formName][$frmEntry]['posted_data'];
    } elseif ($_SESSION['forms'][$formName][$frmEntry]['is_required']) {
        $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "Please enter a valid " . strtolower($_SESSION['forms'][$formName][$frmEntry]['label'] . "...");
        $_SESSION['forms'][$formName]['error'] = true;
    }
}

/**
 * Cette fonction sert à contrôler un champ password et sa confirmation.
 * @param string $formName Nom du formulaire
 * @param string $frmEntry Nom du champ
 * @param array $post Superglobale $_POST
 */
function CheckPassword($formName, $frmEntry, $post) {
    // Initialise le tableau des erreurs et l'indicateur d'erreur interne.
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();
    $error = false;

    // Retrouve la valeur postée
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = trim(filter_var($post[$frmEntry], FILTER_SANITIZE_SPECIAL_CHARS));

    // Si il s'agit d'une confirmation contrôler qu'il correspond au mot de passe. 
    // Sinon contrôler au moins 8 caractères dont au moins 1 chiffre et 1 lettre.
    // Messages d'erreur.
    if ($_SESSION['forms'][$formName][$frmEntry]['is_confirm']) {
        $password = str_replace("Confirm", "", $frmEntry);
        if ($_SESSION['forms'][$formName][$password]['posted_data'] != $_SESSION['forms'][$formName][$frmEntry]['posted_data']) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "The password must be the same as " . strtolower($_SESSION['forms'][$formName][$password]['label']) . "...";
            $error = true;
        }
    } else {
        if (strlen($_SESSION['forms'][$formName][$frmEntry]['posted_data']) < 8) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "The password must contain at least 8 characters...";
            $error = true;
        }
        if (!preg_match("#[0-9]+#", $_SESSION['forms'][$formName][$frmEntry]['posted_data'])) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "The password must contain at least 1 number...";
            $error = true;
        }
        if (!preg_match("#[a-zA-Z]+#", $_SESSION['forms'][$formName][$frmEntry]['posted_data'])) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "The password must contain at least 1 letter...";
            $error = true;
        }
        if (!$_SESSION['forms'][$formName][$frmEntry]['is_required']) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "No password is required, you can leave it empty...";
        }
    }

    // Si les conditions sont remplies stocker la valeur.
    if (!$error) {
        if(!$_SESSION['forms'][$formName][$frmEntry]['is_confirm']){
            $_SESSION['forms'][$formName][$frmEntry]['value'] = $_SESSION['forms'][$formName][$frmEntry]['posted_data'];
        }     
    } elseif ($_SESSION['forms'][$formName][$frmEntry]['is_required']) {
        $_SESSION['forms'][$formName]['error'] = true;
    }
}

/**
 * Cette fonction sert à contrôler des cases à cocher.
 * @param string $formName Nom du formulaire
 * @param string $frmEntry Nom du champ
 * @param array $post Superglobale $_POST
 */
function CheckCheckbox($formName, $frmEntry, $post) {
    // Initialise le tableau des erreurs.
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();
    
    // (Ré)initialise le tableau des valeurs.
    $_SESSION['forms'][$formName][$frmEntry]['is_selected'] = array();

    // Probleme de checkbox, le nom à des [] mais pas le post !!!
    $frmEntryPostName = substr($frmEntry, 0, -2);

    // Retrouve les valeures postées.
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = isset($post[$frmEntryPostName]) ? $post[$frmEntryPostName] : array();

    // Si les valeurs existent, les stocker. Sinon message d'erreur.
    if (isset($post[$frmEntryPostName])) {
        foreach ($post[$frmEntryPostName] as $value) {
            if (!array_key_exists($value, $_SESSION['forms'][$formName][$frmEntry]['values'])) {
                $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "This value doesn't exists !";
                $_SESSION['forms'][$formName]['error'] = true;
            } else {
                $_SESSION['forms'][$formName][$frmEntry]['is_selected'][] = $value;
            }
        }
    }

    // Si aucune valeur n'a été postée message d'erreur.
    if (!isset($post[$frmEntryPostName]) && $_SESSION['forms'][$formName][$frmEntry]['is_required']) {
        $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "Please select at least one value for " . strtolower($_SESSION['forms'][$formName][$frmEntry]['label'] . "...");
        $_SESSION['forms'][$formName]['error'] = true;
    }
}

/**
 * Cette fonction sert à contrôler un champ choix multiple (radioboutons ou barre de sélection).
 * @param string $formName Nom du formulaire
 * @param string $frmEntry Nom du champ
 * @param array $post Superglobale $_POST
 */
function CheckMultipleChoice($formName, $frmEntry, $post) {
    // Initialise le tableau des erreurs.
    $_SESSION['forms'][$formName][$frmEntry]['errors'] = array();
    
    // Initialise la valeur.
    $_SESSION['forms'][$formName][$frmEntry]['is_selected'] = "";

    // Retrouve la valeur postée.
    $_SESSION['forms'][$formName][$frmEntry]['posted_data'] = isset($post[$frmEntry]) ? $post[$frmEntry] : "";
    $value = $_SESSION['forms'][$formName][$frmEntry]['posted_data'];

    // Si la valeur existe, la stocker. Sinon message d'erreur.
    if (isset($post[$frmEntry])) {
        if (!array_key_exists($value, $_SESSION['forms'][$formName][$frmEntry]['values'])) {
            $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "This value doesn't exists !";
            $_SESSION['forms'][$formName]['error'] = true;
        } elseif ($value != "default") {
            $_SESSION['forms'][$formName][$frmEntry]['is_selected'] = $value;
        }
    }

    // Si aucune valeur n'a été postée message d'erreur.
    if (!isset($post[$frmEntry]) && $_SESSION['forms'][$formName][$frmEntry]['is_required'] || $value == "default") {
        $_SESSION['forms'][$formName][$frmEntry]['errors'][] = "Please select a value for " . strtolower($_SESSION['forms'][$formName][$frmEntry]['label'] . "...");
        $_SESSION['forms'][$formName]['error'] = true;
    }
}

/**
 * 1) Initialiser détecteur d'erreur à false pour chaque formulaire.
 * 2) Contrôler chaque champ de chaque formulaire selon le type du champ.
 * 3) Rediriger selon le détecteur d'erreur.
 */
foreach ($_SESSION['forms'] as $formName => $formEntry) {
    $_SESSION['forms'][$formName]['error'] = false;
    foreach ($formEntry as $frmEntry => $frmEntryValues) {
        if ($frmEntry != "error") {
            switch ($frmEntryValues['type']) {
                case 'checkbox':
                    CheckCheckbox($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'radio':
                    CheckMultipleChoice($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'select':
                    CheckMultipleChoice($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'text':
                    CheckText($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'password':
                    CheckPassword($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'submit':
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                case 'email':
                    CheckEmail($formName, $frmEntry, $_POST);
                    echo "I am $frmEntry and error is :" . $_SESSION['forms'][$formName]['error'] . "<br/>";
                    break;
                default:
                    echo "Je ne connais pas (encore) ce type de champs ($frmEntry)";
                    break;
            }
        }
    }
    $report = $_SESSION['forms'][$formName]['error'] == true ? "Il y a une faute quelque part dans $formName !" : "Tout juste pour $formName !";
    echo $report;
}

// Debug
debug($_POST, "POST:");
debug($_SESSION, "SESSION:");
