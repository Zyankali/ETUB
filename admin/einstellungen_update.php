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
if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$blogtitel = $_POST['blogtitel']; 
$eintragszahl = $_POST['eintragszahl'];


// entfernt HTML Tags aus dem Blogtitel
$blogtitel = strip_tags($blogtitel);
// Wandelt Sonderzeichen in HTML Code um
$blogtitel = htmlentities($blogtitel);
// entfernt Backslashes aus dem Titel
$blogtitel = stripslashes($blogtitel);
// Ersetzt \n durch HTML Titel
$blogtitel = nl2br($blogtitel);


// Überprüft ob es eine zahl ist in der Variable $eintragszahl

if (is_numeric($eintragszahl))

	{
		
		// Wenn eine Zahl dann wird das Programm fort geführt.
		?>
		<h1>Einstellungen aktuallisieren!</h1>
<?php

// Editierter Eintrag in Datenbank an Spezifischen Punkt aktuallisieren und eintragen
$sql = "UPDATE settings SET blogtitel  = '" . $blogtitel . "', eintragszahl = '" . $eintragszahl . "' WHERE id = '1'" ;

if (mysqli_query($db_link, $sql)) {
    echo "Einstellungen erfolgreich aktualisiert.";
} else {
    echo "Fehler beim aktualisieren der Einstellungen: " . mysqli_error($db_link);
}
}
?>

<h4><a class="normallink" href="kern.php" name="mainpage" title="Zurueck">Zur&uuml;ck</a></h4>