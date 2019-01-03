<html>
	<head>
		Mon DM de BDD
	</head>
    <!-- Notre formulaire :-->
    <form method ="post" action="traitement.php">
        <p> Creation de la table de votre choix
        </p>
        <select name="choix">
        <option value="Livres">Livres</option>
        <option value="Ecole">Ecole</option>
        <option value="Entreprise">Entreprise</option>
        <br/> <!-- Pourquoi ne fait pas un retour à la ligne ? -->
        <input type="submit" name "Creation d'une table" value="OK"/>
        </select>
<!--Bizarre ça fonctionne alors que je n ai jamais mis la balise php ...-->
        <p> Ajout de ligne dans les tables à partir des fichiers csv
        </p>
        <p> Bouton permettant de se diriger sur divers pages cf questions suivantes
        </p>
        <p> Bouton qui efface toutes la table de données ainsi que toute trace d exectution sur la machine
        </p>
    </form>

</html>