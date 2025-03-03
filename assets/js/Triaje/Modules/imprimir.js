export function configurarImpresion() {
    document.getElementById('triajeForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const iframe = document.createElement('iframe'); // Creación del iframe
        iframe.name = 'printIframe'; // Atributo name
        iframe.style.display = 'none'; // Ocultar
        document.body.appendChild(iframe);  // Agregar al body

        this.target = 'printIframe'; // 
        this.submit();

        iframe.onload = function () {
            iframe.contentWindow.print();
        };
    });
}
