<!--27. Tee php-sivu (olkoon sivun nimi data.php), jolla käyttäjä syöttää sukupuolen (mies/nainen, radiobutton), koulutus (peruskoulu, lukio, ammattikoulu, ammattikorkeakoulu; checkbox) ja nimen. Kun käyttäjä painaa ”Talleta”-nappia, lähetetään tiedot data_check.php-sivulle, jossa tarkistetaan ensin tiedot: Jos nimi on tyhjä tai koulutusta ei ole valittu, tulostetaan sivulle tieto puutteista. Jos tiedot ovat oikein, tulostetaan ne sivulle HTML-taulukkoon.-->
<!doctype html>

<html>
	<head>
		<title>dataa :D</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head> 

	<body>
        <form action="tehtava28.php" method="get">
            Sukupuolesi <br>
            <input type="radio" name="sukupuoli" value="Mies">Mies
            <input type="radio" name="sukupuoli" value="Nainen">Nainen
            <br>
            Koulutuksesi: <br>
            <input type="checkbox" name="koulutus[]" value="peruskoulu">Peruskoulu<br>
            
            <input type="checkbox" name="koulutus[]" value="ammattikoulu">ammattikoulu<br>
            
            <input type="checkbox" name="koulutus[]" value="ammattikorkeakoulu">ammattikorkeakoulu<br>
            Nimesi <br>
            
            <input type="text" name="nimi"><br>
            
            <input type="submit" value="Talleta">
            

        </form>
        
	
    </body>
    
    
</html>