<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurante</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #c6d2d1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            background: rgba(255, 255, 255, 0.8);
            z-index: 1;
            padding: 20px;
            width: 100%; /* Ancho del formulario */
            max-width: 400px; /* Ancho máximo del formulario */
        }
        .card-title {
            color: #495057;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #33a2ff;
            border-color: #33a2ff;
        }
        .btn-primary:hover {
            background-color: #3396ff; /* Color al pasar el mouse */
            border-color: #3396ff;
        }
        .alert {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="image-side"></div> <!-- Imagen de fondo -->
    <div class="card">
        <h5 class="card-title text-center">Iniciar Sesión</h5>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="cUsuUsuario">Usuario</label>
                <input type="text" class="form-control" id="cUsuUsuario" name="cUsuUsuario" required>
            </div>
            <div class="form-group">
                <label for="cUsuPassword">Contraseña</label>
                <input type="password" class="form-control" id="cUsuPassword" name="cUsuPassword" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
