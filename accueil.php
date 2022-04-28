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
        ?>
        <div class="background">
            <div class="grand_titre">
                <h1>Recherche un défunt </h1>
            <form action="resultats_recherche_defunt.php" method="POST">
                <input type="text" name="nom" size="20" placeholder="Nom :"/>
                <input type="text" name="prenom" size="20" placeholder="Prénom :"/>
                <input type="text" name="allee" size="20" placeholder="Allée (optionnel) :"/>
                <br/>
                <input type="submit" name="submit" value="Rechercher" />
            </form>
            </div>

        </div>
        <div class="footer">
        <a href="estimation.php"><button class="btn"> Estimer le prix d'une concession</button></a>
         </div> 

         
    </body>  
</html>