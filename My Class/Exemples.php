<?php
//Inclure la classe et l'instancier 
include 'HTMLtools.php';
include 'values.php';
//session_start();
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Exemples</title>
    </head>
    <body>
        <form method="post" action="CheckForm.php">
            <table>
                <?php
                //Exemple de checkbox
                $chkLabel = 'Checkbox :';
                // Le nom se définit dans values.php
                $chkChecked = isset($_SESSION[$_SESSION["$chkName"]]) ? $_SESSION[$_SESSION["$chkName"]] : ""/*array('test2')*/;
                echo Checkbox($chkLabel, $chkName, $chkValues, $chkChecked, $_SESSION['formTypes']);
                
                

                //Exemple de radiobutton
                $rdbLabel = 'Radiobuttons :';
                // Le nom se définit dans values.php
                $rdbChecked = isset($_SESSION[$rdbName]) ? $_SESSION[$rdbName] : 'test';
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
                
                //Exemple de submit
                $subName = 'submit';
                $subValue = 'Done';
                echo Submit($subName, $subValue, $_SESSION['formTypes']);
                
                //Exemple de bouton
                $btnName = 'button';
                $btnValue = 'Go to Test.php';
                $btnLink = 'Test.php';
                echo Button($btnName, $btnValue, $btnLink);
                
                //Debug
                debug($_SESSION, "SESSION:");
                debug($_POST, "POST:");
                ?>
            </table>
        </form>
    </body>
</html>