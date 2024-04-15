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
    @include('partials.menu')<br>
    <div class="card">
        <h1 style="font-weight: bold;">Administrador de Productos
        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado']))
            <a href="{{ route('productos.create') }}" class="add-product-btn">Agregar Producto</a>
        @endif
    </h1>
         @if ($currentUser)
            <p>Usuario actual: {{ $currentUser->strNombreUsuario }}</p>
            <p>Tipo de usuario: {{ $currentUser->tipoUsuario->strNombre }}</p>
        @else
            <p>La variable $currentUser no está definida.</p>
        @endif

        <form action="{{ url('productos') }}" method="GET">
            <input type="text" name="nombre" placeholder="Buscar por nombre..." value="{{ request()->nombre }}">
            <select name="categoria">
                <option value="">Selecciona una categoría</option>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request()->categoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->strNombre }}</option>
                @endforeach
            </select>
            <select name="subcategoria">
                <option value="">Selecciona una subcategoría</option>
                @foreach ($subcategorias as $subcategoria)
                <option value="{{ $subcategoria->id }}" {{ request()->subcategoria == $subcategoria->id ? 'selected' : '' }}>{{ $subcategoria->strNombre }}</option>
                @endforeach
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
                @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->strNombreProducto }}</td>
                    <td>{{ $producto->strDescripcion }}</td>
                    <td>{{ $producto->categoria ? $producto->categoria->strNombre : 'Sin categoría' }}</td>
                    <td>{{ $producto->subcategoria ? $producto->subcategoria->strNombre : 'Sin subcategoría' }}</td>
                    <td>{{ $producto->curPrecio }}</td>
                    <td>
                        @if ($producto->strImage)
                            <img src="{{ asset($producto->strImage) }}" alt="Imagen del producto" style="max-width: 100px; max-height: 100px;">
                        @else
                            Sin Imagen
                        @endif
                    </td>
                    <td>
                        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado']))
                            <button class="edit-btn" onclick="location.href='{{ route('productos.edit', $producto->id) }}'">Editar</button>
                        @endif

                        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado']))
                            <a href="{{ route('print.product', ['id' => $producto->id]) }}" class="edit-btn">Imprimir</a>
                        @endif


                        @if (in_array($currentUser->tipoUsuario->strNombre, ['Administrador', 'Empleado']))
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn">Eliminar</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </body>
</html>
