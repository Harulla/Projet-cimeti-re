<!DOCTYPE html>  
<html>  
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>  
    
    <body>  
        <?php
            include("header.php");
            session_start();
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Identifiez-vous :</h1>
                <div class="EcranCentral" >
                    <form action="connexion.php" method="post">
                        <table>
                            <tr><td><label for="prenom">Prénom</label></td><td><input type="text" name="prenom" /></td></tr>
                            <tr><td><label for="nom">Nom</label></td><td><input type="text" name="nom" /></td></tr>
                        </table>
                        <br />
                        <input type="reset" name="reset" value="Effacer" /> 
                        <input type="submit" name="submit" value="Valider" />
                    </form>
                </div>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>