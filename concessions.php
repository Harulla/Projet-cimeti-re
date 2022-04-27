<!DOCTYPE html>  
<html>  
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>  
    
    <body>  
        <?php
            include("connexion.inc.php");
            include("header.php");
            session_start();

            if ($_SESSION['role']!=1){
                header('location: accueil.php');
            }
            
        ?>

        <div class="background">|
            <div class="overlay">
                <h1> Concessions :</h1>
                
                <div class="EcranCentral" >
                    <table >
                        <TR><th> ID </th><th> DateDébut </th><th> Durée </th><th> Emplacement</th></TR>
                        <?php
                            if (isset($_POST['id'])){
                                $id = $_POST['id'];
                                $results = $cnx->query("SELECT * FROM projetp2.concession WHERE idconcession LIKE '%$id%';");
                            }else{
                                $results = $cnx->query("SELECT * FROM projetp2.concession;");
                            }
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                echo "<tr><td>$ligne->idconcession</td><td>$ligne->date_debut</td><td>$ligne->duree_concession</td><td> N°$ligne->numemplacement</td></tr>";
                            }
                        ?>
                        
                    </table> 
                </div>
                <form action="concessions.php" method="post">
                        <label for="id">Id :</label><input type="text" name="id" />
                        <input type="submit" name="submit" value="Rechercher" />
                    </form>
            </div>
        </div>
        <div class="footer2">         </div> 
    </body>  
</html>