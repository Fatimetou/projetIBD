  
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html;  charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/lib/ionicons.css">
  <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/inscrire.css">

  <!-- nos librairies javascript -->
  <script src="jq/jquery-1.9.1.js"     ></script>


</head>
<body style="background: #fff">
  
<?php
require_once 'connexion.php';
if(!array_key_exists('id', $_GET)){
     echo '<script>window.location.href="listactivite.php"</script>';

}else{


$choix = $_GET["oper"];
$idAct = $_GET["id"];
$req = "SELECT a.* FROM activites a WHERE  id = ".$idAct; 

 $execute = mysql_query($req) or die ('erreur sql'.$req.'</br>'.mysql_error());

while ($ligne = mysql_fetch_array($execute)) {
  if($ligne[0]){
     $reqname = "SELECT nomactivite FROM typeactivite where id =".$ligne[2];
     $exe = mysql_query($reqname) or die ('erreur sql'.$reqname.'</br>'.mysql_error());
     $item = mysql_fetch_array($exe);

echo'<form method="post" action="listactivite.php">';   
echo'<input type="hidden" value="'.$ligne[0].'" name="idUpdate">';   

switch ($choix ) {
  case 0:
    echo'<div class="panel panel-default">';
    echo'<div class="panel-body">';
    echo'<div class="p-title">';
    echo'<h3 style="text-align:center">Détail d\'activité</h3>';
    echo'<h4 style="text-align:center"> <a href="listactivite.php">Retour à la liste des activités</a> </h4>';
    echo'</div>';
    echo'</div>';
    echo'</div>';    
    echo' <div class="ins-shell-main-cont">';       
    echo'<div class="ins-shell-main-cont-form">';
    echo'<div class="panel-body">';
    echo'<div class="row">';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Activité</label>';
    echo'<input type="text" class="form-control" disabled value="'.$ligne[1].'">';
    echo'</div>';
    echo'</div>';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Adresse</label>';
    echo'<input type="text" class="form-control" disabled value="'.$ligne[3].'">';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'<div class="row">';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Type d\'activité</label>';
    echo'<input type="text" class="form-control" disabled value="'.$item[0].'">';
    echo'</div>';

    echo'</div>';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Marge de prix</label>';
    echo'<input type="text" class="form-control" disabled value="'.$ligne[4].'">';
    echo'</div>';
    echo'</div>';

    echo'</div>';    
    echo'</div>';

    echo'<div class="pull-right">';
    echo' <div class="row">';
    echo'<div class="col-md-6">';
    echo' <div style="cursor:pointer" class="pull-right" >  ';   
    echo' <input class="btn btn-delete btn-block btn-signin" type="submit" value="Supprimer" name="delAct"/>';
    echo'</div>';

    echo' </div>';
    echo'  </div>';

    echo'</div>';
    break; 
 case 1:
     echo'<div class="panel panel-default">';
    echo'<div class="panel-body">';
    echo'<div class="p-title">';
    echo'<h3 style="text-align:center">Modification d\'activité</h3>';
    echo'<h4 style="text-align:center"> <a href="listactivite.php">Retour à la liste des activités</a> </h4>';
    echo'</div>';
    echo'</div>';
    echo'</div>';
   
    echo' <div class="ins-shell-main-cont">';       
    echo'<div class="ins-shell-main-cont-form">';
    echo'<div class="panel-body">';
    echo'<div class="row">';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Activité</label>';
    echo'<input type="text"  name ="nomacti" class="form-control" required value="'.$ligne[1].'">';
    echo'</div>';
    echo'</div>';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Adresse</label>';
    echo'<input type="text"  name ="adres" class="form-control" required value="'.$ligne[3].'">';
    echo'</div>';
    echo'</div>';
    echo'</div>';
    echo'<div class="row">';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Type d\'activité</label>';
    echo'<select  class="form-control"  name="typeacti" required="">';
    echo' <option  selected value="" disabled="" >Selectionner un type d\'activité</option>';
    $req = "SELECT t.* FROM typeactivite t";
      $execute = mysql_query($req) or die ('erreur sql'.$req.'</br>'.mysql_error());
        while ($lignes = mysql_fetch_array($execute)) {
          if($ligne[0]){
             echo '<option value ='.$lignes[0].'>'.$lignes[1].'</option>'; }
        }
    echo'</select>';
    echo'</div>';

    echo'</div>';
    echo'<div class="col-md-6">';
    echo'<div class="form-group">';
    echo'<label>Marge de prix</label>';
    echo'<input type="number" name="marge" class="form-control" required value="'.$ligne[4].'">';
    echo'</div>';
    echo'</div>';

    echo'</div>';    
    echo'</div>';
    echo'<div class="pull-right">';
    echo' <div class="row">';
    echo'<div class="col-md-6">';
    echo' <div style="cursor:pointer" class="pull-right" >  ';   
    echo' <input class="btn btn-update btn-block btn-signin" type="submit" value="Modifier" name="updateAct"/>';
    echo'</div>';

    echo' </div>';
    echo'  </div>';

    echo'</div>';

    break;
  
  default:
     echo '<script>window.location.href="listactivite.php"</script>';
    break;
  echo'</form>';       
  }
 }
}
}

?>
</body>