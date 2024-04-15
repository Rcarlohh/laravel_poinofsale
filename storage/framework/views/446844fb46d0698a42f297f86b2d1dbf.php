<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 50px;
            width: 400px; 
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <h1 class="text-center">Editar Producto</h1>
                <form action="<?php echo e(route('productos.update', $producto->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="strNombreProducto">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="strNombreProducto" name="strNombreProducto" value="<?php echo e($producto->strNombreProducto); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="strDescripcion">Descripción:</label>
                        <input type="text" class="form-control" id="strDescripcion" name="strDescripcion" value="<?php echo e($producto->strDescripcion); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="idProCatCategoria">Categoría:</label>
                        <select class="form-control" id="idProCatCategoria" name="idProCatCategoria" required>
                            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($categoria->id); ?>" <?php echo e($producto->idProCatCategoria == $categoria->id ? 'selected' : ''); ?>><?php echo e($categoria->strNombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idProCatSubCategoria">Subcategoría:</label>
                        <select class="form-control" id="idProCatSubCategoria" name="idProCatSubCategoria" required>
                            <?php $__currentLoopData = $subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($subcategoria->id); ?>" <?php echo e($producto->idProCatSubCategoria == $subcategoria->id ? 'selected' : ''); ?>><?php echo e($subcategoria->strNombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="curPrecio">Precio:</label>
                        <input type="text" class="form-control" id="curPrecio" name="curPrecio" value="<?php echo e($producto->curPrecio); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar Producto</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/productos/edit.blade.php ENDPATH**/ ?>