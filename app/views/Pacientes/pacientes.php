<?php
    getHeader();
?>

<div class="dash-content">
    <div class="activity">
        <div class="title">
            <i class="uil uil-file-search-alt"></i>
            <span class="text">Resumen de pacientes</span>
        </div>
        <div class="container">
            <div class="activity-data table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Tipo Doc</th>
                            <th>Nro</th>
                            <th>Paciente</th>
                            <th>Medico</th>
                            <th>Diagnostico</th>
                            <th>Usuario</th>
                            <th>Registro</th>
                            <th>Add</th>
                            <th>Print</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<iframe name="printIframe" style="display: none;"></iframe>

<script src="<?= APP_URL ?>/assets/js/pacientes.js"></script>
</section>