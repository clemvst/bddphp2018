<html>
<?php
if (!empty($_POST['envoyer'])){ // lorsque l'utilisateur a demandé a supprimer tout

        $db=$_POST['db'];
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
        }
            catch (PDOException $e) {
                    die("DB ERROR: ". $e->getMessage());
            }

	$sql = "DROP DATABASE IF EXISTS `$db`";
	$dbh->exec($sql);
}

        if(!(isset($_POST['valider']))){ //on vérifie que l'option n'a pas encore été
		
	?>
            <head>
            Menu
            </head>
            <!-- Notre formulaire :-->
            <form method ="post" action="ajout_table.php">
	    <p> Création de la Base de données de votre choix
            </p> 
	    <p>
	    (livres et élèves ne sont pas terminées)
            </p>
            <select name="choix">
            <option value="Livres">Livres</option>
            <option value="Eleves">Eleves</option>
            <option value="Clients">Clients</option>
            <input type="submit" name="valider" value="OK"/>
	    </select>
	    </form>
        </head>


	<?php 
	}elseif(isset($_POST['retour1'])){ //permet de revenir en arrière
        ?>
        <head>
        Menu
        </head>
        <!-- Notre formulaire :-->
        <form method ="post" action="ajout_table.php">
        <p> Changer de Base données
        </p>
        <select name="choix">
        <option value="Livres">Livres</option>
        <option value="Eleves">Eleves</option>
        <option value="Clients">Clients</option>
        <input type="submit" name="valider" value="OK"/>
        </select>
        </form>
        </head>
        <?php
    }
?>
</html>
