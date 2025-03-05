<?php
    getHeader();
    $pageCss = ['pages/triaje.css'];
?>

<link rel="stylesheet" href="<?= APP_URL ?>/assets/css/pages/triaje.css">

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Registro de Triajes</span>
        </div>
        
        <div class="container triaje-moderno">
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="fas fa-user-injured"></i>
                    Formulario de registro
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" id="triajeForm" target="_blank" class="needs-validation" novalidate>
                        <div class="row row-gap-4">
                            <!-- Columna Izquierda -->
                            <div class="col-lg-6">
                                <div class="section-title">Datos del Paciente</div>
                                
                                <div class="form-field">
                                    <label for="tipoDocumento" class="form-label">Tipo de documento<span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <select id="tipoDocumento" name="tipoDocumento" class="form-select" required>
                                        </select>
                                        <span class="input-group-icon"><i class="fas fa-address-card"></i></span>
                                    </div>
                                </div>
                                
                                <div class="form-field">
                                    <label for="nmroDocumento" class="form-label">Nro de documento<span class="text-danger">*</span></label>
                                    <div class="position-relative">
                                        <input type="text" id="nmroDocumento" name="nmroDocumento" class="form-control" placeholder="Seleccione tipo de doc." disabled>
                                        <span class="input-group-icon"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <div class="hint-text">Ingrese el número sin espacios ni caracteres especiales</div>
                                </div>
                                
                                <div class="form-field">
                                    <label for="paciente" class="form-label">Paciente</label>
                                    <input type="text" id="paciente" name="paciente" class="form-control" placeholder="Apellidos y nombres" disabled>
                                </div>
                                
                                <div class="form-field">
                                    <label for="financiamiento" class="form-label">Financiamiento<span class="text-danger">*</span></label>
                                    <select id="financiamiento" name="financiamiento" class="form-select" required>
                                        <option value="" selected disabled>Seleccione</option>
                                        <option value="1">PARTICULAR</option>
                                        <option value="2">SIS</option>
                                        <option value="7">SALUD POL</option>
                                        <option value="19">SOAT</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Columna Derecha -->
                            <div class="col-lg-6">
                                <div class="section-title">Información Médica</div>
                                
                                <div class="row row-gap-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="formaIngreso" class="form-label">Forma de ingreso<span class="text-danger">*</span></label>
                                            <select id="formaIngreso" name="formaIngreso" class="form-select" required>
                                                <!-- Las opciones se cargarán desde JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="motivoIngreso" class="form-label">Motivo de ingreso<span class="text-danger">*</span></label>
                                            <select id="motivoIngreso" name="motivoIngreso" class="form-select" required>
                                                <!-- Las opciones se cargarán desde JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row row-gap-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="servicio" class="form-label">Servicio<span class="text-danger">*</span></label>
                                            <select id="servicio" name="servicio" class="form-select" required>
                                                <!-- Las opciones se cargarán desde JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="medico" class="form-label">Médico<span class="text-danger">*</span></label>
                                            <select id="medico" name="medico" class="form-select" placeholder="Primero seleccione un servicio" disabled required>
                                                <option value="" selected disabled>Primero seleccione un servicio</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-field">
                                    <label for="diagnostico" class="form-label">Diagnóstico<span class="text-danger">*</span></label>
                                    <select id="diagnostico" name="diagnostico" class="form-control" placeholder="Seleccione" required>
                                        <!-- Las opciones se cargarán desde JavaScript -->
                                    <div class="hint-text">Escriba para buscar diagnósticos</div>
                                </div>
                                
                                <div class="row row-gap-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="tipoDiagnostico" class="form-label">Tipo de diagnóstico<span class="text-danger">*</span></label>
                                            <select id="tipoDiagnostico" name="tipoDiagnostico" class="form-select" required>
                                                <!-- Las opciones se cargarán desde JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="gravedad" class="form-label">Gravedad<span class="text-danger">*</span></label>
                                            <select id="gravedad" name="gravedad" class="form-select" required>
                                                <!-- Las opciones se cargarán desde JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="accion" value="insertar_paciente">
                        
                        <div class="button-group">
                            <button type="reset" class="btn btn-outline-secondary" id="limpiarForm">
                                <i class="fas fa-eraser me-2"></i>Limpiar
                            </button>
                            <button type="submit" class="btn-primary-modern">
                                <i class="fas fa-save me-2"></i>Guardar
                                <div class="loader" id="submitLoader"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<iframe name="printIframe" style="display: none;"></iframe>
<script type="module" src="<?= APP_URL ?>/assets/js/Triaje/main.js"></script>