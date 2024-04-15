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
    <h1><?php echo e($producto->strNombreProducto); ?></h1>
    <p><?php echo e($producto->strDescripcion); ?></p>
    <p><?php echo e($producto->curPrecio); ?></p>
    <!-- Más detalles del producto aquí 
    'strNombreProducto',
        'strDescripcion',
        'curPrecio',
    -->
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/viewsPdf/productoReporte.blade.php ENDPATH**/ ?>