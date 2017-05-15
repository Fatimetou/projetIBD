
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html;  charset=UTF-8"/>
  <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/lib/ionicons.css">
  <link rel="stylesheet" type="text/css" href="css/lib/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="css/inscrire.css">
    <link rel="stylesheet" type="text/css" href="back.css">

  <!-- nos librairies javascript -->
  <script src="jq/jquery-1.9.1.js"     ></script>


</head>
<body style="background: #fcf9f9">


 <form method="POST" action="listactivite.php">
  <div class="container-fluid">

     
              <h3 style="text-align:center">Ajout d'activité</h3>
          


    <div class="ins-shell-main">        

      <div class="ins-shell-main-cont">
       
       <div class="ins-shell-main-cont-form">
          <br/>
            <br/>
              <br/>
                <br/>
                 <br/>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="p-title">
                  
                  <span style="color:#ad3030" class="texte">Informations </span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label>Activité</label>
                      <input type="text" class="form-control" name="nomactivite" required="">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label>Adresse</label>
                    <input type="text" class="form-control" name="adresse" required="">
                  </div>
                  </div>
                </div>
                <div class="row">
              
                  <div class="col-md-6">
                    <div class="form-group">
                     <label>Type d'activité</label>
                        <select  class="form-control"  name="typeactivite" required="">
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
                    <div class="form-group">
                    <label>Prix €</label>
                    <input type="number" class="form-control" name="margeprix">
                  </div>
                  </div>
                </div>
               
                <div class="row">
                  <div class="col-md-6">
                  <input type="submit"  class="btn btn-success" style="background-color:#ad3030" value="Valider" name="saveAct"/>
                  <!-- <button type="button" class="btn btn-primary btn-lg">Creer un compte</button> -->
                  </div>
                </div>

              </div>
            </div>

            
        </div>
      </div>
    </div>
    </div>
 </form>
 
</body>
</html>
