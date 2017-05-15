<?php
require_once 'connexion.php';

?>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html;  charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/lib/ionicons.css">
  <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/inscrire.css">
  <link rel="stylesheet" type="text/css" href="stile.css">

  <!-- nos librairies javascript -->
  <script src="js/jq/jquery-1.9.1.js"     ></script>


</head>
<body style="background: #fcf9f9">

<div class="container">
  <div class="row">
    <h1 style="text-align:center">Cherchez-vous une activité ?</h1>  
    <br/> 
    <button class="btn bt-box-tool">        
      <a href="clientactivite.php">Actualiser</a>
    </button> 
      
   </div><div style="text-align:center">
 <h4>Bienvenue sur notre site! Vous êtes étudiants, nouveaux dans une ville et vous ne savez pas comment occupez vos journées ? Vous êtes tombés sur la bonne page.Il vous suffit de juste taper un code postal ou une activité dans la barre de recherche ci-dessous. Notre site vous proposera une liste de choses à faire! Les weekends à rien faire, c'est fini! </h4>
 </div>
  
<br/>
<br/>

  <div class="row">
  <form method="post" action="clientactivite.php">
     
     <div class="col-md-4">
      <div class="form-group">
                    
            <select  class="form-control"  name="typeA" >
            <option  selected value="" disabled="" >Selectionner un type d'activité</option>
           <?php
            require_once 'connexion.php';
          $req = "SELECT t.* FROM typeactivite t";
          $execute = mysql_query($req) or die ('erreur sql'.$req.'</br>'.mysql_error());
            while ($ligne = mysql_fetch_array($execute)) {
              if($ligne[0]){
                 echo '<option value ='.$ligne[0].'>'.$ligne[1].'</option>'; }
            }
          ?>
              
            </select>
                    </div>
     </div>	
     <div class="col-md-6">
     <input type="text" class="form-control" name="searchnameCl" placeholder="Faite une recherche par activité ou adresse "></div>
     <div class="col-md-2">
     <button class="btn bt-box-tool" name="searchBtnClient">      
      Rechercher
     </button>

     </div>
    
  </form>
 </div>
   
      </br>       
      </br>       
      </br> 
          
      <?php

        if(isset($_POST["searchBtnClient"])){
         $search = $_POST['searchnameCl'];
         if(array_key_exists('typeA', $_POST)){
         $typeA  = $_POST['typeA'];
         }else{
              $typeA  = "";
         }
         echo '<script>window.location.href="clientactivite.php?search='.$search.'&tac='.$typeA.'"</script>';
      }
  
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
        if(isset($_GET['tac'])) { 
          
         $type   = $_GET['tac'];
        }
          else{$type  = "";
        }

        if(isset($_GET['search'])) {     
        echo'<table class="table">';
        echo'<thead>';
        echo' <tr>';
        echo'<th>Activite</th>';
        echo'<th>Type Activité</th>';
        echo'<th>Adresse</th>';
        echo'<th>Prix €</th>';
        echo'<th></th>';
        echo'<th></th> ';     
        echo'</tr>';
        echo'</thead>';
        echo'<tbody>';
        echo' <tr>';     
        $search = $_GET['search'];
        $typeA  = $_GET['tac'];

          $req = "SELECT a.* FROM activites a WHERE  ((a.nomactivite like '%".$search."%' or a.adresse like '%".$search."%' or a.margeprix like '%".$search."%') and a.typeactiviteid like '%".$typeA."%' ) ORDER BY a.nomactivite ASC LIMIT ".$premiereEntree.",".$messagesParPage; 

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
            echo'</tr>';
              
           // echo'</form>';      
          }
        }
             echo'</tbody>';
  echo'</table>';
   echo '<p align="center">Page : '; 

  for($i=1; $i<=$nombreDePages; $i++) {
    echo $i;
       //On va faire notre condition
       if($i==$pageActuelle) {
           echo ' [ '.$i.' ] '; 
       }  
       else //Sinon...
       {
            echo '<a href="clientactivite.php?page='.$i.'">'.$i.'</a>';
       }
  }
  echo '</p>';
        }else{
        $search ="";  
        }
         
      ?>


</div>
</body>