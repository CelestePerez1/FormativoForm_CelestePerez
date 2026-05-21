<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario 1 GET1</title>

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

<script>
    $(document).ready(function() {
        $("#formulario").submit(function(e) {
            var campoNombre = $("input[name='nombre_apellido']");
            if (campoNombre.val().trim() === "") {
                alert("El nombre y apellido no puede estar vacío o contener solo espacios.");
                campoNombre.val("").focus();
                e.preventDefault();
                return false;
            }
        });
    });
</script>

</body>
</html>