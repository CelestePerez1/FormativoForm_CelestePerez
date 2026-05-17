<?php
// procesar.php - Valida y procesa los datos recibidos por GET
// Incluye la clase para gestionar la información
require_once("clase.php");

// Verificar que llegaron datos por GET
if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET)) {

    try {
        // === SANITIZAR Y VALIDAR DATOS ===

        // Nombre y apellido
        $nombre_apellido = isset($_GET["nombre_apellido"]) ? trim(htmlspecialchars($_GET["nombre_apellido"])) : "";
        if (empty($nombre_apellido)) {
            throw new Exception("El nombre y apellido es obligatorio.");
        }
        if (!preg_match("/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]+$/", $nombre_apellido)) {
            throw new Exception("El nombre solo debe contener letras y espacios.");
        }

        // Sexo
        $sexo = isset($_GET["sexo"]) ? trim(htmlspecialchars($_GET["sexo"])) : "";
        if (empty($sexo)) {
            throw new Exception("Debe seleccionar un sexo.");
        }
        if (!in_array($sexo, ["Femenino", "Masculino"])) {
            throw new Exception("El sexo seleccionado no es válido.");
        }

        // Nacionalidad
        $nacionalidad = isset($_GET["nacionalidad"]) ? trim(htmlspecialchars($_GET["nacionalidad"])) : "";
        if (empty($nacionalidad)) {
            throw new Exception("Debe seleccionar una nacionalidad.");
        }

        // Intereses (checkbox - puede ser vacío)
        $intereses = isset($_GET["intereses"]) ? $_GET["intereses"] : [];
        // Sanitizar cada interés
        $intereses = array_map("htmlspecialchars", $intereses);

        // Acerca de Usted
        $acerca_de_vos = isset($_GET["acerca_de_vos"]) ? trim(htmlspecialchars($_GET["acerca_de_vos"])) : "";
        if (empty($acerca_de_vos)) {
            throw new Exception("El campo Acerca de Usted es obligatorio.");
        }

        // === CREAR OBJETO CON LOS DATOS VALIDADOS ===
        $persona = new Persona($nombre_apellido, $sexo, $nacionalidad, $intereses, $acerca_de_vos);

        // === GUARDAR EN SESION Y REDIRIGIR A SALIDA ===
        // === MOSTRAR SALIDA DIRECTO ===
        $datos     = $persona->ObtenerDatos();
        $intereses = $persona->ObtenerIntereses();
        include("../html/salida.html");
        exit();

    } catch (Exception $e) {
        // Si hay error redirige al formulario con mensaje
        session_start();
        $_SESSION["error"] = $e->getMessage();
        header("Location: ../index.php");
        exit();
    }

} else {
    // Si entran directo a procesar.php sin datos
    header("Location: ../index.php");
    exit();
}
?>