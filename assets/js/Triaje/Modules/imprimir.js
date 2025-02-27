export function configurarImpresion() {
    document.getElementById('triajeForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const iframe = document.createElement('iframe');
        iframe.name = 'printIframe';
        iframe.style.display = 'none';
        document.body.appendChild(iframe);

        this.target = 'printIframe';
        this.submit();

        iframe.onload = function () {
            iframe.contentWindow.print();
        };
    });
}
