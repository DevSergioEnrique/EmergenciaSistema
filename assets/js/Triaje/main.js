import {
    listarTiposDocumento,
    listarFormasIngreso,
    listarMotivosIngreso,
    listarServicios,
    listarTiposDiagnosticos,
    listarGravedades,
    obtenerDiagnostico
} from './triaje.js';
import { configurarValidaciones } from "./Modules/validacionTipoDocumento.js";
import { autocompletadoPaciente } from './Modules/autocompletado.js';
import { configurarImpresion } from "./Modules/imprimir.js";
import { buscarMedicosPorServicio } from './Modules/selectMedicoPorServicio.js';
// import { buscarDiagnostico } from "./Modules/selectDiagnosticos.js";
import { limpiarFormulario } from './Modules/limpiarForm.js';

$(document).ready(function() {
    $('#diagnostico').select2();
});

$(document).ready(function () {

    $(".products-select2").select2({
      width: '100%',
      closeOnSelect: false,
      placeholder: '',
      minimumInputLength: 3,
      ajax: {
        url: "https://jsonplaceholder.typicode.com/users",
        dataType: 'json',
        delay: 250,
        data: function (query) {
          // add any default query here
          return query;
        },
        processResults: function (data) {
          // Tranforms the top-level key of the response object from 'items' to 'results'
          var results = [];
          data.forEach(e => {
            results.push({ id: e.id, text: e.name });
          });
  
          return {
            results: results
          };
        },
      },
      templateResult: formatResult
    });
    
    function formatResult(d) {
      if(d.loading) {
          return d.text;
      } 
  
      // Creating an option of each id and text
      $d = $('<option/>').attr({ 'value': d.value }).text(d.text);
  
      return $d;
  }
  
  });

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
    $('#medico').select2({});
    // $('#diagnostico').select2({});

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