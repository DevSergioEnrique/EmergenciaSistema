export function buscarDiagnostico() {
    const diagnostico = document.getElementById("diagnostico");
    const listaDiagnosticos = document.getElementById("listaDiagnosticos");

    // Validar que solo se ingresen letras, números, espacios y algunos caracteres especiales
    diagnostico.addEventListener("input", () => {
        const regex = /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s0-9.-]/g; // Permitir letras, números, espacios, puntos y guiones
        diagnostico.value = diagnostico.value.replace(regex, '');
    });

    // Aplicar debounce a la función filtrarDiagnostico
    const busquedaDebounce = debounce(filtrarDiagnostico, 650);

    // Evento input en el campo de búsqueda
    diagnostico.addEventListener("input", (event) => {
        const termino = event.target.value.trim(); // Obtener el término de búsqueda

        if (termino.length >= 2) { // Solo buscar si el término tiene al menos 2 caracteres
            let segundoCaracter = termino.charAt(1); // Obtener el segundo carácter
            if (!isNaN(segundoCaracter) && segundoCaracter !== " ") {
                busquedaDebounce(termino, true);
            } else {
                busquedaDebounce(termino, false);
            }
        } else {
            listaDiagnosticos.innerHTML = ""; // Limpiar la lista si el término es muy corto
        }
    });
}

async function filtrarDiagnostico(termino, flag) {
    const listaDiagnosticos = document.getElementById("listaDiagnosticos");

    let endpoint;
    if (flag){
        endpoint = `http://localhost/emergencia/triaje/obtenerDiagnosticoPorCodigo/${termino}`;
    } else {
        endpoint = `http://localhost/emergencia/triaje/obtenerDiagnosticoPorDescripcion/${termino}`;
    }

    try {
        // Realizar la solicitud al servidor
        const response = await fetch(endpoint);

        // Verificar si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        // Parsear la respuesta como JSON
        const diagnosticos = await response.json();

        // Verificar si diagnosticos es un arreglo
        if (!Array.isArray(diagnosticos)) {
            return;
        }

        // Limpiar la lista actual de diagnósticos
        listaDiagnosticos.innerHTML = "";

        // Limitar a 8 opciones y agregarlas al datalist
        diagnosticos.forEach(diagnostico => {
            const option = document.createElement('option');
            option.value = diagnostico.Codigo + ' ' + diagnostico.Descripcion; // Texto visible en el datalist
            listaDiagnosticos.appendChild(option); // Agregar la opción al datalist
        });
    } catch (error) {
        console.error("Error:", error);
        alert("Ocurrió un error al cargar los diagnósticos. Por favor, inténtalo de nuevo.");
    }
}

// Función Debounce
function debounce(func, wait) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}