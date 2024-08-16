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
                   
                    if (response.rol === 1) {
                        window.location.href = 'campañas.php'; 
                    } else if (response.rol === 2) {
                        window.location.href = 'campañasAdmin.php'; 
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
