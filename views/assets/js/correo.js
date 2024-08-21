$(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault(); 

        $.ajax({
            url: '../controllers/correoController.php', 
            type: 'POST',
            data: $(this).serialize(), 
            success: function(response) {
                if (response.trim() === 'success') { 
                    toastr.success('El mensaje se ha enviado correctamente.');
                    
        
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


