<?php

/**
 * Cette classe contient des fonctions utiles pour dynamiser de l'html.
 * 
 * @author Loïc Humbert
 */

session_start();

/**
 * Cette fonction permet de générer des cases à cocher
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom des cases à cocher
 * @param array $values Un tableau qui contient valeur => texte affiché
 * @param array $checked Liste des valeurs qui doivent être cochée (optionnel)
 */
function Checkbox($label = "", $overallName = "", $values = array(), $checked = array(), &$type) {
    $name = $_SESSION["$overallName"] . "[]";
    $error = isset($_SESSION['formErrors'][$_SESSION[$overallName]]) ? $_SESSION['formErrors'][$_SESSION[$overallName]] : "";
    $type[$_SESSION[$overallName]] = "checkbox";
    $checkbox = "<tr>\n";
    $checkbox .= "\t<th>$label</th>\n";
    $checkbox .= "\t<td>\n";
    foreach ($values as $value => $displayed) {
        $checkbox .= "\t\t<label><input type='checkbox' name='$name' value='$value'";
        $checkbox .= is_int(array_search($value, $checked)) ? 'checked="checked"' : "";
        $checkbox .= " />$displayed</label><br/>\n";
    }
    $checkbox .= "\t</td>\n";
    $checkbox .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    //echo "name: $name";
    $checkbox .= "</tr>\n";
    return $checkbox;
}

/**
 * Cette fonction permet de générer des boutons radios 
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom des boutons radio
 * @param array $values Un tableau qui contient valeur => texte affiché
 * @param string $checked La valeur qui doit être cochée (optionnel)
 */
function Radiobutton($label = "", $name = "", $values = array(), $checked = "", &$type) {
    $error = isset($_SESSION['formErrors'][$name]) ? $_SESSION['formErrors'][$name] : "";
    $type[$name] = "multipleChoice";
    $radiobutton = "<tr>\n";
    $radiobutton .= "\t<th>$label</th>\n";
    $radiobutton .= "\t<td>\n";
    foreach ($values as $value => $displayed) {
        $radiobutton .= "\t\t<label><input type='radio' name='$name' value='$value'";
        $radiobutton .= ($checked == $value) ? ' checked="checked"' : "";
        $radiobutton .= " />$displayed</label><br/>\n";
    }
    $radiobutton .= "\t</td>\n";
    $radiobutton .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $radiobutton .= "</tr>\n";
    return $radiobutton;
}

/**
 * Cette fonction permet de générer une barre de sélection
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom de la barre de sélection
 * @param array $values Un tableau qui contient valeur => texte affiché
 * @param string $selected La valeur qui doit être sélectionnée (optionnel)
 */
function Select($label = "", $name = "", $values = array(), $selected = "", &$type) {
    $error = isset($_SESSION['formErrors'][$name]) ? $_SESSION['formErrors'][$name] : "";
    $type[$name] = "multipleChoice";
    $select = "<tr>\n";
    $select .= "\t<th><label for='$name'>$label</label></th>\n";
    $select .= "\t<td>\n";
    $select .= "\t\t<select name='$name'>\n";
    $select .= "\t\t\t<option></option>";
    foreach ($values as $value => $displayed) {
        $select .= "\t\t\t<option value='$value'";
        $select .= ($selected == $value) ? ' selected="selected"' : "";
        $select .= ">$displayed</option>\n";
    }
    $select .= "\t\t</select>\n\t</td>\n";
    $select .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $select .= "</tr>\n";
    return $select;
}

/**
 * Cette fonction permet de générer un champ mot de passe
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom du champ mot de passe
 * @param string $value Le texte inscrit dans le champ
 */
function Password($label = "", $name = "", $value = "", &$type) {
    $error = isset($_SESSION['formErrors'][$name]) ? $_SESSION['formErrors'][$name] : "";
    $type[$name] = "password";
    $password = "<tr>\n";
    $password .= "\t<th><label for='$name'>$label</label></th>\n";
    $password .= "\t<td><input type='password' name='$name' value='$value' /></td>\n";
    $password .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $password .= "</tr>\n";
    return $password;
}

/**
 * Cette fonction permet de générer un champ texte
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom du champ texte
 * @param string $value Le texte inscrit dans le champ
 */
function Text($label = "", $name = "", $value = "", &$type) {
    $error = isset($_SESSION['formErrors'][$name]) ? $_SESSION['formErrors'][$name] : "";
    $type[$name] = "text";
    $text = "<tr>\n";
    $text .= "\t<th><label for='$name'>$label</label></th>\n";
    $text .= "\t<td><input type='text' name='$name' value='$value' /></td>\n";
    $text .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $text .= "</tr>\n";
    return $text;
}

/**
 * Cette fonction permet de générer une zone de texte
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom de la zone de texte
 * @param string $text Le texte inscrit dans la zone de texte
 * @param array $errors Tableau qui regroupe les erreurs $name => message d'erreur
 */
function TextArea($label = "", $name = "", $text = "", &$type) {
    $error = isset($_SESSION['formErrors'][$name]) ? $_SESSION['formErrors'][$name] : "";
    $type[$name] = "text";
    $textarea = "<tr>\n";
    $textarea .= "\t<th><label for='$name'>$label</label></th>\n";
    $textarea .= "\t<td><textarea name='$name'>$text</textarea></td>\n";
    $textarea .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $textarea .= "</tr>\n";
    return $textarea;
}

/**
 * Cette fonction permet de générer un bouton submit
 * @param string $name Le nom du bouton submit
 * @param string $value Le texte inscrit sur le bouton submit
 */
function Submit($name = "", $value = "", &$type) {
    $type[$name] = "submit";
    $submit = "<tr>\n";
    $submit .= "\t<th></th>\n";
    $submit .= "\t<td><input type='submit' name='$name' value='$value' /></td>\n";
    $submit .= "</tr>\n";
    return $submit;
}

function Button($name = "", $value = "", $link = "") {
    $button = "<tr>\n";
    $button .= "\t<th></th>\n";
    $button .= "\t<td><a href='$link'><input type='button' name='$name' value='$value' /></a></td>\n";
    $button .= "</tr>\n";
    return $button;
}

function debug($d, $note = null) {
    echo "<pre>";
    if ($note)
        echo $note . "<br />";
    is_array($d) ? print_r($d) : printf($d);
    echo "</pre>";
}

?>
    

