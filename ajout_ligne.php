
<!--Saisi de ligne supplémentaire dans ma BDD -->
<?php
    $table=$_POST['tab'];
    $db=$_POST['db_name'];
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
    $j=0;
    ?>
    <table>
    <tr> <!--Ligne des titres -->
    <?php while($j<$num){ ?>
        <th> <?php print_r($result[$j][0]); ?> </th>
        <?php $j++;
            } ?>
    </tr>
    <!-- A completer : bouton-->
    <?php $k=0; ?> <!-- compteur -->
    <tr>
        <form method="post" action="ajout_ligne.php">
            <?php  while($k<$num){ ?>
            <input type="hidden" name="db_name" value=<?php echo "$db"?> >
            <input type="hidden" name="tab" value=<?php echo "$table"?> >
            <td> <input type= "text" name=<?php echo "$k" ?> value=""> </td>
            <?php $k++;
                }?>
            <td> <input type= "submit" name="Valider_ajout" value="OK"> </td>
        </form>
    </tr>
    </table>
    <?php
    if(isset($_POST['Valider_ajout'])){
        $table=$_POST['tab'];
        $db=$_POST['db_name'];
        $host="localhost";
        $root="root";
        $root_password="rootpass";
        $user='newuser';
        $pass='newpass';
        $n=0;
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
        $val="";
        $max=$num-1;
        while($n<$max){
            $new_val=$_POST[$n];
            print_r($new_val);
            $col1=$result[0][0];
            $col_name=$result[$n][0];
            $val.=" "."'$new_val'". " ".",";
            $n++;
        }
        $val.=" ". "'$_POST[$max]'"." ";
        $sql_in="INSERT INTO `$table` VALUES ($val)";
        #echo "$sql_in" ;
        $sth = $dbh->prepare($sql_in);
        $sth->execute();
    }
        ?>
  <form method="post" action = "saisi_main.php">
    <input type="hidden" name="db_name" value=<?php echo "$db"?> >
    <input type="hidden" name="tab" value=<?php echo "$table"?> >
    <input type="submit" name="retour" value="Retour"/>
    </form>

