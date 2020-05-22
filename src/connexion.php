<?php 
session_start();
include("header.php");
$membres = $pdo ->prepare('
SELECT *
FROM Membre
WHERE email=?');
$membres -> execute(array($_POST['mail']));
$listeMembres = $membres->fetch();

//  $goodPassword = password_verify($_POST['password'],$listeMembres['motDePasse']);

    if(isset($_POST['mail']) && ($_POST['password'] == $listeMembres['motDePasse'])){
        $_SESSION['connexion']=true;
        $_SESSION['nom'] = $listeMembres['nom'];
        $_SESSION['prenom']= $listeMembres['prenom'];
        $_SESSION['email']= $listeMembres['email'];
        $_SESSION['admin']= $listeMembres['niveauAcces'];
        $_SESSION['phone']= $listeMembres['telephone'];
       
        header('Location: accueil.php');
    }else{
        
        echo "Mot de passe ou adresse mail erroné ! veuillez réessayer";
    }
?>

<form action="connexion.php" method="POST" >
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

<?php 

include("bas.php")?>