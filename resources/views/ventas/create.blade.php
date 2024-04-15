<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Venta</title>
    <!-- Añade aquí tu referencia a Bootstrap o a tu archivo CSS -->
</head>
<body>
    <div class="container">
        <h1>Crear Venta</h1>
        <form id="formAgregarProducto">
            <div class="form-group">
                <label for="producto">Producto:</label>
                <select class="form-control" id="producto">
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->strNombreProducto }} - ${{ $producto->curPrecio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" class="form-control" value="1" min="1">
            </div>
            <button type="button" class="btn btn-primary" onclick="agregarProducto()">Agregar Producto</button>
        </form>

        <h2>Productos Agregados</h2>
        <ul id="listaProductos">
            <!-- Los productos agregados se listarán aquí -->
        </ul>

        <button class="btn btn-success" onclick="finalizarCompra()">Finalizar Compra</button>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            let productosAgregados = [];
        
            window.agregarProducto = function() {
                const productoSelect = document.getElementById('producto');
                const cantidadInput = document.getElementById('cantidad');
                const selectedOption = productoSelect.options[productoSelect.selectedIndex];
                const [productoId, precio] = selectedOption.value.split('|'); // Asumiendo que el valor es 'id|precio'
                const productoNombre = selectedOption.text;
                const cantidad = cantidadInput.value;
        
                productosAgregados.push({ productoId, productoNombre, cantidad, precio });
        
                actualizarListaProductos();
            };
        
            function actualizarListaProductos() {
                const lista = document.getElementById('listaProductos');
                lista.innerHTML = '';
        
                productosAgregados.forEach((p, index) => {
                    const item = document.createElement('li');
                    item.textContent = `${p.productoNombre} - Cantidad: ${p.cantidad} - Precio: $${p.precio}`;
                    lista.appendChild(item);
                });
            };
        
            window.finalizarCompra = function() {
                fetch('/ventas/store', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        productos: productosAgregados,
                        // Añade aquí otros datos necesarios para la venta
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    alert('Venta procesada correctamente.');
                    // Considera limpiar el formulario o redirigir al usuario
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            };
        });
        </script>
        
</body>
</html>
