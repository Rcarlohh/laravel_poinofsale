<!DOCTYPE html>
<html>
<head>
    <title>7-Eleven - @yield('titulo')</title>
    <style>
        body {
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .menu {
            background-color: #008161; /* Gris azulado */
            color: #ffffff;
            overflow: hidden;
            width: 97%;
            display: flex;
            align-items: center;
            padding: 10px 20px;
        }
        .menu-title {
            font-size: 24px;
            color: aliceblue;
            margin: 0;
            flex: 0.98; /* Ocupa todo el espacio restante */
        }
        .menu-links {
            display: flex;
            align-items: center;
        }
        .menu a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 20px; /* Redondea los bordes */
            transition: background-color 0.3s, color 0.3s; /* Agrega transiciones suaves */
        }
        .menu a:hover {
            background-color: #ddd;
            color: #000000;
        }
        .logout-btn {
            background-color: #f01b2d;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            text-decoration: none;
            margin-left: 20px;
            border-radius: 20px; /* Redondea los bordes */
            transition: background-color 0.3s, color 0.3s; /* Agrega transiciones suaves */
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

<div class="menu">
    <h1 class="menu-title">7-Eleven</h1>
    <div class="menu-links">
        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador']))
        <a href="{{ route('usuarios.index') }}">Usuarios</a>
        @endif
        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador']))
        <a href="{{ route('productos.index') }}">Productos</a>
        @endif
        <a href="{{ route('ventas.index') }}">Ventas</a>
        <a href="{{ route('contactanos') }}">Contáctanos</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
    </div>
</div>

@yield('contenido')

<script>
    // Añadir animación al menú
    const menu = document.querySelector('.menu');
    menu.style.opacity = '0';
    menu.style.transform = 'translateY(-50px)';
    setTimeout(() => {
        menu.style.transition = 'opacity 0.5s, transform 0.5s';
        menu.style.opacity = '1';
        menu.style.transform = 'translateY(0)';
    }, 500);
</script>

</body>
</html>
