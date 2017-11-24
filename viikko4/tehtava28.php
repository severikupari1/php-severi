<!--28. Lisää edelliseen tehtävään toiminto, joka tulostaa (oikein syötettyjen tietojen jälkeen) sivun data_check.php alalaitaan linkin. Linkkiä klikkaamalla avautuu sivu (kiitos.php), jossa kiitetään käyttäjää sivuston käyttämisestä (lisää kiitosviestiin myös käyttäjän nimi, siis se, jonka käyttäjä syötti ekalla sivulla).-->
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
    

//    if($nimi == ""){
//         echo "Et antanut nimeä <br>";
//    }
//    else{
//        
//        echo "<table><tr><th>Nimesi on </th><td>                 {$nimi}</td></tr></table>";
//    }
//     
//
//    if($koulutus == ""){
//        echo "Et antanut koulutusta<br>";
//        } 
//        else{
//            echo "<table>";
//            foreach($koulutus as $x){
//                
//            echo "<tr><td>koulutuksesi on : {$x} </td></tr>";
//                
//        }
//            echo "</table>";
//            
//    }
    
    if($sukupuoli == ""){
        echo "Et antanut sukupuolta<br>";
        
    }
    if($koulutus == ""){
        echo "Et antanut koulutusta<br>";
    }
    if($nimi == ""){
        echo "Et antanut nimeä<br>";
    }
    
    if($sukupuoli != "" && $koulutus != "" && $nimi != "")
    {
        echo "<table><tr><td>Sukupuolesi on : {$sukupuoli}</td></tr>";
        
           foreach($koulutus as $x){
                
           echo "<tr><td>koulutuksesi on : {$x} </td></tr>";
             
    }
        echo "<tr><td>Nimesi on : {$nimi}</td></tr></table>";
        
    }
    if($sukupuoli != "" && $koulutus != "" && $nimi != ""){
        echo "<a href=\"kiitos.php?nimi={$nimi}\">Linkki</a>";
    }
    

   // print_r($_GET);
    
    
    
    
    
    
    


?>