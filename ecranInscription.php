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
                <h1> Entrez-vos informations :</h1>
                <div class="PetitEcranCentral" >
                    <form action="inscription.php" method="post">
                        <label for="prenom">Votre Prénom :</label><input type="text" name="prenom" />
                        <br/>
                        <label for="nom">Votre Nom :</label><input type="text" name="nom" />
                        <br/>
                        <input type="reset" name="reset" value="Effacer" /> 
                        <input type="submit" name="submit" value="S'inscrire" />
                    </form>
                </div>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>