<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a 7-Eleven</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #00a170; /* Color principal de 7-Eleven */
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            padding: 100px;
        }

        .logo {
            max-width: 200px; /* Definir un ancho máximo para la imagen */
            width: auto; /* Para que la imagen se ajuste al ancho máximo */
            height: auto; /* Para mantener la proporción de aspecto */
            display: block; /* Para centrar la imagen horizontalmente */
            margin-left: auto; /* Centrar la imagen horizontalmente */
            margin-right: auto; /* Centrar la imagen horizontalmente */
        }

        h1 {
            color:black;
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        p {
            font-size: 1.2em;
            color: black
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    @include('partials.menu')<br>
    <div class="container">
        <img src="{{ asset('images/7-Eleven-Logo.png') }}" alt="Logo de 7-Eleven" class="logo">
        <h1>Bienvenido a 7-Eleven</h1>
        <p>¡La tienda conveniente para tus necesidades!</p>
    </div>
</body>
</html>
