
<!DOCTYPE html>
<html lang="en">
<?php
  /*Barrasset Raphaël, Castelain Julien, Ducroux Guillaume, Saint-Amand Matthieu  L3i 2019
  raphael.barrasset@gmail.com, julom78@gmail.com, g.ducroux@outlook.fr, throwaraccoon@gmail.com*/
session_start();
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="style.less" media="screen">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap1-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Editer son profil</title>
    <style>
      input[type=text],input[type=password],select{
        width: 60%;
        height: calc(1.75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
      }
      input[type=text]:focus,input[type=password]:focus, select:focus{
          border-color: rgba(0,100,255, 0.8);
          box-shadow: 0 0 1px rgba(0,130,255, 0.075) inset, 0 0 4px rgba(0,130,255, 1);
          outline: 0 none;
      }
      p, h5 {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        margin-bottom: 20px;
      }
      input[type=radio]{
        display: inline-block;
      }
    </style>
</head>
<body>
 <?php
                        require('functions/main.func.php'); 
                        $sizeError = moreInformations($_SESSION['idu']);
                        if($sizeError == "ok"){
                          send($_SESSION['idu']);
                          header('Location: profil.php?idu='.$_SESSION['idu'].'');
                          exit();
                        }
                        // Redirect to profil.php page if no error detected, else show it
                    ?>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
          <a class="navbar-brand" href="https://monucp.u-cergy.fr/uPortal/f/u410l1s6/normal/render.uP" id="nameU">Université de Cergy-Pontoise</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

        
      </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col-md-offset-1 col-md-10">
      <div class="panel panel-default">
            <div class="panel-heading">
              </div>
              <div class="panel-body">
                <form action="editProfil.php" method="POST" onsubmit="return moreInformations($_SESSION['idu'])" enctype="multipart/form-data">
                  <h5>L'étudiant</h5>
                  <table class="table profile__table">
                    <tbody>
                      <tr>
                        <th><strong>Changer de photo de profil</strong></th>
                        <td><input type="file" name="profilimg" id="profilimg"></td>
                      </tr>
                      <tr>
                        <th><strong>Adresse</strong></th>
                        <td><input type="text" name="newadr" size="60" style="width: 425px;"></td>
                      </tr>
                      <tr>
                        <th><strong>Sexe</strong></th>
                        <td><div class="radioB"><input type="radio" id="mygender1" name="newgender" value="Femme">
                          <label for="mygender1">Femme</label>
                          <input type="radio" id="mygender2" name="newgender" value="Homme">
                          <label for="mygender2">Homme</label></div>
                        </td>
                      </tr>
                      <tr>
                        <th><strong>Nationalité</strong></th>
                        <td><input type="text" name="newnat" ></td>
                      </tr>
                      <tr>
                        <th><strong>Date de naissance</strong></th>
                        <td><input type="date" name="newdbir" ></td>
                      </tr>
                      <tr>
                        <th><strong>Lieu de naissance</strong></th>
                        <td><input type="text" name="newpbir" ></td>
                      </tr>
                      <tr>
                        <th><strong>Numéro de téléphone</strong></th>
                        <td><input type="text" name="newtel" ></td>
                      </tr>
                      <tr>
                        <th><strong>Mot de passe</strong></th>
                        <td> <input type="password" name="newpwd" placeholder="Votre mot de passe (8 caractères minimum)"></td>
                      </tr>
                      <tr>
                        <th><strong>Confirmer votre mot de passe</strong></th>
                        <td><input type="password" name="newpwd1" placeholder="Votre mot de passe (8 caractères minimum)"></td>  
                      </tr>
                      <tr>
                        <th><strong>Filière</strong></th>
                        <td>   <select name="newPromo" >
                                <option value="">Pas de changement</option>
                                <option value="Master SID">SID</option>
                                <option value="Master RS">RS</option>
                                <option value="Master STRC">STRC</option>
                              </select> </td>
                      </tr>
                      <tr>
                        <th><strong>Groupe de TD</strong></th>
                        <td> <select name="newGroup" >
                                <option value="">Pas de changement</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                              </select> </td>
                      </tr>
                    </tbody>
                  </table>
                      <h5>Le poste</h5>
                  <table class="table profile__table">
                    <tbody>
                      <tr>
                        <th><strong>Date de début de contrat</strong></th>
                        <td><input type="date" name="newdfirst" ></td>
                      </tr>
                      <tr>
                        <th><strong>Date de fin de contrat</strong></th>
                        <td><input type="date" name="newdend" ></td>
                      </tr>
                      <tr>
                        <th><strong>Intitulé du poste pourvu par l'apprenti</strong></th>
                        <td><input type="text" name="newjapp" ></td>
                      </tr>
                      <tr>
                        <th><strong>Missions confiées</strong></th>
                        <td><textarea name="newmiss" rows=4 cols=40></textarea></td>
                      </tr>
                      <tr>
                        <th><strong>Outils et technologies mises en oeuvre</strong></th>
                        <td><textarea name="newtech" rows=4 cols=40></textarea></td>
                      </tr>
                      </tbody>
                    </table>
                    <h5>L'entreprise</h5>
                    <table class="table profile__table">
                    <tbody> 
                      <tr>
                        <th><strong>Nom de l'entreprise accueillant l'étudiant</strong></th>
                        <td><input type="text" name="newent" > </td>
                      </tr>
                      <tr>
                        <th><strong>Adresse de l'entreprise accueillant l'étudiant </strong></th>
                        <td><input type="text" name="newadre" ></td>
                      </tr>
                      <tr>
                        <th><strong>Numéro de téléphone pour contacter l'entreprise </strong></th>
                        <td><input type="text" name="newenttel" ></td>
                      </tr>
                      <tr>
                        <th><strong>Code postal de l'entreprise</strong></th>
                        <td><input type="number" name="newpostent" ></td>
                      </tr>
                      <tr>
                        <th><strong>Ville de l'entreprise</strong></th>
                        <td><input type="text" name="newcity" ></td>
                      </tr>
                      <tr>
                        <th><strong>Nombre de salariés</strong></th>
                        <td><input type="number" name="newnbsal" ></td>
                      </tr>
                      <tr>
                        <th><strong>Numéro de Siret</strong></th>
                        <td><input type="number" name="newnumsir" ></td>
                      </tr>
                      <tr>
                        <th><strong>Code NAF</strong></th>
                        <td><input type="number" name="newcdenaf" ></td>
                      </tr>
                      <tr>
                        <th><strong>Numéro de convention collective</strong></th>
                        <td><input type="number" name="newnumconvco" ></td>
                      </tr>
                      <tr>
                        <th><strong>Intitulé de la convention collective</strong></th>
                        <td><input type="text" name="newconvco" ></td>
                      </tr>
                      <tr>
                        <th><strong>Numéro de la TVA intercommunautaire</strong></th>
                        <td><input type="number" name="newnumtva" ></td>
                      </tr>
                      <tr>
                        <th><strong>Caisse de retraite complémentaire non cadre</strong></th>
                        <td><input type="text" name="newrtrt" ></td>
                      </tr>
                      <tr>
                        <th><strong>Affiliation</strong></th>
                        <td> <select name="newAff" >
                                <option value="">Pas de changement</option>
                                <option value="Chambre de commerce">Chambre de commerce</option>
                                <option value="Chambre d'agriculture">Chambre d'agriculture</option>
                                <option value="Chambre des métiers">Chambre des métiers</option>
                                <option value="Transports">Transports</option>
                                <option value="Secteur public">Secteur public</option>
                                <option value="Autre">Autre</option>
                              </select> </td>
                      </tr>
                      <tr>
                        <th><strong>Site internet</strong></th>
                        <td><input type="text" name="newweb" ></td>
                      </tr>
                      <tr>
                        <th><strong></strong></th>
                        <td><input type="submit" name="editvalid" value="Mettre à jour" class="sendMail" /></td>
                      </tr>                             
                    </tbody>
                  </table>
                </form>
              </div>
        </div>
        </div>
    </div>
  </div>


</body>
</html> 