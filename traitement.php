BDD
<html>

    <head>
    Création BDD de notre choix
    </head>
<!-- On récpère le choix de l utilisateur -->

    $name_table = <?php echo htmlspecialchars($_POST['choix']);?> <!-- On a mis le html specialchars afin déciter les utilisateurs mal veillant, pas forcément nécessaire pour ce DM -->

    <?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=$name_table;charset=utf8','root','root');
        echo "La base de données est crée !!!";
    }
    catch (Exception $e)
    {   echo "ça ne marche pas ! ";
        die('Erreur : ' . $e->getMessage());
    }?>
 
</html>