export function autocompletadoPaciente() {
    const nmroDocumentoInput = document.getElementById('nmroDocumento');
    const tipoDocumento = document.getElementById('tipoDocumento');

    if (!tipoDocumento || !nmroDocumentoInput) {
        return;
    }

    nmroDocumentoInput.addEventListener('keydown', async function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // ¡Detiene el envío del formulario!

            const nmroDocumento = this.value.trim();
            if (!nmroDocumento) {
                return;
            }

            // Obtener el tipo de documento seleccionado
            const tipoDoc = tipoDocumento.value;

            // Primero buscar en el SIS
            const encontradoEnSIS = await buscarPacientePorSIS(tipoDoc, nmroDocumento);

            // Si no se encontró en el SIS, buscar en la BD
            if (!encontradoEnSIS) {
                await buscarPacientePorBD(tipoDoc, nmroDocumento);
            }
        }
    });
}

async function buscarPacientePorSIS(tipoDocumento, nmroDocumento) {
    const pacienteInput = document.getElementById('paciente');
    const financiamiento = document.getElementById('financiamiento');

    if (!pacienteInput) {
        console.error('No se encontró el campo "paciente".');
        return false;
    }

    // Validar que el número de documento no esté vacío
    if (!nmroDocumento) {
        return false;
    }

    try {
        const response = await fetch(`http://localhost/emergencia/api-sis/consulta-sis/${tipoDocumento}/${nmroDocumento}`);

        if (!response.ok) {
            throw new Error("Error en la solicitud.");
        }

        const data = await response.json();

        // Si hay un error en la respuesta (paciente no encontrado)
        if (data.error) {
            return false; // Retornar false para indicar que no se encontró
        }

        // Autocompletar el campo del paciente
        pacienteInput.value = data.nombreCompleto;
        financiamiento.value = 2;

        // Convertimos la colección de opciones en un array y recorremos con forEach
        Array.from(financiamiento.options).forEach(opcion => {
            if (opcion.value !== "2" && opcion.value !== "") {
                opcion.disabled = true; // Deshabilita las opciones que no son "SIS"
            }
        });
        return true; // Retornar true para indicar que se encontró

    } catch (error) {
        console.error('Error al buscar en el SIS:', error);
        alert(error.message + " Nivel: JavaScript");
        return false; // Retornar false en caso de error
    }
}

async function buscarPacientePorBD(tipoDocumento, nmroDocumento) {
    const pacienteInput = document.getElementById('paciente');
    const financiamiento = document.getElementById('financiamiento');

    if (!pacienteInput) {
        console.error('No se encontró el campo "paciente".');
        return;
    }

    // Validar que el número de documento no esté vacío
    if (!nmroDocumento) {
        return;
    }

    try {
        // Hacer la solicitud al backend
        const response = await fetch(`http://localhost/emergencia/triaje/obtenerPaciente/${tipoDocumento}/${nmroDocumento}`);

        if (!response.ok) {
            throw new Error("Error en la solicitud.");
        }

        // Convertir la respuesta a JSON
        const data = await response.json();

        if (data.error) {
            pacienteInput.value = "";
            pacienteInput.disabled = false;
            pacienteInput.placeholder = "No encontrado. Inserte sus nombres manualmente";
            return;
        }

        // Autocompletar el campo del paciente
        pacienteInput.value = data.Paciente;
        financiamiento.value = "";
    } catch (error) {
        console.error('Error al buscar en la BD:', error);
        alert(error.message + " Nivel: JavaScript");
    }
}