<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CharStore - Lista de Ventas</title>
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

        .add-venta-btn {
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
    @include('partials.menu')<br>
    <div class="card">
        <h1 style="font-weight: bold;">Administrador de Ventas <a href="{{ route('ventas.create') }}" class="add-venta-btn">Agregar Venta</a></h1>
        
        <form action="{{ url('ventas') }}" method="GET">
            <input type="text" name="folio" placeholder="Buscar por folio..." value="{{ request()->folio }}">
            <select name="estado">
                <option value="">Selecciona un estado</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->id }}" {{ request()->estado == $estado->id ? 'selected' : '' }}>{{ $estado->strDescripcion }}</option>
                @endforeach
            </select>
            <button type="submit">Buscar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha de Venta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->strFolio }}</td>
                        <td>{{ $venta->dteFechaVenta }}</td>
                        <td>{{ $venta->estado ? $venta->estado->strDescripcion : 'Sin estado' }}</td>
                        <td>
                            <button class="edit-btn" onclick="location.href='{{ route('ventas.edit', $venta->id) }}'">Editar</button>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Eliminar</button>
                            </form>
                            <button class="print-btn" onclick="imprimir('{{ route('ventas.print', $venta->id) }}')">Imprimir</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function imprimir(url) {
            // Redirecciona a la URL para imprimir
            window.open(url, '_blank');
        }
    </script>
</body>
</html>
