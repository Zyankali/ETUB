<?php

session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$user =	$_SESSION["user"];
$clearance = $_SESSION["clearance"];


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





 if (!ctype_digit($status)) {
	
			// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
 die("<div style=\"text-align: left\;\">Unzulässige eingabe!");
 
 }


$titel = $_POST['titel']; 
$inhalt = $_POST['inhalt'];


// entfernt HTML Tags aus dem Titel
$titel = strip_tags($titel);
// Wandelt Sonderzeichen in HTML Code um
$titel = htmlentities($titel);
// entfernt Backslashes aus dem Titel
$titel = stripslashes($titel);
// Ersetzt \n durch HTML Titel
$titel = nl2br($titel);


// entfernt HTML Tags aus Inhalt
$inhalt = strip_tags($inhalt);
// Wandelt Sonderzeichen in HTML Code um
$inhalt = htmlentities($inhalt);
// entfernt Backslashes aus dem inhalt
$inhalt = stripslashes($inhalt);
// Ersetzt \n durch HTML umbruchzeichen
$inhalt = nl2br($inhalt); 


//Zeitzone und Zeit ermitteln in UNIX formation

date_default_timezone_set("Europe/Berlin");
$timestamp = time();

// Uhrzeit in var eintragen

$zeit = date("H:i:s",$timestamp);

$datum = date("Y-m-d",$timestamp);

//Titel der Seite
?>
<h1>Eintragen</h1>
<?php


if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}
// Muss noch angepasst werden!!!
$sql = "INSERT INTO kontent (titel, inhalt, authoren, zeit, datum) VALUES ('" . $titel . "', '" . $inhalt . "', '" . $user . "', '" . $zeit . "', '" . $datum . "')"; 
 
if (mysqli_query($db_link, $sql)) {
	
	echo "Eintrag erfolgreich neu gesetzt.";
	
} else {
	
	echo "Fehler: " . $sql . "<br>" . mysqli_error($db_link);
	
}



?>
	<h4><a class="normallink" href="kern.php" name="mainpage" title="Zurueck">Zurück</a></h4>

</div>