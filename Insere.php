<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>

<body>
    <header>
        <nav class="nav_bar">
            <ul class="nav_links">
                <li>
                    <a href="./Index.html">Acceuil</a>
                </li>
                <li>
                    <a href="./Inscrire.php">Inscrire</a>
                </li>
                <li>
                    <a href="./Authentifier.php">Authentifier</a>
                </li>
                <li>
                    <a href="./Voter.php">Voter</a>
                </li>
                <li>
                    <a href="./Consulter.html">Consulter</a>
                </li>
                <li>
                    <a href="./Afficher.html">Afficher</a>
                </li>
                <li>
                    <a href="#"></a>Deconnexion
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <img class="logo" src="./Images/electiontunisienne.jpg" alt="">
        <img class="logo" src="./Images/Isie.jpg" alt="">
        <img class="logo" src="./Images/Tunisie-votes.jpg" alt="">
    </div>
    <?php
    include 'dbConn.php';
    if (isset($_POST['Inscrire'])) {
        $stm1 = $db->prepare("select * from electeur where pseudo='$_POST[Username]'");
        $stm1->execute();
        $stm1->fetchAll();
        $stm2 = $db->prepare("select * from electeur where email='$_POST[Email]'");
        $stm2->execute();
        $stm2->fetchAll();
        if ($stm1->rowCount() != 0 || $stm2->rowCount() != 0) {
            echo "<h2>Alert Messages</h2>" .
                "<h3>Username Or Email Already Used</h3>";
        } else {
            try {
                $dt = getdate();
                $date = $dt['year'] . "/" . $dt['mon'] . "/" . $dt['mday'];
                //$sth appartient à la classe PDOStatement
                $sth = $db->prepare("
 INSERT INTO electeur (pseudo,motPasse,email,age,dateInscription,idGouvernorat)
    VALUES (?,?,?,?,?,?)
 ");
                //La constante de type par défaut est STR
                $sth->bindValue(1, $_POST['Username']);
                $sth->bindValue(2, $_POST['Password']);
                $sth->bindValue(3, $_POST['Email']);
                $sth->bindValue(4, $_POST['Age'], PDO::PARAM_INT);
                $sth->bindValue(5, $date);
                $sth->bindValue(6, $_POST['Gouvernorat']);
                $sth->execute();
                echo "<h2>Alert Messages</h2>" .
                    "<h3>Iscription acceptée tu peut maintenant voter</h3>";
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }
    }
