$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault(); // Evita el envío tradicional del formulario

        $.ajax({
            url: '../controllers/correoController.php', // Asegúrate de que la ruta sea correcta
            type: 'POST',
            data: $(this).serialize(), // Enviar datos del formulario
            success: function(response) {
                if (response.trim() === 'success') { // Usa trim() para eliminar espacios en blanco
                    toastr.success('El mensaje se ha enviado correctamente.');
                    
                    // Limpiar los campos del formulario
                    $('#contactForm')[0].reset();
                } else {
                    toastr.error('Error al enviar el mensaje.');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Error al enviar el mensaje.');
            }
        });
    });
});


