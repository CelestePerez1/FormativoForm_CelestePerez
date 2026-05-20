<?php
// procesar.php - Valida y procesa la informacion recibida por POST
require_once("ClaseEstudiante.php");

session_start();

// Funciones de saneamiento y validacion
function limpiar_dato($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

function validar_nombre($nombre) {
    return preg_match("/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{3,60}$/", $nombre);
}

function validar_correo($correo) {
    return filter_var($correo, FILTER_VALIDATE_EMAIL) !== false;
}

function validar_edad($edad) {
    return filter_var($edad, FILTER_VALIDATE_INT, [
        "options" => ["min_range" => 17, "max_range" => 99]
    ]) !== false;
}

// Catalogo valido de carreras y materias del lado del servidor
$catalogo = [
    "DS" => [
        "nombre"   => "Desarrollo de Software",
        "materias" => [
            "DS101" => "Programación I",
            "DS202" => "Base de Datos",
            "DS303" => "Ingeniería de Software"
        ]
    ],
    "RED" => [
        "nombre"   => "Redes",
        "materias" => [
            "RED101" => "Redes I",
            "RED202" => "Seguridad Informática"
        ]
    ],
    "CIB" => [
        "nombre"   => "Ciberseguridad",
        "materias" => [
            "CIB101" => "Criptografía",
            "CIB202" => "Ethical Hacking",
            "CIB303" => "Análisis Forense Digital"
        ]
    ]
];

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {

    try {
        // === NOMBRE ===
        $nombre = isset($_POST["nombre"]) ? limpiar_dato($_POST["nombre"]) : "";
        if (empty($nombre)) {
            throw new Exception("El nombre del estudiante es obligatorio.");
        }
        if (!validar_nombre($nombre)) {
            throw new Exception("El nombre solo debe contener letras y espacios (3 a 60 caracteres).");
        }

        // === CORREO ===
        $correo = isset($_POST["correo"]) ? limpiar_dato($_POST["correo"]) : "";
        if (empty($correo)) {
            throw new Exception("El correo electrónico es obligatorio.");
        }
        if (!validar_correo($correo)) {
            throw new Exception("El correo electrónico no es válido.");
        }

        // === EDAD ===
        $edad = isset($_POST["edad"]) ? limpiar_dato($_POST["edad"]) : "";
        if ($edad === "") {
            throw new Exception("La edad es obligatoria.");
        }
        if (!validar_edad($edad)) {
            throw new Exception("La edad debe ser un número entero entre 17 y 99.");
        }
        $edad = (int)$edad;

        // === CARRERA ===
        $carrera_cod = isset($_POST["carrera"]) ? limpiar_dato($_POST["carrera"]) : "";
        if (empty($carrera_cod)) {
            throw new Exception("Debe seleccionar una carrera.");
        }
        if (!array_key_exists($carrera_cod, $catalogo)) {
            throw new Exception("La carrera seleccionada no es válida.");
        }
        $carrera_nombre = $catalogo[$carrera_cod]["nombre"];

        // === MATERIAS ===
        $materias_post = isset($_POST["materias"]) ? $_POST["materias"] : [];
        if (!is_array($materias_post) || count($materias_post) === 0) {
            throw new Exception("Debe seleccionar al menos una materia.");
        }

        // Construir array asociativo 2D validando contra el catalogo
        $materias = [];
        foreach ($materias_post as $item) {
            $item  = limpiar_dato($item);
            $partes = explode("|", $item);
            if (count($partes) !== 2) {
                throw new Exception("Formato de materia inválido.");
            }
            $codigo = $partes[0];
            $nombreMat = $partes[1];

            // Verificar que la materia pertenezca a la carrera seleccionada
            if (!isset($catalogo[$carrera_cod]["materias"][$codigo])) {
                throw new Exception("La materia '$codigo' no pertenece a la carrera seleccionada.");
            }
            // Tomar el nombre desde el catalogo (mas confiable que el del POST)
            $materias[] = [
                "codigo" => $codigo,
                "nombre" => $catalogo[$carrera_cod]["materias"][$codigo]
            ];
        }

        // === CREAR OBJETO ESTUDIANTE ===
        $estudiante = new Estudiante($nombre, $correo, $edad, $carrera_nombre, $materias);

        // === PREPARAR DATOS PARA LA VISTA ===
        $datos    = $estudiante->ObtenerDatos();
        $materias = $estudiante->ObtenerMaterias();
        include("../html/salida.php");
        exit();

    } catch (Exception $e) {
        $_SESSION["error"] = $e->getMessage();
        header("Location: ../index.php");
        exit();
    }

} else {
    // Acceso directo sin datos
    header("Location: ../index.php");
    exit();
}
?>
