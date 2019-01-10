<html>
    <?php
        if(!(isset($_POST['valider']))){ //on vérifie que l'option n'a pas encore été
            ?>
            <head>
            Menu
            </head>
            <!-- Notre formulaire :-->
            <form method ="post" action="ajout_table.php">
            <p> Creation de la Base de données de votre choix
            </p>
            <select name="choix">
            <option value="Livres">Livres</option>
            <option value="Eleves">Eleves</option>
            <option value="Clients">Clients</option>
            <input type="submit" name="valider" value="OK"/>
	    </select>
		<input type="button" value= "Tout effacer et revenir au menu principal" onClick="document.location.href = document.referrer">
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
        <input type="button" value= "Tout effacer et revenir au menu principal" onClick="document.location.href = document.referrer">
        </form>
        </head>
        <?php
    }
	//l'option a été validé ...
	//echo "$table1"

?>
</html>
