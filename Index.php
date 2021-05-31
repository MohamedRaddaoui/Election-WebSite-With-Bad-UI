<?php
session_start();
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
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\section.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '\projet\Requirements\footer.php';
    ?>
</body>

</html>