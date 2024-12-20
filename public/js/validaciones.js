document.addEventListener('DOMContentLoaded', function() {
    const registroForm = document.getElementById('registroForm');

    if (registroForm) {
        registroForm.addEventListener('submit', function(event) {
            let isValid = true;

            // Validar nombre
            const nombre = document.getElementById('nombre');
            if (nombre.value.trim() === '') {
                alert('El nombre es obligatorio.');
                isValid = false;
            }

            // Validar apellidos
            const apellidos = document.getElementById('apellidos');
            if (apellidos.value.trim() === '') {
                alert('Los apellidos son obligatorios.');
                isValid = false;
            }

            // Validar cédula
            const cedula = document.getElementById('cedula');
            if (cedula.value.trim() === '') {
                alert('La cédula es obligatoria.');
                isValid = false;
            }

            // Validar correo electrónico
            const correoElectronico = document.getElementById('correo_electronico');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (correoElectronico.value.trim() === '' || !emailPattern.test(correoElectronico.value)) {
                alert('El correo electrónico es obligatorio y debe ser válido.');
                isValid = false;
            }

            // Validar teléfono
            const telefono = document.getElementById('telefono');
            const phonePattern = /^[0-9]{10}$/; // Asumiendo que el teléfono tiene 10 dígitos
            if (telefono.value.trim() === '' || !phonePattern.test(telefono.value)) {
                alert('El teléfono es obligatorio y debe tener 10 dígitos.');
                isValid = false;
            }

            // Validar contraseña
            const contrasena = document.getElementById('contrasena');
            if (contrasena.value.trim() === '') {
                alert('La contraseña es obligatoria.');
                isValid = false;
            }

            // Validar rol
            const rol = document.getElementById('rol');
            if (rol.value.trim() === '') {
                alert('El rol es obligatorio.');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    }
});


