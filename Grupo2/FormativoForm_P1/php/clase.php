<?php
// Clase.php - Clase Persona para gestionar la información del formulario P1

class Persona {

    // === ATRIBUTOS ===
    private $nombre_apellido;
    private $sexo;
    private $nacionalidad;
    private $intereses;
    private $acerca_de_vos;

    // === CONSTRUCTOR ===
    public function __construct($nombre_apellido, $sexo, $nacionalidad, $intereses, $acerca_de_vos) {
        $this->nombre_apellido = $nombre_apellido;
        $this->sexo            = $sexo;
        $this->nacionalidad    = $nacionalidad;
        $this->intereses       = $intereses;   // array
        $this->acerca_de_vos   = $acerca_de_vos;
    }

    // === GETTERS ===
    public function getNombre() {
        return $this->nombre_apellido;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function getNacionalidad() {
        return $this->nacionalidad;
    }

    public function getIntereses() {
        return $this->intereses; // retorna array
    }

    public function getAcerca() {
        return $this->acerca_de_vos;
    }

    // === METODO ObtenerDatos ===
    // Retorna array asociativo 1D con los datos del formulario
    public function ObtenerDatos() {
        return [
            "Nombre y Apellido" => $this->nombre_apellido,
            "Sexo"              => $this->sexo,
            "Nacionalidad"      => $this->nacionalidad,
            "Acerca de vos"     => $this->acerca_de_vos
        ];
    }

    // === METODO ObtenerIntereses ===
    // Retorna array con los intereses seleccionados
    public function ObtenerIntereses() {
        return $this->intereses;
    }
}
?>