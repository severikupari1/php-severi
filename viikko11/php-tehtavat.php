<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Kanta tehtavia</title>
  <link rel="stylesheet" href="php-tehtavat.css">
  <script src="https://use.fontawesome.com/6f6c5a223e.js"></script>
</head>
<body>
 
 <?php
  require_once("db1.inc");
    
   // print_r($_SESSION);
    
    function Islike($muuttuja){
    $muuttuja = str_split($muuttuja);
    if(in_array("*",$muuttuja))
    {
      array_pop($muuttuja);
      $x = implode($muuttuja);
      return " LIKE '$x%'";
    }
    else
    {  
      $x = implode($muuttuja);
      return " = '$x'"; 
    } 
  }
    
    
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
    function tulosta($title, $data)
	{
		echo "<p>$title:$data</p>";
	} 
  
  // $aika_unix = time();
	//tulosta("Unix_aika", $aika_unix);
	
//	$mk_time = mktime(22, 5, 00, 4, 15, 2013);
//	tulosta("mk_time", $mk_time);
    
    

    
    
    
    
    
    $asty = mysqli_real_escape_string($conn, Tarkaste("tyyppi"));
    
    
   // print_r($_GET);
 
  $nimi = mysqli_real_escape_string($conn, Tarkaste("nimi"));
$osoite = mysqli_real_escape_string($conn, Tarkaste("osoite"));
$postinumero= mysqli_real_escape_string($conn, Tarkaste("postinumero"));
    
$hae =   mysqli_real_escape_string($conn, Tarkaste("hae"));
    
 $poista = mysqli_real_escape_string($conn, Tarkaste("poista"));
  $lisaa = mysqli_real_escape_string($conn, Tarkaste("lisaa"));
    $lisaakantaan = mysqli_real_escape_string($conn, Tarkaste("lisaakantaan"));
    $postitoimipaikka = mysqli_real_escape_string($conn, Tarkaste("postitoimipaikka"));
    $lisaaasiakastyyppi = mysqli_real_escape_string($conn, Tarkaste("asiakastyyppi"));
    $peruuta = mysqli_real_escape_string($conn, Tarkaste("peruuta"));
    $muutosavain = mysqli_real_escape_string($conn, Tarkaste("muutosavain"));
    
    $asiakastyyppi = mysqli_real_escape_string($conn, Tarkaste("tyyppi"));
    
     $muokkaus = mysqli_real_escape_string($conn, Tarkaste("muokkaus"));
  //poista
      $muutosasiakastyyppi = mysqli_real_escape_string($conn, Tarkaste("muutosasiakastyyppi"));
    
    
    
    $nimiMuokkaus = mysqli_real_escape_string($conn, Tarkaste("nimiMuokkaus"));
    $osoiteMuokkaus = mysqli_real_escape_string($conn, Tarkaste("osoiteMuokkaus"));
    $postinumeroMuokkaus= mysqli_real_escape_string($conn, Tarkaste("postinumeroMuokkaus"));
    $postitoimipaikkaMuokkaus= mysqli_real_escape_string($conn, Tarkaste("postitoimipaikkaMuokkaus"));
    
$Lisaysnimi = mysqli_real_escape_string($conn, Tarkaste("Lisaysnimi"));
$Lisaysosoite    = mysqli_real_escape_string($conn, Tarkaste("Lisaysosoite"));
$Lisayspostinumero  = mysqli_real_escape_string($conn, Tarkaste("Lisayspostinumero"));
$Lisayspostitoimipaikka = mysqli_real_escape_string($conn, Tarkaste("Lisayspostitoimipaikka"));
    
     $sessionimuuttuja= array();
    $_SESSION["asiakastiedot"]["asty"]= $asty;   
    $_SESSION["asiakastiedot"]["nimi"]= $nimi;
$_SESSION["asiakastiedot"]["osoite"]= $osoite;
$_SESSION["asiakastiedot"]["postinumero"]= $postinumero;
    $aktivointiaika = mysqli_real_escape_string($conn, Tarkaste("aktivointiaika"));
    $aktivointipaiva =mysqli_real_escape_string($conn, Tarkaste("aktivointipaiva"));

    
    $sessionimuuttuja = $_SESSION["asiakastiedot"];
    
    $nykyaika = time();
    $datenow = date("d-m-Y",$nykyaika);
    
    
 $kaksiviikkoa = time() + (14 * 24 * 60 * 60);
                   
    

    if($poista != "")    
    {
        $poistoquery = "DELETE FROM Asiakas WHERE Avain=$poista";     
        
        if (mysqli_query($conn, $poistoquery)) {
           
            } else {
          echo "Ei onnistunut " . mysqli_error($conn);
        }
        
        $query = $_SESSION["query"];
        
         $tulos = mysqli_query($conn, $query);
	   
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        }
		//käydään tavarat läi
        
        echo "<table>";
        echo "<tr><th>Nimi</th><th>Osoite</th><th>Postinumero</th><th></th><th>Asiakas selite</th><th></th></tr>";
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"];
			$nimituloste = $rivi["nimi"]; 
			$osoitetuloste = $rivi["osoite"];
            $postinumerotuloste = $rivi["postinro"];
            $asikasselite = $rivi["lyhenne"];     
 echo "<tr><td>$nimituloste</td><td>$osoitetuloste</td><td>$postinumerotuloste</td><td><a href=\"php-tehtavat.php?poista={$avain}\"><i class=\"fa fa-trash-o fa-2x testi\" aria-hidden=\"true\"></i></a></td><td>$asikasselite</td><td><a href=\"php-tehtavat.php?muutosavain={$avain}\">Muokkaa</a></td></tr>";
  
		} 
                echo "</table>";
	}
    
    


//oista if loppu
  
  if($hae != "" xor $muokkaus != "")
  {
    $query = "select a.avain,a.nimi,a.osoite,at.lyhenne,a.postinro,a.asty_avain,a.postitmp from asiakas as a inner join asiakastyyppi as at on a.ASTY_AVAIN = at.AVAIN where 1=1";
    //$query = "select asiakas.avain,nimi,osoite from asiakas INNER JOIN asiakastyyppi ON asiakas.ASTY_AVAIN = asiakastyyppi.SELITE WHERE 1=1 ";
     // print_r($_SESSION["query"]);
      
    if($nimi != "")
    {
        
      $query .= " AND nimi " . Islike($nimi) ."";
        
    }
    else{
        //$_SESSION["asiakastiedot"]["nimi"]= "";
    }
      
    
  if($osoite != "")
    {
        $query .= " AND osoite " . Islike($osoite) ."";
      
    }
    else{
       // $_SESSION["asiakastiedot"]["osoite"]= "";
    } 
      
     if($postinumero != "")
    {
        $query .= " AND postinro " . Islike($postinumero) ."";
         
         
    }
    else{
          //  $_SESSION["asiakastiedot"]["postinumero"]= "";
    }
     // $query .= "AND INNER JOIN asiakastyyppi ON asiakas.AVAIN = asiakastyyppi.AVAIN;";
    
      if($hae != ""){
          $_SESSION["query"] = $query;
      }
      else{
          
      }
     
      $tulos = mysqli_query($conn, $_SESSION["query"]);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        
		//käydään tavarat läpi 
        echo "<table>";
        echo "<tr><th>Nimi</th><th>Osoite</th><th>Postinumero</th><th></th><th>Asiakas selite</th><th></th></tr>";
		while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			$avain = $rivi["avain"];
			$nimituloste = $rivi["nimi"]; 
			$osoitetuloste = $rivi["osoite"];
            $postinumerotuloste = $rivi["postinro"];
            $asikasselite = $rivi["lyhenne"];     
 echo "<tr><td>$nimituloste</td><td>$osoitetuloste</td><td>$postinumerotuloste</td><td><a href=\"php-tehtavat.php?poista={$avain}\"><i class=\"fa fa-trash-o fa-2x testi\" aria-hidden=\"true\"></i></a></td><td>$asikasselite</td><td><a href=\"php-tehtavat.php?muutosavain={$avain}\">Muokkaa</a></td></tr>";
           
        }
			//tulostetaan taulukon rivi 
		}
              
	}
    
  ?>
      

  <h1>Haku</h1>
  <form action="php-tehtavat.php" method="get">
   <table>
   <tr><th>nimi</th>  <td><input type="text" name="nimi" value="<?php echo $sessionimuuttuja["nimi"]; ?>"></td> </tr>
   <tr><th>osoite</th> <td><input type="text"  name="osoite" value="<?php echo $sessionimuuttuja["osoite"]; ?>"></td> </tr>
   <tr><th>postinumero</th> <td><input type="text" name="postinumero" value="<?php echo $sessionimuuttuja["postinumero"]; ?>"></td> </tr>
   
    
    <tr><th>Asty</th> <td>
      
 <?php
        
 $haku = "SELECT avain, selite FROM asiakastyyppi";
 				$atyyppi = mysqli_query($conn, $haku);
 					if (!$atyyppi){
 						echo "virhe asiakastyypissä " . mysqli_error($conn);
 					}else{
 						echo "<select name = 'tyyppi' >";
						echo "<option value = ''  ".($asty==""?"selected":"").">empty</option>";
 						while ($rivi = mysqli_fetch_array($atyyppi, MYSQLI_ASSOC)){
 							$x = $rivi["avain"];
 							$y = $rivi["selite"];

 echo "
<option value='$x' ".($x==$asty?"selected ":" ").">$y</option>";
 						}
 						echo "</select>";
 					}
 ?>
</td></tr></table>

 <br>
 <input type="submit" class="haku"  value="Hae" name="hae"> 
 <input type="submit" value="Lisää" name="lisaa">
  </form>
  
  <?php
    
    
   if($lisaa != "")
    {
       //$insertquery = "INSERT INTO `asiakas` (`AVAIN`, `NIMI`, `OSOITE`, `POSTINRO`, `POSTITMP`, `LUONTIPVM`, `ASTY_AVAIN`,`aktivointiaika`,`aktivointipaiva`)";
       
   
       
       echo "<h1>Lisäys</h1>";
        echo '<form action="php-tehtavat.php" method="get">
   <table>
   <tr><th>nimi</th>  <td><input type="text" name="Lisaysnimi"></td> </tr>
   <tr><th>osoite</th> <td><input type="text"  name="Lisaysosoite"></td> </tr>
   <tr><th>postinumero</th> <td><input type="text" name="Lisayspostinumero"></td> </tr> 
   <tr><th>Postitoimipaikka</th><td><input type="text" name="Lisayspostitoimipaikka"></td></tr>
   
   <tr><th>Aktivointiaika</th><td><input type="text" name="aktivointiaika"></td></tr>
   <tr><th>Aktivointipäivä</th><td><input type="text" name="aktivointipaiva"></td></tr>
   <tr><th>Asiakastyyppi</th><td>
   <select name="asiakastyyppi">
    <option value="">Valitse</option>
      <option value="1" >Yritysasiakas</option>
      <option value="2" >Kuluttaja asiakas</option>
  </select>
   
   </td></tr>
   </table>
   ';
       echo '<input type="submit" value="Ok" name="lisaakantaan">';
       echo '<input type="submit" value="peruuta" name="peruuta">
       </form>';
       
       
       
       
    }
    if($lisaakantaan != "")
       {
        $unixaktivointi = strtotime($aktivointiaika);
        $luontiaika = date("H:i",$unixaktivointi);

     //   echo $aktivointipaiva;
        
        echo "   ";
       $muokattuluontipaiva= str_replace(".","-",$aktivointipaiva); 
       // echo $muokattuluontipaiva;
        echo "   ";
       // echo $aktivointipaiva;

        $testi =explode("-",$muokattuluontipaiva);
    
       // var_dump($testi);
        
        if($aktivointipaiva != ""){
            if(strlen($testi[2]) == 4){
            
                $unixluontipaiva = strtotime($muokattuluontipaiva);       
        $luontipaiva = date("Y-m-d",$unixluontipaiva);
            
        }
        else{
            echo "Annoit luontipaivamaaran vaarin!";
            $luontipaiva = "";
        }
        }
        else{
            $luontipaiva = "";
        }    
        
        
        
        
        
        

        
        //echo $luontipaiva;
        echo "   ";
    
   // echo $muokattuluontipaiva;
        
        
        
       $insertquery = "INSERT INTO `asiakas` ( `NIMI`, `OSOITE`, `POSTINRO`, `POSTITMP`, `LUONTIPVM`, `ASTY_AVAIN`,`LUONTIAIKA`,`LUONTIPAIVA`) VALUES
( '$Lisaysnimi', '$Lisaysosoite', '$Lisayspostinumero', '$Lisayspostitoimipaikka', '2011-12-01', $lisaaasiakastyyppi,'$aktivointiaika','$luontipaiva')";
        
        
        
       
       // echo $insertquery;
           if(mysqli_query($conn, $insertquery)){
               echo "<p>Lisäys onnistui</p>";
           }
           else 
           {
               echo "lisäys epaonnistui ";
           }
           
       }
    
    if($muutosavain != ""){
        
    // echo $_SESSION["query"];
        $_SESSION["muutosavain"] = $muutosavain;
        $query = $_SESSION["query"];
        $query .= " AND a.avain='$muutosavain'";
        //echo $query;
        
       // echo $_SESSION["query"];

        $tulos = mysqli_query($conn, $query);
	
	if ( !$tulos )
	{
		echo "Kysely epäonnistui " . mysqli_error($conn);
	}
	else
	{
        while ($rivi = mysqli_fetch_array($tulos, MYSQL_ASSOC)) { 
			//haetaan nimi, hinta ja määrä muuttujiin 
			
			$nimimuutos = $rivi["nimi"]; 
			$osoitemuutos = $rivi["osoite"];
            $postinumeromuutos = $rivi["postinro"];
            $postitoimipaikkamuutos = $rivi["postitmp"];
            $astyavain = $rivi["asty_avain"];
            $lyhennemuutos = $rivi["lyhenne"];            
        }
        //echo $astyavain;
        
       
		//käydään tavarat läpi 
        
        echo <<<EOT
        <h1>Muokkaus</h1>
        <form action="php-tehtavat.php" method="get">
<table>
    <tr>
        <th>nimi</th>
        <td><input type="text" name="nimiMuokkaus" value="$nimimuutos"></td>
    </tr>
    <tr>
        <th>osoite</th>
        <td><input type="text" name="osoiteMuokkaus" value="$osoitemuutos"></td>
    </tr>
    <tr>
        <th>postinumero</th>
        <td><input type="text" name="postinumeroMuokkaus" value="$postinumeromuutos"></td>
    </tr>
      <tr>
        <th>Postitoimipaikka</th>
        <td><input type="text" name="postitoimipaikkaMuokkaus" value="$postitoimipaikkamuutos"></td>
    </tr>      
EOT;
        
        
        echo '<tr>
<th>Asiakastyyppi</th>
<td><select name="muutosasiakastyyppi">
     <option value="1"';
        if($astyavain = 1)
        {
            echo 'selected';
        }
            
         echo '>Yritysasiakas</option>
     <option value="2"';
         if($astyavain = 2)
        {
             echo 'selected';
        }
            
        echo '>Kuluttaja asiakas</option>
 </select></td>
</tr>
 

    <tr>
    <td><input type="submit" value="Peruuta"></td>
    
    <td><input type="submit" name="muokkaus" value="Muokkaus"></td>
    
    </tr>


</table>

</form>';
        
		
			//tulostetaan taulukon rivi 
		}
    
    }
    
    if($muokkaus != "")
    {
        $muutosavain1 = $_SESSION["muutosavain"];
        
        
        $query = "UPDATE Asiakas SET Nimi = '$nimiMuokkaus', osoite='$osoiteMuokkaus', postinro='$postinumeroMuokkaus',postitmp='$postitoimipaikkaMuokkaus', asty_avain='$muutosasiakastyyppi' WHERE Avain=$muutosavain1";
        echo $query;
      if(mysqli_query($conn,$query)){
          echo "Muokkaus onnistui";
      }
        
    }
    ?>
    


</body>
</html>