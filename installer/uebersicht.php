<?php
session_start();


// Einspeichern der Datenbankeingaben


$datenbankbenutzer         = $_POST['datenbankbenutzer'];
$datenbankpasswort         = $_POST['datenbankpasswort'];
$datenbankname         = $_POST['datenbankname'];

$_SESSION['datenbankname']         = $datenbankname;


// Variableneinladung der benutzereingaben
$benutzer = $_SESSION['benutzer'];
$passwort = $_SESSION['passwort'];

?>



<!DOCTYPE html>
<html>
<head>
<title>Eingaben &Uuml;bersicht</title>
<meta name="description" content="installer index">
<meta name="keywords" content="installer">
<meta name="author" content="silentsands">

</head>
<body text="#000000" bgcolor="#F4F8F4" link="#FF0000" alink="#FF0000" vlink="#FF0000">
<font size="+4" face="VERDANA,ARIAL,HELVETICA"><p align="center">Installer</p></font>

<fieldset>
<legend>&Uuml;bersicht</legend>
<p align="left">Hier nun eine &Uuml;bersicht ihrer Eingaben:</p>
<p align="left">&Uuml;berpr&uuml;fen Sie bitte ihre Eingaben.</p><br>
<br>
Ihre Benutzereingaben:<br>
<br>

<?php
echo "Benutzername: ";

// Wenn der Benutzername leer ist Fehler meldung eintragen

if (!isset($benutzer) OR empty($benutzer)){
         echo "Kein Benutzer angegeben!";
         echo "<br>";
         echo "Bitte starten Sie die Installationsroutine neu!";

         ?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>

         <?php
         die ();
         }
         else
         {
         echo $benutzer;
         }
         ;
echo "<br>";
echo "Passwort: ";


// Bei leeren Benutzer Passworteingaben Fehlermeldung eintragen

if (!isset($passwort) OR empty($passwort)){
         echo "Kein Passwort angegeben!";
         echo "<br>";
         echo "Bitte starten Sie die Installationsroutine neu!";

         ?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>

         <?php
         die ();
         }
         else
         {
         echo $passwort;
         $length = strlen(utf8_decode($passwort));

         // Wenn das Passwort weniger als 10 Zeichen hat darauf hinweisen
                 if ($length < "10")
                 {
                 echo "<br>";
                 echo "<br>";
                 echo "WARNUNG: Ihr passwort hat weniger als 10 Zeichen!";
                 echo "<br>";
                 echo "Sie sollten ein l&auml;ngeres Passwort verwenden.";
                 }
         }
         ;

echo "<br>";
echo "<br>";

?>

Ihre Datenbankeingaben:<br><br>

<?php

// Wenn kein Datenbank Benutzer angegeben wurde darauf hinweisen und standart root voreintragen

if (!isset($datenbankbenutzer) OR empty($datenbankbenutzer))
{

echo "Kein Datenbank Benutzer vorgegeben! Wirklich leer? <br> Es wird als Datenbankbenutzer dann \"root\" eingetragen!";
$datenbankbenutzer = "root";

$_SESSION["datenbankbenutzer"] = "root";

}

echo "Datenbank Benutzer: " . $datenbankbenutzer;

$_SESSION["datenbankbenutzer"] = $datenbankbenutzer;

echo "<br>";
echo "<br>";

echo "Datenbank Passwort: " . $datenbankpasswort;

// Wenn kein Datenbankpasswort angeben wurde darauf hinweisen und vor gefahr warnen
if (!isset($datenbankpasswort) OR empty($datenbankpasswort))
{

echo "<br> Kein Datenbank Passwort vorgegeben! Wirklich leer?";

}

$_SESSION["datenbankpasswort"] = $datenbankpasswort;

echo "<br>";
echo "<br>";
echo "Datenbankname: ";

// Pruefen ob eine Datenbank angegeben wurde und nutzer ggf. zurueck zum start schicken

if (!isset($datenbankname ) OR empty($datenbankname )){
         echo "Keine Datenbank angegeben!";
         echo "<br>";
         echo "Bitte starten Sie die Installationsroutine neu!";

         ?>

         <h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>

         <?php
         die ();
         }
         else
         {
         echo $datenbankname ;
         }
         ;



echo "<br>";
echo "<br>";


?>
</fieldset>

<h4><a class="normallink" href="install_etub.php" name="installer" title="Abrechen">Fortfahren und Installieren</a></h4>
<h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>



</body>
</html>