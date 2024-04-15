<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CharStore - Lista de Usuarios</title>
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

        .add-user-btn {
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
            min-width: 120px; 
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
        <h1 style="font-weight: bold;">Administrador de Usuarios 
            <?php if($currentUser->tipoUsuario->strNombre === 'Administrador'): ?>
                <a href="<?php echo e(route('register')); ?>" class="add-user-btn">Agregar Usuario</a>
            <?php endif; ?>
        </h1>
        <?php if($currentUser): ?>
             <p>Usuario actual: <?php echo e($currentUser->strNombreUsuario); ?></p>
            <p>Tipo de usuario: <?php echo e($currentUser->tipoUsuario->strNombre); ?></p>
        <?php else: ?>
        <p>La variable $currentUser no está definida.</p>
        <?php endif; ?>        
        <form action="<?php echo e(url('usuarios')); ?>" method="GET">
            <input type="text" name="nombre" placeholder="Buscar por nombre..." value="<?php echo e(request()->nombre); ?>">
            <select name="estado">
                <option value="">Selecciona un estado</option>
                <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($estado->id); ?>" <?php echo e(request()->estado == $estado->id ? 'selected' : ''); ?>><?php echo e($estado->strDescripcion); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select name="tipo">
                <option value="">Selecciona un tipo</option>
                <?php $__currentLoopData = $tipos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($tipo->id); ?>" <?php echo e(request()->tipo == $tipo->id ? 'selected' : ''); ?>><?php echo e($tipo->strNombre); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit">Buscar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($user->strNombreUsuario); ?></td>
                    <td>
                        <?php if($user->estado): ?>
                            <?php echo e($user->estado->strDescripcion); ?>

                        <?php else: ?>
                            Sin estado
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($user->tipoUsuario ? $user->tipoUsuario->strNombre : 'Tipo de usuario no disponible'); ?></td>
                    <td>
                        <?php if(in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado'])): ?>
                            <button class="edit-btn" onclick="location.href='<?php echo e(route('usuarios.edit', $user->id)); ?>'">Editar</button>
                        <?php endif; ?>
                
                        <?php if($currentUser->tipoUsuario->strNombre === 'Administrador' && $currentUser->id !== $user->id): ?>
                            <form action="<?php echo e(route('usuarios.destroy', $user->id)); ?>" method="POST" style="display: inline;">
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
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/users/index.blade.php ENDPATH**/ ?>