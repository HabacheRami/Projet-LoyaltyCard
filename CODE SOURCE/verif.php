<?php
include('Includes/connexion.php');


if (isset($_POST['supp'])) {
	if($_POST['type']=='partenaire'){
			$q = 'DELETE FROM `demande` WHERE name =:name';
			$req = $db->prepare($q);
			$resultat = $req->execute([
				'name' => $_POST['name']
			]);

			if($resultat){
				header('location:demande_admin.php?message=Demande supprimé !! &type=danger');
				exit;
			}
	}
	else //($_POST['type']=='entreprise'){
	{

		$to      = $_POST["email"];
		$subject = "Demande d'adhésion LoyaltyCard";
		$message = "Votre demande n'a pas été accepté";
		$headers = "Content-Type : text/plain; charset=utf-8\r\n";
		$headers .= "From: habache.rami@gmail.com\r\n";

		if(mail($to, $subject, $message, $headers)){
		  echo "good";
		}
		  else {
		    header('location:demande_admin.php?message=erreur envoie email !! &type=danger');
		  }

		$q = 'DELETE FROM `demande` WHERE name =:name';
		$req = $db->prepare($q);
		$resultat = $req->execute([
			'name' => $_POST['name']
		]);

		if($resultat){
			header('location:demande_admin.php?message=Demande supprimé !! &type=danger');
			exit;
		}

	}


}

	if (isset($_POST['val'])) {
		if($_POST['type']=='partenaire'){

			$q = 'DELETE FROM `demande` WHERE name =:name';
			$req = $db->prepare($q);
			$resultat = $req->execute([
				'name' => $_POST['name']
			]);

			$x = 'INSERT INTO `partenaire` (name) VALUES (:name)';
			$rex = $db->prepare($x);
			$reponsx = $rex->execute([
				'name' => $_POST['name']
			]);
			if($reponsx){
				header('location:demande_admin.php?message=Partenaire Ajouté !.&type=danger');
				exit;
			}
		}

		else //($_POST['type']=='entreprise'){
{
		$q = 'DELETE FROM `demande` WHERE name =:name';
		$req = $db->prepare($q);
		$resultat = $req->execute([
			'name' => $_POST['name']
		]);

		if(!$resultat){
			header('location:demande_admin.php?message=Erreur !&type=danger');
			exit;
		}


		$q = 'INSERT INTO `user` (name, password, phone, addresse, country, codepostale, email,status, entreprise) VALUES (:name,:password,:phone,:addresse,:country, :codepostale, :email, :status, :entreprise)';
		$req = $db->prepare($q);
		$reponse = $req->execute([
			'name' =>  $_POST['name'],
			'password' => $_POST['password'],
			'addresse' => 	$_POST['addresse'],
			'country' => $_POST['country'],
			'codepostale' => $_POST['codepostale'],
			'phone' => $_POST['phone'],
			'email' => $_POST['email'],
			'status'  => 'entreprise',
			'entreprise'  => $_POST['name']
		]);


		$x = 'INSERT INTO `entreprise` (name, CA) VALUES (:name,:CA)';
		$rex = $db->prepare($x);
		$reponsx = $rex->execute([
			'name' =>  $_POST['name'],
			'CA' =>  $_POST['CA']
		]);

		$to      = $_POST["email"];
		$subject = "Demande d'adhésion LoyaltyCard";
		$message = "Votre demande a été accepté";
		$headers = "Content-Type : text/plain; charset=utf-8\r\n";
		$headers .= "From: habache.rami@gmail.com\r\n";

		if(mail($to, $subject, $message, $headers)){
			echo "good";
		}
			else {
				header('location:demande_admin.php?message=erreur envoie email !! &type=danger');
			}


		$q = 'DELETE FROM `demande` WHERE name =:name';
		$req = $db->prepare($q);
		$resultat = $req->execute([
			'name' => $_POST['name']
		]);

		if($resultat){
			header('location:demande_admin.php?message=Validation success !&type=success');
			exit;
		}
	else{
			header('location:demande_admin.php?message=Erreur.&type=danger');
			exit;
		}
	}
}
