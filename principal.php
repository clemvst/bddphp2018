
<html>

    <head>

	<meta charset="utf-8" />
	<?php 	
		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=BASE_TP;charset=utf8','root','Pass8php+');
		}
		catch(Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

	$nomdelabase = 'Supermarché';
	?>

	<title><?php echo "$nomdelabase"; ?></title>

    </head>

    <body>
	<?php include("entete.php"); ?>
  
       	<?php include("menu.php"); ?>	
	<div id="corps">
		<h1>Voici la base : </h1> 
		
		La <strong>base de données</strong> est appelée : <?php echo $nomdelabase ?>.<br />
		
		<?php 
		$reponse = $bdd->query('SELECT * FROM CLIENTS');
		while ($donnees = $reponse->fetch())

		{

		?>

    		<p>

		 <strong>Client</strong> <br /> 
		Mail : <?php echo $donnees[0]; ?><br />
	        Mot de Passe : <?php echo $donnees[1]; ?><br />

 		  </p>

		<?php

		}


		$reponse->closeCursor(); // Termine le traitement de la requête


?>
	</p>

	</div>

	<?php include("pied.php"); ?>	
    </body>

</html>
