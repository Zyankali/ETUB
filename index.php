<?php

include "css/mainstyle.css";

?>

<!DOCTYPE html>
<head>
<html lang="de">
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>index</title>

</head>

<body>


<?php

// Der Haupttitel sollte spaeter noch definierbar sein. MySQL tabelleneintrag?
echo "<h1>EasyToUseBlog</h1>";

?>

<br><br>
<ul>
  <li><a  id="linker"  href="index.php" >Start</a></li>
  <li><a id="linker" href="admin/login.php?logout=login" name="Login" title="Login">Login</a></li>
</ul>

<div>
<?php 

if (file_exists("admin/connect.php")) {
require_once ('admin/connect.php');
} else {

echo "Fehler: Konnte keine Verbindung zur Datenbank herstellen.";
}

$sql = "SELECT id, titel, inhalt, authoren, zeit, datum FROM kontent ORDER BY id DESC";

// den query an mysql übertragen und anschließend abfragen.

$ereg = mysqli_query($db_link, $sql);
while($row = mysqli_fetch_object($ereg))
{
$inhalt = $row->inhalt;

// URLs aus BBCode [url][/url] erstellen
$suchmuster = '/[\[url\]]+((http|https|ftp|ftps):\/\/[\w]+.*)\[\/url\]/';
$ersetzung = '<a href="$1" target="_blank">$1</a>';
$inhalt = preg_replace($suchmuster, $ersetzung, $inhalt);
	
echo "<table>";
echo "<tr>";
echo "<th id=\"smalltext\" colspan=\"2\">Author: " . $row->authoren . " | " . $row->zeit . " | " . $row->datum . "</th>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"titel\" colspan=\"2\"><idler>" . $row->id . " |</idler> <titel>" . $row->titel . "</titel></td>";
echo "</tr>";
echo "<tr>";
echo "<th class=\"inhalt\" colspan=\"2\">" . $inhalt . "</th>";

echo "</tr>";
echo "</table>";
 
}

?>
</div>

</body>
</html>