$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: '../controllers/inicioSesionController.php',
            type: 'POST',
            data: {
                op: 'autenticar',
                correo: $('#correo').val(),
                password: $('#password').val()
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Comprobar el rol del usuario y redirigir en consecuencia
                    if (response.rol === 1) {
                        window.location.href = 'campañas.php'; // Redirigir a la página para usuarios normales
                    } else if (response.rol === 2) {
                        window.location.href = 'campañasAdmin.php'; // Redirigir a la página para administradores
                    }
                } else {
                    $('#error-message').removeClass('d-none').text(response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });
});
