<?php
define("ERROR", -1);


$nombre = "Pedro";
$edad = 12;
$sexo = "Masculino";
$edad = "cuatro";
$casado = true;
$sueldo = 1567.4;
$num_hijos = 23;

$numero = "23" + 4;

$nombre_variable = "sexo";

echo "El sexo de $nombre es :" . $$nombre_variable . "\n";

echo "La suma es $numero\n";

echo "El nombre es $nombre - " . $nombre . "\n";

//Funciones base

if (isset($num_hijos) && !is_null($num_hijos)) echo "La variable no es nula, no hay " . ERROR . "\n";
if ($num_hijos == null) echo "La variable es nula\n";
