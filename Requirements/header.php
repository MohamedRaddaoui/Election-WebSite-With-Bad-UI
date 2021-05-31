<nav>
    <ul class="nav-links">
        <li><a href="/projet/Index.php">Acceuil</a></li>
        <li><a href="/projet/Inscrire.php">Inscription</a></li>
        <li><a href="/projet/Authentifier.php">Authentification</a></li>
        <img class="logo" src="/projet/Images/Isie.jpg" alt="Instance Supérieure Indépendante pour les Élections" onclick="location.href='\Index.php'"></div>
        <li> <a href="/projet/Voter.php">Vote</a></li>
        <li><a href="/projet/Consulter.php">Consultation</a></li>
        <li><a href="/projet/Afficher.php">Affichage</a></li>
        <?php
        if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {

        ?>
            <li><a href="/projet/Redirection.php">Déconnexion</a></li>
        <?php
        }
        ?>
    </ul>
    <div class="burger">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
    </div>
</nav>

<div class="img-container">
    <div class="inner-container">
        <h1 class="img-headline">ELECTION</h1>
        <h2 class="img-subheadline">Un politicien pense à la prochaine élection. Un homme d'État, à la prochaine génération.</h2>
        <?php
        if (!empty($_SESSION['username'])) {


        ?>
            <a class="btn" href="\projet\Voter.php">Voter</a>
        <?php
        } else {
        ?>
            <a class="btn" href="\projet\Inscrire.php">Inscrire</a>
        <?php
        }
        ?>
    </div>
</div>
<section>
    <div class="carte">
        <h1>Processus électoral moderne</h1>
        <h2>La phase pré-électorale :</h2>
        <p> le recensement et le découpage électoral.<br> le dépôt des candidatures en vue de l'élection .<br> la campagne électorale.<br></p>
        <h2>la phase électorale :</h2>
        <p>les opérations et le déroulement du vote.<br> le dépouillement du vote dans chaque bureau de vote.</p>

    </div>
</section>
<script src="\projet\Requirements\header.js"></script>