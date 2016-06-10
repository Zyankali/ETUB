<?php
session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$clearance = $_SESSION["clearance"];

// Kontrolle der Berechtigung. Wenn zugangsberechtigung verweigert wird oder leer ist wird der Zugriff beendet per Hinweis.

if (!$clearance OR empty($clearance)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verdächtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zurück Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}

// Überprüfen der zugangsberechtigung  des Nutzers.

if ($status > "1" OR !isset($status)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("<div style=\"text-align: left\;\">ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verdächtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zurück Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}



$delite = $_GET["delite"];

 if (!ctype_digit($delite)) {
	
			// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
 die("<div style=\"text-align: left\;\">Unzulässige eingabe!");
 
 }
 

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "DELETE FROM `kontent` WHERE `kontent`.`id` = $delite";


if (mysqli_query($db_link, $sql)) {
    echo "<div style=\"text-align: left\;\">Eintrag erfolgreich gelöscht";
} else {
    echo "<div style=\"text-align: left\;\">Fehler beim Löschen des eintrages " . mysqli_error($db_link);
}

?>
	<h4><a class="normallink" href="kern.php" name="Administrationsbereich" title="Administrationsbereich">Zurück</a></h4>
	</div>