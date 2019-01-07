<html>
    <?php
        if(!(isset($_POST['valider']))){ //on vérifie que l'option n'a pas encore été
            ?>
            <head>
            Mon DM de BDD
            </head>
            <!-- Notre formulaire :-->
            <form method ="post" action="index.php">
            <p> Creation de la Base de données de votre choix
            </p>
            <select name="choix">
            <option value="Livres">Livres</option>
            <option value="Eleves">Eleves</option>
            <option value="Clients">Clients</option>
            <input type="submit" name="valider" value="OK"/>
	    </select>
		<p>
	    	<input type="button" value= "bouton permettant de se diriger sur plusieurs pages"/>
	  	</p>
		<input type="button" value= "Tout effacer et revenir au menu principal" onClick="document.location.href = document.referrer">
            </form>
            <?php
            if((isset($_POST['valider2']))){ //On crée le bouton pour trouver la table CSV à ajouter
                echo "Sélectionne le fichier $_POST[choix2]";
                ?>
                <form method = "post" action="index.php" enctype="multipart/form-data">
                <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />
                <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                <input type="file" name="mon_fichier" id="mon_fichier" /> <br/>
                <input type="submit" name="valider3" value="OK"/>
                </form>
                <?php
                }
            if(isset($_POST['valider3'])){ // le fichier a été trouvé dans le finder
                $path=$_FILES['mon_fichier']['tmp_name'];
                echo "j ai $path"; //je crois que normalement c'est le path 
                }
            }else{ //l'option a été validé ...
            $db = $_POST['choix']; /**la récupération données non protégé*/
            //echo "la base est $db";
            $host="localhost";
            $root="root";
            $root_password="rootpass";
            $user='newuser';
            $pass='newpass';
	    //$db="TP_BDD";
	    
            try
            {
                $dbh = new PDO("mysql:host=localhost",'root','root');
                $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`; CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass'; GRANT ALL ON `$db`.* TO '$user'@'localhost';FLUSH PRIVILEGES;")
                or die(print_r($dbh->errorInfo(), true));
                //echo "La base de données est crée !!!";
            }
            catch (PDOException $e) {
                die("DB ERROR: ". $e->getMessage());
            }
            //En fonction de la table choisi on veut créer des tables dedans
            if($db=="Eleves"){
                $ajout1=$dbh->exec("CREATE TABLE `Eleves`.`Act` ( `ActID` INT(1) NOT NULL , `Lieu` VARCHAR(100) NOT NULL , `Bus` INT(1) NOT NULL , `Theme` VARCHAR(100) NOT NULL , `Jour` INT(1) NOT NULL ) ENGINE = InnoDB; ");
                $ajout2=$dbh->exec("CREATE TABLE `Eleves`.`Classes` ( `ClasID` INT(1) NOT NULL , `Enseignant` VARCHAR(100) NOT NULL)ENGINE = InnoDB ;");
                $ajout3=$dbh->exec("CREATE TABLE `Eleves`.`Eleves` ( `ElevID` INT(2) NOT NULL , `Nom` VARCHAR(100) NOT NULL , `Age` INT(2) NOT NULL , `Ville` VARCHAR(100) NOT NULL  ) ENGINE = InnoDB;" );
                //table Repartition je ne la comprends pas ...
                //echo "je suis dans la boucle eleve";
                $table1="Activites";
                $table2="Classes";
                $table3="Eleves";
                $table4="Repartition";
                $table5="";
                
            }elseif($db=="Clients"){
                $ajout1=$dbh->exec("CREATE TABLE `Client` (`AdresseMail` varchar(13) NOT NULL,`MotDePasse` varchar(4) DEFAULT NULL,`Nom` varchar(7) DEFAULT NULL,`Prenom` varchar(7) DEFAULT NULL,`Adresse` varchar(10) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout2=$dbh->exec("CREATE TABLE `Commandes` (`NumeroCommande` int(1) NOT NULL,`DateCommande` varchar(10) DEFAULT NULL,`ModePaiement` varchar(6) DEFAULT NULL,`DateExpedition` varchar(10) DEFAULT NULL,`AdresseMail` varchar(13) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout3=$dbh->exec("CREATE TABLE `Detail`( `NumeroCommande` int(1) NOT NULL,`Reference` int(1) NOT NULL,`Quantite` int(2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout4=$dbh->exec("CREATE TABLE `Produit` (`Reference` int(1) NOT NULL,`Nom` varchar(16) DEFAULT NULL,`Categorie` varchar(7) DEFAULT NULL,`Marque` varchar(7) DEFAULT NULL,`PrixUnitaire` decimal(3,2) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $table1="Client";
                $table2="Commande";
                $table3="Detail";
                $table4="Produit";
                $table5="";
                //echo "je suis dans la table Clients";
            }elseif($db=="Livres"){
                $ajout1=$dbh->exec("CREATE TABLE `Auteur` (`id_auteur` INT(1) NOT NULL,`nom_auteur` varchar(20) DEFAULT NULL,`pre_nom_auteur` varchar(20) DEFAULT NULL,`Naissance` DATE DEFAULT NULL,`Mort` DATE DEFAULT NULL,`Nationalite` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout2=$dbh->exec("CREATE TABLE `Ecrit_par` (`id_auteur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout3=$dbh->exec("CREATE TABLE `Edite_par` (`id_editeur` INT(1) NOT NULL,`id_livre` INT(1)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout4=$dbh->exec("CREATE TABLE `Editeur` (`id_editeur` INT(1) NOT NULL,`nom_editeur` VARCHAR(30),`site_web` VARCHAR(40))) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $ajout5=$dbh->exec("CREATE TABLE `Livre` (`id_livre` INT(1) NOT NULL,`nom_livre` VARCHAR(30),`genre` VARCHAR(40),`parution` YEAR,`nature` VARCHAR(20),`langue` VARCHAR(20)) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                $table1="Auteur";
                $table2="Ecrit_par";
                $table3="Edite_par";
                $table5="Livre";
                $table4="Editeur";
                //echo "je suis dans la table Clients";
            }
            //echo "$table1"
            ?>
            </head>
            <form method ="post" action="index.php">
            <p> Creation de la Base de données de votre choix
            </p>
            <select name="choix">
            <option value="Livres">Livres</option>
            <option value="Eleves">Eleves</option>
            <option value="Clients">Clients</option>
            <input type="submit" name="valider" value="OK"/>
            </select>
            <p> Ajout de tables à partir des fichiers csv
            </p>
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
            <p> Bouton permettant de se diriger sur divers pages cf questions suivantes
            </p>
            <p> Bouton qui efface toutes la base de données ainsi que toute trace d'execution sur la machine
	    </p>
	    <p>    	
		<input type="button" value= "Tout effacer et revenir au menu principal" onClick="document.location.href = document.referrer">
	   </p>
		
	    </form>
            <?php
            }
            ?>
</html>
