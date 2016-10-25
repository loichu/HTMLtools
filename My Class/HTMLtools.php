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
/*function Checkbox($frmName = "", $label = "", $overallName = "", $values = array(), $checked = array(), &$type) {
    $_SESSION["forms"][$frmName] = array("type" => "checkbox");
    $name = $_SESSION["$overallName"] . "[]";
    $error = isset($_SESSION['formErrors'][$_SESSION[$overallName]]) ? $_SESSION['formErrors'][$_SESSION[$overallName]] : "";
    $type[$_SESSION[$overallName]] = "checkbox";
    $checkbox = "<tr>\n";
    $checkbox .= "\t<th>$label</th>\n";
    $checkbox .= "\t<td>\n";
    foreach ($values as $value => $displayed) {
        $checkbox .= "\t\t<label><input type='checkbox' name='$name' value='$value'";
        $checkbox .= (is_array($checked) && is_int(array_search($value, $checked))) ? 'checked="checked"' : "";
        $checkbox .= " />$displayed</label><br/>\n";
    }
    $checkbox .= "\t</td>\n";
    $checkbox .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    //echo "name: $name";
    $checkbox .= "</tr>\n";
    return $checkbox;
}*/
// Create checkbox: FormName, Type, Label, Name (Unique!), array of value, array of selected items, is required
function CheckboxAndRadiobutton($frmName, $fieldType, $fieldLabel, $fieldName, $fieldValues, $isRequired = false) {

    $isSelected = isset($_SESSION['forms'][$frmName][$fieldName]['is_selected']) && count($_SESSION['forms'][$frmName][$fieldName]['is_selected']) ? $_SESSION['forms'][$frmName][$fieldName]['is_selected'] : array();

    $_SESSION["forms"][$frmName][$fieldName] = array("type" => $fieldType, "label" => $fieldLabel, "name" => $fieldName, "values" => $fieldValues, "is_selected" => $isSelected, "is_required" => $isRequired);
    $_SESSION["forms"][$frmName][$fieldName]['errors'] = '';
    $error = $_SESSION["forms"][$frmName][$fieldName]['errors'];

    $checkbox = "<tr>\n";
    $checkbox .= "\t<th>$fieldLabel :</th>\n";
    $checkbox .= "\t<td>\n";
    foreach ($fieldValues as $value => $text) {
        $checkbox .= "\t\t<label><input type='$fieldType' name='$fieldName' value='$value'";
        $checkbox .= (is_array($isSelected) && is_int(array_search($value, $isSelected))) ? 'checked="checked"' : "";
        $checkbox .= " />$text</label><br/>\n";
    }
    $checkbox .= "\t</td>\n";
    $checkbox .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $checkbox .= "</tr>\n";

    return $checkbox;
}
// Create select: FormName, Type, Label, Name (Unique!), array of value, array of selected items, is required
function Select($frmName, $fieldType, $fieldLabel, $fieldName, $fieldValues, $isRequired = false) {
    
    $isSelected = isset($_SESSION['forms'][$frmName][$fieldName]['is_selected']) && count($_SESSION['forms'][$frmName][$fieldName]['is_selected']) ? $_SESSION['forms'][$frmName][$fieldName]['is_selected'] : array();
    
    $_SESSION["forms"][$frmName][$fieldName] = array("type" => $fieldType, "label" => $fieldLabel, "name" => $fieldName, "values" => $fieldValues, "is_selected" => $isSelected, "is_required" => $isRequired);
    $_SESSION["forms"][$frmName][$fieldName]['errors'] = '';
    $error = $_SESSION["forms"][$frmName][$fieldName]['errors'];
    
    $select = "<tr>\n";
    $select .= "\t<th><label for='$fieldName'>$fieldLabel</label></th>\n";
    $select .= "\t<td>\n";
    $select .= "\t\t<select name='$fieldName'>\n";
    $select .= "\t\t\t<option></option>";
    foreach ($fieldValues as $value => $displayed) {
        $select .= "\t\t\t<option value='$value'";
        $select .= ($_SESSION["forms"][$frmName][$fieldName]['is_selected'] == $value) ? ' selected="selected"' : "";
        $select .= ">$displayed</option>\n";
    }
    $select .= "\t\t</select>\n\t</td>\n";
    $select .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $select .= "</tr>\n";
    
    return $select;
}

// Create select: FormName, Type, Label, Name (Unique!),  is required
function Password($frmName, $fieldType, $fieldLabel, $fieldName, $isRequired = false) {
    
    $value = isset($_SESSION['forms'][$frmName][$fieldName]['value']) ? $_SESSION['forms'][$frmName][$fieldName]['value'] : array();
    
    $_SESSION["forms"][$frmName][$fieldName] = array("type" => $fieldType, "label" => $fieldLabel, "name" => $fieldName, "is_required" => $isRequired);
    $_SESSION["forms"][$frmName][$fieldName]['errors'] = '';    
    $error = $_SESSION["forms"][$frmName][$fieldName]['errors'];
    $value = isset($_SESSION["forms"][$frmName][$fieldName]['value']) ? $_SESSION["forms"][$frmName][$fieldName]['value'] : "";

    $password = "<tr>\n";
    $password .= "\t<th><label for='$fieldName'>$fieldLabel</label></th>\n";
    $password .= "\t<td><input type='password' name='$fieldName' value='$value' /></td>\n";
    $password .= "\t<td><span class='erreur'>" . $error . "</span></td>\n";
    $password .= "</tr>\n";
    
    return $password;
}
/*function Radiobutton2($frmName, $fieldType, $fieldLabel, $fieldName, $fieldValues, $isRequired = false){
    $isSelected = isset($_SESSION['forms'][$frmName][$fieldName]['is_selected']) && count($_SESSION['forms'][$frmName][$fieldName]['is_selected']) ? $_SESSION['forms'][$frmName][$fieldName]['is_selected'] : array();

    $_SESSION["forms"][$frmName][$fieldName] = array("type" => $fieldType, "label" => $fieldLabel, "name" => $fieldName, "values" => $fieldValues, "is_selected" => $isSelected, "is_required" => $isRequired);
    $_SESSION["forms"][$frmName][$fieldName]['errors'] = '';

    $checkbox = "<tr>\n";
    $checkbox .= "\t<th>$fieldLabel:</th>\n";
    $checkbox .= "\t<td>\n";
    foreach ($fieldValues as $value => $text) {
        $checkbox .= "\t\t<label><input type='$fieldType' name='$fieldName' value='$value'";
        $checkbox .= (is_array($isSelected) && is_int(array_search($value, $isSelected))) ? 'checked="checked"' : "";
        $checkbox .= " />$text</label><br/>\n";
    }
    $checkbox .= "\t</td>\n";
    $checkbox .= "\t<td><span class='erreur'>" . $_SESSION["forms"][$frmName][$fieldName]['errors'] . "</span></td>\n";
    $checkbox .= "</tr>\n";

    return $checkbox;
}*/
/**
 * Cette fonction permet de générer des boutons radios
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom des boutons radio
 * @param array $values Un tableau qui contient valeur => texte affiché
 * @param string $checked La valeur qui doit être cochée (optionnel)
 *
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
}*/

/**
 * Cette fonction permet de générer une barre de sélection
 * @param string $label L'étiquette qui correspond
 * @param string $name Le nom de la barre de sélection
 * @param array $values Un tableau qui contient valeur => texte affiché
 * @param string $selected La valeur qui doit être sélectionnée (optionnel)
 */
function Select_Bckp($label = "", $name = "", $values = array(), $selected = "", &$type) {
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
function Password_Bckp($label = "", $name = "", $value = "", &$type) {
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
