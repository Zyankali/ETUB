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
$suchmustera = '/(?!\[img\])\[url\]+\b((http|https|ftp|ftps):\/\/[\w]+.*)\b\[\/url\](?!\[\/img\])/';
$ersetzunga = '<a href="$1" target="_blank">$1</a>';
$inhalt = preg_replace($suchmustera, $ersetzunga, $inhalt);

// Bilder anzeigen lassen mit der Hilfe von URLs aus BBCode [img][/img] erstellen. !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterb = '/(?!\[url\])\[img\]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/img\](?!\[\/url\])/';
$ersetzungb = '<img src="$1" alt="Bild" border="0">';
$inhalt = preg_replace($suchmusterb, $ersetzungb, $inhalt);

// Bilder anzeigen lassen und als Link einfuegen mit der Hilfe von URLs aus BBCode [uri][/uri] erstellen. !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterc = '/[\[uri\]]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/uri\]/i';
$ersetzungc = '<a href="$1" target="_blank"><img src="$1" alt="Bild" border="1"></a>';
$inhalt = preg_replace($suchmusterc, $ersetzungc, $inhalt);

// Bilder als !unechten! Thumbnail anzeigen lassen und anklickbar machen.  !! Es werden nur JPG, PNG und GIF Bilder unterstuetzt.
$suchmusterd = '/[\[thumb\]]+\b((http|https|ftp|ftps):\/\/[\w]+.*(png|jpg|gif))\b\[\/thumb\]/i';
$ersetzungd = '<a href="$1" target="_blank"><img src="$1" alt="Bild" border="1" width="250"></a>';
$inhalt = preg_replace($suchmusterd, $ersetzungd, $inhalt);



	
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