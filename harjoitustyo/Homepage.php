<?php session_start();
if(!isset($_SESSION["kirjautuminen"])){
	header('Location: Login.php?takaisin');
} 
require_once("db.inc");  ?>


<?php 

$kayttajatunnus = array();
$kayttajatunnus =$_SESSION["kayttajatiedot"]["kayttajatunnus"];




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	
</body>
</html>