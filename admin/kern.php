<?php
session_start();

include "../css/mainstyle.css";

$status = $_SESSION["status"];
$user =	$_SESSION["user"];
$clearance = $_SESSION["clearance"];

// Kontrolle der Berechtigung. Wenn zugangsberechtigung verweigert wird oder leer ist wird der Zugriff beendet per Hinweis.

if (!$clearance OR empty($clearance)){
	
		// Alle Session Variablen loeschen
session_unset();

// Zerstoere die allgemeine Session
session_destroy();
	
	die("ZUGRIFF VERWEIGERT!!! Keine Berechtigung! Verdächtiges Verhalten entdeckt! Laden Sie die Hauptseite neu!<br>Geben Sie die URL neu ein oder gehen Sie per Zurück Funktion ihres Browsers zur Startseite bzw. Hauptseite.");
	
}



if ($status == "0") {
	
echo "<h1>Adminbereich</h1>";

?>

<br><br>
<ul>
  <li><a id="linker" href="login.php?logout=1" name="Loout" title="Abmelden">Logout</a></li>
</ul>

<?php
	
echo "<div style=\"text-align: left\;\"> Hallo Meister!<br>Eingelogt als: <br>" . $user;
echo "<br>";
echo "<br>";
echo "<a id=\"linker\" href=\"eintrag.php\" name=\"neuereintrag\" title=\"NeuerEintrag\">Neuer Eintrag</a>";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC";

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
echo "<th colspan=\"2\"><a id=\"linker\" href=\"editieren.php?editid=" . $row->id . "\" name=\"Eintrag editieren\" title=\"Editieren\">Editieren</a><a id=\"linker\" href=\"loeschen.php?delite=" . $row->id . "\" name=\"Loeschen\" title=\"Loeschen\">Löschen</a> </th>";
echo "</tr>";
echo "</table>";

}
	
}

if ($status == "1") {
	
echo "<h1>Adminbereich</h1>";	
echo "<div style=\"text-align: left\;\"> <br>Eingelogt als: <br>" . $user;
echo "<br>";
echo "<br>";
echo "<a id=\"linker\" href=\"eintrag.php\" name=\"neuereintrag\" title=\"NeuerEintrag\">Neuer Eintrag</a>";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC";

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
echo "<th colspan=\"2\"><a id=\"linker\" href=\"editieren.php?editid=" . $row->id . "\" name=\"Eintrag editieren\" title=\"Editieren\">Editieren</a><a id=\"linker\" href=\"loeschen.php?delite=" . $row->id . "\" name=\"Loeschen\" title=\"Loeschen\">Löschen</a> </th>";
echo "</tr>";
echo "</table>";

}
	
}

if ($status == "2") {
	
echo "<h1>Adminbereich</h1>";	
echo "<div style=\"text-align: left\;\"> Hallo Moderator<br>Eingelogt als: <br>" . $user;	
echo "<br>";
echo "Als Moderator k&#246;nnen Sie nur Eintr&#228;ge editieren!";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC";

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
echo "<th colspan=\"2\"><a id=\"linker\" href=\"editieren.php?editid=" . $row->id . "\" name=\"Eintrag editieren\" title=\"Editieren\">Editieren</a></th>";
echo "</tr>";
echo "</table>";

}
	
}

if ($status == "3" OR !isset($status)) {
	
echo "<h1>Adminbereich</h1>";	
echo "<div style=\"text-align: left\;\"> <br>Eingelogt als GAST <br>";
echo "Als Gast könenn Sie lediglich die Eintr&#228;ge einsehen nicht aber &#228;ndern oder l&#246;schen";
echo "<br>";

if (file_exists("connect.php")) {
require_once ('connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC";

// den query an mysql übertragen und anschließend abfragen.

$ereg = mysqli_query($db_link, $sql);
while($row = mysqli_fetch_object($ereg))
{
	
echo "<table>";
echo "<tr>";
echo "<th id=\"smalltext\" colspan=\"2\">Author: " . $row->authoren . " | " . $row->zeit . " | " . $row->datum . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"titel\" colspan=\"2\"><idler>" . $row->id . " |</idler> <titel>" . $row->titel . "</titel></td>";
echo "</tr>";
echo "</table>";

}
	
}

?>
</div>
