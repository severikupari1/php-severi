<!doctype html>
<!--25. Tee HTML-sivu, jolla käyttäjä syöttää kotikunnan (alasvetovalikko) ja postinumeron. Kun käyttäjä painaa ”Tarkista”-nappia, lähetetään tiedot php-sivulle, joka tarkistaa postinumeron oikeellisuuden (riittää tarkistaa että pituus on 5). Jos tiedot ovat oikein, tulostetaan syötetyt tiedot . Jos tiedot ovat väärin, kerrotaan tieto käyttäjälle  ja tulostetaan linkki takaisin HTML-sivulle, jolla annetaan kotikunta ja postinumero.-->

<html>
	<head>
		<title>Tehtava 25</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0">
	</head>

	<body>
        
        <form action="testi.php" method="get">
        Kotikuntasi : 
            <select name="kotikunta">
            <option value="kuopio">Kuopio</option>
                
            <option value="rovaniemi">Rovaniemi</option>
                
            <option value="kuopio">tampere</option>
            
            </select>
            <br> 
            Postinumerosi : <input type="text" name="postinumero">
            <br>
            <input type="submit" value="Tarkista">
            
        </form>
        
        
        
        
        <?php
        
            if(isset($_GET['virhe'])){
                echo "<p>Postinumerosi oli väärin, syötä tiedot uudelleen</p>";
            }
            
        ?>
        
        
	</body>
</html>