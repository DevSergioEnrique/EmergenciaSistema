<?php
    getHeader();
?>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Registro de Triajes</span>
        </div>
        <div class="container">
            <form action="" method="POST" enctype="multipart/form-data" id="triajeForm" target="_blank">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="tipoDocumento" class="form-label fw-bold">Tipo de documento</label>
                        <select id="tipoDocumento" name="tipoDocumento" class="form-control" required>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="nmroDocumento" class="form-label fw-bold">Nro de documento</label>
                        <input type="text" id="nmroDocumento" name="nmroDocumento" class="form-control" placeholder="Seleccione tipo de doc." disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="paciente" class="form-label fw-bold">Paciente</label>
                        <input type="text" id="paciente" name="paciente" class="form-control" placeholder="Apellidos y nombres" disabled>
                    </div>
                </div>
                <div class="row">
                    <!-- Campo: Forma de Ingreso -->
                    <div class="col-md-4 mb-3">
                        <label for="formaIngreso" class="form-label fw-bold">Forma de ingreso</label>
                        <select id="formaIngreso" name="formaIngreso" class="form-control" required>
                        </select>
                    </div>
                    <!-- Campo: Motivo de Ingreso -->
                    <div class="col-md-4 mb-3">
                        <label for="motivoIngreso" class="form-label fw-bold">Motivo de ingreso</label>
                        <select id="motivoIngreso" name="motivoIngreso" class="form-control" required>
                        </select>
                    </div>
                    <!-- Campo: Servicio -->
                    <div class="col-md-4 mb-3">
                        <label for="servicio" class="form-label fw-bold">Servicio</label>
                        <select id="servicio" name="servicio" class="form-control" placeholder="Seleccione" required>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="medico" class="form-label fw-bold">Médico</label>
                        <input type="text" id="medico" name="medico" class="form-control" list="listaMedicos" placeholder="Primero seleccione un servicio" disabled required>
                        <datalist id="listaMedicos"></datalist>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="diagnostico" class="form-label fw-bold">Diagnóstico</label>
                        <input type="text" id="diagnostico" name="diagnostico" class="form-control" list="listaDiagnosticos" placeholder="Seleccione" required>
                        <datalist id="listaDiagnosticos"></datalist>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="tipoDiagnostico" class="form-label fw-bold">Tipo de diagnóstico</label>
                        <select id="tipoDiagnostico" name="tipoDiagnostico" class="form-control" placeholder="Seleccione" required>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="gravedad" class="form-label fw-bold">Gravedad</label>
                        <select id="gravedad" name="gravedad" class="form-control" required>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="financiamiento" class="form-label fw-bold">Financiamiento</label>
                        <select id="financiamiento" name="financiamiento" class="form-control" required>
                            <option value="" selected disabled>Seleccione</option>
                            <option value="1">PARTICULAR</option>
                            <option value="2">SIS</option>
                            <option value="7">SALUD POL</option>
                            <option value="19">SOAT</option>
                        </select>
                    </div>
                </div>               
                <div class="mb-2">
                    <input type="hidden" name="accion" value="insertar_paciente">
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">💾 Guardar</button>
                        <button type="reset" class="btn btn-primary btn-lg"
                            aria-label="Limpiar formulario" id="limpiarForm">🧹 Limpiar</button>
                    </div>
                </div>
                <br></br>
            </form>
        </div>
    </div>
</div>

<iframe name="printIframe" style="display: none;"></iframe>
<script type ="module" src="<?= APP_URL ?>/assets/js/Triaje/main.js"></script>