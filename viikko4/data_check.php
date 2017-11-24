<!--27. Tee php-sivu (olkoon sivun nimi data.php), jolla käyttäjä syöttää sukupuolen (mies/nainen, radiobutton), koulutus (peruskoulu, lukio, ammattikoulu, ammattikorkeakoulu; checkbox) ja nimen. Kun käyttäjä painaa ”Talleta”-nappia, lähetetään tiedot data_check.php-sivulle, jossa tarkistetaan ensin tiedot: Jos nimi on tyhjä tai koulutusta ei ole valittu, tulostetaan sivulle tieto puutteista. Jos tiedot ovat oikein, tulostetaan ne sivulle HTML-taulukkoon.-->
<!--
function GetValue($param)
	{
		if ( isset($_GET[$param]) )
			return $_GET[$param];
		else 
			return "";
	}
-->

<?php
    
    function Tarkastus($parametri){
        if(isset($_GET[$parametri]) )
        {
            return $_GET[$parametri];
        }
        else {
           return "";
        }
    }

    
    
    $nimi = Tarkastus("nimi");
    $sukupuoli = Tarkastus("sukupuoli");
    $koulutus = Tarkastus("koulutus");
    echo "<table>";
    if($nimi != ""){
         echo "<table><tr><th>Nimesi on </th><td>{$nimi}</td></tr></table>";
    }
    else{
        echo "Et antanut nimeä <br>";
    }
     

    if($koulutus == ""){
        echo "Et antanut koulutusta<br>";
        } 
        else{
            echo "<table>";
            foreach($koulutus as $x){
                
            echo "<tr><td>koulutuksesi on : {$x} </td></tr>";
                
        }
            echo "</table>";
            
    }
    
    if($sukupuoli == ""){
        echo "Et antanut sukupuolta";
        
    }
    else{
        echo "<table><tr><td>Sukupuolesi on : {$sukupuoli}</td></tr></table>";
    }

    
    
    
    echo "<br>";

   // print_r($_GET);
    
    
    
    
    
    
    


?>