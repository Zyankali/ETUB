<?php

$passwort = "10Nigger";

$hash = password_hash($passwort, PASSWORD_DEFAULT);

echo $hash;

?>