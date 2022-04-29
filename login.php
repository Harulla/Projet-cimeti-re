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
                <div class="PetitEcranCentral" >
                    <form action="connexion.php" method="post">
                        <label for="prenom">Prénom :</label><input type="text" name="prenom" />
                        <br/>
                        <label for="nom">Nom :</label><input type="text" name="nom" />
                        <br/>
                        <label for="mdp">Mot de passe: :</label><input type="password" name="mdp" />
                        <br/>
                        <input type="reset" name="reset" value="Effacer" /> 
                        <input type="submit" name="submit" value="Se connecter" />
                    </form>
                    <p> Si vous n'avez pas de compte : <a href="ecranInscription.php"> Inscrivez-vous </a></p>
                </div>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>