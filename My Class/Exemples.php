<?php
// Inclure les fichiers externes
include 'SessionTools.php';
// Décommenter la ligne ci-dessous pour réinitialiser la session
//killSession(true);
include 'HTMLtools.php';
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Exemples</title>
    </head>
    <body>
        <?php
        /**
         * Spécifier le nom du champ et éventuel debug.
         */
        $formName = "form1";
        //debug($_SESSION, "SESSION:")
        ?>
        <form method="post" action="CheckForm.php" name="<?=$formName?>">
            <table border="1">
                <?php
                //Exemple de cases à cocher :
                $chkValues = array(
                    'test1' => 'this is a test',
                    'test2' => 'another test but not checked',
                    'test3' => 'another test - 3',
                );
                $chkType = "checkbox";
                $chkLabel = "Checkbox";
                $chkName = "checkbox[]";
                // Create checkbox: FormName, Type, Label, Name (Unique!), array of value, is required
                echo CheckboxOrRadiobutton($formName, $chkType, $chkLabel, $chkName, $chkValues, true);

                //Exemple de boutons radio :
                $rdbValues = array(
                    'test' => 'this is a test',
                    'test2' => 'another test but not checked'
                );
                $rdbType = "radio";
                $rdbLabel = "Radiobutton";
                $rdbName = "rdb";
                // Create radiobutton: FormName, Type, Label, Name (Unique!), array of value, is required
                echo CheckboxOrRadiobutton($formName, $rdbType, $rdbLabel, $rdbName, $rdbValues, true);

                //Exemple de barre de sélection :
                $sctLabel = "Select";
                $sctName = "sct";
                // WARNING: le tableau des valeurs nécessite que la variable de nom soit préalablement définie.
                $sctValues = array(
                    'default' => "Please select a " . strtolower($sctLabel),
                    '1' => 'first',
                    '2' => 'second and selected',
                    '3' => 'third'
                );
                // Create select: FormName, Type, Label, Name (Unique!),value, is required 
                echo Select($formName, $sctLabel, $sctName, $sctValues, true);

                //Exemple de champ texte :
                $txtType = "text";
                $txtLabel = "Text";
                $txtName = "txt";
                // Create text box: FormName, Type, Label, Name (Unique!), is required
                echo PasswordOrTextOrEmail($formName, $txtType, $txtLabel, $txtName, true);

                //Exemple de champ mot de passe :
                $pwdType = "password";
                $pwdLabel = "Password";
                $pwdName = "pwd";
                // Create password: FormName, Type, Label, Name (Unique!), is required, is confirmation
                echo PasswordOrTextOrEmail($formName, $pwdType, $pwdLabel, $pwdName, true);

                //Exemple de champ confirmation de mot de passe :
                $pwdConfirmType = "password";
                $pwdConfirmLabel = "Confirm password";
                $pwdConfirmName = "pwd";
                // Create password confirm: FormName, Type, Label, Name (Unique!), is required, is confirmation
                echo PasswordOrTextOrEmail($formName, $pwdConfirmType, $pwdConfirmLabel, $pwdConfirmName, true, true);
                
                //Exemple de champ email :
                $emailType = "email";
                $emailLabel = "Email";
                $emailName = "email";
                // Create email: FormName, Type, Label, Name (Unique!), is required, is confirmation
                echo PasswordOrTextOrEmail($formName, $emailType, $emailLabel, $emailName, true);

                //Exemple de zone de texte :
                $tarLabel = "Text area";
                $tarName = "tar";
                // Create text area: FormName, Type, Label, Name (Unique!), is required
                echo TextArea($formName, $tarLabel, $tarName, true);
                
                //Exemple de submit
                $submitName = 'submit';
                $submitText = 'POST';
                // Create submit: FormName, Name, Text
                echo Submit($formName, $submitName, $submitText)
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
