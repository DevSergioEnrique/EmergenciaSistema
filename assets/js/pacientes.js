document.querySelectorAll('form[target="printIframe"]').forEach(form => {
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Enviar el formulario al iframe oculto y luego imprimir
        this.submit();
        this.target = 'printIframe';

        // Esperar a que el PDF se cargue en el iframe
        const iframe = document.getElementsByName('printIframe')[0];
        iframe.onload = function () {
            iframe.contentWindow.print();
        };
    });
});