<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
        input[type="password"],
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
    <form method="POST" action="<?php echo e(route('register')); ?>">
        <h2>Registro de Usuario</h2>
        <?php echo csrf_field(); ?>
        <div>
            <label for="strNombreUsuario">Nombre de Usuario:</label>
            <input type="text" id="strNombreUsuario" name="strNombreUsuario" required>
        </div>
        <div>
            <label for="strContrasena">Contraseña:</label>
            <input type="password" id="strContrasena" name="strContrasena" required>
        </div>
        <div>
            <label for="strContrasena_confirmation">Confirmar Contraseña:</label>
            <input type="password" id="strContrasena_confirmation" name="strContrasena_confirmation" required>
        </div>
        <div>
            <label for="idUsuCatTipoUsuario">Tipo de Usuario:</label>
            <select name="idUsuCatTipoUsuario" id="idUsuCatTipoUsuario" required>
                <option value="">Selecciona un tipo de usuario</option>
                <?php $__currentLoopData = $usucattipoestado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoUsuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tipoUsuario->id); ?>"><?php echo e($tipoUsuario->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <label for="idUsuCatEstado">Estado:</label>
            <select name="idUsuCatEstado" id="idUsuCatEstado" required>
                <option value="">Selecciona un estado</option>
                <?php $__currentLoopData = $usucatestado; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estados): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($estados->id); ?>"><?php echo e($estados->strNombre); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div>
            <button type="submit">Registrarse</button>
        </div>
    </form>
</body>
</html>
<?php /**PATH /home/u819128121/domains/pointlcr.shop/resources/views/auth/register.blade.php ENDPATH**/ ?>