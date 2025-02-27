export function limpiarFormulario() {

    // Selects
    const tipoDocumento = document.getElementById('tipoDocumento');
    const formaIngreso = document.getElementById('formaIngreso');
    const motivoIngreso = document.getElementById('motivoIngreso');
    const servicio = document.getElementById('servicio');
    const tipoDiagnostico = document.getElementById('tipoDiagnostico');
    const gravedad = document.getElementById('gravedad');
    const financiamiento = document.getElementById('financiamiento');

    // Inputs
    const nmroDocumento = document.getElementById('nmroDocumento');
    const paciente = document.getElementById('paciente');
    const medico = document.getElementById('medico');
    const diagnostico = document.getElementById('diagnostico');
    const listaDiagnosticos = document.getElementById('listaDiagnosticos');

    const botonLimpiar = document.getElementById('limpiarForm');

    botonLimpiar.addEventListener("click", function() {
        limpiarForm();
    });
}

// Función para limpiar el formulario
function limpiarForm() {

    // Selects
    const selects = [tipoDocumento, formaIngreso, motivoIngreso, servicio, tipoDiagnostico, gravedad, financiamiento];
    selects.forEach(select => {
        select.value = ""; // Restablecer el valor a vacío
    });

    // Nmro documento
    nmroDocumento.value="";
    nmroDocumento.disabled=true;
    nmroDocumento.placeholder="Seleccione tipo de doc.";
    
    // Paciente
    paciente.value="";
    paciente.disabled=true;
    paciente.placeholder="Apellidos y nombres";

    // Medico
    medico.value="";
    medico.disabled = true;
    medico.placeholder = "Primero seleccione un servicio";

    // Diagnostico
    diagnostico.value="";
    listaDiagnosticos.innerHTML = "";

    // Financiamiento
    Array.from(financiamiento.options).forEach(opcion => {
        if (opcion.value !== "2" && opcion.value !== "") {
            opcion.disabled = false; // Vuelve a habilitar las opciones que no son "SIS"
        }
    });
}
