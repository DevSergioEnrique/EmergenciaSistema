document.addEventListener('DOMContentLoaded', function () {
    const nombreInput = document.getElementById('nombre');

    nombreInput.addEventListener('input', function () {
        // Elimina cualquier carácter que no sea letra, número o Ñ
        this.value = this.value.replace(/[^a-zA-Z0-9ñÑ\s]/g, '');
    });
});