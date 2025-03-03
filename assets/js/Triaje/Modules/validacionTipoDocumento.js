export function configurarValidaciones() {
    document.getElementById('tipoDocumento').addEventListener('change', actualizarTipoDocumento);
    document.getElementById('nmroDocumento').addEventListener('input', validarDocumento);
    document.getElementById('paciente').addEventListener('input', validarNombre);
}

function actualizarTipoDocumento() {
    const nmroDocumento = document.getElementById('nmroDocumento');
    const paciente = document.getElementById('paciente');
    const financiamiento = document.getElementById('financiamiento');
    const alertaFinanciamiento = document.getElementById('alerta-financiamiento');

    // Convertimos la colección de opciones en un array y recorremos con forEach
    Array.from(financiamiento.options).forEach(opcion => {
        if (opcion.value !== "" && opcion.disabled == true) {
            opcion.disabled = false; // Vuelva a habilitar las opciones
        }
    });
    
    alertaFinanciamiento.style.display = "none";
    alertaFinanciamiento.innerHTML = "";
    financiamiento.value = "";

    if (this.value == 0) { // "Sin Documento"
        nmroDocumento.value = "";
        nmroDocumento.disabled = true;
        nmroDocumento.placeholder = "NN"; // Placeholder para "Sin Documento"
        
        paciente.value = "";
        paciente.disabled = false;
        paciente.placeholder = "Apellidos y nombres";

        const opcionSIS = financiamiento.querySelector('option[value="2"]');
        if (opcionSIS) {
            opcionSIS.disabled = true; // Inhabilitar la opción
        }

        alertaFinanciamiento.style.display = "block"
        alertaFinanciamiento.innerHTML = "No registrado en el SIS";
        alertaFinanciamiento.style.backgroundColor = "black";
    } else {
        nmroDocumento.value = ""; // Restablecer el placeholder
        nmroDocumento.disabled = false;
        nmroDocumento.placeholder = "Inserte su número"; // Restablecer el placeholder

        paciente.disabled = true;
        paciente.placeholder = "Apellidos y Nombres";
        paciente.value = "";

        if (Number(this.value) !== 1 && Number(this.value) !== 2) {
            const opcionSIS = financiamiento.querySelector('option[value="2"]');
            if (opcionSIS) {
                opcionSIS.disabled = true; // Inhabilitar la opción
            }

            alertaFinanciamiento.style.display = "block"
            alertaFinanciamiento.innerHTML = "No registrado en el SIS";
            alertaFinanciamiento.style.backgroundColor = "black";
        }
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