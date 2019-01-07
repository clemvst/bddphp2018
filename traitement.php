BDD
<html>

    <head>
    Création BDD de notre choix
    </head>
<!-- On récpère le choix de l utilisateur -->

    <?php
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
    ?>

 
</html>