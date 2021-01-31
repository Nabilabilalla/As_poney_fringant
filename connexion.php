<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=brief', 'nabila', 'nabila1997');
if(isset($_POST['formconnexion'])){
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect =sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)){
$requser = $bdd->prepare("SELECT * FROM Adherents WHERE mail = ? AND motdepasse = ?");
$requser->execute(array($mailconnect, $mdpconnect));
$userexist = $requser->rowCount();
if($userexist == 1){
    $userinfo = $requser->fetch();
    $_SESSION['id'] = $userinfo['id'];
    $_SESSION['pseudo'] = $userinfo['pseudo'];
    $_SESSION['mail'] = $userinfo['mail'];
    header("Location: profil.php?id=".$_SESSION['id']);
 
}
else{
    $erreur = "Mauvais mail ou mot de passe !";
}
}
    else{
        $erreur = "tous les champs doivent être complétés !";
    }
}

?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Brief</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>

<body>
    <header>
       
        <img class="img" src="pegasus.png" alt="">
        <img class="imgg" src="https://cdn.pixabay.com/photo/2016/10/14/16/04/angel-1740459_640.png" alt="">
        <img class="imga" src="https://cdn.pixabay.com/photo/2016/10/14/16/04/angel-1740459_640.png" alt="">
    </header>


    <section class="contacte" >
      
    <button class="Connexion"><a href="connexion.php">Connexion</a></button>  

        <form method="POST" action="" class="contactform">
                       <input  class="conta" type="email " name="mailconnect" id="" placeholder="Mail" />
                       <input  class="conta" type="password" name="mdpconnect" id="" placeholder="Mot de passe" />
                       <input class="submit" type="submit" vlue="Se connecter" name="formconnexion" id="" />
        </form>
       
        <br>
        <?php
                if (isset($erreur)) {
                        echo '<font color="red">' . $erreur . "</font>";
                }
                ?>
        </div>

        <p class="inscription"><a href="inscription.php">Inscription</a></p>

</section>


<div class="fot">


</div>
<h4>©️ 2021 Association Le poney fringant</h4>


</body>

</html>