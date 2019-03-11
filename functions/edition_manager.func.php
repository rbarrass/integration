<?php
/*Barrasset Raphaël, Castelain Julien, Ducroux Guillaume, Saint-Amand Matthieu	L3i 2019
raphael.barrasset@gmail.com, julom78@gmail.com, g.ducroux@outlook.fr, throwaraccoon@gmail.com*/

require('main.func.php');
require('connectDatabase.php');
/*

Supervisor feature

*/

//Display manual registration form
function editRegisteringForm(){
	echo '	     <div class="titleEdit">Créer un compte utilisateur</div>
                    <div>
                        <form class="formEdit" action="edition_manager.php" method="post">
                            <div>
                                <label for="targetname" class="labelEdit">Nom :</label>
                                <div>
                                    <input type="text" id="targetname" name="targetname" placeholder="Nom de famille de l\'utilisateur" required autofocus><!-- NAME -->
                                </div>
                            </div>

                            <div>
                                <label for="targetsurname" class="labelEdit">Prénom :</label>
                                <div>
                                    <input type="text" id="targetsurname" name="targetsurname" placeholder="Prénom de l\'utilisateur" required> <!-- Surname -->
                                </div>
                            </div>
                            <div>
                                <label for="targetemail" class="labelEdit">E-mail :</label>
                                <div>
                                    <input type="email" id="targetemail" name="targetemail" placeholder="Adresse email de l\'utilisateur ( Valide )" required> <!-- MAIL -->
                                </div>
                            </div>
                            <div>
                                <label for="targettype" class="labelEdit">Type d\'utilisateur</label>
                                <div>
                                	<select id="targettype" name="targettype">
									  <option value="student">Etudiant</option>
									  <option value="internshipsupervisor">Maître de stage</option>
									  <option value="tutor">Enseignant tuteur</option>
									  <option value="tutorVip">Enseignant tuteur responsable de formation</option>
									</select>
                                </div>
                            </div>
                            <div>
                                <button type="submit" name="validCreation">
                                    Créer
                                </button>
                            </div>
                    </div>
                    </form>';
  

}

//check/confirm/creat account 
function accountCreation(){
	if(isset($_POST['validCreation']) ){
		$dbconn = connectionDB();
		$errorR="";

		//name check
		//Size check
		if (strlen($_POST['targetname']) > 30){
			$errorR.='    <div class="row justify-content-center">
          	<div class="col-md-8">
              	<div class="card-body">
               		<div class="alert alert-danger" role="alert">
                    	<strong>Erreur</strong> : la taille du nom est limitée à 30 caractères.
               		</div>
              	</div>
          	</div>
    		</div>';
			return $errorR;
		}else{
			//Insure typing is accepted
			if (autorizedChar($_POST['targetname'], 0) == 1){
				//Format text
				$name = ucfirst(strtolower($_POST['targetname']));
			}else{
				$errorR.='    <div class="row justify-content-center">
			          <div class="col-md-8">
			              <div class="card-body">
			                  <div class="alert alert-danger" role="alert">
			                    <strong>Erreur</strong> : format nom incorrect : a-z àéèù- acceptés.
			                  </div>
			              </div>
			          </div>
			    </div>';
				return $errorR;
			}
		}

		//surname check
		//Size check
		if (strlen($_POST['targetsurname']) > 30){
			$errorR.='    <div class="row justify-content-center">
		          <div class="col-md-8">
		              <div class="card-body">
		                  <div class="alert alert-danger" role="alert">
		                    <strong>Erreur</strong> : la taille du prénom est limitée à 30 caractères.
		                  </div>
		              </div>
		          </div>
		    </div>';
			return $errorR;
		}else{
			//Insure typing is accepted
			if (autorizedChar($_POST['targetsurname'], 0) == 1){
				//Format text
				$surname = ucfirst(strtolower($_POST['targetsurname']));
			}else{
				$errorR.='    <div class="row justify-content-center">
			          <div class="col-md-8">
			              <div class="card-body">
			                  <div class="alert alert-danger" role="alert">
			                    <strong>Erreur</strong> : format prénom incorrect : a-z àéèù- acceptés..
			                  </div>
			              </div>
			          </div>
			    </div>';
				return $errorR;
			}	
		}

		//Email check
		//Size check
		if (strlen($_POST['targetemail']) > 60){
			$errorR.='    <div class="row justify-content-center">
		          <div class="col-md-8">
		              <div class="card-body">
		                  <div class="alert alert-danger" role="alert">
		                    <strong>Erreur</strong> : la taille du mail est limitée à 30 caractères.
		                  </div>
		              </div>
		          </div>
		    </div>';
			return $errorR;
		}//Pas fini, verif typing
		/*
		* we take all the emails that are in the database and we ckeck if the email that the client put in the form already exist in the database
		* With this, we check in witch db table to look (tutor or users)
		*/
		if (($_POST['targettype'] == "tutor") || ($_POST['targettype'] == "tutorVip")){
			$query = 'SELECT emailtut FROM tutors';
		}else{
			$query = 'SELECT emailU FROM users';
		}
		$result = pg_query($query) or die('Échec de la requête : ' . pg_last_error());
		$tab = array();
		$i=0;
		$j=0;
		$k=0;
		while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    		foreach ($line as $col_value) {
    			$tab[$i]=$col_value;
    			$i++;
    		}
 
		}
		//if the email existing in the database a popup alert the client the email exist
		while(($k==0) && ($j<$i)){
			if (strcmp($_POST['targetemail'], $tab[$j])==0) {
				$k=2;
				$errorR.='    <div class="row justify-content-center">
			          <div class="col-md-8">
			              <div class="card-body">
			                  <div class="alert alert-danger" role="alert">
			                    <strong>Erreur</strong> : Email déjà utilisé.
			                  </div>
			              </div>
			          </div>
			    </div>';
				return $errorR;
			}
			else {
				$j++;
			}
		}
 		

		//Creation of a randompassword 10 char long
		$pwd = bin2hex(openssl_random_pseudo_bytes(5));
		//Crypting it
      	$password_hash = crypt($pwd, 'rl');
		
		//request to create line in table.users or table.tutors(simple or vip)
		if ($_POST['targettype'] == "tutor"){
			$request = "INSERT INTO tutors VALUES(DEFAULT, '".$_POST['targetname']."', '".$_POST['targetsurname']."', '".$_POST['targetemail']."', '$password_hash', 'false')";

		}elseif ($_POST['targettype'] == "tutorVip") {
			$request = "INSERT INTO tutors VALUES(DEFAULT, '".$_POST['targetname']."', '".$_POST['targetsurname']."', '".$_POST['targetemail']."', '$password_hash', 'true')";
		
		}else{
		$request = "INSERT INTO users VALUES(DEFAULT, '', '".$_POST['targetname']."', '".$_POST['targetsurname']."', ' ', '".$_POST['targetemail']."', ' ', ' ', '$password_hash', ' ', '".$_POST['targettype']."', 'allowed')";
		}
		$resultat = pg_query($request) or die('ERREUR SQL : '. $request . 	pg_last_error());

		//We want to increment table.logs to save this action and keep an eye on registering requests
		if (pg_last_error() == NULL) {
			//Request to search id of account just created 
			if (($_POST['targettype'] == "tutor") || ($_POST['targettype'] == "tutorVip")){
				$requestUserId = "SELECT idtut FROM tutors WHERE emailtut='".$_POST['targetemail']."'";
				$resultUserId = pg_query($requestUserId) or die('ERREUR SQL : '. $requestUserId . 	pg_last_error());
				$tutorId = pg_fetch_result($resultUserId, 'idtut');

				//Add a line in table.Logs with : action made/date/client ip/type of request(insert/delete/update)/and object concerned.
				$request = "INSERT INTO logs VALUES(DEFAULT, 'manual supervisor registering', '".getTheDate()."', '".getIp()."', 'insert', null, null, '$tutorId', null, null, null, null, null)";
			}else{
				$requestUserId = "SELECT idU FROM users WHERE emailU='".$_POST['targetemail']."'";
				$resultUserId = pg_query($requestUserId) or die('ERREUR SQL : '. $requestUserId . 	pg_last_error());
				$userId = pg_fetch_result($resultUserId, 'idu');

				//Add a line in table.Logs with : action made/date/client ip/type of request(insert/delete/update)/and object concerned.
				$request = "INSERT INTO logs VALUES(DEFAULT, 'manual supervisor registering', '".getTheDate()."', '".getIp()."', 'insert', null, '$userId', null, null, null, null, null, null)";
			}

		
			$resultat = pg_query($request) or die('ERREUR SQL : '. $request . 	pg_last_error());
		}

		return $errorR;
	}
	//We don't use form, so no error can be spoted. This line inform it to manage manageError()
	return $error = 'nothing yet';
}

function manageError($error){
	if ($error == ''){
		echo '<div class="row justify-content-center">
		          <div class="col-md-8">
		              <div class="card-body">
		                  <div class="alert alert-primary" role="alert">
		                      Le compte a bien été crée. Un email de confirmation a été envoyé au destinataire.
		                  </div>
		              </div>
		          </div>
		    </div>';
	}else if ($error == 'nothing yet'){
			//We don't want do do anything
	}else {
		echo $error;
	}
}
?>