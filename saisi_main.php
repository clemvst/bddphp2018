<html>
<!-- Saisi Manuel -->
<?php
    $table=$_POST['tab'];
    $db=$_POST['db_name'];
       ?>
        <p>
    <?php echo " On est sur cette $table et $db";?>
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
            $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$table'";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll();
            $num=count($result);
        //Testons si la table a été modifié :
            if(isset($_POST['Modif'])){
            //On doit faire des updates
                $n=0;
                $val=$_POST['val']; //Array containig the new values of the line
                $val2=$_POST['val2'];
                while($n<$num){
                    $new_val=$_POST[$n];
                    $col1=$result[0][0];
                    $col_name=$result[$n][0];
                    if($table=="Detail"){
                        $col2=$result[1][0];
                        $sql_up="UPDATE `$table` SET `$col_name`='$new_val' WHERE $col1='$val' AND $col2='$val2' ";
                        $sth = $dbh->prepare($sql_up);
                        $n++;
                        $sth->execute();
                    }else{
                        $sql_up="UPDATE `$table` SET `$col_name`='$new_val' WHERE $col1='$val'";
                        echo "$sql_up";
                        $n++;
                        $sth = $dbh->prepare($sql_up);
                        $sth->execute();
                    }
                }
            }if(isset($_POST['del'])){
                $val=$_POST['val']; //Array containig the new values of the line
                $val2=$_POST['val2'];
                 $col1=$result[0][0];
                if($table=="Detail"){
                    $col2=$result[1][0];
                    $sql_del="DELETE FROM `$table` WHERE $col1='$val' AND $col2='$val2' ";
                    echo "$sql_del";
                    $sth = $dbh->prepare($sql_del);
                    $sth->execute();
                }else{
                    $sql_del="DELETE FROM `$table` WHERE $col1='$val'";
                    echo "$sql_del";
                    $sth = $dbh->prepare($sql_del);
                    $sth->execute();
                    }
            }
    //Determinons le nom des colonnes en fonction de la table sélectionné
        $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = N'$table'";
        $sth = $dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll();
        $num=count($result);
        // Pour les données du tableau
        $sql2="SELECT * FROM $table";
        $sth2 = $dbh->prepare($sql2);
        $sth2->execute();
        $result2 = $sth2->fetchAll();
        $num2=count($result2);
        //Initialisation compteurs des whiles
        $j=0;
        $j2=0;
       
        //print_r($result2[1][1]);
        //echo "$num2";
        ?>
        <table>
        <?php //print_r($result[1][0]);
    //$sql2=""; ?>

        <tr> <!--Ligne des titres -->
        <?php
        while($j<$num){
        ?>
        <th> <?php print_r($result[$j][0]); ?> </th>
            <?php $j++;
        } ?>
        </tr>
        <!-- Lignes du tableaux-->
        <?php while($j2<$num2){ ?>
            <tr>
            <?php  $k=0; ?>
            <form method ="post" action="saisi_main.php">
            <?php while($k<$num){ ?>
                <input type="hidden" name="db_name" value=<?php echo "$db"?> >
                <input type="hidden" name="tab" value=<?php echo "$table"?> >
                <td>
                <?php //echo"$j2"; ?>
                <input type="text" name = <?php echo "$k" ?> value= <?php print_r($result2[$j2][$k]) ?> /> </td>
                <?php
                $k++;
            }
            ?>
            <td>
            <?php $val=$result2[$j2][0]; ?> <!--il s agit de la valeur de la clé primaire de la valeur modifier-->
            <?php $val2=$result2[$j2][1]; ?><!--il s agit de la valeur de la clé primaire uniquement utile pour table Detail de la valeur modifier-->
            <input type="submit" name="Modif" value="OK">
            <input type="submit" name= "del" value="supprimer"/>
            <input type="hidden" name="val" value=<?php echo "$val"; ?> >
            <input type="hidden" name="val2" value=<?php echo "$val2"; ?>>
            </td>
            </form>
            </tr>
    <?php
        $j2++;
        }
        ?>
        </table>
        <form method="post" action="ajout_ligne.php">
        <input type="submit" name="Ajouter" value="Ajouter">
        <input type="hidden" name="db_name" value=<?php echo "$db"?> >
        <input type="hidden" name="tab" value=<?php echo "$table"?> >
        </form>
        </form>
        <form method ="post" action="ajout_table.php" enctype="multipart/form-data">
        <input type="hidden" name="choix" value= <?php echo "$db " ;?> />
        <input type="submit" name="retour_simple" value="retour"/>
        </form>

</html>