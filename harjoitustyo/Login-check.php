<?php session_start();  
require_once("db.inc");
    

    
    function Tarkaste($muuttuja,$conn){
       
   if(isset($_GET[$muuttuja]))
     {
       
    $palautus= mysqli_real_escape_string($conn,$_GET[$muuttuja]);    
    }
    else
    {
           $palautus = "";
    }
    return $palautus;
}
        //ylempiform
        
        $kayttajatunnus = Tarkaste("kayttajatunnus",$conn);
        $salasana = Tarkaste("salasana",$conn);
        $salasanauudelleen = Tarkaste("salasanauudelleen",$conn);
        $nimi = Tarkaste("nimi",$conn);
        $kayntiosoite = Tarkaste("kayntiosoite",$conn);
        $laskutusosoite = Tarkaste("laskutusosoite",$conn);
        $puhelinnumero = Tarkaste("puhelinnumero",$conn);
        $email = Tarkaste("email",$conn);
        $rekisteroi = Tarkaste("rekisteroi",$conn);
        $salasanauudelleen = Tarkaste("salasanauudelleen",$conn);
        $asuntotyyppi= Tarkaste("asuntotyyppi",$conn);
        $asuntopintala   = Tarkaste("asuntopintala",$conn);
        $tonttipintala = Tarkaste("tonttipintala",$conn);

        //alempiform
        $kayttajatunnuscheck = Tarkaste("kayttajatunnuscheck",$conn);
        $salasanacheck = Tarkaste("salasanacheck",$conn);
        $login = Tarkaste("login",$conn);


//    if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != "")
    
//    if(strcmp($salasana,$salasanauudelleen) !== 0 ){
//            
//            
//            echo "Salasanat eivät täsmänneet";
//           // header('Location: Login.php?salasanaeitasmaa');  
//        }
//		else{
//			//inserttaa kantaan
//		}
    
//    $insertquery = "INSERT INTO `customer`(`username`, `password`, `name`, `address`, `billing_address`, `phone_number`, `email`, `apartment_type`, `apartment_area`, `property`) VALUES ('$kayttajatunnus','$salasana','$nimi','$kayntiosoite','$laskutusosoite','$puhelinnumero','$email','$asuntotyyppi','$asuntopintala','$tonttipintala')";
//    
    
    //   header('Location: Login.php?lisaysepaonnistui');
     
    // header('Location: Login.php?kenttatyhja');
    


if($rekisteroi != ""){
    // TOIMII!
        $_SESSION["asiakastiedot"]["kayttajatunnus"] = $kayttajatunnus;
        $_SESSION["asiakastiedot"]["nimi"] = $nimi;
        $_SESSION["asiakastiedot"]["kayntiosoite"] = $kayntiosoite;
        $_SESSION["asiakastiedot"]["laskutusosoite"] = $laskutusosoite;
        $_SESSION["asiakastiedot"]["puhelinnumero"] = $puhelinnumero;
        $_SESSION["asiakastiedot"]["email"] = $email;
        $_SESSION["asiakastiedot"]["asuntotyyppi"] = $asuntotyyppi;
        $_SESSION["asiakastiedot"]["asuntopintala"] = $asuntopintala;
        $_SESSION["asiakastiedot"]["tonttipintala"] = $tonttipintala;

        if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != ""){
            
        $checkquery = "SELECT `username` FROM `customer` WHERE `username` = '$kayttajatunnus'";
            $checkqueryisset = mysqli_query($conn,$checkquery);
            
            if(mysqli_num_rows($checkqueryisset)==0){
                //echo "onnistu";
                
                //jos query ei löytänyt yhtään eli kayttajatunnus on vapaa
				 if(strcmp($salasana,$salasanauudelleen) !== 0 ){
            

					//echo "Salasanat eivät täsmänneet";
				    header('Location: Login.php?salasanaeitasmaa');  
				}
				else{
					//inserttaa kantaan
					if($kayttajatunnus != "" && $salasana != "" && $nimi != "" && $kayntiosoite !="" &&  $laskutusosoite != "" && $puhelinnumero != "" && $email != "" && $asuntotyyppi != "" && $asuntopintala != "" && $tonttipintala != ""){
						$insertquery = "INSERT INTO `customer`(`username`, `password`, `name`, `address`, `billing_address`, `phone_number`, `email`, `apartment_type`, `apartment_area`, `property`) VALUES ('$kayttajatunnus','$salasana','$nimi','$kayntiosoite','$laskutusosoite','$puhelinnumero','$email','$asuntotyyppi','$asuntopintala','$tonttipintala')";
						
						if(mysqli_query($conn,$insertquery)){
							//echo "Onnistu lisäys";
							//lopuksi!
                header('Location: Login.php?lisaysonnistui');
						}
						else{
							//echo "feilas lisays";
							//header('Location: Login.php?lisaysepaonnistui');
						}
		
					}
					else{
						//jos ei annettu kaikkia kenttiä
					}
					
				}
				
                
            }
            else{
                //echo "Kayttajatunnus oli varattu";
				header('Location: Login.php?kayttajatunnusvarattu');
            }
            
            
            
        }
	
	
	
	
        else{
           // echo "et antanut kaikkia kenttiä";
			 header('Location: Login.php?kenttatyhja');
        }
    
    
    
    

}
else{//rekisteröi loppu
    //  header('Location: Login.php?takaisin');
}

if($login != ""){
	
	
	$loginquery = "SELECT `username`,`password` FROM `customer` WHERE `username` = '$kayttajatunnuscheck' AND `password` = '$salasanacheck'";
	$logincheck = mysqli_query($conn,$loginquery);
	//echo $loginquery;
	
	//echo mysqli_num_rows($logincheck);
	if(mysqli_num_rows($logincheck)==1){
		//echo "kirjautuminen onnistui!";
		$_SESSION["kirjautuminen"] = "ok";
		header('Location: Homepage.php');
	}
	else{
		//echo "käyttäjätunnus tai salasana väärin";		
			header('Location: Login.php?kirjautuminenfeilas');
	}
	
}


if($rekisteroi != "" or	$login != ""){
	
}
else{
	 header('Location: Login.php?takaisin');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tarkastele</title>
</head>
<body>
    
 <?php 
    
    
    ?>
</body>
</html>