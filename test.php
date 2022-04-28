<!DOCTYPE html>
<html>
 <head>
 
	<!-- En-tête du document Si avec l'UTF8 cela ne fonctionne pas mettez charset=ISO-8859-1 -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<title>Formulaire de saisie d'une personne</title>
	<style type="text/css">
		body {
			background-color:#ffd;
			font-family:Verdana,Helvetica,Arial,sans-serif;
		}
	</style>
</head>

<body>
    <?php include("connexion.inc.php"); ?>
	<h1>Formulaire correspondant à une personne</h1>

	<form action="test.php" method="POST">
			Acc <select name="acc">
			<?php
            echo '<option value="" selected="selected">-- accessibilite --</option>';
            $results = $cnx->query("SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique;");
            echo "SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracteristique;";
            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                $nom = explode(':',$ligne->nom_caracteristique)[1];
                echo '<option value='.$ligne->id_caracteristique.'>'.$nom.'</option>';
            }  
            echo "</select>";       
            echo "SELECT id_caracteristique, nom_caracteristique FROM projetp2.caracterisitique;";  
			?>
	</p>
	<p>
		<input type="reset" name="reset" value="Effacez" /> 
		<input type="submit" name="submit" value="Validez" />
	</p>
</form>	
</body>
</html>
