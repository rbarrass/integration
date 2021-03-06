<?php
  /*Barrasset Raphaël, Castelain Julien, Ducroux Guillaume, Saint-Amand Matthieu  L3i 2019
  raphael.barrasset@gmail.com, julom78@gmail.com, g.ducroux@outlook.fr, throwaraccoon@gmail.com*/
    require('functions/main.func.php');
    require('functions/tuteur.func.php');
    verifyIfConnected('tuteur.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>UCP Alter Master</title>
  <link rel="stylesheet" type="text/css" href="style.less" media="screen">
  <script src="script.js"></script>
</head>
<body>
    <?php
      echo displayIconLogout();
      echo displayMenu();      
    ?>
    <!-- Barre de recherch dynamique gérée par script.js et style avec style.less -->
    <div class="search__container">
      <?php $i=1; echo '<form id="auto-suggest"  action="functions/main.func.php" method="POST">';?>
        <input type="text" class="search__input" name="search" value="Rechercher..." onfocus="if(this.value=='Rechercher...')this.value=''" autocomplete="off"/>
        <ul class="suggestions">
      <!-- remplit par le script -->
        </ul>
      </form>
    </div>

    <?php
          $tuteurbord = dispBordtuteur();
          echo $tuteurbord;
          if (approvalstud() != ''){
            //refresh page
            echo '<meta http-equiv="refresh" content=0 >';
          }
    ?>    
  </body>
  </html>