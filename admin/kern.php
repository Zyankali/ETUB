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



if ($status == "0") {
	
echo "<h1>Adminbereich</h1>";

?>

<br><br>
<ul>
  <li><a id="linker" href="login.php?logout=1" name="Loout" title="Abmelden">Logout</a></li>
</ul>
<a id="linker" href="einstellungen.php" name="Loout" title="Einstellungen">Einstellungen</a>

<?php
	
echo "<div style=\"text-align: left\;\"> Hallo Meister!<br>Eingelogt als: <br>" . $user;
echo "<br>";
echo "<br>";
echo "<a id=\"linker\" href=\"eintrag.php\" name=\"neuereintrag\" title=\"NeuerEintrag\">Neuer Eintrag</a>";
echo "<br>";
echo "<br>";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

/* Seitenermittelung der anzuzeigenden Einträge. Hierbei sind es Pro Seite 20 einträge.*/

if (!isset($_GET['seite']) or empty ($_GET['seite']))
	
	{
		
		$_GET['seite'] = 1;
		
	}

if (!isset($seite))
	
	{
		
		$seite = 1;
		
	}	
	
	
if ($resultat = mysqli_query($db_link, "SELECT inhalt FROM kontent ORDER BY id")) {
	
    // Bestimme wie viele eintraege in der Datenbank "kontent" vorhanden ist
    $row_cnt = mysqli_num_rows($resultat);
	
	$a = $row_cnt;
    // Schließe und gebe Variable $resultat frei
    mysqli_free_result($resultat);
}

$seite = $_GET['seite'];

if (!is_numeric ($seite))

{
	
	die ("Fehler! Bitte Laden Sie die Seite neu."); 
	
}

// Bestimmen wie viele Einträge auf einmal angezeigt werden sollen.
// Sollte später noch einstellbar sein.
$seitenanzahl = $a / 20;


// Wenn mehr übermittelt wurde als errechnet oder möglich ist oder keine Zahl ermittelt wurde, die "seite" Variable resetten auf eins! Sollte vor den meisten beabischtigten und unbeabsichtigten crashes in dem Fall schützen
	if (is_int($seite))
		{
			
			$seite = 1;
			
		}

if ($seite >= $seitenanzahl + 1)
	{
	
		$seite = 1; 
		
		
	}
	

// Wenn nur eine Seite ermittelt wurde dann zeige auch nur eine Seite an
if ($seitenanzahl == "1")
{
	
	echo '<a href="kern.php">1</a>'; 
	
}

// Wenn mehere Seiten ermittelt wurden dann Zeige Links zu den anderen Seiten an und ermittle den eigenen Seitenzählstand.
if ($seitenanzahl > "1")
	
	{
		
	$seitenunten = $seite; 
		
	$counta = 1;
	while($counta < $seite)
		{
		echo '<a href="kern.php?seite=';
		echo $counta;
		echo '"> ';
		echo $counta;
		echo ' |</a>';
		$counta++;
		}
	
	echo " ";
	echo $seite;
	echo " ";

	$seitenoben = $seite + 1;
		
	while ($seitenoben < $seitenanzahl + 1)
		
		{
		echo '<a href="kern.php?seite=';
		echo $seitenoben;
		echo '">| ';
		echo $seitenoben;
		echo ' </a>';
		$seitenoben++;
		}

}

	

if ($seite != "1")
{
$eintragsoffset = $seite * 20 - 20;
}
else
{
	
	$eintragsoffset = 0;
	
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC LIMIT 20 OFFSET $eintragsoffset";

// den query an mysql übertragen und anschließend abfragen.

$ereg = mysqli_query($db_link, $sql);
while($row = mysqli_fetch_object($ereg))
{

echo "<table>";
echo "<tr>";
echo "<th id=\"smalltext\" colspan=\"2\">Author: " . $row->authoren . " | " . $row->zeit . " | " . $row->datum . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"titel\" colspan=\"2\"><idler>" . $row->id . " |</idler> <titel>" . $row->titel . "</titel>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><a id=\"linker\" href=\"editieren.php?editid=" . $row->id . "\" name=\"Eintrag editieren\" title=\"Editieren\">Editieren</a><a id=\"linker\" href=\"loeschen.php?delite=" . $row->id . "\" name=\"Loeschen\" title=\"Loeschen\">L&ouml;schen</a> </th>";
echo "</tr>";
echo "</table>";

}
	
}

if ($status == "1") {

?>

<br><br>
<ul>
  <li><a id="linker" href="login.php?logout=1" name="Loout" title="Abmelden">Logout</a></li>
  <li><a id="linker" href="einstellungen.php" name="Loout" title="Einstellungen">Einstellungen</a></li>
</ul>

<?php
	
echo "<h1>Adminbereich</h1>";	
echo "<div style=\"text-align: left\;\"> <br>Eingelogt als: <br>" . $user;
echo "<br>";
echo "<br>";
echo "<a id=\"linker\" href=\"eintrag.php\" name=\"neuereintrag\" title=\"NeuerEintrag\">Neuer Eintrag</a>";
echo "<br>";
echo "<br>";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

/* Seitenermittelung der anzuzeigenden Einträge. Hierbei sind es Pro Seite 20 einträge.*/

if (!isset($_GET['seite']) or empty ($_GET['seite']))
	
	{
		
		$_GET['seite'] = 1;
		
	}

if (!isset($seite))
	
	{
		
		$seite = 1;
		
	}	
	
	
if ($resultat = mysqli_query($db_link, "SELECT inhalt FROM kontent ORDER BY id")) {
	
    // Bestimme wie viele eintraege in der Datenbank "kontent" vorhanden ist
    $row_cnt = mysqli_num_rows($resultat);
	
	$a = $row_cnt;
    // Schließe und gebe Variable $resultat frei
    mysqli_free_result($resultat);
}

$seite = $_GET['seite'];

if (!is_numeric ($seite))

{
	
	die ("Fehler! Bitte Laden Sie die Seite neu."); 
	
}

// Bestimmen wie viele Einträge auf einmal angezeigt werden sollen.
// Sollte später noch einstellbar sein.
$seitenanzahl = $a / 20;


// Wenn mehr übermittelt wurde als errechnet oder möglich ist oder keine Zahl ermittelt wurde, die "seite" Variable resetten auf eins! Sollte vor den meisten beabischtigten und unbeabsichtigten crashes in dem Fall schützen
	if (is_int($seite))
		{
			
			$seite = 1;
			
		}

if ($seite >= $seitenanzahl + 1)
	{
	
		$seite = 1; 
		
		
	}
	

// Wenn nur eine Seite ermittelt wurde dann zeige auch nur eine Seite an
if ($seitenanzahl == "1")
{
	
	echo '<a href="kern.php">1</a>'; 
	
}

// Wenn mehere Seiten ermittelt wurden dann Zeige Links zu den anderen Seiten an und ermittle den eigenen Seitenzählstand.
if ($seitenanzahl > "1")
	
	{
		
	$seitenunten = $seite; 
		
	$counta = 1;
	while($counta < $seite)
		{
		echo '<a href="kern.php?seite=';
		echo $counta;
		echo '"> ';
		echo $counta;
		echo ' |</a>';
		$counta++;
		}
	
	echo " ";
	echo $seite;
	echo " ";

	$seitenoben = $seite + 1;
		
	while ($seitenoben < $seitenanzahl + 1)
		
		{
		echo '<a href="kern.php?seite=';
		echo $seitenoben;
		echo '">| ';
		echo $seitenoben;
		echo ' </a>';
		$seitenoben++;
		}

}

	

if ($seite != "1")
{
$eintragsoffset = $seite * 20 - 20;
}
else
{
	
	$eintragsoffset = 0;
	
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC LIMIT 20 OFFSET $eintragsoffset";

// den query an mysql übertragen und anschließend abfragen.

$ereg = mysqli_query($db_link, $sql);
while($row = mysqli_fetch_object($ereg))
{
	
echo "<table>";
echo "<tr>";
echo "<th id=\"smalltext\" colspan=\"2\">Author: " . $row->authoren . " | " . $row->zeit . " | " . $row->datum . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"titel\" colspan=\"2\"><idler>" . $row->id . " |</idler> <titel>" . $row->titel . "</titel>";
echo "</tr>";
echo "<tr>";
echo "<th colspan=\"2\"><a id=\"linker\" href=\"editieren.php?editid=" . $row->id . "\" name=\"Eintrag editieren\" title=\"Editieren\">Editieren</a><a id=\"linker\" href=\"loeschen.php?delite=" . $row->id . "\" name=\"Loeschen\" title=\"Loeschen\">L&ouml;schen</a> </th>";
echo "</tr>";
echo "</table>";

}
	
}

?>
</div>
