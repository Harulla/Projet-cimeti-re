<!DOCTYPE html>
<html>
    <head>  
        <link rel="stylesheet" href="style.css">
        <title>Cimetière</title>  
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head> 
     
    <body>
    <?php
        session_start();
        include("connexion.inc.php");
        if (isset($_POST['nom']) && isset($_POST['prenom'])){
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $auth= 0;
            $results = $cnx->query("SELECT COUNT(prenom_proprietaire) AS nombre FROM projetp2.proprietaire WHERE nom_proprietaire='$nom' AND prenom_proprietaire='$prenom';");
            echo "SELECT COUNT(prenom_proprietaire) AS nombre FROM projetp2.proprietaire WHERE nom_proprietaire='$nom' AND prenom_proprietaire='$prenom';";
            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                if(($ligne->nombre) >= 1){
                    $_SESSION['prenom']=$prenom;
                    $_SESSION['nom']=$nom;
                    if ($nom=="Dabanks" && $prenom=="Malcom"){
                        $_SESSION['role']=1;
                    }else{
                        $_SESSION['role']=0; 
                    }
                }
                header('location: accueil.php');
                
            }
        }else{
            header('location: login.php');
        }
    ?>



</body>
</html>