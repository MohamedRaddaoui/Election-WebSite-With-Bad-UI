<?php
session_start();
include "dbConn.php";
?>
<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\head.html'; ?>
    <title>Consultation</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\header.php';    ?>

    <form class="box" action="./Consulter.php" method="post">
        <h1>Consulter</h1>
        <?php
        $vote = false;
        if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
            $sth0 = $db->prepare("SELECT
idPartiElu,idGouvernorat
FROM
electeur
WHERE
pseudo ='$_SESSION[username]'");
            $sth0->execute();
            /*Retourne un tableau associatif pour chaque entrée de notre table
*avec le nom des colonnes sélectionnées en clefs*/
            $result = $sth0->fetchAll(PDO::FETCH_ASSOC);
            $idG = $result[0]['idGouvernorat'];
            $idP = $result[0]['idPartiElu'];
            if (isset($_POST['enter'])) {
                $sth = $db->prepare("UPDATE electeur 
                SET idPartiElu=null
                WHERE pseudo='$_SESSION[username]' and motPasse='$_SESSION[password]'");
                $sth->execute();
                $sth1 = $db->prepare("DELETE from voix where 
                idGouvernorat='$idG' and
                idParti='$idP' and
                nombreVoix=1");
                $sth1->execute();
                if ($sth->rowCount() && $sth1->rowCount()) {
                    $vote = true;
                    echo "<center><h2>Alert Messages</h2><h3>Vote supprimé avec succes</h3></center>";
                } else {
                    echo "<center><h3>Echec de supression de vote</h3></center>";
                }
            }

        ?>
            <?php
            $sth = $db->prepare("SELECT
electeur.pseudo,
gouvernorat.nomGouvernorat,
partipolitique.nomParti
FROM
electeur
INNER JOIN partipolitique ON electeur.idPartiElu = partipolitique.idParti
INNER JOIN gouvernorat ON electeur.idGouvernorat = gouvernorat.idGouvernorat
WHERE
electeur.pseudo ='$_SESSION[username]'");
            $sth->execute();
            /*Retourne un tableau associatif pour chaque entrée de notre table
*avec le nom des colonnes sélectionnées en clefs*/
            $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
            if ($sth->rowCount()) {
                echo "<center>" . $resultat[0]['pseudo'] . " vous avez voter pour le parti " . $resultat[0]['nomParti'] . " dans le gouvernorat de " . $resultat[0]['nomGouvernorat'] . "</center>";
            ?>
                <input type="submit" name="enter" value="Supprimer">
        <?php
            } else {
                if (!$vote)
                    echo "<center><h3>Vous n'avais pas encore voter</h3></center>";
            }
        } else {
            echo "<center><h3>Vous n'avais pas encore authentifier </h3></center>";
        }
        ?>
    </form>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\footer.php';
    ?>
</body>

</html>