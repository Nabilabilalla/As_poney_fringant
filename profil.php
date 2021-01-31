<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=brief', 'nabila', 'nabila1997');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
$getid = intval($_GET['id']); 
$requser = $bdd->prepare('SELECT * FROM Adherents WHERE id = ?');
$requser->execute(array($getid));
$userinfo = $requser->fetch();
   


?>
<html>
<head>
        <title>Brief</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="profil.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

</head>

<body>
<header>
<img class="logo" src="pegasus.png" alt="">
<h1 class="titre">Association Le poney fringant</h1>

</header>
<section class="menu">
<section class='butt'>
              <a href="editer.php">Editer mon profil</a>
              <a href="deconnexion.php">Se déconnecter</a>
              </section> 
</section>
 

        <div class="div">
               
        <h2>profil de <?php echo $userinfo['pseudo'];?></h2>
        
                <br />
                <section class="photo_de_profil">
              
                <?php
                 if(!empty($userinfo['avatar']))
                {
                   ?>
                 
                   <img class="img"  src="mombre/avatar/<?php echo $userinfo['avatar']; ?>" width="150"/> 
                   <?php
                }?>
         
            <br /></section>

            
            <section class="info">
            
           
            <h3>
            <?php  echo $userinfo['mail'];  ?>
                <?php
              if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
              
              {
                ?></h3>
        
              <?php
                 }
                ?>
          <p><?php echo $userinfo['date_naissance'];?></p>
          <p> <?php echo $userinfo['ville'];?></p>
          <p>je suis un membre du poney fringant</p>
        
           </section>
                </div>
                <div class="divis">
                        <p>On vous présente Nos activités</p>
                </div>
                <section class="publ">
                <div class="publication">
                <img class="pub" src="https://www.echosciences-paca.fr/uploads/folder/image/attachment/1005407167/xl_club-lecture.jpeg" alt="">
                <img class="pub" src="https://naturenergysite.files.wordpress.com/2016/01/faire-du-sport-les-5-disciplines-pour-perdre-des-calories-sans-vider-son-portefeuille-e1456335134585.jpg" alt="">
                <img class="pub" src="https://composer-sa-musique.fr/wp-content/uploads/2012/06/oreille_musicale_by_Meigestu.jpg" alt="">
                <img class="pub" src="https://popcorngame.fr/wp-content/uploads/2018/08/vonguru_images_jeu_video_team_vg_jeux_video_de_lete_cover-min.jpg" alt="">
                </div>
               
                <div class="publication">
                <img class="pub" src="https://cdn-s-www.estrepublicain.fr/images/1F3C4DD6-92D1-4F86-9290-FB2407E7FD66/NW_raw/photo-er-1582207244.jpg" alt="">
                <img class="pub" src="https://clic2boost.fr/wp-content/uploads/2018/03/fe1631d33c0f0d2557949513efd6128d_html_d5dcb9c91-920x425.jpg" alt="">
                <img class="pub" src="https://journalmetro.com/wp-content/uploads/2014/05/carriecc80res_chef-cuisinier_c100.jpg?fit=3800%2C2664" alt="">
                <img class="pub" src="https://www.itsecurityguru.org/wp-content/uploads/2017/04/aviation-industry-3.png" alt="">
                </div>

                <div class="publication">
                <img class="pub" src="https://www.teapot-creation.com/wp-content/uploads/2013/01/Cadre-Mecanique_02.jpg" alt="">
                <img class="pub" src="https://images.radio-canada.ca/v1/ici-premiere/16x9/mlarge-licorne.jpg" alt="">
                <img class="pub" src="https://iosys.fr/wp-content/uploads/2020/03/haute-joaillerie-luxe.jpg" alt="">
                <img class="pub" src="https://irxp.com/wp-content/uploads/2019/08/agriculture-banner-1130x431.jpg" alt="">
                </div>

                <div class="publication">
                <img class="pub" src="https://newtonabbot.scottcinemas.co.uk/media/cinema_galleries/2/1473843136-1457822340.jpg" alt="">
                <img class="pub" src="https://winkstrategies.com/wp-content/uploads/2015/04/logo-politique-1.jpg" alt="">
                <img class="pub" src="https://cache.marieclaire.fr/data/photo/w1000_ci/5b/couturematerielindispensable.jpg" alt="">
                <img class="pub" src="https://images.theconversation.com/files/196369/original/file-20171125-21820-9zwawa.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1356&h=668&fit=crop" alt="">
                </div>

                <div class="publication">
                <img class="pub" src="https://www.sciencenews.org/wp-content/uploads/2019/09/090919_EC_proton_feat-1028x579.jpg" alt="">
                <img class="pub" src="https://i.f1g.fr/media/eidos/805x453_crop/2017/06/16/XVM2b5c766c-4080-11e7-a469-62c36d07d43b.jpg" alt="">
                <img class="pub" src="https://www.cours-ado.com/wp-content/uploads/2017/12/environmental-protection-326923_1920-1025x683.jpg" alt="">
                <img class="pub" src="https://www.univ-brest.fr/digitalAssets/61/61164_Physique-chimie.jpg" alt="">
                </div>
                </section>
                <footer>
                <img class="lofot" src="pegasus.png" alt="">
                        <div class="footer">
             
                       
                        <p>num : 08-99-77-99</p>
                        <p>mail:poney@fringant.fr</p>
                        <h1 class="tite">Association Le poney fringant</h1>
                        </div>
                </footer>
</body>

</html>
<?php
}

?>