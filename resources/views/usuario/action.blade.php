<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fas fa-user-plus me-2"></i>
            {{ $usuario->iUsuID ? 'Editar Usuario' : 'Nuevo Usuario' }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="usuario-form" action="{{ $usuario->iUsuID ? route('usuario.update', $usuario->iUsuID) : route('usuario.store') }}" method="post">
            @csrf
            @if($usuario->iUsuID)
            @method('PUT')
            <input type="hidden" name="iUsuID" value="{{ $usuario->iUsuID }}">
            @endif

            @if (!$usuario->iUsuID)
            <div class="mb-3">
                <label for="dni" class="form-label">DNI del Empleado</label>
                <div class="input-group">
                    <input type="text" class="form-control" name="dni" id="dni"
                        value="{{ old('dni') }}" required placeholder="Ingrese el DNI del empleado" maxlength="8" pattern="\d{8}">
                    <button type="button" class="btn btn-primary" onclick="buscarEmpleado()">Buscar</button>
                </div>
            </div>

            <div id="empleado-info" class="mb-3" style="display: none;">
                <h6>Información del Empleado</h6>
                <div id="info-empleado"></div>
            </div>
            @endif

            <div class="mb-3">
                <label for="cUsuUsuario" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="cUsuUsuario" id="cUsuUsuario"
                    value="{{ old('cUsuUsuario', $usuario->cUsuUsuario) }}" required placeholder="Ingrese el nombre de usuario">
            </div>

            <div class="mb-3">
                <label for="cUsuPassword" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="cUsuPassword" id="cUsuPassword"
                     placeholder="Ingrese la contraseña">
            </div>

            <div class="mb-3">
                <label for="cUsuPassword_confirmation" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" name="cUsuPassword_confirmation" id="cUsuPassword_confirmation"
                     placeholder="Confirme la contraseña">
            </div>

            <div class="mb-3">
                <label for="cUsuRol" class="form-label">Rol</label>
                <select class="form-control" name="cUsuRol" id="cUsuRol" required>
                    <option value="" disabled selected>Seleccione un rol</option>
                    <option value="A" {{ old('cUsuRol', $usuario->cUsuRol) == 'A' ? 'selected' : '' }}>Administrador</option>
                    <option value="E" {{ old('cUsuRol', $usuario->cUsuRol) == 'E' ? 'selected' : '' }}>Empleado</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="fas fa-times"></i> Cerrar
        </button>
    </div>
</div>

<script>
    function buscarEmpleado() {
        const dni = document.getElementById('dni').value;

        // Validación de longitud del DNI
        if (dni.length !== 8) {
            Swal.fire({
                icon: 'error',
                title: 'DNI inválido',
                text: 'El DNI debe tener exactamente 8 dígitos.',
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                timer: 3000
            });
            return;
        }

        $.ajax({
            method: 'GET',
            url: `/empleado/buscar/${dni}`,
            success: function(res) {
                // Verifica que la respuesta sea válida
                if (res && res.cPerNombre && res.cPerApellido) {
                    document.getElementById('info-empleado').innerHTML = `
                        <p><strong>Nombre:</strong> ${res.cPerNombre}</p>
                        <p><strong>Apellido:</strong> ${res.cPerApellido}</p>
                    `;
                    document.getElementById('empleado-info').style.display = 'block';
                    Swal.fire({
                        icon: 'success',
                        title: 'Empleado encontrado',
                        text: 'Se encontró la información del empleado.',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'No encontrado',
                        text: 'No se encontró un empleado con ese DNI.',
                        position: 'top-end',
                        toast: true,
                        showConfirmButton: false,
                        timer: 3000
                    });
                    document.getElementById('empleado-info').style.display = 'none';
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error al buscar el empleado:", textStatus, errorThrown);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error al buscar el empleado. Intente de nuevo.',
                    position: 'top-end',
                    toast: true,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    }
</script>
