<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=brief', 'nabila', 'nabila1997');
if(isset($_SESSION['id']))
{
    $requser = $bdd->prepare('SELECT * FROM Adherents WHERE id = ?');
$requser->execute(array($_SESSION['id']));
$user = $requser->fetch();

if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']){
    $newpseudo = htmlspecialchars($_POST['newpseudo']);
    $insertpseudo = $bdd->prepare("UPDATE Adherents SET pseudo = ? WHERE id = ?");
    $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
}
if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']){
    $newmail = htmlspecialchars($_POST['newmail']);
    $insertmail = $bdd->prepare("UPDATE Adherents SET mail = ? WHERE id = ?");
    $insertmail->execute(array($newmail, $_SESSION['id']));
    header('Location: profil.php?id='.$_SESSION['id']);
}
if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND $_POST['newmdp2'] AND !empty($_POST['newmdp2'])){
    $mdp1 = sha1($_POST['newmdp1']);
    $mdp2 = sha1($_POST['newmdp2']);
    if($mdp1 == $mdp2){
        $insertmdp = $bdd->prepare("UPDATE Adherents SET motdepasse = ? WHERE id = ?");
        $insertmdp->execute(array($newmdp1, $_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']); 
    }
    else{
        $msg = "Vos deux mots de passe ne correspondent pas !";
    }
  
}
/*pour ajouter une image */
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
{
    $tailleMax = 2097152; /*2MO*/
    $extentionsValides = array('jpg', 'jpeg', 'gif', 'png');
    
    if($_FILES['avatar']['size'] <= $tailleMax)
    {
        $extentionsinoUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extentionsinoUpload, $extentionsValides)){
            $chemin = "mombre/avatar/".$_SESSION['id'].".".$extentionsinoUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if($resultat){
                $updateavatar = $bdd->prepare('UPDATE Adherents SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".". $extentionsinoUpload,
                    'id'=> $_SESSION['id']
                ));
                header('Location: profil.php?id='.$_SESSION['id']); 
            }
            else{
                $msg = "Erreur durant l'importation de votre photo de profil ";
            }
        }
        else{
            $msg = " Votre photo de profil être au format: 'jpg', 'jpeg', 'gif', 'png' ";
        }
    }else{
        $msg = "Votre photo de profil ne doit pas dépasser 2MO";
    }

} 
///


  
?>
<html>
<head>
        <title>Brief</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="editi.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

</head>

<body>

    <header>
    <img class="logo" src="pegasus.png" alt="">
<h1 class="titre">Association Le poney fringant</h1>
            </header>
            <section class="menu">
        <ul>
       
                <li>Acueil</li>
                <li> <a>Profil</a> </li>
                <li> <a>a propos</a> </li>
        </ul>

        
</section>
<h2> Edition de mon profil </h2>
        <div class="div">
           
            <form method="POST" action="" enctype="multipart/form-data">
                <input class="conta" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo'];?>" /> <br> 
             
               
                <input class="conta" type="text" name="newmail" placeholder="Mail"  value="<?php echo $user['mail'];?>"  /><br>
                <input class="conta" type="password" name="newmdp1" placeholder="Mot de passe" /><br>
                <input class="conta" type="password" name="newmdp2" placeholder="confirmation du mot de passe" /><br>
                <label for="" class="com"></label> 
                <input class="con" type="file" name="avatar" /> <br>
               
                
                <input class="wrapper" type="submit" value="Mettre a jour mon profil !" name="" id="">  
            </form>
            <img class="imgg" src="https://cdn.pixabay.com/photo/2016/10/14/16/04/angel-1740459_640.png" alt="">
        <?php  if(isset($msg)){ echo $msg; }  ?>
        
        </div>
        <h3>mot de passe oublié</h3>
</body>

</html>
<?php
}
else{
    header("Location: connexion.php");
}
?>













