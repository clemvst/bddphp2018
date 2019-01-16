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
	$r5='SELECT ModePaiement,COUNT(NumeroCommande) FROM Clients.Commandes GROUP BY ModePaiement';
	$r6='SELECT COUNT(Categorie) AS QuantiteProduit, Categorie FROM Clients.Produit  WHERE Marque = \'Villane\' GROUP BY Categorie HAVING COUNT(Categorie) > 1';
	$r7=
	$r8=
	$r9=
	$r10=
	$r12='SELECT SUM(P.PrixUnitaire*D.Quantite) FROM Produit P JOIN Detail D ON D.Reference=P.Reference WHERE D.NumeroCommande=3'
	$r11='SELECT P.Nom, P.Reference,D.Quantite,P.PrixUnitaire FROM Produit P JOIN Detail D ON P.Reference=D.Reference WHERE D.NumeroCommande=3'
	$r13='SELECT C2.NumeroCommande, C1.Nom, C1.Prenom, SUM(P.PrixUnitaire * D.Quantite), C2.ModePaiement FROM Client C1 INNER JOIN Commandes C2 ON C1.AdresseMail = C2.AdresseMail INNER JOIN Detail D ON C2.NumeroCommande = D.NumeroCommande INNER JOIN Produit P ON D.Reference = P.Reference GROUP BY C2.NumeroCommande'
	$r14='SELECT COUNT(TableRep.NumeroCommande),TableRep.Nom, TableRep.Prenom, SUM(TableRep.Total) FROM (SELECT C2.NumeroCommande, C1.Nom, C1.Prenom,C1.AdresseMail, SUM(P.PrixUnitaire * D.Quantite) AS Total, C2.ModePaiement FROM Client C1 INNER JOIN Commandes C2 ON C1.AdresseMail = C2.AdresseMail INNER JOIN Detail D ON C2.NumeroCommande = D.NumeroCommande INNER JOIN Produit P ON D.Reference = P.Reference GROUP BY C2.NumeroCommande) TableRep GROUP BY TableRep.AdresseMail'
	$r15='SELECT TableRep2.Nom, TableRep2.Prenom FROM (SELECT COUNT(TableRep.NumeroCommande),SUM(TableRep.Total) AS tot ,TableRep.Nom, TableRep.Prenom  FROM (SELECT C2.NumeroCommande, C1.Nom, C1.Prenom,C1.AdresseMail, SUM(P.PrixUnitaire * D.Quantite) AS Total, C2.ModePaiement FROM Client C1 INNER JOIN Commandes C2 ON C1.AdresseMail = C2.AdresseMail INNER JOIN Detail D ON C2.NumeroCommande = D.NumeroCommande INNER JOIN Produit P ON D.Reference = P.Reference GROUP BY C2.NumeroCommande) TableRep GROUP BY TableRep.AdresseMail) TableRep2 WHERE TableRep2.tot=(SELECT MAX(TableRep2.tot) FROM (SELECT COUNT(TableRep.NumeroCommande),SUM(TableRep.Total) AS tot ,TableRep.Nom, TableRep.Prenom  FROM (SELECT C2.NumeroCommande, C1.Nom, C1.Prenom,C1.AdresseMail, SUM(P.PrixUnitaire * D.Quantite) AS Total, C2.ModePaiement FROM Client C1 INNER JOIN Commandes C2 ON C1.AdresseMail = C2.AdresseMail INNER JOIN Detail D ON C2.NumeroCommande = D.NumeroCommande INNER JOIN Produit P ON D.Reference = P.Reference GROUP BY C2.NumeroCommande) TableRep GROUP BY TableRep.AdresseMail) TableRep2)'

	echo "Quelle requête souhaitez-vous effectuer sur $db ?";
	echo '<select name="requete">
        <option value="'.$r1.'">'."Requete 1".'</option>
        <option value="'.$r2.'">'."Requete 2".'</option>
        <option value="'.$r3.'">'."Requete 3".'</option>
        <option value="'.$r4.'">'."Requete 4".'</option>
	<option value="'.$r5.'">'."Requete 5".'</option>
        <option value="'.$r6.'">'."Requete 6".'</option>
	<option value="'.$r7.'">'."Requete 7".'</option>
	<option value="'.$r8.'">'."Requete 8".'</option>
	<option value="'.$r9.'">'."Requete 9".'</option>
        <input type="submit" name="valider"/>
	</select>';
       /* <option value="'.$r10.'">'."Requete 10".'</option>
        <option value="'.$r11.'">'."Requete 11".'</option>
	<option value="'.$r12.'">'."Requete 12".'</option>
        <option value="'.$r13.'">'."Requete 13".'</option>
	<option value="'.$r14.'">'."Requete 14".'</option>
	<option value="'.$r15.'">'."Requete 15".'</option>

 */
	?>

	<input type="hidden" name="db_name" value= <?php echo "$db";?> />

</form>


<?php 
	if ((isset($_POST['valider']))){
            $host="localhost";
            $root="root";
            $root_password="rootpass";
            $user='newuser';
            $pass='newpass';
            try
            {
                $dbh = new PDO("mysql:host=localhost",'root','root');
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$dbh->exec("use $db;");
		echo 'RESULTAT DE LA REQUETE : ' .$_POST['requete'] ?>; <br> <?php
		$sth = $dbh->prepare($_POST['requete']);
		$sth->execute();
		while($result = $sth->fetch(PDO::FETCH_ASSOC)){
			print_r("<br>");
			echo implode($result,"<br>");
		}
		/*while ($data = $sth->fetch(PDO::FETCH_ASSOC)) {
			echo implode($data,"<br> ");
			?> 	<br> <?php
		}*/

	    }
            catch (PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
            }

	
	}
?>
