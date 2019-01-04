<html>
    <?php
    if(isset($_POST['valider'])){ //on vérifie que l'option a été coché et on traite le formulaire
        $db = $_POST['choix']; /**la récupération données non protégé*/
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
            echo "La base de données est crée !!!";
        }
        catch (PDOException $e) {
            die("DB ERROR: ". $e->getMessage());
        }
        //En fonction de la table choisi on veut créer des tables dedans
        if($db="Eleves"){
            $table1="Activites";
            $table2="Classes";
            $table3="Eleves";
        }if($db="Clients"){
            $table1="Client";
            $table2="Commande";
            $table3="Detail";
            $table4="Produit";
        }if($db="Livres"){
            $table1="Auteur";
            $table2="Ecrit_par";
            $table3="Edite_par";
            $table4="Livre";
        }
    }?>

    else{
        
        <head>
        Mon DM de BDD
        </head>
        <!-- Notre formulaire :-->
        <form method ="post" action="index.php">
        <p> Creation de la table de votre choix
        </p>
        <select name="choix">
        <option value="Livres">Livres</option>
        <option value="Eleves">Ecole</option>
        <option value="Clients">Entreprise</option>
        <br/> <!-- Pourquoi ne fait pas un retour à la ligne ? -->
        <input type="submit" name="valider" value="OK"/>
        </select>
        <p> Ajout de ligne dans les tables à partir des fichiers csv
        </p>
        <p> Bouton permettant de se diriger sur divers pages cf questions suivantes
        </p>
        <p> Bouton qui efface toutes la table de données ainsi que toute trace d exectution sur la machine
        </p>
        </form>
    }
</html>