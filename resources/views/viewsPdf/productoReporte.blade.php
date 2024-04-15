<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Producto</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        /* Aquí puedes añadir más estilos */
    </style>
</head>
<body>
    <h1>{{ $producto->strNombreProducto }}</h1>
    <p>{{ $producto->strDescripcion }}</p>
    <p>{{ $producto->curPrecio }}</p>
    <!-- Más detalles del producto aquí 
    'strNombreProducto',
        'strDescripcion',
        'curPrecio',
    -->
</body>
</html>
