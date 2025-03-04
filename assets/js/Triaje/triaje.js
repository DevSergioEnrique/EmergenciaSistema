import { obtenerDatos } from "./Modules/selectsNoDinamicos.js";

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
    document.getElementById('diagnostico').addEventListener('click', function() {
        if (this.options.length > 1) return;
        obtenerDatos('http://localhost/emergencia/triaje/obtenerDiagnosticos', 'diagnostico', 'IdDiagnostico', 'Descripcion');
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
