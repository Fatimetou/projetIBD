<!DOCTYPE html>
<html>
  <head lang="fr">
  <meta charset="utf-8">
    <title> mon cinquième formulaire</title>
  </head>

 <body>

	<form method="get" action="calc.php">
	  <input name="a" size="5" 
<?php 
if (isset($_GET["a"])){
$a=$_GET["a"];
echo "value=\"$a\"";
}
?>  
/>
	  <select name="op">
             <option value="+"
<?php 
if (isset($_GET["op"]) && $_GET["op"]=="+"){
echo "selected";

}
?>>+<option>

             <option value="-"
<?php 
if (isset($_GET["op"]) && $_GET["op"]=="-"){
echo "selected";

}
?>>-<option>
             <option value="*"
<?php 
if (isset($_GET["op"]) && $_GET["op"]=="*"){
echo "selected";
}
?>>*<option>
             <option value="/"
<?php 
if (isset($_GET["op"]) && $_GET["op"]=="/"){
echo "selected";
}
?>>/<option>
	  </select>
	  <input name="b" size="5" 
<?php 
if (isset($_GET["b"])){
$a=$_GET["b"];
echo "value=\"$b\"";
}
?> 
/> <br/>
	  <input type="submit" value="Envoyer">

	</form>
<hr/><br/>
<form method="get" action="calc.php">
	  <input name="a" size="5" />
         
          <input type="radio" name="op" value="+" /> +
	  <input type="radio" name="op" value="-" /> -
	  <input type="radio" name="op" value="*" /> *
	  <input type="radio" name="op" value="/" /> /

	  <input name="b" size="5"/> <br/>
	  <input type="submit" value="Envoyer" />
</form>
<hr>
<?php 
if(isset($_GET["op"]) && isset($_GET["a"]) && isset($_GET["b"])){
         $a=$_GET["a"]; 
         $b=$_GET["b"];
         $op=$_GET["op"];

   switch($_GET["op"]) {
       case "+":
           $res = $a + $b;
           break;
       case "-":
           $res = $a- $b;
           break;
       case "*":
           $res = $a * $b;
	   break;
       case "/":
           $res = $a / $b;
}
 echo "le calcul demandé est : $a $op $b = $res"; 
}
?>

 </body>
</html>

