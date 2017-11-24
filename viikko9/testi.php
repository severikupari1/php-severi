<?php require_once("db.inc");

function Tarkaste($muuttuja){
       
   if(isset($_GET[$muuttuja]))
     {
       
    $x= $_GET[$muuttuja];    
    }
    else
    {
           $x = "";
    }
    return $x;
   
}

$lisattavaresepti =  Tarkaste("reseptinimi");
$query = "SELECT * FROM `ruoka` WHERE 1";

 $tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
		// Ao 2 riviä tulostetaan vain TESTI-mielessä!
		
		
		
		//käydään tavarat läpi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			 
			$ruoka_nimi = $rivi["ruoka_nimi"]; 
			
            
			//tulostetaan taulukon rivi 
			echo "<p>Resepti :$ruoka_nimi</p>";
		} 
	}
$query = "SELECT * FROM yhdistys INNER JOIN ainesosat on yhdistys.ainesosa_id = ainesosat.ainesosat_id where yhdistys.ruoka_id = '2' ";

 $tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
		// Ao 2 riviä tulostetaan vain TESTI-mielessä!
		
		
		
		//käydään tavarat läpi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$tuotteet = $rivi["Nimi"]; 
			
			
            $laskuri = $laskuri+1;
			//tulostetaan taulukon rivi 
			echo "<p>$laskuri, $tuotteet, </p>";
            
		} 
	}

    if ($lisattavaresepti != ""){
        $query2 = "INSERT INTO `ruoka`(`ruoka_nimi`) VALUES ('$lisattavaresepti')";
        mysqli_query($conn,$query2);
        
    }

    if ($haku != ""){
        $query = "SELECT * FROM `ruoka`";
         mysqli_query($conn,$query);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
    <form action="testi.php">
        Lisättävä resepti: <input type="text" name="reseptinimi"><br>
        
        <input type="submit" value="Lisää" name="lisaa">
        <input type="submit" value="Haku" name="haku">
    </form>
    
    
</body>
</html>