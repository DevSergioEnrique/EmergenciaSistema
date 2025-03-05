import {
    listarTiposDocumento,
    listarFormasIngreso,
    listarMotivosIngreso,
    listarServicios,
    listarTiposDiagnosticos,
    listarGravedades,
    obtenerDiagnostico,
} from './triaje.js';
import { configurarValidaciones } from "./Modules/validacionTipoDocumento.js";
import { autocompletadoPaciente } from './Modules/autocompletado.js';
import { configurarImpresion } from "./Modules/imprimir.js";
import { buscarMedicosPorServicio } from './Modules/selectMedicoPorServicio.js';
import { limpiarFormulario } from './Modules/limpiarForm.js';

document.addEventListener('DOMContentLoaded', () => {
    // Selects
    listarTiposDocumento();
    listarFormasIngreso();
    listarMotivosIngreso();
    listarServicios();
    listarTiposDiagnosticos();
    listarGravedades();
    obtenerDiagnostico();
    
    //Select2 para el select de médicos
    $('#medico').select2({
      theme: 'bootstrap-5'
    });

    // Validación tipo de documento
    configurarValidaciones();

    // Autocompletado Paciente
    autocompletadoPaciente();

    // Select de médicos en base al servicio seleccionado
    buscarMedicosPorServicio();

    // Diagnosticos
    // buscarDiagnostico();

    // Imprimir resultado del formulario
    configurarImpresion();

    // Limpiar formulario
    limpiarFormulario();
});
