<?php
session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$user =	$_SESSION["user"];
$clearance = $_SESSION["clearance"];

?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<?php

// Kontrolle der Berechtigung. Wenn zugangsberechtigung verweigert wird oder leer ist wird der Zugriff beendet per Hinweis.

if (!$clearance OR empty($clearance)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verd&auml;chtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zur&uuml;ck Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}

// Verbindung zur Datenbank herstellen
if (file_exists("admin/connect.php")) {
require_once ('admin/connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

//Blogeinstellungen einladen
$blogeinstellungen = mysqli_query($db_link, "SELECT blogtitel, eintragszahl FROM settings");
while($row = mysqli_fetch_object($blogeinstellungen))
{
$blogtitel = $row->blogtitel;
$eintragszahl = $row->eintragszahl;
}


echo "<h1>Einstellungen</h1>";



?>

<br><br>
<ul>
  <li><a id="linker" href="login.php?logout=1" name="Loout" title="Abmelden">Logout</a></li>
</ul>
<a id="linker" href="einstellungen.php" name="Loout" title="Einstellungen">Einstellungen</a>


<!--Formular für die Einstellungen-->

<form action="uebersicht.php" method="post">
<fieldset>
<legend>Datenbank Einstellungen:</legend>

Blog Titelname:<br>
<input type = "text" name="blogtitel" placeholder="Blog Tielname"><br><br>

Anzahl der anzuzeigenden Einträge:<br>
  <input type="radio" name="eintragszahl" value="10" > 10<br>
  <input type="radio" name="eintragszahl" value="15" > 15<br>
  <input type="radio" name="eintragszahl" value="20" checked> 20 (empfohlen)<br>
  <input type="radio" name="eintragszahl" value="30" > 30<br>
  <input type="radio" name="eintragszahl" value="50" > 50<br>

<input type = "submit" value="Weiter">

<h4><a class="normallink" href="index.php" name="installer" title="Abrechen">Abrechen</a></h4>
</fieldset>
</form>