<?php

namespace modelo;

use Illuminate\Contracts\Container\CircularDependencyException;

class Circuito
{

    private string $nombre;
    private string $pais;
    private int $longitud;
    private static $listaCategorias = ["MotoGP", "F1", "SuperBikes"];

    public function __construct(string $nombre = "Jerez", string $pais = "Francia", int $longitud = 20)
    {

        $this->nombre = $nombre;
        $this->pais = $pais;
        $this->longitud = $longitud;
    }

    public function __destruct()
    {
        //Codigo cuando se destruye o elimina el objeto
    }


    public static function categorias()
    {
        $str_categorias = implode(",", self::$listaCategorias);
        return $str_categorias;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
}

$jarama = new Circuito(pais: "Francia", longitud: 3400);

$jerez = new Circuito();


var_dump($jarama);
var_dump($jerez);

//Accedemos a los métodos y variables estaticas con ::
echo "La lista de categorias de los circuitos es " . Circuito::categorias() . "\n";

//Para usar los metodos y variables publicas usamos ->
print "El nombre del circuito es {$jerez->getNombre()}";
