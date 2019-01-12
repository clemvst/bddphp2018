<html>

<head>
Requetes SQL au choix
</head>
<p>

<?php 
$db = $_POST['db_name'];
echo"Nom de la table actuellement utilisée :  $db"; ?>
</p>
<p>
<form method="post" action="requetes_sql.php" enctype="multipart/form-data">
<?php
	$r1= 'SELECT Nom, Categorie, Marque, PrixUnitaire FROM Clients.Produit ORDER BY Categorie, Marque';
	$r2= 'SELECT DISTINCT Marque FROM Clients.Produit ORDER BY Marque';
 	$r3= 'SELECT DISTINCT Nom, Prenom, AdresseMail FROM Clients.Client WHERE Nom = \'Davin\' ORDER BY Prenom';
	$r4= 'SELECT NumeroCommande, DateCommande, DateExpedition, COUNT(NumeroCommande) FROM Clients.Commandes WHERE NumeroCommande IN (SELECT NumeroCommande FROM Clients.Commandes WHERE DATEDIFF(DateExpedition, DateCommande)>1)';
	$r5= 'SELECT ModePaiement,COUNT(NumeroCommande) FROM Clients.Commandes GROUP BY ModePaiement';
	$r6= 'SELECT COUNT(Categorie) AS QuantiteProduit, Categorie FROM Clients.Produit  WHERE Marque = \'Villane\' GROUP BY Categorie HAVING COUNT(Categorie) > 1';
	$r7= 'SELECT NumeroCommande, DateCommande, ModePaiement FROM Clients.Commandes NATURAL JOIN Clients.Client WHERE Prenom = \"Laurent\" AND Nom = \"Tournin\"';
	$r8= 'SELECT Reference, Nom, Categorie, Marque, MAX(PrixUnitaire) FROM Clients.Produit'; 
/*	$r9=
	$r10=
	$r11=
	$r12=
	$r13=
	$r14=
	$r15= */
	echo "Quelle requête souhaitez-vous effectuer sur $db ?";
	echo '<select name="requete">
        <option value="'.$r1.'">'."Requete 1".'</option>
        <option value="'.$r2.'">'.$r2.'</option>
        <option value="'.$r3.'">'.$r3.'</option>
        <option value="'.$r4.'">'.$r4.'</option>
	<option value="'.$r5.'">'.$r5.'</option>
        <option value="'.$r6.'">'.$r6.'</option>
	<option value="'.$r7.'">'.$r7.'</option>
	<option value="'.$r8.'">'.$r8.'</option>
        <input type="submit" name="valider" value="OK"/>
	</select>';
/*	<option value="'.$r9.'">'.$r9.'</option>
        <option value="'.$r10.'">'.$r10.'</option>
        <option value="'.$r11.'">'.$r11.'</option>
	<option value="'.$r12.'">'.$r12.'</option>
        <option value="'.$r13.'">'.$r13.'</option>
	<option value="'.$r14.'">'.$r14.'</option>
	<option value="'.$r15.'">'.$r15.'</option>

 */
?>
</form>


<?
