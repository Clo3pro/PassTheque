
<?php include 'header.php'?>

<form action="ajoutuser.php" methode="post" >
    <div id ="formulaire">
        <fieldset>
                <legend>Inscription</legend>
                
                <label for="nom"><b>Nom </b></label></br></br>
                <input type="text" placeholder="Entrer votre" name="nom"  required></br></br>

                <label for="prenom"><b> Prénom</b></label></br></br>
                <input type="text" placeholder="Entrer votre prénom" name="prenom" required></br></br>

                <label for="password"><b>Mot de passe</b></label></br></br>
                <input type="password" placeholder="Entrer le mot de passe" name="password"   required></br></br>

                <label for="mail"><b>Adresse mail valide</b></label></br></br>
                <input type="mail" placeholder="Entrer votre adresse mail" name="mail"  required></br></br>

                <label for="phone"><b>Numéros de téléphone</b></label></br></br>    
                <input type="tel" placeholder="Entrer votre numéros de téléphone" " name="phone"  pattern="[0-9]{10}"  required></br></br>


                <input type="submit"  value='INSCRIPTION' >
                <p></a>Déjà inscrit ? Connectez-vous <a href="">ici </a></p>

         </fieldset>
    </div>
</form>



