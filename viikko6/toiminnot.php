<!--36. Muokkaa edellisiä tehtäviä niin, että käyttäjä voi syöttää kaupunkin, lämpötilan ja kosteusprosentin. Käyttäjä voi siis myös poistaa ja tulostaa em. tiedot (ja täytyy tarkistaa, että kaupunkia EI ole vielä syötetty).
Tästä tehtävästä 36 saa triplapisteet  (eli jos teet kaikki tehtävät -> 6 merkintää) -->
<?php
session_start();

    
    
 
    if(isset($_GET["lisaa"]))
    { 
        if(isset($_GET["kaupunki"])){
             $kaupunki = $_GET["kaupunki"];
        }
       
        if(isset($_GET["lampotila"]))
        {
            $lampotila = $_GET["lampotila"];
        }
        
        if(isset($_GET["kosteusprosentti"]))
        {
            $kosteusprosentti = $_GET["kosteusprosentti"];
        }
        
        if(isset($kaupunki))
        {
    
            if(isset($_SESSION[$kaupunki]))
            {
                header("Location:tiedot.php?kaupunkionjo={$kaupunki}"); 
            }
            else
            {
                $lampojakosteus = array("{$lampotila}" => "$kosteusprosentti");
                $_SESSION["{$kaupunki}"] = $lampojakosteus;
                header("Location:tiedot.php?testi");
            }
            
        }
  
        exit();
    }

    if(isset($_GET["poista"]))
    {
        $kaupunki = $_GET["kaupunki"];
        if(isset($_SESSION["$kaupunki"]))
        {
            unset($_SESSION["$kaupunki"]);
            header("Location:tiedot?poistook");
        }
        else
        {
            header("Location:tiedot?poistoepaonnistui");
        }
    }

?>
<!doctype html>

<html>
	<head>
		<title>Page Title</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>

       <?php
        if(isset($_GET["tulosta"]))
        {
            
            echo "<table><tr><th>Kaupunki</th><th>Lämpötila</th><th>Kosteusprosentti</th></tr>";
            
            foreach($_SESSION as $key => $value)
            {
                echo "<tr><td>{$key}</td>";
                foreach($value as $key1 => $value1)
                {
                    echo "<td>{$key1}</td><td>{$value1}</td></tr>";
                    
                }
            }
            
            
            echo "</table>";
            
            
        }
        ?>
     <a href="tiedot.php">Takaisin täyttämään</a>
        
    
	</body>
</html>