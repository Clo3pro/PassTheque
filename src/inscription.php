
<form action="ajoutuser.php" method="POST" >
    <div id ="formulaire">
        <fieldset>
                <legend>Inscription</legend>
                
                <label for="nom"><b>Nom </b></label></br></br>
                <input type="text" placeholder="Entrer votre" name="nom" id="nom" required></br></br>

                <label for="prenom"><b> Prénom</b></label></br></br>
                <input type="text" placeholder="Entrer votre prénom" name="prenom" id="prenom" required></br></br>

                <label for="password"><b>Mot de passe</b></label></br></br>
                <input type="password" placeholder="Entrer le mot de passe" name="password" id="password"  required></br></br>

                <label for="mail"><b>Adresse mail valide</b></label></br></br>
                <input type="mail" placeholder="Entrer votre adresse mail" name="mail" id="mail" required></br></br>

                <label for="phone"><b>Numéro de téléphone</b></label></br></br>    
                <input type="tel" placeholder="Entrer votre numéros de téléphone"  name="phone" id="phone" pattern="[0-9]{10}"  required></br></br>


                <input type="submit"  value='INSCRIPTION' >
                <p></a>Déjà inscrit ? Connectez-vous <a href="connexion.php">ici </a></p>

         </fieldset>
    </div>
</form>



