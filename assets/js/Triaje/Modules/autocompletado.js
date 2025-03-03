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
    const alertaFinanciamiento = document.getElementById('alerta-financiamiento');

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
            alertaFinanciamiento.innerHTML = "No registrado en el SIS";
            alertaFinanciamiento.style.backgroundColor = "black";
            alertaFinanciamiento.style.display = "block";

            // Convertimos la colección de opciones en un array y recorremos con forEach
            Array.from(financiamiento.options).forEach(opcion => {
                if (opcion.value == "2") {
                    opcion.disabled = true; // Deshabilitar solo la opción del SIS (value="2")
                } else if (opcion.value == "") {
                    opcion.disabled = true; // Mantener deshabilitado el placeholder (value="")
                } else {
                    opcion.disabled = false; // Habilitar el resto de las opciones (values 1, 3, 4)
                }
            });

            return false; // Retornar false para indicar que no se encontró
        }

        // Autocompletar el campo del paciente
        pacienteInput.value = data.nombreCompleto;

        if (data.estado == "INACTIVO") {
            alertaFinanciamiento.innerHTML = "SIS Inactivo";
            alertaFinanciamiento.style.backgroundColor = "red";
            alertaFinanciamiento.style.display = "block";

            financiamiento.value = "";

            const opcionSIS = financiamiento.querySelector('option[value="2"]');
            if (opcionSIS) {
                opcionSIS.disabled = true; // Habilitar la opción
            }
            return true;
        }

        const opcionSIS = financiamiento.querySelector('option[value="2"]');
        if (opcionSIS.disabled = true) {
            opcionSIS.disabled = false; // Habilitar la opción
        }

        financiamiento.value = "2"; 

        alertaFinanciamiento.innerHTML = "SIS Activo";
        alertaFinanciamiento.style.backgroundColor = "green";
        alertaFinanciamiento.style.display = "block";
    
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