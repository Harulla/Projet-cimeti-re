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
    ?>
    <div class="header">
        <?php 
        if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])){
            if ($_SESSION['role']==1){
                echo '
                    <ul class="MenuPrincipal">
                        <li class="carre"><a href="login.php"> '.$_SESSION['nom']." ".$_SESSION['prenom'].'(Gestionnaire)</a>
                            <ul class="SousMenu">
                                <li><a href="concessions.php">Concessions</a></li>
                                <li><a href="personnes.php">Personnes</a></li>
                                <li><a href="deconnexion.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul> ';
            }else{
                echo '
                    <ul class="MenuPrincipal">
                        <li class="carre"><a href="login.php"> '.$_SESSION['nom']." ".$_SESSION['prenom'].'(Client)</a>
                            <ul class="SousMenu">
                                <li><a>Accéder à mes concessions</a></li>
                                <li><a href="deconnexion.php">Déconnexion</a></li>
                            </ul>
                        </li>
                    </ul> ';
            };
            
        }
        else{
            echo '
            <ul class="MenuPrincipal">
                <li class="carre"><a href="login.php"> Se connecter </a>
                    <ul class="SousMenu">
                    </ul>
                </li>
            </ul> ';
        }
        ?>
    <h1>Cimetière Pâquerette</h1> 
    </div> 
    </body>  
</html>



