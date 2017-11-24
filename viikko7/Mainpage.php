<?php session_start();
  //print_r($_SESSION);
  if(isset($_COOKIE["okei"]))
     {
        
     }
      else
      {
        header("Location:Login.php?hyvayritys");
      }
if(isset($_GET["logout"])){
    session_destroy();
    setcookie("okei",'',time() - (86400 * 30));
    header("Location:Login.php?logout");
}

$tilaus = Tarkaste("tilaus");
$kappalemaara = Tarkaste("kappalemaara");
$tilaa = Tarkaste("tilaa");
$poisto = Tarkaste("Poista"); 
$vahvistus = Tarkaste("vahvistus");

if($vahvistus != "")
{
    header("Location:Checkout.php");
}

if($poisto != "")
{
    unset($_SESSION["Tilaukset"][$poisto]);
}

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




  

    if($tilaa != "")
    {
        
        
        if($tilaus != "" && $kappalemaara != "")
        {
            
            $_SESSION["Tilaukset"][$tilaus] = $kappalemaara; 
        }
        
      //  $_SESSION["Tilaukset"][] = 
    }
  
if(isset($_SESSION["Tilaukset"]))
{
    echo "<table>";
    echo "<tr><th>Tuotteet</th><th>Kappalemaara</th></tr>";
    foreach($_SESSION["Tilaukset"] as $key => $value)
    {
        echo "<tr> <td>$key</td> <td>$value</td> 
        <td><a href=\"Mainpage.php?Poista=$key\">Poista</a>
        
        </td></tr> 
        ";
        
    }
    echo "</table>";
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>

      <form action="Mainpage.php">
        Tilaamasi tuote: <input type="text" name="tilaus">
        Kappale määrä : <input type="text" name ="kappalemaara">
        <input type="submit" value="Lisää" name="tilaa">
        <input type="submit" value="Ostoskoriin" name="vahvistus">
        <input type="submit" value="Kirjaudu Ulos" name="logout">
      </form>


</body>
</html>