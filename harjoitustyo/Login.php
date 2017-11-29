<?php session_start(); require_once("db.inc"); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kirjautuminen</title>
</head>
<body>
    <?php 
    
    //`apartment_type`, `apartment_area`, `property`
    
    ?>
    
    <h1>Rekisteröinti</h1>
    <form action="Login-check.php" method="get"> <br>
    Käyttäjätunnus: <input type="text" name="kayttajatunnus" value="">    <br>
    Salasana : <input type="text" name="salasana" value=""> <br>
    Salasana uudestaan : <input type="text" name="salasanauudelleen" value=""> <br>
    Nimi : <input type="text" name="nimi" value=""> <br>
    Käyntiosoite:    <input type="text" name="kayntiosoite" value=""> <br>
    Laskutusosoite:    <input type="text" name="laskutusosoite" value=""> <br>
    Puhelinnumero:    <input type="text" name="puhelinnumero" value=""> <br>
    Sähköposti:    <input type="text" name="email" value=""> <br>
    Asuntotyyppi: <input type="text" name="asuntotyyppi" >   <br>
       Asuntosi pinta-ala: <input type="text" name="asuntopintala" >  <br>
       Tonttisi pinta-ala <input type="text" name="tonttipintala" >  <br>
        <input type="submit" value="rekisteröi" name="rekisteroi"> <br>
    </form>
    
    <h1>Sisäänkirjautuminen
    </h1>
    <form action="Login-check.php" method="get">
    Käyttäjätunnnus: <input type="text" name="kayttajatunnuscheck" > <br>
    Salasana : <input type="text" name="salasanacheck" ><br>
    <input type="submit" value="Kirjaudu sisään" name="login">
    </form>
    
</body>
</html>