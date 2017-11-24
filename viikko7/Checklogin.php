<?php session_start();
  //print_r($_GET);
function Tarkaste($muuttuja){
   if(isset($_GET[$muuttuja]))
  {
    return $_GET[$muuttuja];    
  }
  else
  {
    return "";
  }  
}

$kayttajatunnus = Tarkaste("kayttajatunnus");
$salasana = Tarkaste("salasana");
$nimi = Tarkaste("nimi");
$luottokortti = Tarkaste("luottokortti");
  
  
  
  if($kayttajatunnus == "severi" && $salasana == "kupari" && $nimi != "" && $luottokortti != "")
  {
    $cookie_loginok = "okei";
    setcookie($cookie_loginok,time() + (86400 * 30));
    $_SESSION["data"] = array();
    
    $_SESSION["data"][$nimi] = $luottokortti;
    header("Location:Mainpage.php");
  }
  else
  {
    header("Location:Login.php?loginvirhe");
  }
  exit();
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