<div>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración - Reserva de Canchas</title>
</head>
<body>
    <h2>Configuración</h2>
    <form action="/guardar-configuracion" method="POST">

        <label for="nombre">Nombre del Hotel</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <label for="correo">Correo Electrónico:</label>
        <input type="email" id="correo" name="correo" required>
        <br><br>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono" required>
        <br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br><br>

        <label for="cuit">CUIT:</label>
        <input type="text" id="cuit" name="cuit" required>
        <br><br>

        <button type="submit">Guardar Configuración</button>
    </form>
</body>
</html>

</div>
