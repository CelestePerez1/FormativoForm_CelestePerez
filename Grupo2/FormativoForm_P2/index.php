<!DOCTYPE html>
<!-- Formulario P2 — Página de entrada con método POST. -->
<!-- Incluye menú global, formulario de estudiante y pie de página. -->
<!-- Muestra alerta si procesar.php guardó un error en la sesión. -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario P2 POST</title>

    <!-- Bootstrap 3 CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- CSS global -->
    <link rel="stylesheet" href="../../css/styles.css">

    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php include("../../html/menu.html"); ?>
    <?php include("html/form.html"); ?>
    <?php include("html/footer.html"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<?php
// Mostrar alert si vino un error desde procesar.php
session_start();
if (isset($_SESSION["error"])):
?>
<script>
    alert("<?php echo addslashes($_SESSION['error']); ?>");          
</script>
<?php
    unset($_SESSION["error"]);
endif;
?>

<script>
    // Bloquear "e", "E", "+", "-", "." y otros caracteres no numericos en el campo edad
    function bloquearNoNumerico(e) {
        // Permitir teclas de control: backspace, delete, tab, escape, enter, flechas, home, end
        var teclasPermitidas = [8, 9, 13, 27, 35, 36, 37, 38, 39, 40, 46];
        if (teclasPermitidas.indexOf(e.keyCode) !== -1) {
            return true;
        }
        // Permitir Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
        if (e.ctrlKey && [65, 67, 86, 88].indexOf(e.keyCode) !== -1) {
            return true;
        }
        // Bloquear explicitamente "e", "E", "+", "-", "."
        var bloqueados = ["e", "E", "+", "-", ".", ","];
        if (bloqueados.indexOf(e.key) !== -1) {
            e.preventDefault();
            return false;
        }
        // Solo permitir digitos 0-9 (teclado normal o numerico)
        var esDigito = (e.keyCode >= 48 && e.keyCode <= 57 && !e.shiftKey) ||
                       (e.keyCode >= 96 && e.keyCode <= 105);
        if (!esDigito) {
            e.preventDefault();
            return false;
        }
        return true;
    }

    // Bloquear pegar contenido no numerico
    function bloquearPegarNoNumerico(e) {
        var pegado = (e.clipboardData || window.clipboardData).getData("text");
        if (!/^\d+$/.test(pegado)) {
            e.preventDefault();
            alert("Solo se permiten números en el campo edad.");
            return false;
        }
        return true;
    }

    // Mostrar el grupo de materias segun la carrera seleccionada
    $(document).ready(function() {
        $("#carrera").change(function() {
            $(".grupo-materias").hide();
            // Desmarcar todos los checkbox al cambiar de carrera
            $("input[name='materias[]']").prop("checked", false);

            var carrera = $(this).val();
            if (carrera !== "") {
                $("#materias-" + carrera).show();
            }
        });

        // Validacion extra al enviar: nombre sin espacios solos y al menos una materia
        $("#formulario").submit(function(e) {
            var campoNombre = $("input[name='nombre']");
            if (campoNombre.val().trim() === "") {
                alert("El nombre del estudiante no puede estar vacío o contener solo espacios.");
                campoNombre.val("").focus();
                e.preventDefault();
                return false;
            }

            var carrera = $("#carrera").val();
            if (carrera === "") {
                alert("Debe seleccionar una carrera.");
                e.preventDefault();
                return false;
            }
            var marcadas = $("#materias-" + carrera + " input[name='materias[]']:checked").length;
            if (marcadas === 0) {
                alert("Debe seleccionar al menos una materia.");
                e.preventDefault();
                return false;
            }
        });
    });
</script>

</body>
</html>
