<?php session_start(); require_once("db.inc"); 

function Tulostaja($tuloste){
    if(isset($_SESSION["asiakastiedot"])){
        $tulostearray = array();
       $tulostearray =  $_SESSION["asiakastiedot"];
        echo $tulostearray["$tuloste"];
    }
    
}

if(isset($_GET["lisaysonnistui"])){
    echo "<p>rekisteröinti onnistui!</p>";
}

if(isset($_GET["lisaysepaonnistui"])){
    echo "<p>lisays epäonnistui</p>";
}



//print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kirjautuminen</title>
</head>
<body>
    <?php 
    
    //`apartment_type`, `apartment_area`, `property`
    if(isset($_GET["takaisin"])){
        echo "Eipäs yritetä !";
    } 
    ?>

    <h1>Rekisteröinti</h1>
    <form action="Login-check.php" method="get"> <br>
    Käyttäjätunnus: <input type="text" name="kayttajatunnus" value="<?php Tulostaja("kayttajatunnus"); ?>">    <br>
    Salasana : <input type="text" name="salasana" value="<?php ?>"> <br>
    Salasana uudestaan : <input type="text" name="salasanauudelleen" value="<?php ?>"> <br>
    Nimi : <input type="text" name="nimi" value="<?php Tulostaja("nimi"); ?>"> <br>
    Käyntiosoite:    <input type="text" name="kayntiosoite" value="<?php Tulostaja("kayntiosoite"); ?>"> <br>
    Laskutusosoite:    <input type="text" name="laskutusosoite" value="<?php Tulostaja("laskutusosoite"); ?>"> <br>
    Puhelinnumero:    <input type="text" name="puhelinnumero" value="<?php Tulostaja("puhelinnumero"); ?>"> <br>
    Sähköposti:    <input type="text" name="email" value="<?php Tulostaja("email"); ?>"> <br>
    Asuntotyyppi: <input type="text" name="asuntotyyppi"  value="<?php Tulostaja("asuntotyyppi"); ?>">   <br>
       Asuntosi pinta-ala: <input type="text" name="asuntopintala"  value="<?php Tulostaja("asuntopintala"); ?>">  <br>
       Tonttisi pinta-ala <input type="text" name="tonttipintala"  value="<?php Tulostaja("tonttipintala");  ?>">  <br>
        <input type="submit" value="rekisteröi" name="rekisteroi" > <br>
    </form>
    <?php 
        if(isset($_GET["salasanaeitasmaa"])){
            echo "<p>Salasanat eivät täsmänneet! annappas ne uudelleen</p>";
        }
    if(isset($_GET["kenttatyhja"])){
        echo "<p>Et antanut kaikkia kenttiä!</p>";
    }
    if(isset($_GET["kayttajatunnusvarattu"])){
        echo "<p>käyttäjätunnus oli varattu!</p>";
    }
	
    ?>
    <h1>Sisäänkirjautuminen
    </h1>
    <form action="Login-check.php" method="get">
    Käyttäjätunnnus: <input type="text" name="kayttajatunnuscheck" > <br>
    Salasana : <input type="text" name="salasanacheck" ><br>
    <input type="submit" value="Kirjaudu sisään" name="login">
    </form>
    <?php if(isset($_GET["kirjautuminenfeilas"])){
        echo "<p>käyttäjätunnus tai salasana väärin!</p>";
    } ?>
    
</body>
</html>