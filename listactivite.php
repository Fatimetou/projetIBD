<?php
require_once 'connexion.php';

if(array_key_exists('nomactivite', $_POST)){
$nomactivite  = $_POST['nomactivite'];
$typeactivite = $_POST['typeactivite'];
$adresse      = $_POST['adresse'];
$margeprix    = $_POST['margeprix'];
$insertquery  = "INSERT INTO ACTIVITES (nomactivite,typeactiviteid,adresse,margeprix) VALUES ('".$nomactivite."','".$typeactivite."','".$adresse."','".$margeprix."')";
$result = mysql_query($insertquery) or die ('erreur sql'.$insertquery.'</br>'.mysql_error());
}

?>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html;  charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/lib/ionicons.css">
  <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/inscrire.css">

  <!-- nos librairies javascript -->
  <script src="js/jq/jquery-1.9.1.js"     ></script>


</head>
<body style="background: #fcf9f9">

<div class="container">
  <div class="row">
     <div class="col-md-6"><h2>Liste des activités</h2></div>

 </div>

  <div class="row">
  <form method="post" action="listactivite.php">
     
      <div class="col-md-4">
     <button class="btn bt-box-tool">       
      <a href="listactivite.php">Actualiser</a>
     </button>
     </div>  	
     <div class="col-md-6">
     <input type="text" class="form-control" name="searchname" placeholder="Saisir une recherche"></div>
     <div class="col-md-2">
     <button class="btn bt-box-tool" name="searchBtn">      
      Rechercher
     </button>

     </div>
    
  </form>
 </div>
   
      </br>       
      </br>       
      </br> 
  <table class="table">
    <thead>
      <tr>
        <th>Activite</th>
        <th>Type Activité</th>
        <th>Adresse</th>
        <th>Prix €</th>
        <th></th>
        <th></th>
      
      </tr>
    </thead>
    <tbody>
      <tr>        
      <?php
       $messagesParPage=5;
       $nbrequery ="SELECT COUNT(*) AS total FROM activites  ";
       $retour_total=mysql_query($nbrequery) or die ('erreur sql '.$nbrequery.'</br>'.mysql_error());
       $donnees_total = mysql_fetch_array($retour_total);
       $total = $donnees_total['total'];
       $nombreDePages=ceil($total/$messagesParPage);

       if(isset($_GET['page'])) {
               $pageActuelle=intval($_GET['page']);
           
               if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
               {
                    $pageActuelle=$nombreDePages;
               }
          }
          else // Sinon
          {
               $pageActuelle=1; // La page actuelle est la n°1    
          }

        $premiereEntree=($pageActuelle-1)*$messagesParPage;
        if(isset($_GET['search'])) {          
        $search = $_GET['search'];
        }else{
        $search ="";  
        }
          echo'<script>echo'. $search.'</script>';
        $req = "SELECT a.* FROM activites a WHERE  (a.nomactivite like '%".$search."%' ) ORDER BY a.nomactivite ASC LIMIT ".$premiereEntree.",".$messagesParPage; 

         $execute = mysql_query($req) or die ('erreur sql'.$req.'</br>'.mysql_error());
         while ($ligne = mysql_fetch_array($execute)) {
            if($ligne[0]){

               $reqname = "SELECT nomactivite FROM typeactivite where id =".$ligne[2];
               $exe = mysql_query($reqname) or die ('erreur sql'.$reqname.'</br>'.mysql_error());
               $item = mysql_fetch_array($exe);
           // echo'<form metod="post" action="element.php">';
            echo'<tr>';
            echo'<th>'.$ligne[1].'</th>';
            echo'<th>'.$item[0].'</th>';
            echo'<th>'.$ligne[3].'</th>';
            echo'<th>'.$ligne[4].'</th>';
            echo'<th><button name="detail"val class="btn btn-box-tool" title="Détail"><a href="element.php?id='.$ligne[0].'&oper=0">Detail</a></button></th>';
            echo'<th><button name="modif" class="btn btn-box-tool" title="Modifier" ><a href="element.php?id='.$ligne[0].'&oper=1">Modifier</a></button></th>';
       
            echo'</tr>';
              
           // echo'</form>';      
          }
        }
      ?>
      
      </tbody>
  </table>
  <?php
  echo '<p align="center">Page : '; 

  for($i=1; $i<=$nombreDePages; $i++) {
    echo $i;
       //On va faire notre condition
       if($i==$pageActuelle) {
           echo ' [ '.$i.' ] '; 
       }  
       else //Sinon...
       {
            echo '<a href="listactivite.php?page='.$i.'">'.$i.'</a>';
       }
  }
  echo '</p>';

  if(isset($_POST["searchBtn"])){
     $search = $_POST['searchname'];
    echo '<script>window.location.href="listactivite.php?search='.$search.'"</script>';
  }
  
  if(isset($_POST["updateAct"])){
  
    $id           = $_POST['idUpdate'];
    $nomactivite  = $_POST['nomacti'];
    $typeactivite = $_POST['typeacti'];
    $adresse      = $_POST['adres'];
    $margeprix    = $_POST['marge'];
    $query ="UPDATE `activites` SET `nomactivite`='".$nomactivite."', `typeactiviteid`='".$typeactivite."', `adresse`='".$adresse."', `margeprix`='".$margeprix."' WHERE `id`=".$id;

    $result = mysql_query($query) or die ('erreur sql'.$query.'</br>'.mysql_error());
    echo '<script>window.location.href="listactivite.php"</script>';
  }

  if(isset($_POST["delAct"])){
  
    $id = $_POST['idUpdate'];
  
    $query ="DELETE FROM `activites` WHERE id= ".$id;

    $result = mysql_query($query) or die ('erreur sql'.$query.'</br>'.mysql_error());
    echo '<script>window.location.href="listactivite.php"</script>';
  }


  ?>



  <a href="./index.php">Nouvelle activité</a>
</div>
</body>