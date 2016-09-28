<?php
session_start();


// Einspeichern der Benutzerangaben

$benutzer         = $_POST['user'];
$passwort         = $_POST['password'];
$passwort_        = $_POST['password_'];

$_SESSION["benutzer"]         = $benutzer;
$_SESSION["passwort"]         = $passwort;
$_SESSION["passwort_"]         = $passwort_;

?>

<!DOCTYPE html>
<html lang="de">
<head>
<title>Datenbank Einstellungen</title>
<meta name="description" content="installer index">
<meta name="keywords" content="installer">
<meta name="author" content="silentsands">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<body text="#000000" bgcolor="#F4F8F4" link="#FF0000" alink="#FF0000" vlink="#FF0000">



<?php


// Wenn kein Benutzer eingetragewn wurde Formeingabe wiederholen lassen

if (!isset($benutzer) OR empty($benutzer)){
         echo "Kein Benutzer angegeben!";
         echo "<br>";
         echo "Bitte starten Sie die Installationsroutine neu!";

         ?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>

         <?php
         die ();
         }

// Wenn kein Benutzer Passwort gesetzt wurde Scribt abbrechen und Form Vorgang wiederholen lassen

if (!isset($passwort) OR empty($passwort))
{

         echo "Bitte Passwortfelder ausf&uuml;llen!"

         ?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Zur&uuml;ck</a></h4>

         <?php
         die ();
}


// Wenn Passwoerter ungleich sind Scribt abbrechen und Formeingabe wiederholen lassen

if ($passwort != $passwort_){

echo "Passworteingaben stimmen nicht &uuml;berein!";
echo "<br>";
echo "Beide Passwortfelder m&uuml;ssen das gleiche Passwort haben!";
echo "<br>";
echo "Gro&szlig;- und Kleinschreibung m&uuml;ssen ebenfalls in beiden F&auml;llen gleich sein!";

?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Zur&uuml;ck</a></h4>

         <?php
         die ();

}

?>

<font size="+4" face="VERDANA,ARIAL,HELVETICA"><p align="center">Installer</p></font>


<form action="uebersicht.php" method="post">
<fieldset>
<legend>Datenbank Einstellungen:</legend>

<p align="left"><b>HINWEIS:</b> Wenn Sie das Feld &quot;Datenbank Benutzer&quot; leer lassen so wird als Datenbank benutzer &quot;root&quot; verwendet.</p>
<p align="left"><b>HINWEIS2:</b> In seltenen F&auml;llen kann sogar das &quot;Datenbank Passwort&quot; Feld leer gelassen werden. Nur dann jedoch wenn auch kein Passwort verlangt wird und keiner gesetzt wurde. ACHTUNG Jeder kann dann in dem Fall sich auf ihre Datenbank einloggen/anmelden und hat dar&uuml;ber volle kontrolle! Es sollte immer ein Passwort gesetzt sein!</p>

Datenbank Benutzer:<br>
<input type = "text" name="datenbankbenutzer" placeholder="Datenbank Benutzer"><br><br>
Datenbank Passwort:<br>
<input type = "text" name="datenbankpasswort" placeholder="Datenbank Passwort"><br><br>

Datenbankname:<br>
<input type = "text" name="datenbankname" placeholder="Datenbankname"><br><br>

<input type = "submit" value="Weiter">

<h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>
</fieldset>
</form>



</body>
</html>