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
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="strNombreUsuario">Nombre de Usuario:</label>
                        <input type="text" class="form-control" id="strNombreUsuario" name="strNombreUsuario" value="{{ $user->strNombreUsuario }}" required>
                    </div>
                    <div class="form-group">
                        <label for="idUsuCatEstado">Estado:</label>
                        <select class="form-control" id="idUsuCatEstado" name="idUsuCatEstado" required>
                            @foreach($estados as $estado)
                                <option value="{{ $estado->id }}" {{ $user->idUsuCatEstado == $estado->id ? 'selected' : '' }}>{{ $estado->strDescripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="idUsuCatTipoUsuario">Tipo de Usuario:</label>
                        <select class="form-control" id="idUsuCatTipoUsuario" name="idUsuCatTipoUsuario" required>
                            @foreach($tiposUsuarios as $tipoUsuario)
                                <option value="{{ $tipoUsuario->id }}" {{ $user->idUsuCatTipoUsuario == $tipoUsuario->id ? 'selected' : '' }}>{{ $tipoUsuario->strNombre }}</option>
                            @endforeach
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
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
