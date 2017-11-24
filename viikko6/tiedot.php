<!--36. Muokkaa edellisiä tehtäviä niin, että käyttäjä voi syöttää kaupunkin, lämpötilan ja kosteusprosentin. Käyttäjä voi siis myös poistaa ja tulostaa em. tiedot (ja täytyy tarkistaa, että kaupunkia EI ole vielä syötetty).
Tästä tehtävästä 36 saa triplapisteet  (eli jos teet kaikki tehtävät -> 6 merkintää)-->

 
<!--AINA cookiet tänne ylös!!-->
<?php 
   
    
    if(isset($_GET["kaupunkionjo"]))
    {
        $tuloste = $_GET["kaupunkionjo"];
        echo "Kaupungille {$tuloste} on jo asetettu lampotila";
    }
    
    if(isset($_GET["poistook"])){
        echo "kaupungin poisto onnistui";
    }
    if(isset($_GET["poistoepaonnistui"]))
    {
        echo "Kaupunkia ei loytynyt ja poisto epaonnistui";
    }

?>
<!doctype html>

<html>
	<head>
		<title>Tehtava 33</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
           <form action="toiminnot.php" method="get">
               Kaupunki : <input type="text" name="kaupunki">
               <br>
               Lämpötila : <input type="text" name="lampotila">
                   <br>
                Kosteusprosentti : <input type="text" name="kosteusprosentti">
                <br>
               <input type="submit" value="Talleta" name="lisaa">
              <input type="submit" value="poista" name="poista">
           </form>
            
            <a href="toiminnot.php?tulosta">Tulosta</a>
            
	</body>
</html>