<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=brief', 'nabila', 'nabila1997');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST['forminscription'])) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $code_posta = htmlspecialchars($_POST['code_posta']);
        $date_naissance = htmlspecialchars($_POST['date_naissance']);
        $ville = htmlspecialchars($_POST['ville']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $mdp = sha1($_POST['mdp']);
        $mdp2 = sha1($_POST['mdp2']);
        $ch = $_POST["ch"];
        if (!empty($_POST['pseudo']) and !empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['code_posta']) and !empty($_POST['date_naissance']) and !empty($_POST['ville']) and !empty($_POST['mail']) and !empty($_POST['mail2']) and !empty($_POST['mdp']) and !empty($_POST['mdp2'])) {

                $pseudolength = strlen($pseudo);
                if ($pseudolength <= 255) {
                        if ($mail == $mail2) {

                                if ($mdp == $mdp2) {
                                        try {
                                                $insertmbr = $bdd->prepare("INSERT INTO Adherents(pseudo, nom, prenom, code_posta, date_naissance, ville, mail, motdepasse) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
                                                $insertmbr->execute(array($pseudo, $nom, $prenom, $code_posta, $date_naissance, $ville, $mail, $mdp));
                                                $erreur = "Votre compte a bien été créé <a href='connexion.php'> connectez </a>vous";
                                        } catch (Exception $exception) {
                                                $erreur = $exception->getMessage();
                                        }
                                        $req = $bdd->prepare("INSERT INTO Interets(nom) VALUES(?)");
                                        $req->execute(array(implode(".", $ch)));
                                } else {
                                        $erreur = "Vos mot de passes ne correspondent pas !";
                                }
                        } else {
                                $erreur = "votre adresse mail n'est pas valide !";
                        }
                } else {
                        $erreur = "Vos adresses mail ne correspondent pas !";
                }
        } else {
                $erreur = "Votre pseudo ne doit pas dépsser 255 caractères !";
        }
} else {
        $erreur = "Tous les champs doivent etre complétés ! ";
}



?>





<html>

<head>
        <meta charset="UTF-8">
        <title>Brief</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="inscription.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
        <script>
                function insert(num) {
                        document.form.textiview.value = document.form.textiview.value + num
                }
        </script>
</head>
<img class="img" src="pegasus.png" alt="">
<img class="imgg" src="https://cdn.pixabay.com/photo/2016/10/14/16/04/angel-1740459_640.png" alt="">

</header>


<section class="contacte">

        <button class="Inscription">Inscription </button> <br>

        <form method="POST" action="" name="form" class="contactform">
                <label for="pseudo "></label>
                <input class="conta" type="text" placeholder="votre pseudo" id="pseudo" name="pseudo" value="<?php if (isset($pseudo)) {
                                                                                                                        echo $pseudo;
                                                                                                                } ?>">
                <label for="nom"></label>
                <input class="conta" type="text" placeholder="votre Nom" id="nom" name="nom" value="<?php if (isset($nom)) {
                                                                                                                echo $nom;
                                                                                                        } ?>">
                <label for="prenom"></label>
                <input class="conta" type="text" placeholder="votre Prénom" id="prenom" name="prenom" value="<?php if (isset($prenom)) {
                                                                                                                echo $prenom;
                                                                                                        } ?>">
                <label for="code_posta"></label>
                <input class="conta" type="number" placeholder="votre code postall" id="code_posta" name="code_posta" value="<?php if (isset($code_posta)) {
                                                                                                                                        echo $code_posta;
                                                                                                                                } ?>">
                <label for="date_naissance"></label>
                <input class="conta" type="date" placeholder="votre date de naissance" id="date_naissance" name="date_naissance" value="<?php if (isset($date_naissance)) {
                                                                                                                                                echo $date_naissance;
                                                                                                                                        } ?>">
                <label for="ville"></label>
                <input class="conta" type="text" placeholder="votre Ville" id="mail" name="ville" value="<?php if (isset($ville)) {
                                                                                                                        echo $ville;
                                                                                                                } ?>">
                <label for="mail"></label>
                <input class="conta" type="email" placeholder="votre mail" id="mail" name="mail" value="<?php if (isset($mail)) {
                                                                                                                echo $mail;
                                                                                                        } ?>">
                <label for="mail2"></label>
                <input class="conta" type="email" placeholder="confirmez votre mail" id="mail2" name="mail2" value="<?php if (isset($mail2)) {
                                                                                                                                echo $mail2;
                                                                                                                        } ?>">
                <label for="mdp"></label>
                <input class="conta" type="password" placeholder=" votre mot de passe" id="mdp" name="mdp">
                <label for="mdp2"></label>
                <input class="conta" type="password" placeholder=" confirmez votre mot de passe" id="mdp2" name="mdp2">
                <div class="inter">
                        <label for="ch"></label>
                        <input type="checkbox" name="ch[]" value="#sport" onclick="insert('#sport')">Sport
                        <input type="checkbox" name="ch[]" value="#Musique" onclick="insert('#Musique')">Musique
                        <input type="checkbox" name="ch[]" value="#vidéos" onclick="insert('#vidéos')">vidéos
                        <input type="checkbox" name="ch[]" value="#Jeux" onclick="insert('#Jeux')">Jeux
                        <input type="checkbox" name="ch[]" value="#Lecture " onclick="insert('#Lecture')">Lecture <br> <br>
                        <input type="checkbox" name="ch[]" value="#Informatique " onclick="insert('#Informatique')">Informatique
                        <input type="checkbox" name="ch[]" value="#Sorties " onclick="insert('#Sorties')">Sorties
                        <input type="checkbox" name="ch[]" value="#Cuisine" onclick="insert('#Cuisine')">Cuisine
                        <input type="checkbox" name="ch[]" value="#Aviation" onclick="insert('#Aviation')">Aviation <br> <br>
                        <input type="checkbox" name="ch[]" value="#Mécanique" onclick="insert('#Mécanique')">Mécanique
                        <input type="checkbox" name="ch[]" value="#Licornes" onclick="insert('#Licornes')">Licornes
                        <input type="checkbox" name="ch[]" value="#Joaillerie " onclick="insert('#Joaillerie')">Joaillerie
                        <input type="checkbox" name="ch[]" value="#Agriculture" onclick="insert('#Agriculture')">Agriculture <br> <br>
                        <input type="checkbox" name="ch[]" value="#Cinéma" onclick="insert('#Cinéma')">Cinéma
                        <input type="checkbox" name="ch[]" value="#Politique" onclick="insert('#Politique')">Politique
                        <input type="checkbox" name="ch[]" value="#Couture" onclick="insert('#Couture')">Couture
                        <input type="checkbox" name="ch[]" value="#Animaux" onclick="insert('#Animaux')">Animaux <br><br>
                        <input type="checkbox" name="ch[]" value="#Science" onclick="insert('#Science')">Science
                        <input type="checkbox" name="ch[]" value="#Histoire " onclick="insert('#Histoire')">Histoire
                        <input type="checkbox" name="ch[]" value="#SVT" onclick="insert('#SVT')">SVT
                        <input type="checkbox" name="ch[]" value="#Physique-Chimie" onclick="insert('#Physique-Chimie')">Physique-Chimie <br> <br>
                        <input type="checkbox" name="ch[]" value="#Taxidermie" onclick="insert('#Taxidermie')">Taxidermie
                        <input type="checkbox" name="ch[]" value="#Philatélie" onclick="insert('#Philatélie')">Philatélie <br>
                        <form name="form"><br>
                                <input class="textiview" name="textiview" <?php if (isset($ch)) {
                                                                                        echo $ch;
                                                                                } ?>>

                </div>
                <input class="wrapper" type="submit" vlue="Je m'inscris" name="forminscription" id="" />
        </form>


        <br>
        <?php
        if (isset($erreur)) {
                echo '<font color="#1a0420">' . $erreur . "</font>";
        }
        ?>

        </div>

        <button class="Connexion"><a href="connexion.php">Connexion</a></button>
        <img class="imgombre" src="https://cdn.pixabay.com/photo/2016/10/14/16/04/angel-1740459_640.png" alt="">
</section>
<footer>
        <p class="titre">VOUS avez besoin d'aide ? </p>

</footer>
<div class="fot">


</div>
<h4>©️ 2021 Association Le poney fringant</h4>

</body>

</html>