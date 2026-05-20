<?php
// ClaseEstudiante.php - Clase Estudiante para el formulario P2 (POST)

class Estudiante {

    // === ATRIBUTOS ===
    private $nombre;
    private $correo;
    private $edad;
    private $carrera;
    private $materias; // array asociativo 2D: [ [codigo=>..., nombre=>...], ... ]

    // === CONSTRUCTOR ===
    public function __construct($nombre, $correo, $edad, $carrera, $materias) {
        $this->nombre   = $nombre;
        $this->correo   = $correo;
        $this->edad     = $edad;
        $this->carrera  = $carrera;
        $this->materias = $materias;
    }

    // === METODO ObtenerDatos ===
    // Retorna array asociativo 1D con los datos del estudiante
    public function ObtenerDatos() {
        return [
            "nombre"  => $this->nombre,
            "correo"  => $this->correo,
            "edad"    => $this->edad,
            "carrera" => $this->carrera
        ];
    }

    // === METODO ObtenerMaterias ===
    // Retorna array asociativo 2D con codigo y nombre de las materias
    public function ObtenerMaterias() {
        return $this->materias;
    }
}
?>
