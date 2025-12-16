<?php
$numeros = [4, 3, 6, 7, 8];

echo "El numero en la posicion 2 es $numeros[2]\n";

//Añadimos elementos al array
$numeros[] = 23;

echo "El numero en la posicion 5 es $numeros[5]\n";

$mapa[10][10] = [
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
];

echo "Hay " . count($numeros) . " números en el array de numeros\n";

//Estas dos instrucciones son equivalentes
array_push($numeros, 4);
$numeros[] = 4;

echo "Hay " . count($numeros) . " números en el array de numeros\n";

//pop elimina el elemento ademas de devolver el valor
echo "El último numero es :" . array_pop($numeros) . "\n";

echo "Hay " . count($numeros) . " números en el array de numeros\n";

$alumno1 = [
    "nombre" => "Juan4",
    "edad" => 15,
    "sexo" => "poco",
    "casado" => true,
];
$alumno2 = [
    "nombre" => "Juan7",
    "edad" => 13,
    "sexo" => "poco",
    "casado" => true,
    "hijo" => [
        "nombre" => "Pedro"
    ]
];
$alumno3 = [
    "nombre" => "Juan3",
    "edad" => 23,
    "sexo" => "poco",
    "casado" => true,
    "hijo" => [
        "nombre" => "Pedro"
    ]
];
$alumno4 = [
    "nombre" => "Juan4",
    "edad" => 23,
    "sexo" => "poco",
    "casado" => true,
    "hijo" => [
        "nombre" => "Pedro"
    ]
];

$alumnos = [$alumno1, $alumno2, $alumno3, $alumno4];

echo "El nombre del alumno es " . $alumno1["nombre"];

//echo "El nombre del hijo del alumno es " . $alumno1["hijo"]["nombre"] . "\n";

//$hijo = $alumno1["hijo"];

//Recorrer arrays
for ($i = 0; $i < count($numeros); $i++) {
    echo "Numero en posicion $i es $numeros[$i]\n";
}
//Con -> se usan los metodos y variables publicas de un objeto php
//Con => se define el valor de una clave de un array asociativo
foreach ($alumno1 as $clave => $valor) {
    echo "La clave $clave tiene el valor $valor\n";
}

$max = $numeros[0]; //PHP_INT_MIN tambien valdria
foreach ($numeros as $numero) {
    if ($numero > $max) $max = $numero;
}

echo "El número maximo es $max";

foreach ($alumnos as $alumno) {
    echo "El nombre del alumno es " . $alumno["nombre"] . "\n";
}

//Con array_filter podemos eliminar elementos de un array dependiendo de condiciones
$alumnos_mayores = array_filter($alumnos, function ($a) {
    return $a["edad"] > 18;
});

$lista_nombres = array_map(function ($a) {
    return $a["nombre"];
}, $alumnos);

//Var dump muestra el contenido de la variables por pantalla
echo "Lista de menores de edad con array_filter\n";
var_dump($alumnos_mayores);
echo "Lista de solo los nombres con array_map\n";
var_dump($lista_nombres);

var_dump(array_keys($alumno1));
var_dump(array_values($alumno1));

//Funcion que ordena un array
rsort($numeros);
sort($alumnos);

echo "\n\nLista ordenada de numeros\n\n";
var_dump($numeros);
echo "\n\nLista ordenada de alumnos\n\n";
var_dump($alumnos);

shuffle($alumnos);

echo "\n\nLista aleatoria de alumnos\n\n";
var_dump($alumnos);

//Crea un string con todos los elementos del array
$numeros_txt = implode(", ", $numeros);
echo "Numeros: $numeros_txt";

$lista_nombres = " Alejandro, Jaime, Juan , Pedro, Antonio";

//Implode crea un array a partir de un string, separando los elementos por la cadena que pongamos
$nombres = explode(",", $lista_nombres);
var_dump($nombres);
print_r($nombres);
