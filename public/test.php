<?php
$mysqli = new mysqli("127.0.0.1", "camisasb_usermike", "Xm7emedl-*-*++", "camisasb_bdfe");

if ($mysqli->connect_errno) {
    echo "Fallo la conexión: " . $mysqli->connect_error;
} else {
    echo "Conexión exitosa 🎉";
}