<?php
session_start();
include 'dbConn.php';
if (isset($_POST['Enter'])) {
    $stm1 = $db->prepare("select * from electeur where pseudo='$_POST[username]' and motPasse='$_POST[password]'");
    $stm1->execute();
    $stm1->fetchAll();
    if ($stm1->rowCount() != 0) {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];
    }
}
?>
<!DOCTYPE html>
<html lang="Fr-fr">

<head>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\head.html'; ?>
    <title>Authentification</title>
</head>

<body>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\header.php';    ?>
    <form class="box" method="post">
        <h1>Authentifier</h1>
        <?php
        if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
            if (isset($_POST['Enter'])) {
                echo "<center><h2>Alert Messages</h2>
                <h4>Authentification acceptée</h4><center>
                <h5>Bienvenue " . $_SESSION['username'] . "</h5></center>";
            } else {
                echo "<center><h2>Alert Messages</h2>
                    <h4>Bienvenue " . $_SESSION['username'] . "</h4></center>";
            }
        } else {
            if (isset($_POST['Enter'])) {
                echo "<center><h2>Alert Messages</h2>" .
                    "<h4>Authentification non acceptée</h4>" .
                    "<h5>Verifier vos données</h5></center>";
            }
        ?>
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input type="submit" name="Enter" value="Connecter">
        <?php
        }
        ?>
    </form>
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\footer.php';
    ?>
</body>

</html>