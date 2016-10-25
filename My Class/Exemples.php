<?php
//Inclure la classe et l'instancier
include 'HTMLtools.php';
include 'values.php';
//session_start();
//unset($_SESSION);
//session_destroy();
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Exemples</title>
    </head>
    <body>
        <?php $frm1 = "form1"; ?>
        <form method="post" action="CheckForm.php" name="form1">
            <table border="1">
                <?php
                //Exemple de checkbox
                //$chkLabel = 'Checkbox :';
                // Le nom se définit dans values.php
                //$chkChecked = isset($_SESSION[$_SESSION["$chkName"]]) ? $_SESSION[$_SESSION["$chkName"]] : ""/*array('test2')*/;
                //echo Checkbox($frm1, $chkLabel, $chkName, $chkValues, $chkChecked, $_SESSION['formTypes']);

                // Create checkbox: FormName, Type, Label, Name (Unique!), array of value, is required
                echo Checkbox2("form1", "checkbox", "Checkbox", "checkbox[]", $chkValues, false);

/*
                //Exemple de radiobutton
                $rdbLabel = 'Radiobuttons :';
                // Le nom se définit dans values.php
                $rdbChecked = isset($_SESSION[$rdbName]) ? $_SESSION[$rdbName] : '';
                echo Radiobutton($rdbLabel, $rdbName, $rdbValues, $rdbChecked, $_SESSION['formTypes']);

                //Exemple de select
                $sctLabel = 'Select :';
                $sctName = 'sct';
                $sctSelected = isset($_SESSION[$sctName]) ? $_SESSION[$sctName] : '2';
                echo Select($sctLabel, $sctName, $sctValues, $sctSelected, $_SESSION['formTypes']);

                //Exemple de mot de passe
                $pwdLabel = 'Password :';
                $pwdName = 'pwd';
                $pwdValue = isset($_SESSION[$pwdName]) ? $_SESSION[$pwdName] : '';
                $pwdConfirmLabel = 'Confirm password :';
                $pwdConfirmName = 'pwdConfirm';
                $pwdConfirmValue = '';
                echo Password($pwdLabel, $pwdName, $pwdValue, $_SESSION['formTypes']);
                echo Password($pwdConfirmLabel, $pwdConfirmName, $pwdConfirmValue, $_SESSION['formTypes']);

                //Exemple de champ texte
                $txtLabel = 'Text :';
                $txtName = 'txt';
                $txtValue = isset($_SESSION[$txtName]) ? $_SESSION[$txtName] : 'default value';
                echo Text($txtLabel, $txtName, $txtValue, $_SESSION['formTypes']);

                //Exemple de zone de texte
                $tarLabel = 'Text area :';
                $tarName = 'tar';
                $tarValue = isset($_SESSION[$tarName]) ? $_SESSION[$tarName] : 'blah blah blah';
                echo TextArea($tarLabel, $tarName, $tarValue, $_SESSION['formTypes']);
*/
                //Exemple de submit
                $subName = 'submit';
                $subValue = 'POST';
                echo Submit($subName, $subValue, $_SESSION['formTypes']);
/*
                //Exemple de bouton
                $btnName = 'button';
                $btnValue = 'Go to Test.php';
                $btnLink = 'Test.php';
                echo Button($btnName, $btnValue, $btnLink);
*/
                ?>
            </table>
        </form>
        <?php
        //Debug
        debug($_SESSION, "SESSION:");
        debug($_POST, "POST:");
        ?>
    </body>
</html>
