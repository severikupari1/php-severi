<!--37. Tee PHP:llä ”köyhän miehen” verkkokauppasovellus. Sovellus käyttää hyväksi keksejä ja sessiota asiakkaan ostosten ylläpitämiseen. Verkkokaupassa myydään esimerkiksi kirjoja, joilla jokaisella on yksilöllinen id (tai joku muu vastaava tapa yksilöidä tilattu tuote, se voi olla myös vaikka kirjan nimi). Sovellus jakaantuu seuraavasti erilaisiin näyttöihin: 

Login.php-näytöllä loggaudutaan sovellukseen
Kirjaudu-napin alla kutsutaan checkLogin.php-sivua, joka tarkistaa tunnukset (kovakoodaa jotkut tunnukset)
Login-näytöllä annetaan myös nimi ja luottokortin numero tilausta varten (talleta nämä sessioon)
Onnistuneen loggautumisen jälkeen avataan päänäyttö (käytä header-funktiota siirtymiseen uudelle sivulle)

Kirjautuneen käyttäjän tiedot talletetaan keksiin
Jokaisella sivulla tarkistetaan, onko käyttäjä kirjautunut ja jos ei ole, avataan login-näyttö (ts. löytyykö keksistä käyttäjän tietoja)
Jos kirjautuminen EI onnistu, näytetään käyttäjälle login.php-sivu (voi virittää tätä vielä niin, että tällöin sivulla kerrotaan, miksi kirjautuminen epäonnistui)-->


<!-- Kutsu checklogin sivulle!, tarkistettava tunnukset , Kovakoodatut tunnukset.   -->


<!DOCTYPE html>
<?php
//print_r($_GET);
  if(isset($_GET["loginvirhe"]))
  {
    echo "<p>Virhe kayttajatunnuksessa tai salasanassa<p>";
  }
  if(isset($_GET["hyvayritys"]))
  {
    echo "Ei onnistu ilman kirjautumista!";
  }

    if(isset($_GET["logout"])){
        echo "Ulos kirjautuminen onnistui";
    }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sisäänkirjautuminen</title>
</head>
<body>
    <form action="Checklogin.php">
      Käyttäjätunnus <input type="text" name="kayttajatunnus"><br>
      Salasana <input type="text" name="salasana"><br>
      Nimi : <input type="text" name="nimi"> <br>
      Luottokortin numero : <input type="text" name="luottokortti"><br>
      <input type="submit" value="Kirjaudu sisään" name="kirjautuminen">  
      
    </form>
    
    
</body>
</html>