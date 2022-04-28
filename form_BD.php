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

	<form action="form_BD.php" method="POST">
		<p>Nom <input type="text" name="nom" size="40"  /> 
			Prénom <input type="text" name="prenom" size="20" /><br />
			<input type="radio" name="titre" value="1" />M. <br />
			<input type="radio" name="titre" value="2"  />Mme <br />
			<input type="radio" name="titre" value="3" />Mlle <br />
			Date de naissance <input type="text" name="date_n" size="6" value="jj/mm/aaaa"  /> <br />
			Service <select name="service">
			<?php
            echo '<option value="" selected="selected">-- service --</option>';

            
            $results = $cnx->query("SELECT code_service, lib_service FROM tp6.t_service");

            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                echo '<option value='.$ligne->code_service.'>'.$ligne->lib_service.'</option>';
            }           
			?>
		</select>
	</p>
	<p>
		Loisirs <br />
        <?php
            $results = $cnx->query("SELECT code_loisir, lib_loisir FROM tp6.t_loisir");

            while( $ligne = $results->fetch(PDO::FETCH_OBJ) ) {
                echo '<input type="checkbox" name="loisirs[]" value="'.$ligne->code_loisir.'" /> '.$ligne->lib_loisir.'<br />';
            }           
			?>
	</p>
	<p>
		<input type="reset" name="reset" value="Effacez" /> 
		<input type="submit" name="submit" value="Validez" />
	</p>
</form>	
<?php 
	if ((isset($_POST['nom'])) && (isset($_POST['prenom'])) && (isset($_POST['titre'])) && (isset($_POST['date_n'])) && (isset($_POST['service'])) && (isset($_POST['loisirs']))){
		if ((empty($_POST['nom'])) || (empty($_POST['prenom'])) || (empty($_POST['titre'])) || (empty($_POST['date_n'])) || (empty($_POST['service'])) || (empty($_POST['loisirs']))){
			echo "Il faut remplir le formulaire en entier !";
		}else{
			$nom=$_POST['nom'];
			$prenom=$_POST['prenom'];
			$titre=$_POST['titre'];
			$date_n=$_POST['date_n'];
			$service=$_POST['service'];
			$loisirs=$_POST['loisirs'];
	
			$req1 = "INSERT INTO tp6.t_personne VALUES(default,'$nom','$prenom','$titre','$date_n','$service') RETURNING num;";
			echo "$req1";
			if($results = $cnx -> query($req1)){
				echo "<br/>REQUETE FAITE<br/>";
				$num = ($results->fetch(PDO::FETCH_OBJ))->num;
				foreach ($loisirs as $lois){
					$req2 = "INSERT INTO tp6.pratique VALUES('$num','$lois');";
					$cnx -> query($req2);
					echo "<br/>$req2";
				}
			}else{
				echo "<br/>REQUETE PAS FAITE<br/>";
			}
		}
		
	}
	
	?>
</body>
</html>
