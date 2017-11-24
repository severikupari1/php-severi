<?php
session_start();
   // print_r($_SESSION);
  if(isset($_COOKIE["okei"]))
     {
       echo "Kirjatuminen ok ";

     }
      else
      {
        header("Location:Login.php?hyvayritys");
      }

if(isset($_GET["vahvistus"]))
{
    header("Location:Mainpage.php?tilausvahvistettu");
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
    
    if(isset($_SESSION["data"]))
    {
        foreach($_SESSION["data"] as $key1 => $value1)
        {
            echo "<tr><th>Nimesi</th><th>Luottokortin numero</th></tr><tr><td>$key1</td><td>$value1</td></tr>";
        }
    }
    else 
    {
        echo "Tulit käymättä login pagessa";
        header("Location:Login.php?hyvayritys");
    }
    
    echo "</table>";
}
else
{
    echo "Et lisännyt yhtään tuotetta";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
</head>
<body>
    <form action="Checkout.php" method="get">
        <input type="submit" value="Vahvista" name="vahvistus">
    </form>
</body>
</html>