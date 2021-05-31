<?php
session_start();
include "dbConn.php";  // Using database connection file here

?>
<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\head.html'; ?>
    <title>Home</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\header.php';    ?>
    <form class="box" action="./Voter.php" method="post">
        <h1>Voter</h1>
        <?php
        if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
            echo "<center><h2>Alert Messages</h2><h3>Tu doit authentifier d'abord</h3></center>";
        } else {
            try {
                $sql = "SELECT * FROM partipolitique";
                $projresult = $db->query($sql);
                $projresult->setFetchMode(PDO::FETCH_ASSOC);
                echo '<select name="partipolitique"  id="partipol" class="form-control" >';
                while ($row = $projresult->fetch()) {
                    echo '<option value="' . $row['idParti'] . '">' . $row['nomParti'] . '</option>';
                }
                echo '</select>';
            } catch (PDOException $e) {
                die("Some problem getting data from database !!!" . $e->getMessage());
            }
        ?>
            <input type="submit" name="Voter" value="Voter">
            <input type="submit" name="Annuler" value="Annuler">
        <?php

            if (isset($_POST['Voter'])) {
                try {
                    $stm2 = $db->prepare("select idPartiElu from electeur where pseudo='$_SESSION[username]'");
                    $stm2->execute();
                    $resultat = $stm2->fetchAll(PDO::FETCH_ASSOC);
                    if ($resultat[0]['idPartiElu'] != null) {
                        echo "<center><h2>Alert Messages</h2>" .
                            "<h3>Vous avez déja voter s'il vous plait consulter votre vote</h3></center>";
                    } else {
                        $dt = getdate();
                        $date = $dt['year'] . "/" . $dt['mon'] . "/" . $dt['mday'];
                        //$sth appartient à la classe PDOStatement 
                        $sql = "SELECT idGouvernorat FROM electeur where pseudo='$_SESSION[username]'";
                        $projresult = $db->query($sql);
                        $projresult->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $projresult->fetch();
                        $sth = $db->prepare("
    INSERT INTO voix(
    idGouvernorat,
    idParti,
    nombreVoix)
    VALUES (?,?,?)
    ");
                        $sth->bindValue(1, $row['idGouvernorat'], PDO::PARAM_INT);
                        $sth->bindValue(2, $_POST['partipolitique'], PDO::PARAM_INT);
                        $sth->bindValue(3, 1, PDO::PARAM_INT);
                        $sth->execute();
                        $sth = $db->prepare("
UPDATE electeur 
SET idPartiElu='$_POST[partipolitique]',dateDerniereElection='$date'
WHERE pseudo='$_SESSION[username]' and motPasse='$_SESSION[password]'
");
                        $sth->execute();
                        if ($sth->rowCount() != 0) {
                            echo "<center><h2>Alert Messages</h2>" .
                                "<h3>Vote acceptée</h3></center>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage();
                }
            }
        }
        ?>
    </form>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\footer.php';
    ?>
</body>

</html>