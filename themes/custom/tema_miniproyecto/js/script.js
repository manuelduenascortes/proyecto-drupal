(function (Drupal) {
    Drupal.behaviors.registroFormulario = {
      attach: function (context, settings) {

        const formulario = document.querySelector('#registro-usuario-bloque');
        const formatoEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
        if (formulario) {
        formulario.addEventListener('submit', function(evento) {
            const emailUsuario = formulario.querySelector('input[name="email"]');
            const valorEmail = emailUsuario.value.trim();
            if (!formatoEmail.test(valorEmail)) {
                alert('Correo electrónico no válido.');
                evento.preventDefault();
            } else {
                console.log('Datos enviados.');
            }
        });
        }
    }
};
})(Drupal);