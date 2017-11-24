<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Haetut asiakkaat</title>
</head>

<body>

<?php
	require_once("db.inc");
	
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
    
      
        
        
        $nimi    = Tarkaste("nimi");
        $osoite    = Tarkaste("osoite");
        $postinumero    = Tarkaste("postinumero");
        $haku    = Tarkaste("haku");
        print_r($_GET);
        $nimiarray = str_split($nimi);
        $osoitearray = str_split($osoite);
        $postinumeroarray = str_split($postinumero);
        
     if(in_array("*",$postinumeroarray)){
        //echo "löyty";
        // eli query LIKE eikä = 
        array_pop($postinumeroarray);
        $postinumerojokeri = implode($postinumeroarray); 
        $postinumerojokeri = "LIKE '$postinumerojokeri%'";  
    }
    
     if(in_array("*",$osoitearray)){
        //echo "löyty";
        // eli query LIKE eikä = 
        array_pop($osoitearray);
        $osoitejokeri = implode($osoitearray); 
        $osoitejokeri = "LIKE '$osoitejokeri%'";  
    }
    if(in_array("*",$nimiarray)){
        //echo "löyty";
        // eli query LIKE eikä = 
        array_pop($nimiarray);
        $nimijokeri = implode($nimiarray); 
        $nimijokeri = "LIKE '$nimijokeri%'";  
    }
 
    //Jos haku muuttuja on olemassa 
    
    if($haku != "")
    {
        
        if($nimi != "" && $osoite != "" && $postinumero != "")
        {
            
           
            
            
           
                $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where"; 
                    
                if(isset($nimijokeri)){
                    $query = "$query nimi $nimijokeri AND osoite='$osoite' AND postinro = '$postinumero'";
                
                 else{  
                $query = "$query nimi = '$nimi' AND osoite='$osoite' AND postinro = '$postinumero'";
            }
                    
            
            
                
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }  
            
        }
        elseif($nimi != "" && $osoite != "" && $postinumero == ""){
          
                $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where nimi = '$nimi' AND osoite='$osoite'";
            
            
            
            
            
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }  
        }
        elseif($nimi != "" && $osoite == "" && $postinumero != "")
        {
            
            
            $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where nimi = '$nimi' AND postinro='$postinumero'";
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }   
        }
        elseif($nimi == "" && $osoite != "" && $postinumero != "")
        {
          
                  $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where osoite='$osoite' AND postinro='$postinumero'";
 
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }   
        }
         elseif($nimi == "" && $osoite == "" && $postinumero != "")
        {
             
                  $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where postinro = '$postinumero'";
             
             
           
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }  
        }
        elseif($nimi == "" && $osoite != "" && $postinumero == "")
        {
           
            
  
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }  
        }
         elseif($nimi != "" && $osoite == "" && $postinumero == "")
        {
             
            
         
                 $query = "Select avain, nimi, osoite, postinro, postitmp, asty_avain from asiakas where nimi = '$nimi'";
             
             
            
            
            $suorite = mysqli_query($conn,$query);
            
            if(!$suorite){
                echo "epäonnistui";
            }
            else{
                while ($rivi = mysqli_fetch_array($suorite, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		}  
            }  
        }
        
        else{
        //Tulostellaan kaikki jos arvoja ei ole annettu
         $query = "Select avain, nimi, osoite, postinro from asiakas";
         
         // suoritetaan kysely
	$tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{

		//käydään tavarat läpi 
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"]; 
			$nimi = $rivi["nimi"]; 
			$osoite = $rivi["osoite"];
            $postinumero = $rivi["postinro"];
			//tulostetaan taulukon rivi 
			echo "<p>$avain, $nimi, $osoite,$postinumero</p>";
		  } 
	     }
            
            
       }
    } //ison iffin lopetus
    
    
	
	
	
?>

<form action="pohja-testi.php">
    nimi: <input type="text" name="nimi">
    osoite: <input type="text" name="osoite">
    postinumero: <input type="text" name="postinumero">
    <input type="submit" name="haku" value="hae">
    
</form>

</body>
</html>
