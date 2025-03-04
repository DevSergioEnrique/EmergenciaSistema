// export function buscarMedicosPorServicio() {
//     const servicio = document.getElementById("servicio");
//     const inputMedico = document.getElementById("medico");
//     const listaMedicos = document.getElementById("listaMedicos");

//     // Evento al cambiar el servicio
//     servicio.addEventListener("change", () => {
//         // Habilitar el campo de búsqueda y cambiar el placeholder
//         inputMedico.value = ""; // Limpiar el input
//         inputMedico.disabled = false;
//         inputMedico.placeholder = "Buscar médico...";
//         listaMedicos.innerHTML = ""; // Limpiar la lista de médicos
//     });

//     // Validar que solo se ingresen letras (incluyendo acentos y ñ)
//     inputMedico.addEventListener("input", () => {
//         // Expresión regular para permitir solo letras, espacios y caracteres con acentos
//         const regex = /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g;
//         // Reemplazar cualquier caracter no permitido
//         inputMedico.value = inputMedico.value.replace(regex, '');
//     });

//     // Aplicar debounce a la función buscarMedicos
//     const busquedaDebounce = debounce(buscarMedicos, 750);

//     // Evento input en el campo de búsqueda
//     inputMedico.addEventListener("input", (event) => {
//         const termino = event.target.value.trim(); // Obtener el término de búsqueda
//         const idServicio = servicio.value; // Obtener el ID del servicio

//         if (termino.length >= 1) { // Solo buscar si el término tiene al menos 2 caracteres
//             busquedaDebounce(termino, idServicio);
//         } else {
//             listaMedicos.innerHTML = ""; // Limpiar la lista si el término es muy corto
//         }
//     });
// }
import { obtenerDatos } from "./selectsNoDinamicos.js";

export function buscarMedicosPorServicio() {
    const servicio = document.getElementById("servicio");
    const selectMedico = document.getElementById("medico"); // Corregido a 'medico'

    servicio.addEventListener("change", () => {
        const idServicio = servicio.value;
        selectMedico.innerHTML = '<option value="" selected disabled>Cargando médicos...</option>';
        selectMedico.disabled = true;
        console.log(idServicio);
        

        if (idServicio) {
            obtenerDatos(
                `http://localhost/emergencia/triaje/obtenerMedicos/${idServicio}`,
                'medico',
                'IdMedico',
                'Medicos'
            );
            selectMedico.disabled = false;
        } else {
            selectMedico.innerHTML = '<option value="" selected disabled>Seleccione un servicio primero</option>';
            selectMedico.disabled = true;
        }
    });
}

async function buscarMedicos(termino, idServicio) {
    try {
        // Realizar la solicitud al servidor
        const response = await fetch(`http://localhost/emergencia/triaje/obtenerMedicos/${idServicio}`);
        
        // Verificar si la respuesta es exitosa
        if (!response.ok) {
            throw new Error(`Error en la solicitud: ${response.statusText}`);
        }

        // Parsear la respuesta como JSON
        const data = await response.json();

        // Verificar si data es un arreglo
        if (!Array.isArray(data)) {
            throw new Error("La respuesta del servidor no es un arreglo.");
        }

        // Filtrar los médicos que coincidan con el término de búsqueda
        const medicosFiltrados = data.filter(medico => {
            const palabras = medico.Medicos.toLowerCase().split(" "); // Separar nombres y apellidos
            return palabras.some(palabra => palabra.startsWith(termino.toLowerCase())); // Buscar en cualquier palabra
        });

        // Limpiar la lista actual de médicos
        listaMedicos.innerHTML = "";

        // Agregar las nuevas opciones al select
        medicosFiltrados.forEach(medico => {
            let option = document.createElement('option');
            option.textContent = capitalizar(medico.Medicos); // Texto visible en el select
            listaMedicos.appendChild(option); // Agregar la opción al select
        });
    } catch (error){
        console.error("Error:", error);
        alert("Ocurrió un error al cargar los médicos. Por favor, inténtalo de nuevo.");
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

function capitalizar(str) {
    if (!str) return ""; // Si el string está vacío, devolver un string vacío

    return str
        .toLowerCase() // Convertir todo a minúsculas
        .split(' ') // Dividir el string en palabras
        .map(word => word.charAt(0).toUpperCase() + word.slice(1)) // Capitalizar cada palabra
        .join(' '); // Unir las palabras en un solo string
}