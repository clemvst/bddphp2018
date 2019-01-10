<html>
<!-- Une base  il faut lui ajouter des tables-->
<head>
Modification des tables
</head>
<p>
<?php

    if(!(isset($_POST['valider2'])) && !(isset($_POST['valider3']))){ //L'option valider 2 correspond au choix de la table valider 3 au choix du fichier csv
        $db = $_POST['choix']; /**la récupération données non protégé*/
        echo " La base $db a été crée";
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
        
        //echo "La base de données est crée !!!";
            }
            catch (PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
            }
//En fonction de la table choisi on veut créer des tables dedans
            if($db=="Eleves"){
                $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Act` ( `ActID` INT(1) NOT NULL , `Lieu` VARCHAR(100) NOT NULL , `Bus` INT(1) NOT NULL , `Theme` VARCHAR(100) NOT NULL , `Jour` INT(1) NOT NULL ) ENGINE = InnoDB; ");
                $ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Classes` ( `ClasID` INT(1) NOT NULL , `Enseignant` VARCHAR(100) NOT NULL)ENGINE = InnoDB ;");
                $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Eleves`.`Eleves` ( `ElevID` INT(2) NOT NULL , `Nom` VARCHAR(100) NOT NULL , `Age` INT(2) NOT NULL , `Ville` VARCHAR(100) NOT NULL  ) ENGINE = InnoDB;" );
                //table Repartition je ne la comprends pas ...
                //echo "je suis dans la boucle eleve";
                $table1="Activites";
                $table2="Classes";
                $table3="Eleves";
                $table4="Repartition";
                $table5="";
        
            }if($db=="Clients"){
                $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Client` (`AdresseMail` varchar(13) PRIMARY KEY NOT NULL,`MotDePasse` varchar(8) DEFAULT NULL,`Nom` varchar(7) DEFAULT NULL,`Prenom` varchar(7) DEFAULT NULL,`Adresse` varchar(10) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

                $ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Commandes` (`NumeroCommande` int(1) PRIMARY KEY NOT NULL,`DateCommande` varchar(10) DEFAULT NULL,`ModePaiement` varchar(6) DEFAULT NULL,`DateExpedition` varchar(10) DEFAULT NULL,`AdresseMail` varchar(13) DEFAULT NULL,FOREIGN KEY (AdresseMail) REFERENCES Client(AdresseMail) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            
                $ajout4=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Produit` (`Reference` int(1) PRIMARY KEY NOT NULL,`Nom` varchar(16) DEFAULT NULL,`Categorie` varchar(7) DEFAULT NULL,`Marque` varchar(7) DEFAULT NULL,`PrixUnitaire` decimal(3,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                
                $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Clients`.`Detail`( `NumeroCommande` int(1) NOT NULL,`Reference` int(1)NOT NULL,`Quantite` int(2) DEFAULT NULL, PRIMARY KEY (NumeroCommande,Reference), FOREIGN KEY (Reference) REFERENCES Produit(Reference) ON UPDATE CASCADE ON DELETE CASCADE, FOREIGN KEY (NumeroCommande) REFERENCES Commandes(NumeroCommande) ON UPDATE CASCADE ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

                $table1="Client";
                $table2="Commandes";
                $table3="Detail";
                $table4="Produit";
                $table5="";
                $results = $dbh->prepare("SELECT * FROM Client;");
                $results->execute();
                $r = $results->fetchAll();
                echo "salut1";
                foreach ($r as $row){ //Ne fait rien car il n'y a rien dans les colonnes pour le moment...
                    ?>
                    <tr>
            
                    <td><?php echo "saluuut $row[0]"; ?></td>
                    </tr>
                    <?php
                    //echo "fin du while";
                    //echo "je suis dans la table Clients";
                    }
                    }if($db=="Livres"){
                        $ajout1=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Auteur` (`id_auteur` INT(1) NOT NULL,`nom_auteur` varchar(20) DEFAULT NULL,`pre_nom_auteur` varchar(20) DEFAULT NULL,`Naissance` DATE DEFAULT NULL,`Mort` DATE DEFAULT NULL,`Nationalite` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        //$ajout12=$dbh->exec("ALTER TABLE `Auteur` ADD PRIMARY KEY(`id_auteur`);");
                    
                        $ajout2=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Ecrit_par` (`id_auteur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout3=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Edite_par` (`id_editeur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout4=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Editeur` (`id_editeur` INT(1) NOT NULL,`nom_editeur` VARCHAR(30),`site_web` VARCHAR(40)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $ajout5=$dbh->exec("CREATE TABLE IF NOT EXISTS `Livres`.`Livre` (`id_livre` INT(1) NOT NULL,`nom_livre` VARCHAR(30),`genre` VARCHAR(40),`parution` YEAR,`nature` VARCHAR(20),`langue` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                        $table1="Auteur";
                        $table2="Ecrit_par";
                        $table3="Edite_par";
                        $table5="Livre";
                        $table4="Editeur";
                        //echo "je suis dans la table Livres";
                }
                    ?>
            <form method="post" action="ajout_table.php" enctype="multipart/form-data">
            <?php
                echo "Choisir la table à ajouter à la base $db";
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
            echo "Sélectionne le fichier $_POST[choix2]";
            $chosen_table=$_POST['choix2'];
            echo "$chosen_table";
            $db=$_POST['db_name'];
            echo "de la base $db";
            ?>
        <form method = "post" action="ajout_table.php" enctype="multipart/form-data">
        <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
        <input type="file" name="mon_fichier" id="mon_fichier" /> <br/>
        <input type="submit" name="valider3" value="OK"/>
        <input type="hidden" name="db_name" value= <?php echo "$db " ;?> />
        <input type="hidden" name="tab" value=<?php echo "$chosen_table " ;?> />
        </form>
    <?php
    }
    if(isset($_POST['valider3'])){ // le fichier a été trouvé dans le finder        $path=$_FILES['mon_fichier']['tmp_name'];
        $path=$_FILES['mon_fichier']['tmp_name'];
        //echo"je suis dans le valider 3 avec $path";
        $db=rtrim($_POST['db_name'],"/"); // j'ai un caractère / qui s'est ajouté mystérieusement dans le nom de ma base et table avec le dernier POST ...
        $chosen_table=rtrim($_POST['tab'],"/");
        echo "je suis la table $chosen_table";
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
            
            echo "La base de données est $db est utilisé !!!";
        }
        catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
        if($_FILES["mon_fichier"]["size"] > 0)
        {   $file = fopen($path, "r");
            $Name_col=fgetcsv($file, 10000, ",");
            $num=count($Name_col);
            //echo "Titre $Name_col[1]";
            //print_r($Name_col);
            
            while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
            {
                $value="";
                for($j=0;$j<$num-1;$j++){
                    //echo "$chosen_table";
                    //$col=ltrim(rtrim($Name_col[$j],")"),"(");
                    $value.=" "." '$getData[$j]'"." ".",";
                    //echo "$value";
                    //$ajout_table=$dbh->exec($sql);

                }
                $value.=" "."'$getData[$j]'"." "; //eviter avoir virgule à la fin
                $sql = "INSERT INTO `$chosen_table`  VALUES ( $value )";
                echo $sql;
                $ajout_table=$dbh->exec($sql);
                //$result = $dbh->query($sql);
            }
                fclose($file);
        }
        //echo "j ai $path"; //je crois que normalement c'est le path
    }
    
?>
<p>
<input type="button" value= "Effectuer des requêtes SQL" onClick="document.location.href='requetes_sql.php'"/>
</p>

<p>
<input type="button" value= "Tout effacer et revenir au menu principal" onClick="document.location.href = document.referrer"> //ça ne marche pas chez moi
</p>
</form>
</html>
