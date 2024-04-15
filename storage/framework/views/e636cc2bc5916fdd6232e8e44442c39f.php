<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Producto</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }
        
        h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }
        
        form {
            display: flex;
            flex-direction: column;
        }
        
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #0056b3;
        }
    </style>
    <form method="POST" action="<?php echo e(route('productos.store')); ?>">
        <h2>Registro de Producto</h2>
        <?php echo csrf_field(); ?>
        <div>
            <label for="strNombreProducto">Nombre del Producto:</label>
            <input type="text" id="strNombreProducto" name="strNombreProducto" required>
        </div>
        <div>
            <label for="strDescripcion">Descripción:</label>
            <input type="text" id="strDescripcion" name="strDescripcion" required>
        </div>
        <div>
            <label for="idProCatCategoria">Categoría:</label>
            <select name="idProCatCategoria" id="idProCatCategoria" required>
                <option value="">Selecciona una categoría</option>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($categoria->id); ?>"><?php echo e($categoria->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label for="idProCatSubCategoria">Subcategoría:</label>
            <select name="idProCatSubCategoria" id="idProCatSubCategoria" required>
                <option value="">Selecciona una subcategoría</option>
                <?php $__currentLoopData = $subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subcategoria->id); ?>"><?php echo e($subcategoria->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label for="decMaximo">Máximo:</label>
            <input type="number" id="decMaximo" name="decMaximo" required>
        </div>
        <div>
            <label for="decMinimo">Mínimo:</label>
            <input type="number" id="decMinimo" name="decMinimo" required>
        </div>
        <div>
            <label for="curCosto">Costo:</label>
            <input type="number" id="curCosto" name="curCosto" step="0.01" required>
        </div>
        <div>
            <label for="curPrecio">Precio:</label>
            <input type="number" id="curPrecio" name="curPrecio" step="0.01" required>
        </div>
        <div>
            <label for="blodImage">Imagen (BLOB):</label>
            <input type="file" id="blodImage" name="blodImage">
        </div>
        <div>
            <label for="strImage">URL de la Imagen:</label>
            <input type="text" id="strImage" name="strImage">
        </div>
        <div>
            <button type="submit">Registrar Producto</button>
        </div>
    </form>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/productos/create.blade.php ENDPATH**/ ?>