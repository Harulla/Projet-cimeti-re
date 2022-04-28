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
        ?>

        <div class="background">|
            <div class="overlay">
                <div class="EcranCentral" >
                <h1> Estimer le prix d'une concession</h1>
                    <div class="scroll">

                        <p>Dans un premier temps, entrez les caractéristiques de l'emplacement désiré:</p>
                        
                        <form action="estimation.php" method="POST">

                            Accessibilité: <select name="accessibilite">
                            <option value="" selected="selected"></option>
                            <?php
                            $results = $cnx->query("SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique WHERE id_caracteristique LIKE '%ACC%';");
                            echo "SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique;";
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                $nom = explode(':',$ligne->nom_caracteristique)[1];
                                echo '<option value='.$ligne->id_caracteristique.'>'.$nom.'</option>';
                            }
                            echo "</select>";
                            
                            ?>

                            Exposition vent: <select name="exposition">
                            <option value="" selected="selected"></option>
                            <?php
                            $results = $cnx->query("SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique WHERE id_caracteristique LIKE '%EXV%';");
                            echo "SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique;";
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                $nom = explode(':',$ligne->nom_caracteristique)[1];
                                echo '<option value='.$ligne->id_caracteristique.'>'.$nom.'</option>';
                            }
                            echo "</select>";
            
                            ?>

                            Proximité de l'entrée: <select name="proximite">
                            <option value="" selected="selected"></option>
                            <?php
                            $results = $cnx->query("SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique WHERE id_caracteristique LIKE '%PRE%';");
                            echo "SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique;";
                            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                                $nom = explode(':',$ligne->nom_caracteristique)[1];
                                echo '<option value='.$ligne->id_caracteristique.'>'.$nom.'</option>';
                            }
                            echo "</select>";
                            
                            ?>

                            <p>Ensuite le volume nécessaire de la tombe (Une urne requiert 1m<sup>3</sup> et un cercueil 2m<sup>3</sup>):</p>
                            <select name="volume">
                            <option value="" selected="selected"></option>
                            <option value="400">1</option>
                            <option value="750">2</option>
                            <option value="1100">3</option>
                            <option value="1450">4</option>
                            <option value="1800">5</option>
                            <option value="2150">6</option>
                            </select> m<sup>3</sup>

                            <p>Et pour finir la durée de concession :</p>
                            <select name="duree">
                            <option value="" selected="selected"></option>
                            <option value="1">5</option>
                            <option value="2.3">10</option>
                            <option value="4.5">15</option>
                            <option value="6.8">20</option>
                            <option value="11">30</option>
                            <option value="14">50</option>
                            </select> ans
                            <p style= "font-size:12px">Attention, il est possible qu’au moment de création de votre concession, aucune tombe remplissant tout vos critères soient disponible. Cette estimation n’a qu’un un but informatif/préventif.</p>
                            <input type="submit" name="submit" value="Estimer" />
                        </form>
                            
                        <?php
                            $temp = 0;
                            $volume = 0;
                            if (!empty($_POST['volume'])){
                                $volume = $_POST['volume'];
                                $temp = $volume;
                            }
                            if (!empty($_POST['duree'])){
                                $temp = $temp*$_POST['duree'];
                            }
                            
                            if (!empty($_POST['accessibilite']) && !empty($_POST['proximite']) && !empty($_POST['exposition'])){
                                $pro = $_POST['proximite'];
                                $proximite = $cnx->query("SELECT prix FROM projetp2.caracteristique WHERE id_caracteristique = '$pro';");
                                while( $ligne = $proximite->fetch(PDO::FETCH_OBJ) ) {
                                    $temp = $temp + $ligne->prix;  
                                }

                                $acc = $_POST['accessibilite'];
                                $accessibilite = $cnx->query("SELECT prix FROM projetp2.caracteristique WHERE id_caracteristique = '$acc';");
                                while( $ligne = $accessibilite->fetch(PDO::FETCH_OBJ) ) {
                                    $temp = $temp + $ligne->prix;  
                                }

                                $exp = $_POST['exposition'];
                                $exposition = $cnx->query("SELECT prix FROM projetp2.caracteristique WHERE id_caracteristique = '$exp';");
                                while( $ligne = $exposition->fetch(PDO::FETCH_OBJ) ) {
                                    $temp = $temp + $ligne->prix;  
                                }

                            }   
                            else{
                                echo "<p style='color:red; font-size:12px'>Veuillez remplir tout les champs!</p>";
                            }

                            $prix = "".$temp;
                            
                            echo "Prix estimé: $prix";
                        ?>
                        
                       
                    </div>
                </div>
            </div>
        </div>
        <div class="footer2"></div> 
    </body>  
</html>