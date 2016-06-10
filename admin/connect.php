<?php
require_once ('konfiguration.php');
$db_link = mysqli_connect (
                     MYSQL_HOST, 
                     MYSQL_BENUTZER, 
                     MYSQL_KENNWORT, 
                     MYSQL_DATENBANK
					);
mysqli_set_charset($db_link, "utf8");					
?>

