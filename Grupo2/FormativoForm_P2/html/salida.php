<!DOCTYPE html>
<!-- Vista de salida del Formulario P2, método POST. -->
<!-- Muestra tabla con datos del estudiante y materias seleccionadas. -->
<!-- Los datos vienen del objeto Estudiante creado en procesar.php. -->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Salida P2 - POST</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <!-- CSS global -->
    <link rel="stylesheet" href="../../../css/styles.css">
</head>
<body>

<?php include("../../../html/menu.html"); ?>

<div class="container" style="margin-top: 30px;">

    <!-- Titulo -->
    <div class="row">
        <div class="col-sm-12 text-center">
            <h2><strong>Estudiante Registrado</strong></h2>
            <p class="text-muted">Información enviada por método POST</p>
            <hr>
        </div>
    </div>

    <!-- Alert de exito -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="alert alert-success">
                <strong><span class="glyphicon glyphicon-ok"></span> ¡Estudiante registrado correctamente!</strong>
            </div>
        </div>
    </div>

    <!-- Card con datos del estudiante -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Datos del Estudiante</strong></div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Campo</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Nombre</strong></td>
                                <td><?php echo $datos["nombre"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Correo</strong></td>
                                <td><?php echo $datos["correo"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Edad</strong></td>
                                <td><?php echo $datos["edad"]; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Carrera</strong></td>
                                <td><?php echo $datos["carrera"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Materias seleccionadas -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Materias Seleccionadas</strong></div>
                <div class="panel-body">
                    <?php if (!empty($materias)): ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre de la materia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($materias as $mat): ?>
                            <tr>
                                <td>
                                    <span class="label label-primary" style="font-size:13px;">
                                        <?php echo $mat["codigo"]; ?>
                                    </span>
                                </td>
                                <td><?php echo $mat["nombre"]; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <p class="text-muted">No seleccionó ninguna materia.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Boton volver -->
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center" style="margin-bottom:30px;">
            <a href="../index.php" class="btn btn-primary btn-lg">
                <span class="glyphicon glyphicon-arrow-left"></span> Volver al Formulario
            </a>
        </div>
    </div>

</div>

<?php include("../html/footer.html"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
