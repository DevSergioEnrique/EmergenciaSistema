import { obtenerDatos, obtenerDatosSelect2 } from "./Modules/selectsNoDinamicos.js";

export async function listarTiposDocumento() {
    document.getElementById('tipoDocumento').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerTiposDocumento', 'tipoDocumento','IdDocIdentidad','Descripcion');
    });
}

export async function listarFormasIngreso() {
    document.getElementById('formaIngreso').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerFormasIngreso', 'formaIngreso', 'IdFormaIngreso', 'Descripcion');
    });
}

export async function listarMotivosIngreso() {
    document.getElementById('motivoIngreso').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerMotivosIngreso', 'motivoIngreso', 'IdMotivoIngreso', 'Descripcion');
    });
}

export async function listarServicios() {
    document.getElementById('servicio').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerServicios', 'servicio', 'IdServicio', 'Nombre');
        
    });
}

export async function obtenerDiagnostico() {
    const selectElement = document.getElementById('diagnostico');
    
    selectElement.addEventListener('click', async function() {
        if (this.options.length > 1) return;

        await obtenerDatos('http://localhost/emergencia/triaje/obtenerDiagnosticos', 'diagnostico', 'IdDiagnostico', 'Descripcion');
        
        // Initialize Select2 after data is loaded
        $(this).select2({
            theme: 'bootstrap-5',
            processResults: function(data) {
                return {
                    results: data.map(item => {
                        return {
                            id: item.IdDiagnostico,
                            text: [item.Descripcion, item.Codigo]
                        };
                    })
                };
            },
            placeholder: 'Seleccione un diagnóstico',
            allowClear: true,
        });
    });
}

export async function listarTiposDiagnosticos() {
    document.getElementById('tipoDiagnostico').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerTiposDiagnostico', 'tipoDiagnostico', 'IdSubclasificacionDx', 'Descripcion');
    }); 
}

export async function listarGravedades() {
    document.getElementById('gravedad').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerGravedades', 'gravedad','IdTipoGravedad', 'Descripcion');
    });
}
