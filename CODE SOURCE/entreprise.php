<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
  <head>
   <meta charset="UTF-8">
   <link rel="stylesheet" href="CSS/footer.css">
   <title>LoyaltyCard</title>
   <link rel="stylesheet" href="CSS/header.css">
   <link rel="stylesheet" href="CSS/entreprise.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://code.jquery.com/jquery-3.3.1.slim.min.js">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
  </head>
  <body>
    <?php include('Includes/header.php');?>
    <main>

            <?php  include('Includes/result.php');

              include('Includes/connexion.php');
              ?>

              <div class="recherche">
                  <input id="recherche" type="text" name="recherche" onkeyup="search()"  placeholder="Recherche entreprise">
              </div>
              <script src="./functions.js"></script>

              <form action='add_entreprise.php'>
               <input class='remove' type='submit' value='Ajouter une entreprise'>
              </form>
              <div class="ALL">

            <?php
              $qq = 'SELECT USER.name, CA, email, addresse,codepostale, country FROM `entreprise` INNER JOIN `USER` ON USER.name = ENTREPRISE.name WHERE status = :entreprise';
              $reqq = $db->prepare($qq);
              $reqq->execute([
                'entreprise' => 'Entreprise'
              ]);
               $resultsq = $reqq->fetchAll();

               foreach ($resultsq as $key => $valueq) {
                 echo ' <div class="contain">
                        <form action="utilisateurs.php" method="post">
                          <button type="submit">
                          <input type="hidden" name="entreprise" value="' . $valueq[0] . '">
                               <p>Nom : '. $valueq[0].'</p>
                               <p>CA : '. $valueq[1].'</p>
                               <p>Email : '. $valueq[2].'</p>
                               <p>Adresse : '. $valueq[3].'</p>
                               <p>Code postale'. $valueq[4].'</p>
                               <p>Ville : '. $valueq[5].'</p>
                            </button>
                          </form>
                            <form action="delete_entreprise.php?" method="post">
                                   <div class="bouton">
                                     <input type="hidden" name="entreprise" value="' . $valueq[0] . '">
                                     <input class="envoie" type="submit" value="Suppression de l\'entreprise">
                                   </div>
                            </form>
                          </div>';
                   }

                 ?>

          </div>

    </main>
  <?php include('Includes/footer.php'); ?>
  </body>
</html>
