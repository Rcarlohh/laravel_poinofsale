<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-top: 50px;
            width: 400px; 
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
                <h1 class="text-center">Editar Producto</h1>
                <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="strNombreProducto">Nombre del Producto:</label>
                        <input type="text" class="form-control" id="strNombreProducto" name="strNombreProducto" value="{{ $producto->strNombreProducto }}" required>
                    </div>
                    <div class="form-group">
                        <label for="strDescripcion">Descripción:</label>
                        <input type="text" class="form-control" id="strDescripcion" name="strDescripcion" value="{{ $producto->strDescripcion }}" required>
                    </div>
                    <div class="form-group">
                        <label for="idProCatCategoria">Categoría:</label>
                        <select class="form-control" id="idProCatCategoria" name="idProCatCategoria" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $producto->idProCatCategoria == $categoria->id ? 'selected' : '' }}>{{ $categoria->strNombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idProCatSubCategoria">Subcategoría:</label>
                        <select class="form-control" id="idProCatSubCategoria" name="idProCatSubCategoria" required>
                            @foreach($subcategorias as $subcategoria)
                                <option value="{{ $subcategoria->id }}" {{ $producto->idProCatSubCategoria == $subcategoria->id ? 'selected' : '' }}>{{ $subcategoria->strNombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="curPrecio">Precio:</label>
                        <input type="text" class="form-control" id="curPrecio" name="curPrecio" value="{{ $producto->curPrecio }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Actualizar Producto</button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
