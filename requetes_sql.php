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
                echo "Quelle requête souhaitez-vous effectuer sur $db ?";
                echo '<select name="requete">
                <option value="'.$r1.'">'.$r1.'</option>
                <option value="'.$r2.'">'.$r2.'</option>
                <option value="'.$r3.'">'.$r3.'</option>
                <option value="'.$r4.'">'.$r4.'</option>
                <option value="'.$r5.'">'.$r5.'</option>
                <input type="submit" name="valider" value="OK"/>
                </select>';
?>
