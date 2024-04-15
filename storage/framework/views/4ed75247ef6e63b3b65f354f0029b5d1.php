<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CharStore - Lista de Productos</title>
    <style>
         body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 40px;
    background-color: #f4f4f4;
    color: #333;
    display: flex;
    flex-direction: column;
    align-items: flex-start; 
}

header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    margin-bottom: 20px; 
}

.store-name {
   
    color: #2c8bbe; 
    margin: 0; 
    font-size: 24px; 
}

.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    max-width: 80%;
    width: 1100px; 
    background-color: white;
    border-radius: 10px;
    padding: 20px;
    margin: 0 auto 20px; 
}

        h1 {
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .add-product-btn {
             padding: 8px 16px; 
            background-color: #008161;
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 14px; 
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        input[type="text"], select {
            padding: 10px;
            border: 0.8px solid #000000;
            border-radius: 10px;
            margin: 5px 0;
            flex: 1; 
            min-width: 150px; 
        }

        button {
            padding: 10px 20px;
            background-color: #f01b2d;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            flex: none; 
        }

        button:hover {
            background-color: #af5f66;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            margin-top: 20px;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #008161;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .edit-btn, .delete-btn {
            border: none;
            padding: 8px 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            transition: opacity 0.3s;
            border-radius: 10px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #f4821f;
            color: rgb(0, 0, 0);
        }

        .delete-btn {
            background-color: #f01b2d;
            color: white;
        }

        .edit-btn:hover, .delete-btn:hover {
            opacity: 0.7;
        }
        
    </style>
</head>
<body>
    <?php echo $__env->make('partials.menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><br>
    <div class="card">
        <h1 style="font-weight: bold;">Administrador de Productos
        <?php if(in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado'])): ?>
            <a href="<?php echo e(route('productos.create')); ?>" class="add-product-btn">Agregar Producto</a>
        <?php endif; ?>
    </h1>
         <?php if($currentUser): ?>
            <p>Usuario actual: <?php echo e($currentUser->strNombreUsuario); ?></p>
            <p>Tipo de usuario: <?php echo e($currentUser->tipoUsuario->strNombre); ?></p>
        <?php else: ?>
            <p>La variable $currentUser no está definida.</p>
        <?php endif; ?>

        <form action="<?php echo e(url('productos')); ?>" method="GET">
            <input type="text" name="nombre" placeholder="Buscar por nombre..." value="<?php echo e(request()->nombre); ?>">
            <select name="categoria">
                <option value="">Selecciona una categoría</option>
                <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($categoria->id); ?>" <?php echo e(request()->categoria == $categoria->id ? 'selected' : ''); ?>><?php echo e($categoria->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="subcategoria">
                <option value="">Selecciona una subcategoría</option>
                <?php $__currentLoopData = $subcategorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategoria): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($subcategoria->id); ?>" <?php echo e(request()->subcategoria == $subcategoria->id ? 'selected' : ''); ?>><?php echo e($subcategoria->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit">Buscar</button>
        </form>
    
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Subcategoría</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($producto->strNombreProducto); ?></td>
                    <td><?php echo e($producto->strDescripcion); ?></td>
                    <td><?php echo e($producto->categoria ? $producto->categoria->strNombre : 'Sin categoría'); ?></td>
                    <td><?php echo e($producto->subcategoria ? $producto->subcategoria->strNombre : 'Sin subcategoría'); ?></td>
                    <td><?php echo e($producto->curPrecio); ?></td>
                    <td>
                        <?php if($producto->strImage): ?>
                            <img src="<?php echo e(asset($producto->strImage)); ?>" alt="Imagen del producto" style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            Sin Imagen
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado'])): ?>
                            <button class="edit-btn" onclick="location.href='<?php echo e(route('productos.edit', $producto->id)); ?>'">Editar</button>
                        <?php endif; ?>

                        <?php if(in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado'])): ?>
                            <a href="<?php echo e(route('print.product', ['id' => $producto->id])); ?>" class="edit-btn">Imprimir</a>
                        <?php endif; ?>


                        <?php if(in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado'])): ?>
                            <form action="<?php echo e(route('productos.destroy', $producto->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="delete-btn">Eliminar</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/productos/index.blade.php ENDPATH**/ ?>