<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-card {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-card h2 {
            text-align: center;
            margin: 0 0 20px;
        }
        .login-card form {
            display: flex;
            flex-direction: column;
        }
        .login-card form div {
            margin-bottom: 15px;
        }
        .login-card form input[type="text"],
        .login-card form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .login-card form button {
            padding: 10px;
            background-color: #0056b3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-card form button:hover {
            background-color: #003d82;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Iniciar Sesión</h2>
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div>
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <?php if($errors->has('username')): ?>
                    <span style="color: red;"><?php echo e($errors->first('username')); ?></span>
                <?php endif; ?>
            </div>
            <div>
                <input type="password" name="password" placeholder="Contraseña" required>
                <?php if($errors->has('password')): ?>
                    <span style="color: red;"><?php echo e($errors->first('password')); ?></span>
                <?php endif; ?>
            </div>
            <div>
                <button type="submit">Iniciar Sesión</button>
            </div>
        </form>
    </div>
    
</body>
</html>
<?php /**PATH /home/u819128121/domains/pointlcr.shop/resources/views/auth/login.blade.php ENDPATH**/ ?>