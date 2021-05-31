<?php
session_start();
?>
<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\head.html'; ?>
    <title>Inscription</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\header.php'; ?>
    <form class="box" action="./Insere.php" method="post">
        <h1>Inscrire</h1>
        <input type="text" name="Username" placeholder="Username">
        <input type="password" name="Password" placeholder="Password">
        <input type="email" name="Email" placeholder="Email">
        <input type="Number" name="Age" placeholder="Age">
        <?php
        require_once "dbConn.php";  // Using database connection file here
        try {
            $sql = "SELECT * FROM gouvernorat";
            $projresult = $db->query($sql);
            $projresult->setFetchMode(PDO::FETCH_ASSOC);

            echo '<select name="Gouvernorat"  id="Gov" class="form-control" >';

            while ($row = $projresult->fetch()) {
                echo '<option value="' . $row['idGouvernorat'] . '">' . $row['nomGouvernorat'] . '</option>';
            }
            echo '</select>';
        } catch (PDOException $e) {
            die("Some problem getting data from database !!!" . $e->getMessage());
        }
        ?>
        <input type="submit" name="Inscrire" value="Inscrire">
    </form>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\footer.php'; ?>
</body>

</html>