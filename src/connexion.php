<?php 
session_start();
include("header.php");
?>

<form action="valid_connexion.php" method="POST" >
    <div id ="formulaire">
        <fieldset>
                <legend>Connexion</legend>

                <label for="mail"><b>Adresse mail</b></label></br></br>
                <input type="mail" placeholder="Entrer votre adresse mail" name="mail"  required></br></br>


                <label for="password"><b>Mot de passe</b></label></br></br>
                <input type="password" placeholder="Entrer le mot de passe" name="password"   required></br></br>

                <input type="submit"  value='connexion' >
                <p></a>Pas encore inscrit ? c'est par <a href="inscription_home.php">ici </a></p>

         </fieldset>
    </div>
</form>

<?php include("bas.php")?>