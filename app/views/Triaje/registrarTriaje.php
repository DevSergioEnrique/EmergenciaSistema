<?php
    $pageCss = ['pages/triaje-moderno.css'];
    getHeader();
?>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Registro de Triajes</span>
        </div>
        
        <!-- Contenedor con clase triaje-moderno para namespacing CSS -->
        <div class="triaje-moderno">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <i class="fas fa-user-injured me-2"></i>
                    Registro de Triaje Rápido
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data" id="triajeForm" target="_blank">
                        <div class="row g-4">
                            <!-- Columna Izquierda - Datos del Paciente -->
                            <div class="col-lg-6">
                                <div class="section-title">Datos del Paciente</div>
                                
                                <div class="form-field">
                                    <label for="tipoDocumento" class="form-label">Tipo de documento <span class="text-danger">*</span></label>
                                    <select id="tipoDocumento" name="tipoDocumento" class="form-select" required>
                                        <!-- Se poblará mediante JavaScript -->
                                    </select>
                                </div>
                                
                                <div class="form-field">
                                    <label for="nmroDocumento" class="form-label">Nro de documento <span class="text-danger">*</span></label>
                                    <input type="text" id="nmroDocumento" name="nmroDocumento" class="form-control" placeholder="Seleccione tipo de doc." disabled>
                                    <div class="hint-text">Ingrese el número sin espacios ni caracteres especiales</div>
                                </div>
                                
                                <div class="form-field">
                                    <label for="paciente" class="form-label">Paciente</label>
                                    <input type="text" id="paciente" name="paciente" class="form-control" placeholder="Apellidos y nombres" disabled>
                                </div>
                                
                                <div class="form-field">
                                    <label for="financiamiento" class="form-label">Financiamiento <span class="text-danger">*</span></label>
                                    <select id="financiamiento" name="financiamiento" class="form-select" required>
                                        <option value="" selected disabled>Seleccione</option>
                                        <option value="1">PARTICULAR</option>
                                        <option value="2">SIS</option>
                                        <option value="7">SALUD POL</option>
                                        <option value="19">SOAT</option>
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Columna Derecha - Información Médica -->
                            <div class="col-lg-6">
                                <div class="section-title">Información Médica</div>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="formaIngreso" class="form-label">Forma de ingreso <span class="text-danger">*</span></label>
                                            <select id="formaIngreso" name="formaIngreso" class="form-select" required>
                                                <!-- Se poblará mediante JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="motivoIngreso" class="form-label">Motivo de ingreso <span class="text-danger">*</span></label>
                                            <select id="motivoIngreso" name="motivoIngreso" class="form-select" required>
                                                <!-- Se poblará mediante JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="servicio" class="form-label">Servicio <span class="text-danger">*</span></label>
                                            <select id="servicio" name="servicio" class="form-select" required>
                                                <!-- Se poblará mediante JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="medico" class="form-label">Médico <span class="text-danger">*</span></label>
                                            <select id="medico" name="medico" class="form-select" disabled required>
                                                <option value="" selected disabled>Primero seleccione un servicio</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label for="diagnostico" class="form-label">Diagnóstico <span class="text-danger">*</span></label>
                                    <input type="text" id="diagnostico" name="diagnostico" class="form-control" list="listaDiagnosticos" placeholder="Seleccione" required>
                                    <datalist id="listaDiagnosticos"></datalist>
                                    <div class="hint-text">Máximo 200 caracteres</div>
                                </div>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="tipoDiagnostico" class="form-label">Tipo de diagnóstico <span class="text-danger">*</span></label>
                                            <select id="tipoDiagnostico" name="tipoDiagnostico" class="form-select" required>
                                                <!-- Se poblará mediante JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <label for="gravedad" class="form-label">Gravedad <span class="text-danger">*</span></label>
                                            <select id="gravedad" name="gravedad" class="form-select" required>
                                                <!-- Se poblará mediante JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <input type="hidden" name="accion" value="insertar_paciente">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Guardar
                                <span class="loader"></span>
                            </button>
                            <button type="reset" class="btn btn-outline-secondary" id="limpiarForm">
                                <i class="fas fa-eraser me-2"></i>Limpiar
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