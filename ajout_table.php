<html>
<!-- Une base  il faut lui ajouter des tables-->
<head>
Modification des tables 

</head>

<p>
<?php

    if(!(isset($_POST['valider2'])) && !(isset($_POST['valider3']))){ //L'option valider 2 correspond au choix de la table valider 3 au choix du fichier csv
        $db = $_POST['choix']; /**la récupération données non protégée*/
        echo " La base $db a été crée.";
        ?>
        </p>
        <?php
            $host="localhost";
            $root="root";
            $root_password="rootpass";
            $user='newuser';
            $pass='newpass';
            try
            {
                $dbh = new PDO("mysql:host=localhost",'root','root');
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`; CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass'; GRANT ALL ON `$db`.* TO '$user'@'localhost';FLUSH PRIVILEGES;")
                or die(print_r($dbh->errorInfo(), true));
                $dbh->exec("use $db;");        
           }
            catch (PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
	    }
	    if($db=="Eleves"){ // les bases livres et eleves ne sont pas terminées, seule CLIENTS fonctionne
                $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Act` ( `ActID` INT(1) NOT NULL , `Lieu` VARCHAR(100) NOT NULL , `Bus` INT(1) NOT NULL , `Theme` VARCHAR(100) NOT NULL , `Jour` INT(1) NOT NULL ) ENGINE = InnoDB; ");
                $ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Classes` ( `ClasID` INT(1) NOT NULL , `Enseignant` VARCHAR(100) NOT NULL)ENGINE = InnoDB ;");
                $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Eleves` ( `ElevID` INT(2) NOT NULL , `Nom` VARCHAR(100) NOT NULL , `Age` INT(2) NOT NULL , `Ville` VARCHAR(100) NOT NULL  ) ENGINE = InnoDB;" );
                $table1="Activites";
                $table2="Classes";
                $table3="Eleves";
                $table4="Repartition";
                $table5="";
        
            }if($db=="Clients"){
                $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Client` (`AdresseMail` varchar(13) PRIMARY KEY NOT NULL,`MotDePasse` varchar(8) DEFAULT NULL,`Nom` varchar(7) DEFAULT NULL,`Prenom` varchar(7) DEFAULT NULL,`Adresse` varchar(10) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

                $ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Commandes` (`NumeroCommande` int(1) PRIMARY KEY NOT NULL,`DateCommande` varchar(10) DEFAULT NULL,`ModePaiement` varchar(200) DEFAULT NULL,`DateExpedition` varchar(10) DEFAULT NULL,`AdresseMail` varchar(13) DEFAULT NULL,FOREIGN KEY (AdresseMail) REFERENCES Client(AdresseMail) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            
                $ajout4=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Produit` (`Reference` int(1) PRIMARY KEY NOT NULL,`Nom` varchar(30) DEFAULT NULL,`Categorie` varchar(30) DEFAULT NULL,`Marque` varchar(7) DEFAULT NULL,`PrixUnitaire` decimal(3,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                
                $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Detail`( `NumeroCommande` int(1) NOT NULL,`Reference` int(1)NOT NULL,`Quantite` int(2) DEFAULT NULL, PRIMARY KEY (NumeroCommande,Reference), FOREIGN KEY (Reference) REFERENCES Produit(Reference) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY (NumeroCommande) REFERENCES Commandes(NumeroCommande) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

                $table1="Client";
                $table2="Commandes";
                $table3="Detail";
                $table4="Produit";
		$table5="";
		}if($db=="Livres"){ // les bases livres et eleves ne sont pas terminées, seule CLIENTS fonctionne

                        $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Auteur` (`id_auteur` INT(1) NOT NULL,`nom_auteur` varchar(20) DEFAULT NULL,`pre_nom_auteur` varchar(20) DEFAULT NULL,`Naissance` DATE DEFAULT NULL,`Mort` DATE DEFAULT NULL,`Nationalite` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
			$ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Ecrit_par` (`id_auteur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Edite_par` (`id_editeur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout4=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Editeur` (`id_editeur` INT(1) NOT NULL,`nom_editeur` VARCHAR(30),`site_web` VARCHAR(40)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout5=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Livre` (`id_livre` INT(1) NOT NULL,`nom_livre` VARCHAR(30),`genre` VARCHAR(40),`parution` YEAR,`nature` VARCHAR(20),`langue` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $table1="Auteur";
                        $table2="Ecrit_par";
                        $table3="Edite_par";
                        $table5="Livre";
                        $table4="Editeur";                }
                    ?>
            <form method="post" action="ajout_table.php" enctype="multipart/form-data">
            <?php
                echo "Choisir la table à ajouter à la base $db  :  ";
                echo '<select name="choix2">
                <option value="'.$table1.'">'.$table1.'</option>
                <option value="'.$table2.'">'.$table2.'</option>
                <option value="'.$table3.'">'.$table3.'</option>
                <option value="'.$table4.'">'.$table4.'</option>
                <option value="'.$table5.'">'.$table5.'</option>
                <input type="submit" name="valider2" value="OK"/>
                </select>';
?>

                <input type="hidden" name="db_name" value= <?php echo "$db";?> />
		</form>

        <?php
            }
            if(isset($_POST['valider2'])){ //On crée le bouton pour trouver la table CSV à ajouter
            echo "Sélectionne dans les Documents le fichier $_POST[choix2],";
            $chosen_table=$_POST['choix2'];
            $db=$_POST['db_name'];
            echo " de la base $db.";
            ?>
        <form method = "post" action="ajout_table.php" enctype="multipart/form-data">
        <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /> <br/>
        <input type="submit" name="valider3" value="OK"/>
        <input type="hidden" name="db_name" value= <?php echo "$db " ;?> />
        <input type="hidden" name="tab" value=<?php echo "$chosen_table " ;?> />
        </form>
        <form method="post" action="saisi_main.php" enctype="multipart/form-data">
        <input type="hidden" name="tab" value=<?php echo "$chosen_table " ;?> />
        <input type="hidden" name="db_name" value= <?php echo "$db " ;?> />
        <input type="submit" name="Valider" value="Afficher table déjà crée"/>
        </form>
    <?php
    }
    if(isset($_POST['valider3'])){ // le fichier a été trouvé dans le finder
        $path=$_FILES['mon_fichier']['tmp_name'];
	$db=rtrim($_POST['db_name'],"/");
	$chosen_table=rtrim($_POST['tab'],"/");
        $host="localhost";
        $root="root";
        $root_password="rootpass";
        $user='newuser';
        $pass='newpass';
        try
        {
            $dbh = new PDO("mysql:host=localhost",'root','root');
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`; CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass'; GRANT ALL ON `$db`.* TO '$user'@'localhost';FLUSH PRIVILEGES;")
            or die(print_r($dbh->errorInfo(), true));
            $dbh->exec("use $db;");

	}
        catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
	if($_FILES["mon_fichier"]["size"] > 0)
        {   $file = fopen($path, "r");

	while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $value="";
                $num=count($getData);//nombre max col
                for($j=0;$j<$num-1;$j++){
    
			if(gettype($getData[$j])=="integer" or gettype($getData[$j])=="double"){
                        $value.=" "." $getData[$j]"." ".",";
                    }else{
                        $value.=" "." '$getData[$j]'"." ".",";
                    }
                }
                $value.=" "."'$getData[$j]'"." "; //eviter avoir virgule à la fin
                $sql = "INSERT INTO  `$chosen_table`  VALUES ( $value )";
		$ajout_table=$dbh->exec($sql);
	}
?>
        <form method="post" action="saisi_main.php" enctype="multipart/form-data">
        <input type="hidden" name="tab" value=<?php echo "$chosen_table " ;?> />
        <input type="hidden" name="db_name" value= <?php echo "$db " ;?> />
        <input type="submit" name="Valider" value="Saisie_Manuelle"/>
        </form>
        <form method="post" action="ajout_ligne.php" enctype="multipart/form-data">
        <input type="hidden" name="tab" value=<?php echo "$chosen_table " ;?> />
        <input type="hidden" name="db_name" value= <?php echo "$db " ;?> />
        <input type="submit" name="Valider" value="Ajout de ligne"/>
        </form>

	<form method="post" action="requetes_sql.php" enctype="multipart/form-data">
        <input type="hidden" name="db_name" value= <?php echo "$db";?> />
        <p>
	<input type="submit" name="sqlrequete" value= "Effectuer des requêtes SQL" />
	</p>
	</form>
<?php
	fclose($file);
	}       
    }
?>
<form method ="post" action="ajout_table.php" enctype="multipart/form-data">
<input type="hidden" name="choix" value=<?php echo "$db " ;?> />
<input type="submit" name="retour_simple" value="retour"/>
</form>
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="db" value= <?php echo "$db " ;?> />
<p>
<input type="submit" name="notdelete" value="Revenir au menu principal"/>
</p>
</form>
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="db" value= <?php echo "$db " ;?> />
<p>
<input type="submit" name="envoyer" value="Tout effacer et revenir au menu principal"/>
</p>
</form>


</html>
