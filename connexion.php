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
            $mdp = $_POST['mdp'];
            $mdp=md5($mdp);
            $auth= 0;
            $results = $cnx->query("SELECT COUNT(p.id_proprietaire) AS nombre FROM projetp2.proprietaire p JOIN projetp2.authentification a ON a.id_proprietaire = p.id_proprietaire WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom' AND a.mdp='$mdp';");
            echo "SELECT COUNT(p.id_proprietaire) AS nombre FROM projetp2.proprietaire p JOIN projetp2.authentification a ON a.id_proprietaire = p.id_proprietaire WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom' AND a.mdp='$mdp';";
            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                if(($ligne->nombre) >= 1){
                    echo "Authentification Réussie;";
                    $results2 = $cnx->query("SELECT p.id_proprietaire AS id FROM projetp2.proprietaire p JOIN projetp2.authentification a ON a.id_proprietaire = p.id_proprietaire WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom' AND a.mdp='$mdp';");
                    echo "SELECT p.id_proprietaire AS id FROM projetp2.proprietaire p JOIN projetp2.authentification a ON a.id_proprietaire = p.id_proprietaire WHERE p.nom_proprietaire='$nom' AND p.prenom_proprietaire='$prenom' AND a.mdp='$mdp';";
                    while( $ligne2 = $results2->fetch(PDO::FETCH_OBJ) ) {
                        $_SESSION['prenom']=$prenom;
                        $_SESSION['nom']=$nom;
                        $_SESSION['id_proprietaire']=$ligne2->id;
                        if ($nom=="Dabanks" && $prenom=="Malcom"){
                            $_SESSION['role']=1;
                        }else{
                            $_SESSION['role']=0; 
                        }
                        header('location: accueil.php');
                    }
                }else{
                    header('location: login.php');
                }
            }
        }else{
            header('location: login.php');
        }
    ?>



</body>
</html>