export function configurarValidaciones() {
    document.getElementById('tipoDocumento').addEventListener('change', actualizarTipoDocumento);
    document.getElementById('nmroDocumento').addEventListener('input', validarDocumento);
    document.getElementById('paciente').addEventListener('input', validarNombre);
}

function actualizarTipoDocumento() {
    const nmroDocumento = document.getElementById('nmroDocumento');
    const paciente = document.getElementById('paciente');

    if (this.value == 0) { // "Sin Documento"
        nmroDocumento.value = ""; // Consultar lógica de negocio aquí
        nmroDocumento.disabled = true;
        nmroDocumento.placeholder = "NN"; // Placeholder para "Sin Documento"

        paciente.disabled = false;
        paciente.value = "";
    } else {
        nmroDocumento.value = ""; // Restablecer el placeholder
        nmroDocumento.disabled = false;
        nmroDocumento.placeholder = "Inserte su número"; // Restablecer el placeholder

        paciente.disabled = true;
        paciente.placeholder = "Apellidos y Nombres";
        paciente.value = "";
    }
}

function validarDocumento() {
    const tipoDocumento = document.getElementById('tipoDocumento').value;
    let valor = this.value.replace(/\D/g, '');

    const maxLength = {
        '1': 8,  // DNI
        '2': 10, // Carnet de Extranjería
        '3': 9,  // Pasaporte
        '4': 12  // Documento de Identidad Extranjera
    };

    this.value = valor.slice(0, maxLength[tipoDocumento] || 0);
}

function validarNombre() {
    this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
}