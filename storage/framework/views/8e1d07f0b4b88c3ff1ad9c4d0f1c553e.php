<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 50px; 
            width: 400px; /* Ancho del card */
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
                <h1 class="text-center">Editar Usuario</h1><br>
                <form action="<?php echo e(route('usuarios.update', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="form-group">
                        <label for="strNombreUsuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="strNombreUsuario" name="strNombreUsuario" value="<?php echo e($user->strNombreUsuario); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="idUsuCatEstado">Estado:</label>
                        <select class="form-control" id="idUsuCatEstado" name="idUsuCatEstado" required>
                            <?php $__currentLoopData = $estados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($estado->id); ?>" <?php echo e($user->idUsuCatEstado == $estado->id ? 'selected' : ''); ?>><?php echo e($estado->strDescripcion); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idUsuCatTipoUsuario">Tipo de Usuario:</label>
                        <select class="form-control" id="idUsuCatTipoUsuario" name="idUsuCatTipoUsuario" required>
                            <?php $__currentLoopData = $tiposUsuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipoUsuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($tipoUsuario->id); ?>" <?php echo e($user->idUsuCatTipoUsuario == $tipoUsuario->id ? 'selected' : ''); ?>><?php echo e($tipoUsuario->strNombre); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="current_password">Contraseña Actual (para confirmar cambios):</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nueva Contraseña (opcional):</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" minlength="8">
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirmar Nueva Contraseña (opcional):</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" minlength="8">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-space">Actualizar Usuario</button>
                    <a href="<?php echo e(url()->previous()); ?>" class="btn btn-secondary btn-block">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\_pointlcr.shop (1)\resources\views/users/edit.blade.php ENDPATH**/ ?>